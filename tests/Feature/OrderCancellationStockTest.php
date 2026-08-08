<?php

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ShippingAddress;
use App\Models\User;
use App\Models\Vendor;

describe('Order Cancellation Stock Restock', function () {
    it('restocks product stock when order is cancelled', function () {
        $user = User::factory()->create();

        $vendor = Vendor::create([
            'user_id' => $user->id,
            'vendor_name' => 'Test Vendor',
            'owner_name' => 'Owner Name',
            'email' => 'vendor@test.com',
            'phone' => '9800000000',
            'status' => 'active',
        ]);

        $category = Category::create([
            'cat_name' => 'Electronics',
            'slug' => 'electronics',
            'status' => 'active',
        ]);

        $shipping = ShippingAddress::create([
            'user_id' => $user->id,
            'label' => 'Home',
            'address' => 'Kathmandu',
            'city' => 'Kathmandu',
            'province' => 'Bagmati',
            'phone' => '9800000000',
        ]);

        $product = Product::create([
            'vendor_id' => $vendor->id,
            'category_id' => $category->id,
            'name' => 'Test Product',
            'slug' => 'test-product',
            'price' => 100,
            'stock' => 10,
            'sku' => 'TEST-100',
            'status' => 'active',
        ]);

        $order = Order::create([
            'user_id' => $user->id,
            'shipping_address_id' => $shipping->id,
            'total_amount' => 200,
            'status' => 'pending',
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'variant_id' => null,
            'vendor_id' => $vendor->id,
            'quantity' => 2,
            'price' => 100,
            'subtotal' => 200,
            'status' => 'pending',
        ]);

        // When order is cancelled, stock should increase by 2 (10 -> 12)
        $order->cancel();

        expect($product->fresh()->stock)->toBe(12);
    });

    it('restocks variant stock when order with variant is cancelled', function () {
        $user = User::factory()->create();

        $vendor = Vendor::create([
            'user_id' => $user->id,
            'vendor_name' => 'Test Vendor 2',
            'owner_name' => 'Owner Name 2',
            'email' => 'vendor2@test.com',
            'phone' => '9800000001',
            'status' => 'active',
        ]);

        $category = Category::create([
            'cat_name' => 'Fashion',
            'slug' => 'fashion',
            'status' => 'active',
        ]);

        $shipping = ShippingAddress::create([
            'user_id' => $user->id,
            'label' => 'Home',
            'address' => 'Kathmandu',
            'city' => 'Kathmandu',
            'province' => 'Bagmati',
            'phone' => '9800000000',
        ]);

        $product = Product::create([
            'vendor_id' => $vendor->id,
            'category_id' => $category->id,
            'name' => 'Test T-Shirt',
            'slug' => 'test-tshirt',
            'price' => 500,
            'stock' => 5,
            'sku' => 'TSHIRT-001',
            'status' => 'active',
        ]);

        $variant = ProductVariant::create([
            'product_id' => $product->id,
            'sku' => 'TSHIRT-RED-L',
            'size' => 'L',
            'color' => 'Red',
            'price' => 500,
            'stock' => 8,
            'status' => 'active',
        ]);

        $order = Order::create([
            'user_id' => $user->id,
            'shipping_address_id' => $shipping->id,
            'total_amount' => 1500,
            'status' => 'pending',
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'variant_id' => $variant->id,
            'vendor_id' => $vendor->id,
            'quantity' => 3,
            'price' => 500,
            'subtotal' => 1500,
            'status' => 'pending',
        ]);

        // When order is cancelled, variant stock should increase from 8 to 11
        $order->cancel();

        expect($variant->fresh()->stock)->toBe(11);
        expect($product->fresh()->stock)->toBe(5);
    });

    it('re-deducts stock if cancelled order status is reverted', function () {
        $user = User::factory()->create();

        $vendor = Vendor::create([
            'user_id' => $user->id,
            'vendor_name' => 'Test Vendor 3',
            'owner_name' => 'Owner Name 3',
            'email' => 'vendor3@test.com',
            'phone' => '9800000002',
            'status' => 'active',
        ]);

        $category = Category::create([
            'cat_name' => 'Books',
            'slug' => 'books',
            'status' => 'active',
        ]);

        $shipping = ShippingAddress::create([
            'user_id' => $user->id,
            'label' => 'Home',
            'address' => 'Kathmandu',
            'city' => 'Kathmandu',
            'province' => 'Bagmati',
            'phone' => '9800000000',
        ]);

        $product = Product::create([
            'vendor_id' => $vendor->id,
            'category_id' => $category->id,
            'name' => 'Test Book',
            'slug' => 'test-book',
            'price' => 200,
            'stock' => 10,
            'sku' => 'BOOK-001',
            'status' => 'active',
        ]);

        $order = Order::create([
            'user_id' => $user->id,
            'shipping_address_id' => $shipping->id,
            'total_amount' => 200,
            'status' => 'pending',
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'variant_id' => null,
            'vendor_id' => $vendor->id,
            'quantity' => 2,
            'price' => 200,
            'subtotal' => 400,
            'status' => 'pending',
        ]);

        // Cancel order: stock becomes 12
        $order->cancel();
        expect($product->fresh()->stock)->toBe(12);

        // Revert to confirmed: stock becomes 10 again
        $order->update(['status' => 'confirmed']);
        expect($product->fresh()->stock)->toBe(10);
    });
});
