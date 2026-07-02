<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function show(Cart $cart)
    {
        $this->authorizeCartItem($cart);

        $cart->load(['product.vendor', 'variant']);

        return view('checkout', [
            'cartItem' => $cart,
            'unitPrice' => $cart->unitPrice(),
            'subtotal' => $cart->subtotal(),
        ]);
    }

    public function saveUserInfo(Request $request, Cart $cart)
    {
        $this->authorizeCartItem($cart);

        $validated = $request->validate([
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string', 'max:255'],
        ]);

        auth()->user()->update($validated);

        return redirect()
            ->route('checkout.show', $cart)
            ->with('success', 'Delivery information saved successfully!');
    }

    public function store(Request $request, Cart $cart)
    {
        $this->authorizeCartItem($cart);

        // ✅ VALIDATION
        $data = $request->validate([
            'payment_method' => ['required', 'in:cod,esewa,khalti'],
            'shipping_address_id' => ['required', 'integer'], // adjust if you have table
        ]);

        $cart->load(['product', 'variant']);

        $product = $cart->product;
        $variant = $cart->variant;

        $availableStock = $variant?->stock ?? $product->stock;

        if ($cart->quantity > $availableStock) {
            return back()->withErrors([
                'quantity' => "Sorry, only {$availableStock} left in stock for {$product->name}.",
            ]);
        }

        $unitPrice = $cart->unitPrice();
        $subtotal = $cart->subtotal();

        // ✅ TRANSACTION
        $order = DB::transaction(function () use ($cart, $product, $variant, $data, $unitPrice, $subtotal) {

            // 1. CREATE ORDER
            $order = Order::create([
                'user_id' => auth()->id(),
                'shipping_address_id' => $data['shipping_address_id'],
                'total_amount' => $subtotal,
                'discount' => 0,
                'payment_method' => $data['payment_method'],
                'status' => 'pending',
            ]);

            // 2. CREATE ORDER ITEM
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

            // 3. DECREASE STOCK
            if ($variant) {
                $variant->decrement('stock', $cart->quantity);
            } else {
                $product->decrement('stock', $cart->quantity);
            }

            // 4. REMOVE CART ITEM
            $cart->delete();

            return $order;
        });

        return redirect()
            ->route('order.confirmation', $order)
            ->with('success', 'Order placed successfully!');
    }

    public function confirmation(Order $order)
    {
        abort_if($order->user_id !== auth()->id(), 403);

        $order->load(['orderItems.product', 'orderItems.vendor']);

        return view('order-confirmation', compact('order'));
    }

    private function authorizeCartItem(Cart $cart): void
    {
        abort_if($cart->user_id !== auth()->id(), 403);
    }
}
