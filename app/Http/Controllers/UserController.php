<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();

        $totalOrders = $user->orders()->count();
        $pendingOrders = $user->orders()->where('status', 'pending')->count();
        $deliveredOrders = $user->orders()->where('status', 'delivered')->count();
        $canceledOrders = $user->orders()->where('status', 'cancelled')->count();

        $recentOrders = $user->orders()->with('orderItems.product.images')->latest()->take(4)->get();

        // ─── TOP DISCOUNTS ────────────────────────────────────────────────────
        // Fetch ALL active discounted products, sorted by highest discount %
        $topDiscounts = Product::with(['images', 'variants', 'category'])
            ->where('status', 'active')
            ->get()
            ->filter(fn ($p) => $p->hasDiscount())
            ->sortByDesc(function ($p) {
                $orig = $p->originalPrice();

                return $orig > 0 ? (($orig - $p->effectivePrice()) / $orig) * 100 : 0;
            })
            ->values();

        // ─── RECOMMENDED FOR YOU ─────────────────────────────────────────────
        // Collect category IDs from 3 sources: Purchase History, Wishlist, Recently Viewed

        // Source 1: Purchase History
        $purchasedProductIds = OrderItem::whereHas('order', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })
            ->pluck('product_id')
            ->unique()
            ->toArray();

        $purchasedCategoryIds = Product::whereIn('id', $purchasedProductIds)
            ->whereNotNull('category_id')
            ->pluck('category_id')
            ->unique()
            ->toArray();

        // Source 2: Wishlist
        $wishlistProductIds = Wishlist::where('user_id', $user->id)
            ->pluck('product_id')
            ->unique()
            ->toArray();

        $wishlistCategoryIds = Product::whereIn('id', $wishlistProductIds)
            ->whereNotNull('category_id')
            ->pluck('category_id')
            ->unique()
            ->toArray();

        // Source 3: Recently Viewed (session)
        $recentlyViewedIds = session()->get('recently_viewed', []);

        $recentlyViewedCategoryIds = Product::whereIn('id', $recentlyViewedIds)
            ->whereNotNull('category_id')
            ->pluck('category_id')
            ->unique()
            ->toArray();

        // Merge all category IDs
        $recommendedCategoryIds = array_unique(array_merge(
            $purchasedCategoryIds,
            $wishlistCategoryIds,
            $recentlyViewedCategoryIds
        ));

        // Exclude products user already bought
        $excludeProductIds = array_unique(array_merge($purchasedProductIds, []));

        // Determine recommendation label for the view
        $recommendationSource = 'Popular Products'; // default fallback label
        if (! empty($purchasedCategoryIds)) {
            $recommendationSource = 'Based on Your Purchases';
        } elseif (! empty($wishlistCategoryIds)) {
            $recommendationSource = 'Based on Your Wishlist';
        } elseif (! empty($recentlyViewedCategoryIds)) {
            $recommendationSource = 'Based on Your Recently Viewed';
        }

        if (! empty($recommendedCategoryIds)) {
            $recommendedProducts = Product::with('images')
                ->where('status', 'active')
                ->whereIn('category_id', $recommendedCategoryIds)
                ->whereNotIn('id', $excludeProductIds)
                ->inRandomOrder()
                ->take(4)
                ->get();

            // Fill up to 4 with popular products if not enough from history
            if ($recommendedProducts->count() < 4) {
                $moreProducts = Product::with('images')
                    ->where('status', 'active')
                    ->whereNotIn('id', $recommendedProducts->pluck('id')->toArray())
                    ->withCount('orderItems')
                    ->orderByDesc('order_items_count')
                    ->take(4 - $recommendedProducts->count())
                    ->get();
                $recommendedProducts = $recommendedProducts->merge($moreProducts);
                if ($recommendedProducts->count() >= 4) {
                    $recommendationSource .= ' & Popular Items';
                }
            }
        } else {
            // No history at all — show most popular products
            $recommendationSource = 'Popular Products';
            $recommendedProducts = Product::with('images')
                ->where('status', 'active')
                ->withCount('orderItems')
                ->orderByDesc('order_items_count')
                ->take(4)
                ->get();
        }

        return view('user.dashboard', compact(
            'user',
            'totalOrders',
            'pendingOrders',
            'deliveredOrders',
            'canceledOrders',
            'recentOrders',
            'recommendedProducts',
            'recommendationSource',
            'topDiscounts'
        ));
    }

    public function orders()
    {
        return view('user.orders');
    }

    public function orderDetail()
    {
        return view('user.order-details');
    }

    public function returnProduct()
    {
        return view('user.return');
    }

    public function userProfile()
    {
        $user = auth()->user();

        return view('user.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:150|unique:users,email,'.$user->id,
            'phone' => 'nullable|string|max:20',
            'profile_pic' => 'nullable|image|max:2048',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        if ($request->hasFile('profile_pic')) {
            $path = $request->file('profile_pic')->store('profiles', 'public');
            $user->profile_pic = $path;
        }

        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function userNotification()
    {
        return view('user.notification');
    }
}
