<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $kategori = $request->kategori;

        if ($kategori) {
            $products = Product::where('kategori', $kategori)->latest()->get();
        } else {
            $products = Product::latest()->get();
        }

        return view('dashboard', compact('products', 'kategori'));
    }
}