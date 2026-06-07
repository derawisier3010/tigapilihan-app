<x-app-layout>

<x-slot name="header">
    <h2>Detail Pesanan</h2>
</x-slot>

<div style="padding:30px; display:flex; justify-content:center;">

    <div style="
        width:600px;
        background:white;
        padding:25px;
        border-radius:15px;
        box-shadow:0 5px 20px rgba(0,0,0,0.1);
    ">

        <!-- BACK -->
        <a href="/admin" style="
            text-decoration:none;
            color:#ff7a00;
            font-weight:500;
        ">
            Kembali ke Dashboard
        </a>

        <h3 style="margin-top:20px;">Informasi Pelanggan</h3>

        <hr>

        <p><b>Nama:</b> {{ $order->nama }}</p>
        <p><b>Alamat:</b> {{ $order->alamat }}</p>
        <p><b>No HP:</b> {{ $order->no_hp }}</p>

        <h3 style="margin-top:20px;">Detail Pesanan</h3>

        <hr>

        <h4>Produk yang Dibeli</h4>

        <table border="1" width="100%" cellpadding="8"
            style="border-collapse:collapse; margin-bottom:20px;">

            <tr style="background:#ff7a00; color:white;">
                <th>Produk</th>
                <th>Qty</th>
                <th>Harga</th>
                <th>Subtotal</th>
            </tr>

            @foreach($order->items as $item)
            <tr>
                <td>{{ $item->product->nama }}</td>
                <td>{{ $item->qty }}</td>
                <td>Rp {{ number_format($item->harga,0,',','.') }}</td>
                <td>
                    Rp {{ number_format($item->qty * $item->harga,0,',','.') }}
                </td>
            </tr>
            @endforeach

        </table>

        <p><b>Metode Pembayaran:</b> {{ $order->metode }}</p>
        <p><b>Total:</b> Rp {{ number_format($order->total, 0, ',', '.') }}</p>

        <p><b>Status:</b> 
            @if($order->status == 'pending')
                <span style="color:red;">Pending</span>
            @elseif($order->status == 'diproses')
                <span style="color:orange;">Diproses</span>
            @else
                <span style="color:green;">Selesai</span>
            @endif
        </p>

<!-- BUTTON STATUS -->
        @if($order->status == 'pending')
            <div style="margin-top:15px;">
                <a href="{{ route('admin.update', $order->id) }}"
                   style="
                    background:#ffc107;
                    color:black;
                    padding:10px 18px;
                    border-radius:8px;
                    text-decoration:none;
                    display:inline-block;
                   ">
                    Proses Pesanan
                </a>
            </div>

 @elseif($order->status == 'diproses')
            <div style="margin-top:15px;">
                <a href="{{ route('admin.update', $order->id) }}"
                   style="
                    background:#28a745;
                    color:white;
                    padding:10px 18px;
                    border-radius:8px;
                    text-decoration:none;
                    display:inline-block;
                   ">
                    Selesaikan Pesanan
                </a>
            </div>
        @endif

        <!-- BUTTON -->
        <div style="margin-top:25px; text-align:right;">
            <a href="/admin" style="
                background:#ff7a00;
                color:white;
                padding:10px 20px;
                border-radius:8px;
                text-decoration:none;
            ">
                Kembali
            </a>
        </div>

    </div>

</div>

</x-app-layout>