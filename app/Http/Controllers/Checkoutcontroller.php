<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ShippingAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    /**
     * Show the checkout page for ONE cart line. Every product checks out
     * on its own — this is intentional, so a cart with items from two
     * different vendors always results in two separate orders.
     */
    public function show(Cart $cart)
    {
        $this->authorizeCartItem($cart);

        $cart->load(['product.vendor', 'variant']);

        return view('checkout', [
            'cartItem' => $cart,
            'addresses' => auth()->user()->shippingAddresses,
            'unitPrice' => $cart->unitPrice(),
            'subtotal' => $cart->subtotal(),
        ]);
    }

    /**
     * Place the order for this single cart line.
     */
    public function store(Request $request, Cart $cart)
    {
        $this->authorizeCartItem($cart);

        $data = $request->validate([
            'shipping_address_id' => ['required', 'exists:shipping_addresses,id'],
            'payment_method' => ['required', 'string', 'in:cod,esewa,khalti'],
        ]);

        $address = ShippingAddress::where('id', $data['shipping_address_id'])
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $cart->load(['product', 'variant']);
        $product = $cart->product;
        $variant = $cart->variant;

        // Re-check stock right before placing the order — it may have
        // changed since the item was added to the cart.
        $availableStock = $variant?->stock ?? $product->stock;

        if ($cart->quantity > $availableStock) {
            return back()->withErrors([
                'quantity' => "Sorry, only {$availableStock} left in stock for {$product->name}.",
            ]);
        }

        $unitPrice = $cart->unitPrice();
        $subtotal = $cart->subtotal();

        $order = DB::transaction(function () use ($cart, $product, $variant, $address, $data, $unitPrice, $subtotal) {
            $order = Order::create([
                'user_id' => auth()->id(),
                'shipping_address_id' => $address->id,
                'total_amount' => $subtotal,
                'discount' => 0,
                'payment_method' => $data['payment_method'],
                'status' => 'pending',
            ]);

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'variant_id' => $variant?->id,
                'vendor_id' => $product->vendor_id,
                'quantity' => $cart->quantity,
                'price' => $unitPrice,
                'subtotal' => $subtotal,
                'status' => 'pending',
            ]);

            if ($variant) {
                $variant->decrement('stock', $cart->quantity);
            } else {
                $product->decrement('stock', $cart->quantity);
            }

            // This item has been ordered — take it out of the cart.
            $cart->delete();

            return $order;
        });

        return redirect()
            ->route('order.confirmation', $order)
            ->with('success', 'Order placed successfully!');
    }

    /**
     * Simple confirmation page for a single placed order.
     */
    public function confirmation(Order $order)
    {
        abort_if($order->user_id !== auth()->id(), 403);

        $order->load(['orderItems.product', 'orderItems.vendor', 'shippingAddress']);

        return view('order-confirmation', compact('order'));
    }

    private function authorizeCartItem(Cart $cart): void
    {
        abort_if($cart->user_id !== auth()->id(), 403);
    }
}
