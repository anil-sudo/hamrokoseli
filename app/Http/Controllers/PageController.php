<?php

namespace App\Http\Controllers;

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
        return view('shop');
    }

    public function new_arrival()
    {
        return view('new_arrival');
    }

    public function todays_deals()
    {
        return view('todays-deals');
    }

    public function featured_products()
    {
        return view('featured-products');
    }

    public function top_sellers()
    {
        return view('top-sellers');
    }

    public function about_us()
    {
        return view('about');
    }
}
