@php
use Illuminate\Support\Str;
@endphp

<x-app-layout>

<x-slot name="header">
    <h2>Produk</h2>
</x-slot>

@if(session('success'))
<div style="background:#d4edda; padding:10px; margin:10px; text-align:center;">
    {{ session('success') }}
</div>
@endif

<!-- BUTTON ADMIN -->
@if(auth()->user()->role == 'admin')
<div style="text-align:center; margin:20px;">
    <a href="{{ route('products.create') }}" 
       style="background:green; color:white; padding:10px 15px; border-radius:5px; text-decoration:none;">
       + Tambah Produk
    </a>
</div>
@endif

<!-- GRID PRODUK -->
<div style="
    display:flex;
    flex-wrap:wrap;
    gap:20px;
    justify-content:center;
    padding:20px;
">

    @foreach ($products as $p)
    <div style="
        width:200px;
        background:white;
        border-radius:10px;
        overflow:hidden;
        box-shadow:0 2px 8px rgba(0,0,0,0.1);
    ">

        <!-- GAMBAR -->
        @if($p->image)
            <div style="
                width:100%;
                height:150px;
                display:flex;
                align-items:center;
                justify-content:center;
                background:#f1f1f1;
                border-bottom:1px solid #eee;
            ">
                <img src="{{ asset('images/'.$p->image) }}"
                     style="max-width:100%; max-height:100%; object-fit:contain;">
            </div>
        @endif

        <!-- DETAIL -->
        <div style="padding:10px;">

            <h4 style="margin:5px 0;">{{ $p->name }}</h4>

            <p style="
                font-size:12px;
                color:#666;
                margin:5px 0;
            ">
                {{ \Illuminate\Support\Str::limit($p->description, 50) }}
            </p>

            <p style="color:#ff7a00; font-weight:bold;">
                Rp {{ number_format($p->price, 0, ',', '.') }}
            </p>

            <p style="font-size:12px;">
                Stok: {{ $p->stock }}
            </p>

            <!-- KERANJANG -->
            <form action="{{ route('cart.add', $p->id) }}" method="POST">
                @csrf
                <button type="submit" style="
                    width:100%;
                    background:#ff7a00;
                    color:white;
                    border:none;
                    padding:8px;
                    border-radius:5px;
                    margin-top:5px;
                ">
                    + Keranjang
                </button>
            </form>

        </div>
        @if(auth()->user()->role == 'admin')
<div style="margin-top:10px; display:flex; gap:5px;">
    
    <a href="{{ route('products.edit', $p->id) }}" 
       style="
        flex:1;
        background:green;
        color:white;
        text-align:center;
        padding:5px;
        border-radius:5px;
        text-decoration:none;
       ">
       Edit
    </a>

    <form action="{{ route('products.destroy', $p->id) }}" method="POST" style="flex:1;">
        @csrf
        @method('DELETE')
        <button type="submit" style="
            width:100%;
            background:red;
            color:white;
            border:none;
            padding:5px;
            border-radius:5px;
        " onclick="return confirm('Yakin hapus?')">
            Hapus
        </button>
    </form>

</div>
@endif

    </div>
    @endforeach

</div>

</x-app-layout>