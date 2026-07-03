<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Vendor;

class PageController extends Controller
{
    public function home()
    {
        // Fetch approved vendors with their active products
        $vendors = Vendor::where('status', 'approved')
            ->with(['products' => function ($query) {
                $query->where('status', 'active')->limit(8);
            }, 'products.category', 'products.images'])
            ->limit(10)
            ->get();

        // Fallback: Get featured active products if no vendor data
        $featuredProducts = Product::where('status', 'active')
            ->with(['category', 'vendor', 'images', 'variants'])
            ->inRandomOrder()
            ->limit(4)
            ->get();

        return view('welcome', [
            'vendors' => $vendors,
            'featuredProducts' => $featuredProducts,
        ]);
    }

    public function categories()
    {
        $categories = Category::where('status', 'active')->get();

        return view('categories', compact('categories'));
    }

    // Shared query logic for shop() and viewProduct()
    private function buildShopData(): array
    {
        // The actual price range across all active products — drives the
        // slider's min/max bounds so it's never a stale hardcoded number.
        $priceBounds = Product::where('status', 'active')
            ->selectRaw('MIN(price) as min_price, MAX(price) as max_price')
            ->first();

        $priceFloor = (int) floor($priceBounds->min_price ?? 0);
        $priceCeil = (int) ceil($priceBounds->max_price ?? 0);

        // Guard against a single-product / all-same-price catalogue, where
        // floor === ceil would collapse the slider to a single point.
        if ($priceCeil <= $priceFloor) {
            $priceCeil = $priceFloor + 100;
        }

        $query = Product::with(['category', 'vendor', 'images', 'variants'])
            ->where('status', 'active');

        if ($search = request('search')) {
            $query->where('name', 'like', "%{$search}%");
        }

        if (($categorySlug = request('category')) && $categorySlug !== 'all') {
            $query->whereHas('category', function ($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
        }

        if (request()->filled('min_price')) {
            $query->where('price', '>=', request('min_price'));
        }
        if (request()->filled('max_price')) {
            $query->where('price', '<=', request('max_price'));
        }

        if (request()->boolean('in_stock')) {
            $query->where('stock', '>', 0);
        }

        switch (request('sort')) {
            case 'price_asc':   $query->orderBy('price', 'asc');
                break;
            case 'price_desc':  $query->orderBy('price', 'desc');
                break;
            case 'popularity':  $query->withCount('orderItems')->orderBy('order_items_count', 'desc');
                break;
            default:            $query->latest();
        }

        return [
            'products' => $query->paginate(9)->withQueryString(),
            'categories' => Category::where('status', 'active')->get(),
            'priceFloor' => $priceFloor,
            'priceCeil' => $priceCeil,
        ];
    }

    public function shop()
    {
        return view('shop', $this->buildShopData());
    }

    public function new_arrival()
    {
        $products = Product::with(['category', 'vendor', 'images'])
            ->where('status', 'active')
            ->latest()
            ->paginate(8)
            ->withQueryString();

        return view('new_arrival', compact('products'));

    }

    public function todays_deals()
    {
        $dealsBase = Product::with(['category', 'vendor', 'images'])
            ->withCount('reviews')
            ->withAvg('reviews', 'rating')
            ->where('status', 'active')
            ->whereNotNull('discount_price')
            ->where('discount_price', '>', 0)
            ->whereColumn('discount_price', '<', 'price');

        if (($categorySlug = request('category')) && $categorySlug !== 'all') {
            $dealsBase->whereHas('category', function ($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
        }

        switch (request('sort')) {
            case 'price-asc':  $dealsBase->orderBy('discount_price', 'asc');
                break;
            case 'price-desc': $dealsBase->orderBy('discount_price', 'desc');
                break;
            default:           $dealsBase->orderByRaw('((price - discount_price) / price) DESC');
        }

        $products = $dealsBase->paginate(8)->withQueryString();

        $categories = Product::with('category')
            ->where('status', 'active')
            ->whereNotNull('discount_price')
            ->where('discount_price', '>', 0)
            ->whereColumn('discount_price', '<', 'price')
            ->get()
            ->pluck('category')
            ->filter()
            ->unique('id')
            ->values();

        $featuredDeals = Product::with(['category', 'vendor', 'images'])
            ->where('status', 'active')
            ->whereNotNull('discount_price')
            ->where('discount_price', '>', 0)
            ->whereColumn('discount_price', '<', 'price')
            ->orderByRaw('((price - discount_price) / price) DESC')
            ->take(5)
            ->get();

        $trendingProducts = Product::with(['category', 'vendor', 'images'])
            ->withCount('orderItems')
            ->where('status', 'active')
            ->orderByDesc('order_items_count')
            ->take(6)
            ->get();

        return view('todays-deals', compact('products', 'categories', 'featuredDeals', 'trendingProducts'));
    }

    public function top_sellers()
    {
        $products = Product::with(['category', 'vendor', 'images', 'variants'])
            ->where('status', 'active')
            ->withCount('orderItems')
            ->orderByDesc('order_items_count')
            ->take(12)
            ->get();

        if ($products->isEmpty()) {
            $products = collect([
                (object) [
                    'id' => 1,
                    'name' => 'Copper Singing Bowl',
                    'price' => 4500.00,
                    'discount_price' => null,
                    'image' => 'images/1st-image.png',
                    'category' => (object) ['cat_name' => 'Metalware'],
                    'vendor' => (object) ['vendor_name' => 'Patan Crafts'],
                    'description' => 'Experience the meditative resonance of ancient Patan copper singing bowls, hand-hammered with care.',
                    'rating' => 5,
                    'reviews_count' => 124,
                    'sales_count' => 842,
                    'tag' => 'Terai Plains',
                    'stock' => 10,
                ],
                (object) [
                    'id' => 2,
                    'name' => 'Thimi Crackle Bowl',
                    'price' => 3500.00,
                    'discount_price' => null,
                    'image' => 'images/2nd-image.png',
                    'category' => (object) ['cat_name' => 'Pottery'],
                    'vendor' => (object) ['vendor_name' => 'Kancha\'s Pottery'],
                    'description' => 'Authentic ceramic crackle bowl handmade by master artisans in Bhaktapur.',
                    'rating' => 4.5,
                    'reviews_count' => 92,
                    'sales_count' => 765,
                    'tag' => 'Bhaktapur',
                    'stock' => 15,
                ],
                (object) [
                    'id' => 3,
                    'name' => 'Patan Floral Lattice',
                    'price' => 2500.00,
                    'discount_price' => null,
                    'image' => 'images/Table.png',
                    'category' => (object) ['cat_name' => 'Woodcraft'],
                    'vendor' => (object) ['vendor_name' => 'Patan Woodcrafts'],
                    'description' => 'Beautifully hand-carved floral lattice wooden wall art panel.',
                    'rating' => 5,
                    'reviews_count' => 56,
                    'sales_count' => 610,
                    'tag' => 'Artisan Made',
                    'stock' => 5,
                ],
                (object) [
                    'id' => 4,
                    'name' => 'Hand-Woven Dhankuta Dhaka',
                    'price' => 2500.00,
                    'discount_price' => 2200.00,
                    'image' => 'images/4th-image.png',
                    'category' => (object) ['cat_name' => 'Textiles'],
                    'vendor' => (object) ['vendor_name' => 'Dhankuta Weavers'],
                    'description' => 'Intricately woven traditional Dhaka fabric, handmade in Dhankuta.',
                    'rating' => 4.5,
                    'reviews_count' => 84,
                    'sales_count' => 590,
                    'tag' => 'Dhankuta',
                    'stock' => 8,
                ],
                (object) [
                    'id' => 5,
                    'name' => 'Himalayan Lokta Journal',
                    'price' => 1500.00,
                    'discount_price' => 1200.00,
                    'image' => 'images/aboutus.jpg',
                    'category' => (object) ['cat_name' => 'Paper'],
                    'vendor' => (object) ['vendor_name' => 'Himalayan Paper St.'],
                    'description' => 'Eco-friendly journal made from traditional hand-pressed Lokta paper in Mustang.',
                    'rating' => 4,
                    'reviews_count' => 45,
                    'sales_count' => 480,
                    'tag' => 'Mustang',
                    'stock' => 20,
                ],
                (object) [
                    'id' => 6,
                    'name' => 'Silver Filigree Pendant',
                    'price' => 4500.00,
                    'discount_price' => null,
                    'image' => 'images/Jewlery and Accessory.png',
                    'category' => (object) ['cat_name' => 'Jewelry'],
                    'vendor' => (object) ['vendor_name' => 'Newar Silversmiths'],
                    'description' => 'Stunning handmade silver filigree pendant crafted in Kathmandu Valley.',
                    'rating' => 5,
                    'reviews_count' => 78,
                    'sales_count' => 450,
                    'tag' => 'Kathmandu Valley',
                    'stock' => 12,
                ],
                (object) [
                    'id' => 7,
                    'name' => 'Bhaktapur Clay Pot',
                    'price' => 1800.00,
                    'discount_price' => 1500.00,
                    'image' => 'images/pot.png',
                    'category' => (object) ['cat_name' => 'Pottery'],
                    'vendor' => (object) ['vendor_name' => 'Praiapati Clay Art'],
                    'description' => 'Traditional clay pot, perfect for cooking or decoration, fired in Bhaktapur.',
                    'rating' => 4.5,
                    'reviews_count' => 110,
                    'sales_count' => 410,
                    'tag' => 'Bhaktapur',
                    'stock' => 18,
                ],
                (object) [
                    'id' => 8,
                    'name' => 'Handwoven Wool Sweater',
                    'price' => 1899.00,
                    'discount_price' => 1299.00,
                    'image' => 'images/Sweaters.png',
                    'category' => (object) ['cat_name' => 'Textiles'],
                    'vendor' => (object) ['vendor_name' => 'The Wool Studio'],
                    'description' => 'Warm and cozy handwoven wool sweater made by artisans in Helambu.',
                    'rating' => 4.5,
                    'reviews_count' => 134,
                    'sales_count' => 380,
                    'tag' => 'Helambu',
                    'stock' => 10,
                ],
            ]);
        }

        return view('top-sellers', compact('products'));
    }

    public function about_us()
    {
        return view('about');
    }

    public function wishlist()
    {
        return view('wishlist');
    }

    public function privacy()
    {
        return view('privacy');
    }

    public function contactus()
    {
        return view('contact-us');
    }

    public function cart()
    {
        return view('cart');
    }

    public function terms_conditions()
    {
        return view('terms-conditions');
    }

    public function return_policy()
    {
        return view('return-policy');
    }

    public function viewProduct($id)
    {
        $product = Product::with(['category', 'vendor', 'images', 'variants'])->findOrFail($id);

        $product->effective_price = method_exists($product, 'effectivePrice') ? $product->effectivePrice() : $product->price;
        $product->original_price = method_exists($product, 'originalPrice') ? $product->originalPrice() : $product->price;
        $product->discount_price = method_exists($product, 'resolvedDiscountPrice') ? $product->resolvedDiscountPrice() : $product->discount_price;
        $product->primary_image_url = method_exists($product, 'primaryImageUrl') ? $product->primaryImageUrl() : asset($product->image);
        $product->category_name = $product->category?->cat_name ?? $product->category?->name ?? 'Crafts';
        $product->vendor_name = $product->vendor?->vendor_name ?? $product->vendor?->name ?? 'Local Artisan';

        // Track recently viewed products in session (store product IDs)
        $recentlyViewed = session()->get('recently_viewed', []);
        // Remove if already exists to avoid duplicates
        $recentlyViewed = array_filter($recentlyViewed, fn ($pid) => $pid != $id);
        // Prepend current product
        array_unshift($recentlyViewed, (int) $id);
        // Keep only last 20
        $recentlyViewed = array_slice($recentlyViewed, 0, 20);
        session()->put('recently_viewed', $recentlyViewed);

        return view('shop', array_merge($this->buildShopData(), [
            'activeProduct' => $product,
        ]));
    }
}
