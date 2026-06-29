<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
        {
            $query = Order::where('user_id', Auth::id());

            // Filter Status
            if ($request->filled('status')) {
                $query->where('order_status', $request->status);
            }

            // Filter Bulan
            if ($request->filled('month')) {
                $query->whereMonth('order_date', $request->month);
            }

            // Filter Tahun
            if ($request->filled('year')) {
                $query->whereYear('order_date', $request->year);
            }

            $orders = $query
                ->orderBy('order_date', 'desc')
                ->get();

            $selectedStatus = $request->status;
            $selectedMonth = $request->month;
            $selectedYear = $request->year;
            $totalFilteredOrders = $orders->count();

            return view('orders.index', compact(
                'orders',
                'selectedStatus',
                'selectedMonth',
                'selectedYear',
                'totalFilteredOrders'
            ));
        }
        
   public function show($id)
    {
        $order = Order::with('items.product')
                    ->where('user_id', Auth::id())
                    ->findOrFail($id);

        return view('orders.show', compact('order'));
    }

    public function showUploadProof($id)
    {
        $order = \App\Models\Order::findOrFail($id);

        // Pastikan hanya pemilik pesanan yang bisa mengakses
        if ($order->user_id != auth()->id()) {
            abort(403);
        }

        return view('orders.upload-proof', compact('order'));
    }

    public function uploadProof(Request $request, $id)
    {
        $request->validate([
            'transfer_proof' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $order = \App\Models\Order::findOrFail($id);

        if ($order->user_id != auth()->id()) {
            abort(403);
        }

        // Upload bukti baru
        $path = $request->file('transfer_proof')
            ->store('transfer_proofs', 'public');

        // Update data pembayaran
        $order->transfer_proof = $path;
        $order->payment_status = 'Menunggu Verifikasi';
        $order->payment_note = null;

        $order->save();

        return redirect()
            ->route('orders.show', $order->id)
            ->with('success', 'Bukti transfer berhasil diupload ulang.');
    }

    public function confirmReceived($id)
    {
        $order = Order::findOrFail($id);

        // Pastikan hanya pemilik pesanan
        if ($order->user_id != auth()->id()) {
            abort(403);
        }

        // Hanya bisa dikonfirmasi jika status sudah dikirim
        if ($order->order_status != 'dikirim') {

            return back()->with(
                'error',
                'Pesanan belum dapat dikonfirmasi.'
            );

        }

        $oldStatus = $order->order_status;

        // Ubah status menjadi selesai
        $order->order_status = 'selesai';

        // Khusus COD otomatis lunas
        if (
            $order->payment_method == 'COD'
            && $order->payment_status == 'Belum Dibayar'
        ) {

            $order->payment_status = 'Lunas';

        }

        $order->save();

        // Simpan ke order_logs
        OrderLog::create([
        'order_id'   => $order->id,
        'admin_id'   => null,
        'old_status' => $oldStatus,
        'new_status' => 'selesai',
    ]);

        return redirect()
            ->route('orders.show', $order->id)
            ->with(
                'success',
                'Terima kasih. Pesanan telah selesai.'
            );
    }
}