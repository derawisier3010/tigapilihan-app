<x-app-layout>

<x-slot name="header">
    <h2 style="font-size:20px; font-weight:bold;">
        Edit Produk
    </h2>
</x-slot>

<div style="
    display:flex;
    justify-content:center;
    margin-top:30px;
">

    <div style="
        width:500px;
        background:white;
        padding:30px;
        border-radius:15px;
        box-shadow:0 5px 20px rgba(0,0,0,0.1);
    ">

        <!-- BACK BUTTON -->
        <a href="/products" style="
            display:inline-block;
            margin-bottom:20px;
            text-decoration:none;
            color:#ff7a00;
            font-weight:500;
        ">
            ← Kembali ke Produk
        </a>

        <h3 style="margin-bottom:20px;">Edit Data Produk</h3>

        <form action="{{ route('products.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- NAMA -->
            <label>Nama Produk</label>
            <input type="text" name="nama" value="{{ $product->nama }}" required
                style="width:100%; padding:10px; margin-top:5px; margin-bottom:15px; border-radius:8px; border:1px solid #ccc;">

            <!-- HARGA -->
            <label>Harga</label>
            <input type="number" name="harga" value="{{ $product->harga }}" required
                style="width:100%; padding:10px; margin-top:5px; margin-bottom:15px; border-radius:8px; border:1px solid #ccc;">

            <!-- STOK -->
            <label>Stok</label>
            <input type="number" name="stok" value="{{ $product->stok }}" required
                style="width:100%; padding:10px; margin-top:5px; margin-bottom:15px; border-radius:8px; border:1px solid #ccc;">

            <!-- KATEGORI -->
            <label>Kategori</label>
            <select name="kategori"
                style="width:100%; padding:10px; margin-top:5px; margin-bottom:20px; border-radius:8px; border:1px solid #ccc;">

                <option value="Minyak Goreng" {{ $product->kategori == 'Minyak Goreng' ? 'selected' : '' }}>Minyak</option>
                <option value="Gula" {{ $product->kategori == 'Gula' ? 'selected' : '' }}>Gula</option>
                <option value="Daging Ayam" {{ $product->kategori == 'Daging Ayam' ? 'selected' : '' }}>Daging Ayam</option>
                <option value="Daging Sapi" {{ $product->kategori == 'Daging Sapi' ? 'selected' : '' }}>Daging Sapi</option>
                <option value="Lainnya" {{ $product->kategori == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>

            </select>

            <!-- BUTTON -->
            <button type="submit" style="
                width:100%;
                background:#ff7a00;
                color:white;
                border:none;
                padding:12px;
                border-radius:8px;
                font-size:16px;
                font-weight:bold;
                cursor:pointer;
            ">
                Update Produk
            </button>

        </form>

    </div>

</div>

</x-app-layout>