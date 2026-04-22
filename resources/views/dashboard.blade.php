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
            background: {{ empty($kategori) ? '#ff7a00' : 'white' }};
            color: {{ empty($kategori) ? 'white' : 'black' }};
        ">
            Semua
        </div>
    </a>

    <!-- MINYAK -->
    <a href="/dashboard?kategori=Minyak Goreng" style="text-decoration:none;">
        <div style="
            padding:10px 15px;
            border-radius:10px;
            background: {{ $kategori == 'Minyak Goreng' ? '#ff7a00' : 'white' }};
            color: {{ $kategori == 'Minyak Goreng' ? 'white' : 'black' }};
        ">
            Minyak
        </div>
    </a>

    <!-- GULA -->
    <a href="/dashboard?kategori=Gula" style="text-decoration:none;">
        <div style="
            padding:10px 15px;
            border-radius:10px;
            background: {{ $kategori == 'Gula' ? '#ff7a00' : 'white' }};
            color: {{ $kategori == 'Gula' ? 'white' : 'black' }};
        ">
            Gula
        </div>
    </a>

    <!-- AYAM -->
    <a href="/dashboard?kategori=Daging Ayam" style="text-decoration:none;">
        <div style="
            padding:10px 15px;
            border-radius:10px;
            background: {{ $kategori == 'Daging Ayam' ? '#ff7a00' : 'white' }};
            color: {{ $kategori == 'Daging Ayam' ? 'white' : 'black' }};
        ">
            Daging Ayam
        </div>
    </a>

    <!-- SAPI -->
    <a href="/dashboard?kategori=Daging Sapi" style="text-decoration:none;">
        <div style="
            padding:10px 15px;
            border-radius:10px;
            background: {{ $kategori == 'Daging Sapi' ? '#ff7a00' : 'white' }};
            color: {{ $kategori == 'Daging Sapi' ? 'white' : 'black' }};
        ">
            Daging Sapi
        </div>
    </a>

    <!-- LAINNYA -->
    <a href="/dashboard?kategori=Lainnya" style="text-decoration:none;">
        <div style="
            padding:10px 15px;
            border-radius:10px;
            background: {{ $kategori == 'Lainnya' ? '#ff7a00' : 'white' }};
            color: {{ $kategori == 'Lainnya' ? 'white' : 'black' }};
        ">
            Lainnya
        </div>
    </a>

</div>

    <!--PRODUK -->
    <div style="margin-top:30px;">
        <h3>Produk Terbaru</h3>

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
                <img src="{{ asset('images/'.$p->gambar) }}"
                     style="max-width:90%; max-height:90%;">
            </div>

            <!-- DETAIL -->
            <div style="padding:15px;">
                <b>{{ $p->nama }}</b>

                <p style="color:#ff7a00; font-weight:bold;">
                    Rp {{ number_format($p->harga, 0, ',', '.') }}
                </p>

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
            </div>

        </div>
        @endforeach

        </div>
    </div>

</div>

</body>

</x-app-layout>