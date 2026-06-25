<?php

namespace App\Http\Controllers;

use App\Models\Product;

class PageController extends Controller
{
    public function home()
    {
        return view('welcome');
    }

    public function categories()
    {
        return view('categories');
    }

    public function shop()
    {
        $products = Product::with(['category', 'vendor', 'images'])
            ->where('status', 'active')
            ->latest()
            ->get();

        return view('shop', compact('products'));
    }

    public function new_arrival()
    {
        return view('new_arrival');
    }

    public function todays_deals()
    {
        // Fetch active products with category and vendor relationships that have discounts
        $products = Product::with(['category', 'vendor'])
            ->where('status', 'active')
            ->whereNotNull('discount_price')
            ->whereColumn('discount_price', '<', 'price')
            ->take(12)
            ->get();

        if ($products->isEmpty()) {
            // High fidelity mock discounted products matching database schema fields
            $products = collect([
                (object) [
                    'id' => 8,
                    'name' => 'Handwoven Wool Sweater',
                    'price' => 1899.00,
                    'discount_price' => 1299.00,
                    'image' => 'images/Sweaters.png',
                    'category' => (object) ['cat_name' => 'Textiles'],
                    'vendor' => (object) ['vendor_name' => 'The Wool Studio'],
                    'description' => 'Warm and cozy handwoven merino wool sweater from the Himalayas, perfect for cold weather.',
                    'rating' => 4.5,
                    'reviews_count' => 134,
                    'sales_count' => 380,
                    'tag' => 'Helambu',
                    'stock' => 10,
                ],
                (object) [
                    'id' => 106,
                    'name' => 'Bamboo Sunglasses',
                    'price' => 1299.00,
                    'discount_price' => 899.00,
                    'image' => 'images/SunGlass.png',
                    'category' => (object) ['cat_name' => 'Accessories'],
                    'vendor' => (object) ['vendor_name' => 'Eco Eyewear'],
                    'description' => 'Eco-friendly and stylish hand-crafted wooden sunglasses made from sustainable bamboo.',
                    'rating' => 4.5,
                    'reviews_count' => 89,
                    'sales_count' => 290,
                    'tag' => 'Handmade',
                    'stock' => 15,
                ],
                (object) [
                    'id' => 103,
                    'name' => 'Solid Wood Coffee Table',
                    'price' => 15999.00,
                    'discount_price' => 12999.00,
                    'image' => 'images/Table.png',
                    'category' => (object) ['cat_name' => 'Woodcraft'],
                    'vendor' => (object) ['vendor_name' => 'Patan Woodcrafts'],
                    'description' => 'Durable coffee table hand-crafted from solid Nepalese Shorea wood, featuring traditional floral lattices.',
                    'rating' => 5,
                    'reviews_count' => 56,
                    'sales_count' => 610,
                    'tag' => 'Artisan Made',
                    'stock' => 5,
                ],
                (object) [
                    'id' => 7,
                    'name' => 'Bhaktapur Clay Pot',
                    'price' => 1800.00,
                    'discount_price' => 1500.00,
                    'image' => 'images/pot.png',
                    'category' => (object) ['cat_name' => 'Pottery'],
                    'vendor' => (object) ['vendor_name' => 'Praiapati Clay Art'],
                    'description' => 'Traditional clay pot, perfect for cooking or decoration, fired in Bhaktapur kiln.',
                    'rating' => 4.5,
                    'reviews_count' => 110,
                    'sales_count' => 410,
                    'tag' => 'Bhaktapur',
                    'stock' => 18,
                ],
                (object) [
                    'id' => 4,
                    'name' => 'Hand-Woven Dhankuta Dhaka',
                    'price' => 2500.00,
                    'discount_price' => 2200.00,
                    'image' => 'images/4th-image.png',
                    'category' => (object) ['cat_name' => 'Textiles'],
                    'vendor' => (object) ['vendor_name' => 'Dhankuta Weavers'],
                    'description' => 'Intricately woven traditional Dhaka fabric, handmade by women artisans in Dhankuta.',
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
                    'id' => 1,
                    'name' => 'Copper Singing Bowl',
                    'price' => 5500.00,
                    'discount_price' => 4500.00,
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
                    'price' => 4200.00,
                    'discount_price' => 3500.00,
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
            ]);
        }

        return view('todays-deals', compact('products'));
    }

    public function featured_products()
    {
        return view('featured-products');
    }

    public function top_sellers()
    {
        // Fetch active products with category and vendor relationships
        $products = Product::with(['category', 'vendor'])
            ->where('status', 'active')
            ->take(12)
            ->get();

        if ($products->isEmpty()) {
            // High fidelity mock data for frontend demonstration matching standard database schema fields
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
}
