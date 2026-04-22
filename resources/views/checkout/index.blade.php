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

        <h3 style="margin-bottom:15px;">Isi data kamu dulu Yuk!</h3>

        <form action="{{ route('checkout.process') }}" method="POST">
            @csrf

            <!-- NAMA -->
            <div style="margin-bottom:15px;">
                <label>Nama</label>
                <input type="text" name="nama" required style="
                    width:100%;
                    padding:10px;
                    margin-top:5px;
                    border-radius:6px;
                    border:1px solid #ccc;
                ">
            </div>

            <!-- ALAMAT -->
            <div style="margin-bottom:15px;">
                <label>Alamat</label>
                <textarea name="alamat" required style="
                    width:100%;
                    padding:10px;
                    margin-top:5px;
                    border-radius:6px;
                    border:1px solid #ccc;
                "></textarea>
            </div>

            <!-- NO HP -->
            <div style="margin-bottom:15px;">
                <label>Nomor HP</label>
                <input type="text" name="no_hp" required style="
                    width:100%;
                    padding:10px;
                    margin-top:5px;
                    border-radius:6px;
                    border:1px solid #ccc;
                ">
            </div>

            <!-- METODE PEMBAYARAN -->
            <div style="margin-bottom:20px;">
                <label style="display:block; margin-bottom:8px;">Metode Pembayaran</label>

                <label style="display:block; margin-bottom:5px;">
                    <input type="radio" name="metode" value="COD" required>
                    COD (Bayar di Tempat)
                </label>

                <label>
                    <input type="radio" name="metode" value="Transfer">
                    Transfer Bank
                </label>
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

</x-app-layout>