<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('checkout.index', compact('cart'));
    }

    public function process(Request $request)
{
    $cart = session()->get('cart', []);

    $total = 0;

    foreach ($cart as $item) {
        $total += $item['harga'] * $item['qty'];
    }

    Order::create([
        'nama' => $request->nama,
        'alamat' => $request->alamat,
        'no_hp' => $request->no_hp,
        'metode' => $request->metode,
        'total' => $total,
        'status' => 'pending'
    ]);

    // kosongkan cart setelah checkout
    session()->forget('cart');

    return redirect('/products')->with('success', 'Pesanan berhasil dibuat!');
}
}
