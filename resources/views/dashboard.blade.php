@php
use Illuminate\Support\Str;
@endphp

<x-app-layout>

<x-slot name="header">
    <h2 style="font-size:20px; font-weight:bold;">
        Selamat Datang!
    </h2>
</x-slot>

<body style="background:#f6f7fb;">

<div style="padding:30px;">

    <!-- BANNER -->
    <div style="
        background:#ff7a00;
        color:white;
        padding:30px;
        border-radius:15px;
        display:flex;
        justify-content:space-between;
        align-items:center;
    ">
        <div>
            <h2>Promo Hari Ini</h2>
            <p>Diskon spesial untuk kamu!</p>
        </div>

        <img src="{{ asset('images/banner.png') }}" style="height:100px;">
    </div>

    <!--KATEGORI -->
    <div style="margin-top:30px;">
        <h3>Kategori</h3>

        <div style="display:flex; gap:15px; margin-top:10px;">

    <!-- SEMUA -->
    <a href="/dashboard" style="text-decoration:none;">
        <div style="
            padding:10px 15px;
            border-radius:10px;
            background: {{ empty($category) ? '#ff7a00' : 'white' }};
            color: {{ empty($category) ? 'white' : 'black' }};
        ">
            Semua
        </div>
    </a>

    <!-- MINYAK -->
    <a href="/dashboard?category=Minyak Goreng" style="text-decoration:none;">
        <div style="
            padding:10px 15px;
            border-radius:10px;
            background: {{ $category == 'Minyak Goreng' ? '#ff7a00' : 'white' }};
            color: {{ $category == 'Minyak Goreng' ? 'white' : 'black' }};
        ">
            Minyak
        </div>
    </a>

    <!-- GULA -->
    <a href="/dashboard?category=Gula" style="text-decoration:none;">
        <div style="
            padding:10px 15px;
            border-radius:10px;
            background: {{ $category == 'Gula' ? '#ff7a00' : 'white' }};
            color: {{ $category == 'Gula' ? 'white' : 'black' }};
        ">
            Gula
        </div>
    </a>

    <!-- AYAM -->
    <a href="/dashboard?category=Daging Ayam" style="text-decoration:none;">
        <div style="
            padding:10px 15px;
            border-radius:10px;
            background: {{ $category == 'Daging Ayam' ? '#ff7a00' : 'white' }};
            color: {{ $category == 'Daging Ayam' ? 'white' : 'black' }};
        ">
            Daging Ayam
        </div>
    </a>

    <!-- SAPI -->
    <a href="/dashboard?category=Daging Sapi" style="text-decoration:none;">
        <div style="
            padding:10px 15px;
            border-radius:10px;
            background: {{ $category == 'Daging Sapi' ? '#ff7a00' : 'white' }};
            color: {{ $category == 'Daging Sapi' ? 'white' : 'black' }};
        ">
            Daging Sapi
        </div>
    </a>



</div>

    <!--PRODUK -->
    <div style="margin-top:30px;">
        <h3>Produk</h3>

        <div style="
            display:flex;
            flex-wrap:wrap;
            gap:20px;
            margin-top:15px;
        ">

        @foreach ($products as $p)
        <div style="
            width:220px;
            background:white;
            border-radius:15px;
            overflow:hidden;
            box-shadow:0 4px 15px rgba(0,0,0,0.08);
        ">

            <!-- GAMBAR -->
            <div style="
                height:150px;
                display:flex;
                justify-content:center;
                align-items:center;
                background:#f8f8f8;
            ">
                <img src="{{ asset('images/'.$p->image) }}"
                    style="max-width:90%; max-height:90%;">
            </div>

            <!-- DETAIL -->
           <div style="padding:15px;">
                <b>{{ $p->name }}</b>

            <p style="
                font-size:13px;
                color:#666;
                margin-top:5px;
            ">
                {{ Str::limit($p->description, 50) }}
            </p>

                <p style="color:#ff7a00; font-weight:bold;">
                    Rp {{ number_format($p->price, 0, ',', '.') }}
                </p>

                <p style="
                    font-size:13px;
                    color:gray;
                    margin-bottom:10px;
                ">
                    Stok: {{ $p->stock }}
                </p>

              @if($p->stock > 0)

                <form action="{{ route('cart.add', $p->id) }}" method="POST">
                    @csrf

                    <button style="
                        width:100%;
                        background:#ff7a00;
                        color:white;
                        border:none;
                        padding:8px;
                        border-radius:8px;
                        cursor:pointer;
                    ">
                        + Keranjang
                    </button>
                </form>

                @else

                <button disabled style="
                    width:100%;
                    background:#ccc;
                    color:white;
                    border:none;
                    padding:8px;
                    border-radius:8px;
                ">
                    Stok Habis
                </button>

                                @endif

            </div>

        </div>

        @endforeach

        </div>
    </div>

</div>

</body>

</x-app-layout>