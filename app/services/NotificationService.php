<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\Order;
use App\Models\Vendor;

class NotificationService
{
    /**
     * Call this right after a COD order is saved, or after eSewa/Khalti
     * confirm payment. Reads directly from the orders + order_items rows
     * that were just written — no extra queries beyond what's needed.
     */
    public static function orderPlaced(Order $order): void
    {
        // Load only what we need: the buyer's name, and each item's
        // vendor_id + product name + quantity + subtotal
        $order->loadMissing(['user', 'orderItems.product']);

        $customerName = $order->user->name;
        $paymentMethod = match ($order->payment_method) {
            'cod' => 'Cash on Delivery',
            'esewa' => 'eSewa',
            'khalti' => 'Khalti',
            default => $order->payment_method,
        };

        // One notification per vendor whose items are in this order
        foreach ($order->orderItems->groupBy('vendor_id') as $vendorId => $items) {

            $vendor = Vendor::find($vendorId);
            if (! $vendor?->user_id) {
                continue;
            }

            Notification::create([
                'user_id' => $vendor->user_id,
                'type' => Notification::TYPE_ORDER_PLACED,
                'title' => 'New Order Received',
                // Store the exact fields we want to show — pulled straight
                // from the order row that was just inserted
                'message' => json_encode([
                    'order_ref' => '#HK-'.str_pad($order->id, 5, '0', STR_PAD_LEFT),
                    'customer_name' => $customerName,
                    'payment_method' => $paymentMethod,
                    'amount' => 'Rs. '.number_format($items->sum('subtotal'), 2),
                    'quantity' => $items->sum('quantity'),
                    'products' => $items->map(fn ($i) => $i->product->name)->filter()->implode(', '),
                    'order_status' => $order->status,          // 'pending'
                    'placed_at' => $order->created_at->format('M j, Y  g:i A'),
                ]),
                'is_read' => false,
            ]);
        }
    }

    /**
     * Call this after eSewa/Khalti confirm payment (after orderPlaced).
     * Creates a second "Payment Received" notification with confirmed status.
     */
    public static function paymentConfirmed(Order $order): void
    {
        $order->loadMissing(['user', 'orderItems.product', 'payment']);

        $customerName = $order->user->name;
        $gateway = match (strtolower($order->payment?->gateway ?? '')) {
            'esewa' => 'eSewa',
            'khalti' => 'Khalti',
            default => ucfirst($order->payment_method),
        };

        foreach ($order->orderItems->groupBy('vendor_id') as $vendorId => $items) {

            $vendor = Vendor::find($vendorId);
            if (! $vendor?->user_id) {
                continue;
            }

            Notification::create([
                'user_id' => $vendor->user_id,
                'type' => Notification::TYPE_PAYMENT_RECEIVED,
                'title' => 'Payment Received',
                'message' => json_encode([
                    'order_ref' => '#HK-'.str_pad($order->id, 5, '0', STR_PAD_LEFT),
                    'customer_name' => $customerName,
                    'payment_method' => $gateway,
                    'amount' => 'Rs. '.number_format($items->sum('subtotal'), 2),
                    'quantity' => $items->sum('quantity'),
                    'products' => $items->map(fn ($i) => $i->product->name)->filter()->implode(', '),
                    'order_status' => 'confirmed',
                    'placed_at' => $order->created_at->format('M j, Y  g:i A'),
                ]),
                'is_read' => false,
            ]);
        }
    }
}
