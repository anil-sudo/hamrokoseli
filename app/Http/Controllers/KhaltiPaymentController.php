<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class KhaltiPaymentController extends Controller
{
    /**
     * Kick off a Khalti ePayment for an order that was just created
     * (see CheckoutController::store()). Sends the customer to Khalti's
     * hosted checkout page.
     */
    public function initiate(Order $order): RedirectResponse
    {
        abort_if($order->user_id !== auth()->id(), 403);

        $secretKey = config('services.khalti.secret_key');

        if (! $secretKey) {
            Log::error('Khalti secret key is not configured.');

            return redirect()
                ->route('cart')
                ->withErrors(['payment' => 'Online payment is not configured yet. Please choose Cash on Delivery.']);
        }

        $user = auth()->user();

        $response = Http::withHeaders([
            'Authorization' => 'Key '.$secretKey,
        ])->post(rtrim(config('services.khalti.base_url'), '/').'/epayment/initiate/', [
            'return_url' => route('khalti.callback'),
            'website_url' => config('app.url'),
            // Khalti expects the amount in paisa (rupees × 100).
            'amount' => (int) round($order->total_amount * 100),
            'purchase_order_id' => (string) $order->id,
            'purchase_order_name' => 'HamroKoseli Order #'.$order->id,
            'customer_info' => [
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
            ],
        ]);

        if ($response->failed()) {
            Log::error('Khalti initiate failed', [
                'order_id' => $order->id,
                'response' => $response->json(),
            ]);

            return redirect()
                ->route('cart')
                ->withErrors(['payment' => 'Could not start the Khalti payment. Please try again or choose Cash on Delivery.']);
        }

        $data = $response->json();

        // Track the pidx against this order's payment row so the callback
        // below can verify it once the customer comes back from Khalti.
        Payment::updateOrCreate(
            ['order_id' => $order->id],
            [
                'user_id' => $user->id,
                'gateway' => 'khalti',
                'total_amount' => $order->total_amount,
                'status' => 'pending',
                'reference_id' => $data['pidx'] ?? null,
            ]
        );

        return redirect()->away($data['payment_url']);
    }

    /**
     * Khalti redirects the customer's browser back here after they pay
     * (or cancel). We never trust the query string on its own — we
     * re-verify the payment server-side via Khalti's lookup API first.
     */
    public function callback(Request $request): RedirectResponse
    {
        $pidx = $request->query('pidx');

        if (! $pidx) {
            return redirect()
                ->route('cart')
                ->withErrors(['payment' => 'Invalid payment response from Khalti.']);
        }

        $payment = Payment::where('reference_id', $pidx)->first();

        abort_if(! $payment, 404);
        abort_if($payment->user_id !== auth()->id(), 403);

        $response = Http::withHeaders([
            'Authorization' => 'Key '.config('services.khalti.secret_key'),
        ])->post(rtrim(config('services.khalti.base_url'), '/').'/epayment/lookup/', [
            'pidx' => $pidx,
        ]);

        $data = $response->json();
        $status = $data['status'] ?? 'Failed';

        if ($status === 'Completed') {
            $payment->markAsCompleted($data['transaction_id'] ?? $pidx);
            $payment->order->update(['status' => 'confirmed']);

            return redirect()
                ->route('order.confirmation', $payment->order)
                ->with('success', 'Payment successful! Your order has been placed.');
        }

        $payment->markAsFailed();

        return redirect()
            ->route('cart')
            ->withErrors(['payment' => "Khalti payment wasn't completed (status: {$status}). Please try again."]);
    }
}
