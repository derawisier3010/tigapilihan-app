<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class AdminController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->get();

        return view('admin.index', compact('orders'));
    }

    public function updateStatus($id)
    {
        $order = Order::findOrFail($id);

        // ubah status berurutan
        if ($order->status == 'pending') {
            $order->status = 'diproses';
        } elseif ($order->status == 'diproses') {
            $order->status = 'selesai';
        }

        $order->save();

        return back()->with('success', 'Status berhasil diupdate');
    }

    public function show($id)
{
    $order = \App\Models\Order::findOrFail($id);
    return view('admin.show', compact('order'));
}

public function destroy($id)
{
    $order = \App\Models\Order::findOrFail($id);
    $order->delete();

    return redirect()->back()->with('success', 'Pesanan berhasil dihapus');
}
}