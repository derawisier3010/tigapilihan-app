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
                <td>Status Pembayaran</td>

                <td>
                    @if($order->payment_status == 'Belum Dibayar')

                        <span style="
                            background:#dc3545;
                            color:white;
                            padding:5px 10px;
                            border-radius:6px;
                        ">
                            Belum Dibayar
                        </span>

                    @elseif($order->payment_status == 'Menunggu Verifikasi')

                        <span style="
                            background:#ffc107;
                            color:black;
                            padding:5px 10px;
                            border-radius:6px;
                        ">
                            Menunggu Verifikasi
                        </span>

                    @elseif($order->payment_status == 'Ditolak')

                        <span style="
                            background:#dc3545;
                            color:white;
                            padding:5px 10px;
                            border-radius:6px;
                        ">
                            Ditolak
                        </span>

                    @elseif($order->payment_status == 'Lunas')

                        <span style="
                            background:#28a745;
                            color:white;
                            padding:5px 10px;
                            border-radius:6px;
                        ">
                            Lunas
                        </span>

                    @elseif($order->payment_status == 'Sudah Diverifikasi')

                        <span style="
                            background:#28a745;
                            color:white;
                            padding:5px 10px;
                            border-radius:6px;
                        ">
                            Sudah Diverifikasi
                        </span>

                    @endif
                </td>
            </tr>

            @if($order->payment_status == 'Ditolak')

            <tr>
                <td>Alasan Penolakan</td>

                <td>

                    <div style="
                        background:#fdeaea;
                        padding:15px;
                        border-radius:8px;
                        margin-bottom:15px;
                    ">

                        {{ $order->payment_note }}

                    </div>

                    <a
                        href="{{ route('orders.upload.proof',$order->id) }}"
                        style="
                            background:#ff7a00;
                            color:white;
                            padding:10px 18px;
                            text-decoration:none;
                            border-radius:8px;
                            display:inline-block;
                        ">

                        Upload Bukti Transfer Baru

                    </a>

                </td>
            </tr>

            @endif

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

        <div style="margin-top:25px; display:flex; justify-content:space-between; align-items:center;">

            @if($order->order_status == 'dikirim')

                <form action="{{ route('orders.received', $order->id) }}"
                    method="POST">

                    @csrf

                    <button
                        type="submit"
                        onclick="return confirm('Apakah barang sudah benar-benar diterima?')"
                        style="
                            background:#28a745;
                            color:white;
                            padding:10px 20px;
                            border:none;
                            border-radius:8px;
                            cursor:pointer;
                            font-size:15px;
                        ">

                        Pesanan Diterima

                    </button>

                </form>

            @else

                <div></div>

            @endif


            <a href="{{ route('orders.index') }}"
                style="
                    background:#ff7a00;
                    color:white;
                    padding:10px 18px;
                    border-radius:8px;
                    text-decoration:none;
                ">

                ← Kembali

            </a>

        </div>

</x-app-layout>