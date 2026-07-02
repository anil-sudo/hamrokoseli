<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class EsewaPaymentController extends Controller
{
    /**
     * eSewa doesn't have a "create session, get a URL back" API like
     * Khalti — instead you build a signed HTML form and the customer's
     * browser POSTs it straight to eSewa. This shows a tiny page that
     * auto-submits that form.
     */
    public function initiate(Order $order): View
    {
        abort_if($order->user_id !== auth()->id(), 403);

        $config = config('services.esewa');

        // Unique per attempt (not just per order) so the customer can retry
        // a failed payment without eSewa rejecting a re-used transaction id.
        $transactionUuid = $order->id.'-'.now()->timestamp;

        $totalAmount = number_format((float) $order->total_amount, 2, '.', '');

        $signedFieldNames = 'total_amount,transaction_uuid,product_code';
        $message = "total_amount={$totalAmount},transaction_uuid={$transactionUuid},product_code={$config['product_code']}";
        $signature = base64_encode(hash_hmac('sha256', $message, $config['secret_key'], true));

        // Track this attempt so the callback below can look it up and
        // verify it, the same way we do for Khalti's pidx.
        Payment::updateOrCreate(
            ['order_id' => $order->id],
            [
                'user_id' => $order->user_id,
                'gateway' => 'esewa',
                'total_amount' => $order->total_amount,
                'status' => 'pending',
                'reference_id' => $transactionUuid,
            ]
        );

        return view('esewa-redirect', [
            'formUrl' => $config['form_url'],
            'fields' => [
                'amount' => $totalAmount,
                'tax_amount' => '0',
                'total_amount' => $totalAmount,
                'transaction_uuid' => $transactionUuid,
                'product_code' => $config['product_code'],
                'product_service_charge' => '0',
                'product_delivery_charge' => '0',
                'success_url' => route('esewa.callback'),
                'failure_url' => route('esewa.callback'),
                'signed_field_names' => $signedFieldNames,
                'signature' => $signature,
            ],
        ]);
    }

    /**
     * eSewa redirects the customer's browser back here (both on success and
     * failure) with a base64-encoded `data` query param. We never trust
     * that on its own — we re-verify with eSewa's status-check API first.
     */
    public function callback(Request $request)
    {
        $encoded = $request->query('data');

        if (! $encoded) {
            return redirect()
                ->route('cart')
                ->withErrors(['payment' => 'Invalid payment response from eSewa.']);
        }

        $decoded = json_decode(base64_decode($encoded), true);

        if (! is_array($decoded) || empty($decoded['transaction_uuid'])) {
            return redirect()
                ->route('cart')
                ->withErrors(['payment' => 'Invalid payment response from eSewa.']);
        }

        $payment = Payment::where('reference_id', $decoded['transaction_uuid'])->first();

        abort_if(! $payment, 404);
        abort_if($payment->user_id !== auth()->id(), 403);

        $config = config('services.esewa');

        // Server-to-server confirmation — this is the source of truth,
        // not the query string the browser was redirected with.
        $response = Http::get($config['status_url'], [
            'product_code' => $config['product_code'],
            'total_amount' => number_format((float) $payment->total_amount, 2, '.', ''),
            'transaction_uuid' => $decoded['transaction_uuid'],
        ]);

        if ($response->failed()) {
            Log::error('eSewa status check failed', [
                'order_id' => $payment->order_id,
                'response' => $response->body(),
            ]);

            return redirect()
                ->route('cart')
                ->withErrors(['payment' => 'Could not verify the eSewa payment. Please try again.']);
        }

        $status = $response->json('status');

        if ($status === 'COMPLETE') {
            $payment->markAsCompleted($response->json('ref_id') ?? $decoded['transaction_uuid']);
            $payment->order->update(['status' => 'confirmed']);

            return redirect()
                ->route('order.confirmation', $payment->order)
                ->with('success', 'Payment successful! Your order has been placed.');
        }

        $payment->markAsFailed();

        return redirect()
            ->route('cart')
            ->withErrors(['payment' => "eSewa payment wasn't completed (status: {$status}). Please try again."]);
    }
}
