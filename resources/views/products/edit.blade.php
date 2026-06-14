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
            <input type="text" name="name" value="{{ $product->name }}" required
                style="width:100%; padding:10px; margin-top:5px; margin-bottom:15px; border-radius:8px; border:1px solid #ccc;">

            <!-- HARGA -->
            <label>Harga</label>
            <input type="number" name="price" value="{{ $product->price }}" required
                style="width:100%; padding:10px; margin-top:5px; margin-bottom:15px; border-radius:8px; border:1px solid #ccc;">

            <!-- STOK -->
            <label>Stok</label>
            <input type="number" name="stock" value="{{ $product->stock }}" required
                style="width:100%; padding:10px; margin-top:5px; margin-bottom:15px; border-radius:8px; border:1px solid #ccc;">

            <!-- KATEGORI -->
            <label>Kategori</label>
            <select name="category"
                style="width:100%; padding:10px; margin-top:5px; margin-bottom:20px; border-radius:8px; border:1px solid #ccc;">

                <option value="Minyak Goreng" {{ $product->category == 'Minyak Goreng' ? 'selected' : '' }}>Minyak</option>
                <option value="Gula" {{ $product->category == 'Gula' ? 'selected' : '' }}>Gula</option>
                <option value="Daging Ayam" {{ $product->category == 'Daging Ayam' ? 'selected' : '' }}>Daging Ayam</option>
                <option value="Daging Sapi" {{ $product->category == 'Daging Sapi' ? 'selected' : '' }}>Daging Sapi</option>
                <option value="Lainnya" {{ $product->category == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>

            </select>

            <!-- DESKRIPSI PRODUK -->
            <label>Deskripsi Produk</label>

            <textarea name="description"
                rows="4"
                style="width:100%; padding:10px; margin-top:5px; margin-bottom:20px; border-radius:8px; border:1px solid #ccc;">
                {{ $product->description }}
            </textarea>

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