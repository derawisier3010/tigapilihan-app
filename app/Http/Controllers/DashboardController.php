<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->category;

        if ($category) {
            $products = Product::where('category', $category)->latest()->get();
        } else {
            $products = Product::latest()->get();
        }

        return view('dashboard', compact('products', 'category'));
    }
}