<x-app-layout>

<x-slot name="header">
    <h2>Admin Dashboard</h2>
</x-slot>

<div style="padding:30px;">

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

        @foreach ($orders as $o)
        <tr>
            <td>{{ $o->customer_name }}</td>
            <td>{{ $o->address }}</td>
            <td>{{ $o->phone }}</td>
            <td>{{ $o->payment_method }}</td>
            <td>Rp {{ number_format($o->total_amount, 0, ',', '.') }}</td>

            <!-- STATUS -->
            <td>
                @if($o->order_status == 'pending')
                    <span style="color:red;">Pending</span>

                @elseif($o->order_status == 'diproses')
                    <span style="color:orange;">Diproses</span>

                @else
                    <span style="color:green;">Selesai</span>
                @endif
            </td>

           <!-- AKSI -->
            <td style="display:flex; gap:5px;">

    <!-- DETAIL -->
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

    <!-- HAPUS -->
    <form action="{{ route('admin.destroy', $o->id) }}" method="POST">
        @csrf
        @method('DELETE')

        <button type="submit"
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
 @endforeach

    </table>

</div>

</x-app-layout>