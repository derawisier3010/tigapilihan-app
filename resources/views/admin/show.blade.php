<x-app-layout>

<x-slot name="header">
    <h2>Detail Pesanan</h2>
</x-slot>

@if(session('success'))

<div style="
    background:#d4edda;
    color:#155724;
    padding:12px;
    margin-bottom:20px;
    border-radius:8px;
">

    {{ session('success') }}

</div>

@endif

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

         <!-- INFORMASI PELANGGAN -->
        <h3 style="margin-top:20px;">Informasi Pelanggan</h3>

        <hr>

        <p><b>Nama:</b>
            {{ $order->customer_name ?? ($order->user->name ?? '-') }}
        </p>

        <p><b>Alamat:</b>
            {{ $order->address ?? ($order->user->address ?? '-') }}
        </p>

        <p><b>No HP:</b>
            {{ $order->phone ?? ($order->user->phone ?? '-') }}
        </p>

        <h3 style="margin-top:20px;">Detail Pesanan</h3>

        <hr>

         <!-- PRODUK -->
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
                <td>{{ $item->product->name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>Rp {{ number_format($item->price,0,',','.') }}</td>
                <td>
                    Rp {{ number_format($item->quantity * $item->price,0,',','.') }}
                </td>
            </tr>
            @endforeach

        </table>

         <!-- RIWAYAT PESANAN -->
        <h3 style="margin-top:30px;">
            Riwayat Status Pesanan
        </h3>

        <table width="100%" border="1" cellpadding="10" cellspacing="0">

            <tr style="background:#f5f5f5;">
                <th>Admin</th>
                <th>Status Lama</th>
                <th>Status Baru</th>
                <th>Waktu</th>
            </tr>

            @foreach($order->logs as $log)

            <tr>

                <td>
                    {{ $log->admin->name }}
                </td>

                <td>
                    {{ $log->old_status }}
                </td>

                <td>
                    {{ $log->new_status }}
                </td>

                <td>
                    {{ $log->created_at }}
                </td>

            </tr>

            @endforeach

        </table>

        <!-- INFORMASI PEMBAYARAN -->
        <h3 style="margin-top:30px;">Informasi Pembayaran</h3>

        <hr>

        <p>
            <b>Metode Pembayaran:</b>
            {{ $order->payment_method }}
        </p>

        <p>
            <b>Status Pembayaran:</b>

            @if($order->payment_status == 'Belum Dibayar')

                <span style="
                    background:#dc3545;
                    color:white;
                    padding:5px 12px;
                    border-radius:8px;
                    font-weight:bold;
                ">
                    Belum Dibayar
                </span>

            @elseif($order->payment_status == 'Menunggu Verifikasi')

                <span style="
                    background:#ffc107;
                    color:black;
                    padding:5px 12px;
                    border-radius:8px;
                    font-weight:bold;
                ">
                    Menunggu Verifikasi
                </span>

            @elseif($order->payment_status == 'Lunas')

                <span style="
                    background:#28a745;
                    color:white;
                    padding:4px 10px;
                    border-radius:6px;
                ">
                    Lunas
                </span>

            @elseif($order->payment_status == 'Sudah Diverifikasi')

                <span style="
                    background:#28a745;
                    color:white;
                    padding:5px 12px;
                    border-radius:8px;
                    font-weight:bold;
                ">
                    Sudah Diverifikasi
                </span>

            @elseif($order->payment_status == 'Ditolak')

                <span style="
                    background:#dc3545;
                    color:white;
                    padding:5px 12px;
                    border-radius:8px;
                    font-weight:bold;
                ">
                    Ditolak
                </span>

            @endif

        </p>

        <p>
            <b>Total Pembayaran :</b>
            Rp {{ number_format($order->total_amount,0,',','.') }}
        </p>


        @if($order->payment_method == 'Transfer')

        <hr>

        <h4>Bukti Transfer</h4>

        @if($order->transfer_proof)

        <a href="{{ asset('storage/'.$order->transfer_proof) }}" target="_blank">

            <img
                src="{{ asset('storage/'.$order->transfer_proof) }}"
                style="
                    width:350px;
                    border-radius:10px;
                    border:1px solid #ddd;
                    cursor:pointer;
                    display:block;
                    margin-bottom:20px;
                "
            >

        </a>

        @else

        <p style="color:red;">
            User belum mengupload bukti transfer.
        </p>

        @endif

        @endif


        @if($order->payment_method == 'Transfer'
            && $order->payment_status == 'Menunggu Verifikasi')

        <div style="margin-top:20px;display:flex;gap:10px;">

            <a href="{{ route('admin.verify.payment',$order->id) }}"
            style="
                    background:#28a745;
                    color:white;
                    padding:10px 18px;
                    border-radius:8px;
                    text-decoration:none;
            ">
                Verifikasi Pembayaran
            </a>

            <a href="{{ route('admin.reject.payment',$order->id) }}"
            style="
                    background:#dc3545;
                    color:white;
                    padding:10px 18px;
                    border-radius:8px;
                    text-decoration:none;
            ">
                Tolak Pembayaran
            </a>

        </div>

        @endif

<!-- BUTTON STATUS PESANAN -->

        @if($order->order_status == 'pending')

        <!-- KHUSUS TRANSFER -->

            @if($order->payment_method == 'Transfer')

                @if($order->payment_status == 'Sudah Diverifikasi')

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

                @else

                    <button
                        disabled
                        style="
                            background:#ccc;
                            color:#666;
                            padding:10px 18px;
                            border:none;
                            border-radius:8px;
                            cursor:not-allowed;
                        ">

                        Menunggu Verifikasi Pembayaran

                    </button>

                @endif


           <!-- KHUSUS COD -->

            @else

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

            @endif


        @elseif($order->order_status == 'diproses')

            <a href="{{ route('admin.update', $order->id) }}"
            style="
                    background:#17a2b8;
                    color:white;
                    padding:10px 18px;
                    border-radius:8px;
                    text-decoration:none;
                    display:inline-block;
            ">
                Kirim Barang
            </a>

        @endif


<!-- ALASAN ADMIN  -->
        @if($order->payment_status == 'Ditolak')

        <div style="
            background:#fdeaea;
            padding:15px;
            border-radius:10px;
            margin-top:15px;
        ">

        <b>Alasan Penolakan:</b>

        <br><br>

        {{ $order->payment_note }}

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