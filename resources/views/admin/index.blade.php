<x-app-layout>

<x-slot name="header">
    <h2>Admin Dashboard</h2>
</x-slot>

<div style="padding:30px;">

<!-- FILTER PESANAN -->
<div style="
    background:white;
    padding:20px;
    border-radius:12px;
    box-shadow:0 2px 10px rgba(0,0,0,0.08);
    margin-bottom:20px;
">

    <form method="GET" action="{{ route('admin.index') }}">

        <div style="
                display:flex;
                gap:15px;
                align-items:flex-end;
                flex-wrap:wrap;
            ">

            <!-- FILTER TAHUN -->
            <div>

                <label><b>Tahun</b></label>

                <select
                    name="year"
                    style="
                        width:160px;
                        padding:10px;
                        border-radius:8px;
                        border:1px solid #ccc;
                        display:block;
                        margin-top:5px;
                    ">

                    <option value="">Semua Tahun</option>

                    @for($i = date('Y'); $i >= 2024; $i--)

                        <option
                            value="{{ $i }}"
                            {{ request('year') == $i ? 'selected' : '' }}>
                            {{ $i }}
                        </option>

                    @endfor

                </select>

            </div>

            <!-- FILTER BULAN -->
            <div>

                <label><b>Bulan</b></label>

                <select
                    name="month"
                    style="
                        width:180px;
                        padding:10px;
                        border-radius:8px;
                        border:1px solid #ccc;
                        display:block;
                        margin-top:5px;
                    ">

                    <option value="">Semua Bulan</option>

                    @foreach([
                        1=>'Januari',
                        2=>'Februari',
                        3=>'Maret',
                        4=>'April',
                        5=>'Mei',
                        6=>'Juni',
                        7=>'Juli',
                        8=>'Agustus',
                        9=>'September',
                        10=>'Oktober',
                        11=>'November',
                        12=>'Desember'
                    ] as $key=>$bulan)

                        <option
                            value="{{ $key }}"
                            {{ request('month') == $key ? 'selected' : '' }}>

                            {{ $bulan }}

                        </option>

                    @endforeach

                </select>

            </div>

            <!-- BUTTON FILTER -->
            <div style="margin-top:30px;">

                <button
                    type="submit"
                    style="
                        background:#ff7a00;
                        color:white;
                        border:none;
                        padding:10px 20px;
                        border-radius:8px;
                        cursor:pointer;
                        height:46px;
                    ">
                    Filter
                </button>

            </div>

            <!-- RESET -->
            <div style="margin-top:30px;">

                <a
                    href="{{ route('admin.index') }}"
                    style="
                        display:inline-flex;
                        align-items:center;
                        justify-content:center;
                        background:#6c757d;
                        color:white;
                        width:100px;
                        height:46px;
                        border-radius:8px;
                        text-decoration:none;
                    ">

                    Reset

                </a>

            </div>

        </div>

    </form>

</div>

<!-- STATISTIK ADMIN -->

<div style="
display:flex;
gap:20px;
margin-bottom:30px;
flex-wrap:wrap;
">

    <div style="
        background:white;
        padding:20px;
        width:220px;
        border-radius:12px;
        box-shadow:0 2px 10px rgba(0,0,0,0.08);
    ">
        <h2>{{ $totalUser }}</h2>
        <p>Total User</p>
    </div>

    <div style="
        background:white;
        padding:20px;
        width:220px;
        border-radius:12px;
        box-shadow:0 2px 10px rgba(0,0,0,0.08);
    ">
        <h2>{{ $totalProduk }}</h2>
        <p>Total Produk</p>
    </div>

    <div style="
        background:white;
        padding:20px;
        width:220px;
        border-radius:12px;
        box-shadow:0 2px 10px rgba(0,0,0,0.08);
    ">
        <h2>{{ $totalPesanan }}</h2>
        <p>Total Pesanan</p>
    </div>

    <div style="
        background:white;
        padding:20px;
        width:220px;
        border-radius:12px;
        box-shadow:0 2px 10px rgba(0,0,0,0.08);
    ">
        <h2>{{ $pending }}</h2>
        <p>Pesanan Pending</p>
    </div>

</div>

    <h2>Data Pesanan</h2>

    @if($selectedMonth || $selectedYear)

        <div style="
            background:#e9f7ff;
            border:1px solid #b6e0fe;
            padding:15px;
            border-radius:10px;
            margin:15px 0;
        ">

            <b>Filter Aktif :</b>

            @if($selectedMonth)

                Bulan
                {{ \Carbon\Carbon::create()->month((int) $selectedMonth)->translatedFormat('F') }}

            @endif

            @if($selectedYear)

                {{ $selectedYear }}

            @endif

            <br>

            <b>Jumlah Pesanan :</b>

            {{ $totalFilteredOrders }}

        </div>

        @endif

    @if(session('success'))
        <div style="background:#d4edda; padding:10px; margin:10px 0;">
            {{ session('success') }}
        </div>
    @endif

    <table border="1" cellpadding="10" width="100%" style="border-collapse:collapse; background:white;">

        <tr style="background:#ff7a00; color:white;">
            <th>Nama</th>
            <th>Alamat</th>
            <th>No HP</th>
            <th>Metode</th>
            <th>Total</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>

        @forelse ($orders as $o)

        <tr>
            <td>{{ $o->customer_name }}</td>
            <td>{{ $o->address }}</td>
            <td>{{ $o->phone }}</td>
            <td>{{ $o->payment_method }}</td>
            <td>Rp {{ number_format($o->total_amount, 0, ',', '.') }}</td>

         <td>
                @if($o->order_status == 'pending')
                    <span style="color:red;">Pending</span>

                @elseif($o->order_status == 'diproses')
                    <span style="color:orange;">Diproses</span>

                @elseif($o->order_status == 'dikirim')
                    <span style="color:#0d6efd;">Dikirim</span>

                @elseif($o->order_status == 'selesai')
                    <span style="color:green;">Selesai</span>
                @endif
        </td>

        <td style="display:flex; gap:5px;">

                <a href="{{ route('admin.show', $o->id) }}"
                style="
                    background:green;
                    color:white;
                    padding:5px 10px;
                    border-radius:5px;
                    text-decoration:none;
                    font-size:12px;
                ">
                    Detail
                </a>

                <form action="{{ route('admin.destroy', $o->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        onclick="return confirm('Yakin ingin hapus pesanan ini?')"
                        style="
                            background:red;
                            color:white;
                            padding:5px 10px;
                            border:none;
                            border-radius:5px;
                            font-size:12px;
                            cursor:pointer;
                        ">
                        Hapus
                    </button>
                </form>

        </td>

        </tr>

        @empty

        <tr>

            <td colspan="7"
                style="
                    text-align:center;
                    padding:30px;
                    color:#666;
                ">

                Tidak ada pesanan pada periode yang dipilih.

            </td>

        </tr>

        @endforelse

    </table>

</div>

</x-app-layout>