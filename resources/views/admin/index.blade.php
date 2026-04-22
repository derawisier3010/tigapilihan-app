<x-app-layout>

<x-slot name="header">
    <h2>Admin Dashboard</h2>
</x-slot>

<div style="padding:30px;">

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
            <td>{{ $o->nama }}</td>
            <td>{{ $o->alamat }}</td>
            <td>{{ $o->no_hp }}</td>
            <td>{{ $o->metode }}</td>
            <td>Rp {{ number_format($o->total, 0, ',', '.') }}</td>

            <!-- STATUS -->
            <td>
                @if($o->status == 'pending')
                    <span style="color:red;">Pending</span>
                @elseif($o->status == 'diproses')
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