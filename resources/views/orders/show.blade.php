<x-app-layout>

<x-slot name="header">
    <h2>Detail Pesanan</h2>
</x-slot>

<div style="padding:30px; display:flex; justify-content:center;">

    <div style="
        width:700px;
        background:white;
        padding:20px;
        border-radius:10px;
        box-shadow:0 2px 10px rgba(0,0,0,0.1);
    ">

        <table width="100%" border="1" cellpadding="10" cellspacing="0">

            <tr>
                <th width="30%">Data</th>
                <th>Informasi</th>
            </tr>

            <tr>
                <td>ID Pesanan</td>
                <td>{{ $order->id }}</td>
            </tr>

            <tr>
                <td>Nama</td>
                <td>{{ $order->customer_name }}</td>
            </tr>

            <tr>
                <td>Alamat</td>
                <td>{{ $order->address }}</td>
            </tr>

            <tr>
                <td>No HP</td>
                <td>{{ $order->phone }}</td>
            </tr>

            <tr>
                <td>Metode Pembayaran</td>
                <td>{{ $order->payment_method }}</td>
            </tr>

            <tr>
                <td>Total Belanja</td>
                <td>
                    Rp {{ number_format($order->total_amount,0,',','.') }}
                </td>
            </tr>

            <tr>
                <td>Status Pesanan</td>
                <td>{{ ucfirst($order->order_status) }}</td>
            </tr>

            <tr>
                <td>Tanggal Pesanan</td>
                <td>{{ $order->created_at }}</td>
            </tr>

        </table>

        <h3 style="margin-top:25px;">
    Produk yang Dibeli
</h3>

<table width="100%" border="1" cellpadding="10" cellspacing="0">

        <tr style="background:#ff7a00; color:white;">
            <th>Produk</th>
            <th>Qty</th>
            <th>Harga</th>
            <th>Subtotal</th>
        </tr>

        @foreach($order->items as $item)

        <tr>
            <td>{{ $item->product->name }}</td>

            <td>{{ $item->quantity }}</td>

            <td>
                Rp {{ number_format($item->price,0,',','.') }}
            </td>

            <td>
                Rp {{ number_format($item->quantity * $item->price,0,',','.') }}
            </td>
        </tr>

        @endforeach

</table>

        <div style="margin-top:20px;">

            <a href="{{ route('orders.index') }}"
                style="
                background:#ff7a00;
                color:white;
                padding:10px 15px;
                text-decoration:none;
                border-radius:6px;
                ">
                ← Kembali ke Pesanan Saya
            </a>

        </div>

    </div>

</div>

</x-app-layout>