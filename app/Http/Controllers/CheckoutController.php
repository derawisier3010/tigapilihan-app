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
            $total += $item['price'] * $item['quantity'];
        }

        $user = Auth::user();

        // SIMPAN ORDER
        $order = Order::create([
        'user_id' => $user->id,
        'customer_name' => $user->name,
        'address' => $user->address,
        'phone' => $user->phone,
        'payment_method' => $request->metode,
        'total_amount' => $total,
        'order_status' => 'pending',
        'order_date' => now(),
    ]);

        foreach ($cart as $productId => $item) {

    $product = Product::find($productId);

    // CEK STOK
    if ($product->stock < $item['quantity']) {

        return back()->with(
            'error',
            'Stok '.$product->name.' tidak mencukupi'
        );
    }

        // SIMPAN DETAIL PESANAN
        OrderItem::create([
        'order_id' => $order->id,
        'product_id' => $productId,
        'quantity' => $item['quantity'],
        'price' => $item['price']
    ]);

        // KURANGI STOK
        $product->stock -= $item['quantity'];
        $product->save();
    }
        // KOSONGKAN KERANJANG
        session()->forget('cart');

        return redirect('/products')
            ->with('success', 'Pesanan berhasil dibuat!');
    }
}