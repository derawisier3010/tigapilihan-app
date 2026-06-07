<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

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

        $user = Auth::user();

        // SIMPAN ORDER
        $order = Order::create([
            'user_id' => $user->id,
            'nama' => $user->name,
            'alamat' => $user->alamat,
            'no_hp' => $user->no_hp,
            'metode' => $request->metode,
            'total' => $total,
            'status' => 'pending',
        ]);

        foreach ($cart as $productId => $item) {

    $product = Product::find($productId);

    // CEK STOK
    if ($product->stok < $item['qty']) {

        return back()->with(
            'error',
            'Stok '.$product->nama.' tidak mencukupi'
        );
    }

        // SIMPAN DETAIL PESANAN
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $productId,
            'qty' => $item['qty'],
            'harga' => $item['harga']
        ]);

        // KURANGI STOK
        $product->stok -= $item['qty'];
        $product->save();
    }
        // KOSONGKAN KERANJANG
        session()->forget('cart');

        return redirect('/products')
            ->with('success', 'Pesanan berhasil dibuat!');
    }
}