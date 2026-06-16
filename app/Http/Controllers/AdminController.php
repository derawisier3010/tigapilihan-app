<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use App\Models\OrderLog;

class AdminController extends Controller
{
   public function index()
    {
        $orders = Order::latest()->get();

        $totalUser = User::count();
        $totalProduk = Product::count();
        $totalPesanan = Order::count();
        $pending = Order::where('order_status', 'pending')->count();

        return view('admin.index', compact(
            'orders',
            'totalUser',
            'totalProduk',
            'totalPesanan',
            'pending'
        ));
    }

  public function updateStatus($id)
    {
        $order = Order::findOrFail($id);

        $oldStatus = $order->order_status;

        if ($order->order_status == 'pending') {
            $order->order_status = 'diproses';
        } elseif ($order->order_status == 'diproses') {
            $order->order_status = 'selesai';
        }

        $newStatus = $order->order_status;

        $order->save();

        OrderLog::create([
            'order_id' => $order->id,
            'admin_id' => auth()->id(),
            'old_status' => $oldStatus,
            'new_status' => $newStatus,
        ]);

        return back()->with('success', 'Status berhasil diupdate');
    }

    public function show($id)
    {
        $order = Order::with([
            'items.product',
            'logs.admin'
        ])->findOrFail($id);

        return view('admin.show', compact('order'));
    }

    public function destroy($id)
    {
        $order = \App\Models\Order::findOrFail($id);
        $order->delete();

        return redirect()->back()->with('success', 'Pesanan berhasil dihapus');
    }

    public function users()
    {
        $users = User::latest()->get();

        return view('admin.users', compact('users'));
    }

    public function changeRole($id)
    {
        $user = User::findOrFail($id);

        if ($user->role == 'user') {
            $user->role = 'admin';
        } else {
            $user->role = 'user';
        }

        $user->save();

        return back()->with('success', 'Role berhasil diubah');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        // Tidak bisa hapus akun sendiri
        if ($user->id == auth()->id()) {
            return back()->with('success', 'Tidak dapat menghapus akun yang sedang login');
        }

        // Tidak bisa hapus admin
        if ($user->role == 'admin') {
            return back()->with('success', 'Admin tidak dapat dihapus');
        }

        $user->delete();

        return back()->with('success', 'User berhasil dihapus');
    }

}