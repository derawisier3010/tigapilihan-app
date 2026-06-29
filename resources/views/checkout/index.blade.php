<x-app-layout>

<x-slot name="header">
    <h2>Checkout</h2>
</x-slot>

<div style="display:flex; justify-content:center; margin-top:30px;">

    <div style="
        width:500px;
        background:white;
        padding:25px;
        border-radius:12px;
        box-shadow:0 2px 10px rgba(0,0,0,0.1);
    ">

        <!-- TOMBOL KEMBALI -->
        <a href="{{ route('cart.index') }}" style="
            display:inline-block;
            margin-bottom:15px;
            text-decoration:none;
            background:#eee;
            padding:8px 12px;
            border-radius:8px;
            color:black;
            font-size:14px;
        ">
            ← Kembali ke Keranjang
        </a>

        @if(session('error'))
        <div style="
            background:#f8d7da;
            color:#721c24;
            padding:12px;
            margin-bottom:15px;
            border-radius:8px;
            border:1px solid #f5c6cb;
        ">
            {{ session('error') }}
        </div>
        @endif
        
        <form action="{{ route('checkout.process') }}"
            method="POST"
            enctype="multipart/form-data">

             @csrf

            <!-- NAMA -->
            <div style="margin-bottom:15px;">
    <label>Nama</label>

    <input type="text"
           value="{{ auth()->user()->name }}"
           readonly
           style="
            width:100%;
            padding:10px;
            margin-top:5px;
            background:#f5f5f5;
            border-radius:6px;
            border:1px solid #ccc;
           ">
</div>

            <!-- ALAMAT -->
            <div style="margin-bottom:15px;">
                <label>Alamat</label>
                <textarea readonly
                    style="
                    width:100%;
                    padding:10px;
                    margin-top:5px;
                    background:#f5f5f5;
                    border-radius:6px;
                    border:1px solid #ccc;
                    ">{{ auth()->user()->address }}
                    </textarea>
            </div>

            <!-- NO HP -->
            <div style="margin-bottom:15px;">
                <label>Nomor HP</label>
                <input type="text"
                value="{{ auth()->user()->phone }}"
                readonly
                style="
                    width:100%;
                    padding:10px;
                    margin-top:5px;
                    background:#f5f5f5;
                    border-radius:6px;
                    border:1px solid #ccc;
                ">
            </div>

            <!-- PRODUK YANG DICHECKOUT -->

            <h3 style="margin-bottom:15px;">
                Produk yang Dipilih
            </h3>

            @php $total = 0; @endphp

            <table width="100%" cellpadding="10" cellspacing="0" border="1" style="margin-bottom:20px;">

            <tr>
                <th>Produk</th>
                <th>Qty</th>
                <th>Subtotal</th>
            </tr>

            @foreach($cart as $item)

            @php
                $subtotal = $item['price'] * $item['quantity'];
                $total += $subtotal;
            @endphp

            <tr>
                <td>{{ $item['name'] }}</td>

                <td align="center">
                    {{ $item['quantity'] }}
                </td>

                <td align="right">
                    Rp {{ number_format($subtotal,0,',','.') }}
                </td>
            </tr>

            @endforeach

            </table>

            <div style="
                background:#fff3cd;
                padding:12px;
                border-radius:8px;
                margin-bottom:20px;
                font-weight:bold;
            ">
                Total Belanja:
                Rp {{ number_format($total,0,',','.') }}
            </div>


            <!-- METODE PEMBAYARAN -->
          <label style="display:block; margin-bottom:10px;">
                <input
                    type="radio"
                    name="metode"
                    value="COD"
                    id="cod-radio"
                    required>

                COD (Bayar di Tempat)
            </label>

            <label style="display:block; margin-bottom:10px;">
                <input
                    type="radio"
                    name="metode"
                    value="Transfer"
                    id="transfer-radio">

                Transfer Bank
            </label>

            <div id="transfer-info" style="
                display:none;
                background:#f8f9fa;
                border:1px solid #ddd;
                padding:15px;
                border-radius:10px;
                margin-top:15px;
            ">

                <h4>Informasi Transfer</h4>

                <p>
                    <b>BCA Blu</b>
                </p>

                <p>
                    No Rekening :
                    <b>005823525602</b>
                </p>

                <p>
                    Atas Nama :
                    <b>Ratna Dwi Gita Stefani</b>
                </p>

                <hr>

                <label style="display:block;margin-top:15px;">
                    Upload Bukti Transfer
                </label>

                <input
                    type="file"
                    name="transfer_proof"
                    accept=".jpg,.jpeg,.png"
                >

                <small style="color:gray;">
                    Format JPG / PNG maksimal 2 MB.
                </small>

            </div>

            <!-- BUTTON -->
            <div style="text-align:right;">
                <button type="submit" style="
                    background:#ff7a00;
                    color:white;
                    padding:10px 20px;
                    border:none;
                    border-radius:8px;
                    font-size:14px;
                    cursor:pointer;
                ">
                    Pesan Sekarang
                </button>
            </div>

        </form>

    </div>

</div>

<script>

const cod=document.getElementById('cod-radio');
const transfer=document.getElementById('transfer-radio');
const info=document.getElementById('transfer-info');

document.querySelectorAll('input[name="metode"]').forEach(function(item){

    item.addEventListener('change',function(){

        if(transfer.checked){

            info.style.display='block';

        }else{

            info.style.display='none';

        }

    });

});

</script>

</x-app-layout>