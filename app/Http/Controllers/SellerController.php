<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function dashboard()
    {
        return view('seller.dashboard');
    }

    public function product_management()
    {
        abort_if(auth()->user()->cannot('view products'), 403, 'You do not have permission to view products.');

        return view('seller.product-management');
    }

    public function store(Request $request)
    {
        abort_if(auth()->user()->cannot('create products'), 403, 'You do not have permission to create products.');
        // your create logic here
    }

    public function update(Request $request, $id)
    {
        abort_if(auth()->user()->cannot('update products'), 403, 'You do not have permission to update products.');
        // your update logic here
    }

    public function destroy($id)
    {
        abort_if(auth()->user()->cannot('delete products'), 403, 'You do not have permission to delete products.');
        // your delete logic here
    }
}
