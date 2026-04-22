<x-app-layout>

<x-slot name="header">
    <h2 style="font-size:20px; font-weight:bold;">Tambah Produk</h2>
</x-slot>

<div style="
    max-width:600px;
    margin:30px auto;
    background:white;
    padding:30px;
    border-radius:12px;
    box-shadow:0 4px 12px rgba(0,0,0,0.1);
">

    <h2 style="margin-bottom:20px;">Tambah Produk Baru</h2>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- NAMA -->
        <div style="margin-bottom:15px;">
            <label>Nama Produk</label>
            <input type="text" name="nama" required
                style="
                width:100%;
                padding:10px;
                border:1px solid #ccc;
                border-radius:6px;
                margin-top:5px;
                ">
        </div>

        <!-- HARGA -->
        <div style="margin-bottom:15px;">
            <label>Harga</label>
            <input type="number" name="harga" required
                style="
                width:100%;
                padding:10px;
                border:1px solid #ccc;
                border-radius:6px;
                margin-top:5px;
                ">
        </div>

        <!-- STOK -->
        <div style="margin-bottom:15px;">
            <label>Stok</label>
            <input type="number" name="stok" required
                style="
                width:100%;
                padding:10px;
                border:1px solid #ccc;
                border-radius:6px;
                margin-top:5px;
                ">
        </div>

        <!-- KATEGORI -->
        <div style="margin-bottom:15px;">
            <label>Kategori</label>
            <select name="kategori" required
                style="
                width:100%;
                padding:10px;
                border:1px solid #ccc;
                border-radius:6px;
                margin-top:5px;
                ">
                <option value="">-- Pilih Kategori --</option>
                <option value="Minyak Goreng">Minyak Goreng</option>
                <option value="Gula">Gula</option>
                <option value="Daging Ayam">Daging Ayam</option>
                <option value="Daging Sapi">Daging Sapi</option>
            </select>
        </div>

        <!-- GAMBAR -->
        <div style="margin-bottom:20px;">
            <label>Gambar Produk</label>
            <input type="file" name="gambar"
                style="margin-top:5px;">
        </div>

        <!-- BUTTON -->
        <div style="display:flex; justify-content:space-between; align-items:center;">
            
            <a href="{{ route('products.index') }}" style="text-decoration:none; color:#555;">
                ← Kembali
            </a>

            <button type="submit" style="
                background:#ff7a00;
                color:white;
                border:none;
                padding:10px 20px;
                border-radius:8px;
                cursor:pointer;
                font-weight:bold;
            ">
                Simpan Produk
            </button>

        </div>

    </form>

</div>

</x-app-layout>