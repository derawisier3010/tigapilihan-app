<x-app-layout>

<x-slot name="header">
    <h2>Pesanan Saya</h2>
</x-slot>

<div style="
    display:flex;
    justify-content:center;
    margin-top:30px;
">

    <div style="
        width:90%;
        max-width:1000px;
        background:white;
        padding:20px;
        border-radius:12px;
        box-shadow:0 2px 10px rgba(0,0,0,0.1);
    ">

        <h3 style="margin-bottom:20px;">
            Riwayat Pesanan
        </h3>

        <!-- FILTER RIWAYAT -->
        <form method="GET"
            action="{{ route('orders.index') }}"
            style="
                display:flex;
                gap:15px;
                align-items:flex-end;
                flex-wrap:wrap;
                margin-bottom:25px;
            ">

            <!-- STATUS -->
            <div>

                <label><b>Status</b></label>

                <select
                    name="status"
                    style="
                        display:block;
                        width:180px;
                        padding:10px;
                        margin-top:5px;
                        border-radius:8px;
                        border:1px solid #ccc;
                    ">

                    <option value="">Semua Status</option>

                    <option value="pending"
                        {{ request('status') == 'pending' ? 'selected' : '' }}>
                        Pending
                    </option>

                    <option value="diproses"
                        {{ request('status') == 'diproses' ? 'selected' : '' }}>
                        Diproses
                    </option>

                    <option value="dikirim"
                        {{ request('status') == 'dikirim' ? 'selected' : '' }}>
                        Dikirim
                    </option>

                    <option value="selesai"
                        {{ request('status') == 'selesai' ? 'selected' : '' }}>
                        Selesai
                    </option>

                </select>

            </div>

            <!-- BULAN -->
            <div>

                <label><b>Bulan</b></label>

                <select
                    name="month"
                    style="
                        display:block;
                        width:180px;
                        padding:10px;
                        margin-top:5px;
                        border-radius:8px;
                        border:1px solid #ccc;
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

            <!-- TAHUN -->
            <div>

                <label><b>Tahun</b></label>

                <select
                    name="year"
                    style="
                        display:block;
                        width:150px;
                        padding:10px;
                        margin-top:5px;
                        border-radius:8px;
                        border:1px solid #ccc;
                    ">

                    <option value="">Semua Tahun</option>

                    @for($i=date('Y'); $i>=2024; $i--)

                        <option
                            value="{{ $i }}"
                            {{ request('year') == $i ? 'selected' : '' }}>

                            {{ $i }}

                        </option>

                    @endfor

                </select>

            </div>

            <!-- FILTER -->
            <div style="margin-top:28px;">

                <button
                    type="submit"
                    style="
                        background:#ff7a00;
                        color:white;
                        border:none;
                        padding:10px 20px;
                        border-radius:8px;
                        cursor:pointer;
                    ">

                    Filter

                </button>

            </div>

            <!-- RESET -->
            <div style="margin-top:28px;">

                <a
                    href="{{ route('orders.index') }}"
                    style="
                        background:#6c757d;
                        color:white;
                        padding:10px 20px;
                        border-radius:8px;
                        text-decoration:none;
                        display:inline-block;
                    ">

                    Reset

                </a>

            </div>

        </form>

        @if($selectedStatus || $selectedMonth || $selectedYear)

        <div style="
            background:#e9f7ff;
            border:1px solid #b6e0fe;
            padding:15px;
            border-radius:10px;
            margin-bottom:20px;
        ">

            <b>Filter Aktif :</b>

            @if($selectedStatus)
                Status :
                <b>{{ ucfirst($selectedStatus) }}</b>
            @endif

            @if($selectedMonth)

                @if($selectedStatus)
                    |
                @endif

                Bulan :
                <b>{{ \Carbon\Carbon::create()->month((int)$selectedMonth)->translatedFormat('F') }}</b>

            @endif

            @if($selectedYear)

                @if($selectedStatus || $selectedMonth)
                    |
                @endif

                Tahun :
                <b>{{ $selectedYear }}</b>

            @endif

            <br><br>

            <b>Jumlah Pesanan :</b>

            {{ $totalFilteredOrders }}

        </div>

        @endif

        <table width="100%" border="1" cellpadding="10" cellspacing="0">

            <tr style="background:#ff7a00; color:white;">
                <th>ID</th>
                <th>Total</th>
                <th>Metode</th>
                <th>Status</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>

            @forelse($orders as $order)

            <tr>
                <td>{{ $order->id }}</td>

                <td>
                    Rp {{ number_format($order->total_amount,0,',','.') }}
                </td>

                <td>{{ $order->payment_method }}</td>

                <td>

                    @if($order->order_status == 'pending')
                        <span style="color:orange;font-weight:bold;">
                            Pending
                        </span>

                    @elseif($order->order_status == 'diproses')
                        <span style="color:blue;font-weight:bold;">
                            Diproses
                        </span>

                    @elseif($order->order_status == 'dikirim')
                        <span style="color:#ff7a00;font-weight:bold;">
                            Dikirim
                        </span>

                    @elseif($order->order_status == 'selesai')
                        <span style="color:green;font-weight:bold;">
                            Selesai
                        </span>

                    @else
                        {{ ucfirst($order->order_status) }}
                    @endif

                </td>

                <td>{{ $order->created_at->format('d-m-Y') }}</td>

                <td>
                    <a href="{{ route('orders.show', $order->id) }}"
                       style="
                       background:#ff7a00;
                       color:white;
                       padding:6px 12px;
                       border-radius:6px;
                       text-decoration:none;
                       ">
                        Detail
                    </a>
                </td>
            </tr>

            @empty

            <tr>
                <td colspan="6" style="text-align:center;">
                    Belum ada pesanan
                </td>
            </tr>

            @endforelse

        </table>

    </div>

</div>

</x-app-layout>