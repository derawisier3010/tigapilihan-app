<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $cart = session()->get('cart', []);

        if ($request->isMethod('post')) {

            $selectedItems = $request->selected_items ?? [];

            if (empty($selectedItems)) {
                return redirect()->back()
                    ->with('error', 'Pilih minimal 1 produk untuk checkout');
            }

            $selectedCart = [];

            foreach ($selectedItems as $id) {

                if (isset($cart[$id])) {
                    $selectedCart[$id] = $cart[$id];
                }

            }

            session()->put('checkout_cart', $selectedCart);

            $cart = $selectedCart;
        } else {

            $cart = session()->get('checkout_cart', []);

        }

        return view('checkout.index', compact('cart'));
    }

    public function process(Request $request)
    {
        $cart = session()->get('checkout_cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')
                ->with('error', 'Keranjang checkout kosong');
        }

        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $user = Auth::user();

        $transferProof = null;
        $paymentStatus = 'Belum Dibayar';

        if ($request->metode == 'Transfer') {

            $request->validate([
                'transfer_proof' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            $transferProof = $request->file('transfer_proof')
                ->store('transfer_proofs', 'public');

            $paymentStatus = 'Menunggu Verifikasi';
        }

        $order = Order::create([
            'user_id' => $user->id,
            'customer_name' => $user->name,
            'address' => $user->address,
            'phone' => $user->phone,
            'payment_method' => $request->metode,
            'transfer_proof' => $transferProof,
            'payment_status' => $paymentStatus,
            'total_amount' => $total,
            'order_status' => 'pending',
            'order_date' => now(),
        ]);

        foreach ($cart as $productId => $item) {

            $product = Product::find($productId);

            if (!$product) {
                continue;
            }

            if ($product->stock < $item['quantity']) {

                return back()->with(
                    'error',
                    'Stok '.$product->name.' tidak mencukupi'
                );
            }

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'quantity' => $item['quantity'],
                'price' => $item['price']
            ]);

            $product->stock -= $item['quantity'];
            $product->save();
        }

        $mainCart = session()->get('cart', []);

        foreach ($cart as $productId => $item) {
            unset($mainCart[$productId]);
        }

        session()->put('cart', $mainCart);

        session()->forget('checkout_cart');

        return redirect('/products')
            ->with('success', 'Pesanan berhasil dibuat!');
    }
}
