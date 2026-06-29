<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use App\Models\OrderLog;

class AdminController extends Controller
{
   public function index(Request $request)
    {
        $query = Order::query();

        // Filter Tahun
        if ($request->filled('year')) {
            $query->whereYear('order_date', $request->year);
        }

        // Filter Bulan
        if ($request->filled('month')) {
            $query->whereMonth('order_date', $request->month);
        }

        $orders = $query
            ->orderBy('order_date', 'desc')
            ->get();

        $totalUser = User::count();
        $totalProduk = Product::count();
        $totalPesanan = Order::count();
        $pending = Order::where('order_status', 'pending')->count();

        $selectedMonth = $request->month;
        $selectedYear = $request->year;
        $totalFilteredOrders = $orders->count();

        return view('admin.index', compact(
            'orders',
            'totalUser',
            'totalProduk',
            'totalPesanan',
            'pending',
            'selectedMonth',
            'selectedYear',
            'totalFilteredOrders'
        ));
    }

   public function updateStatus($id)
    {
        $order = Order::findOrFail($id);

        $oldStatus = $order->order_status;

        /*
        |--------------------------------------------------------------------------
        | Pending -> Diproses
        |--------------------------------------------------------------------------
        */

        if ($order->order_status == 'pending') {

            $order->order_status = 'diproses';

        }

        /*
        |--------------------------------------------------------------------------
        | Diproses -> Dikirim
        |--------------------------------------------------------------------------
        */

        elseif ($order->order_status == 'diproses') {

            $order->order_status = 'dikirim';

        }

        /*
        |--------------------------------------------------------------------------
        | Dikirim
        |--------------------------------------------------------------------------
        | Tidak boleh diubah admin lagi.
        | Menunggu user menekan tombol "Pesanan Diterima"
        |--------------------------------------------------------------------------
        */

        elseif ($order->order_status == 'dikirim') {

            return back()->with(
                'error',
                'Pesanan sedang dalam pengiriman dan menunggu konfirmasi dari customer.'
            );

        }

        $newStatus = $order->order_status;

        $order->save();

        OrderLog::create([
            'order_id'   => $order->id,
            'admin_id'   => auth()->id(),
            'old_status' => $oldStatus,
            'new_status' => $newStatus,
        ]);

        return back()->with(
            'success',
            'Status pesanan berhasil diperbarui.'
        );
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

    public function verifyPayment($id)
    {
        $order = Order::findOrFail($id);

        $order->payment_status = 'Sudah Diverifikasi';
        $order->save();

        return back()->with(
            'success',
            'Pembayaran berhasil diverifikasi.'
        );
    }

    public function rejectPayment(Request $request, $id)
    {
        $request->validate([
            'payment_note' => 'required'
        ]);

        $order = Order::findOrFail($id);

        $order->payment_status = 'Ditolak';
        $order->payment_note = $request->payment_note;

        $order->save();

        return redirect()
            ->route('admin.show', $order->id)
            ->with('success', 'Pembayaran berhasil ditolak.');
    }

    public function showRejectForm($id)
    {
        $order = Order::findOrFail($id);

        return view('admin.reject-payment', compact('order'));
    }


}