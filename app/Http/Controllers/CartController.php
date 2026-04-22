<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
   public function add($id)
{
    $product = \App\Models\Product::findOrFail($id);

    $cart = session()->get('cart', []);

    if(isset($cart[$id])) {
        $cart[$id]['qty'] += 1;
    } else {
        $cart[$id] = [
            "nama" => $product->nama,
            "harga" => $product->harga,
            "gambar" => $product->gambar,
            "qty" => 1
        ];
    }

    session()->put('cart', $cart);

    return redirect()->back();
}

public function increase($id)
{
    $cart = session()->get('cart');

    if(isset($cart[$id])) {
        $cart[$id]['qty']++;
        session()->put('cart', $cart);
    }

    return redirect()->back();
}

public function decrease($id)
{
    $cart = session()->get('cart');

    if(isset($cart[$id])) {
        if($cart[$id]['qty'] > 1) {
            $cart[$id]['qty']--;
        } else {
            unset($cart[$id]);
        }
        session()->put('cart', $cart);
    }

    return redirect()->back();
}

public function index()
{
    $cart = session()->get('cart', []);
    return view('cart.index', compact('cart'));
}

}
