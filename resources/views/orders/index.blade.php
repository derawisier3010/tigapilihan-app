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
                    Rp {{ number_format($order->total,0,',','.') }}
                </td>

                <td>{{ $order->metode }}</td>

                <td>

                    @if($order->status == 'pending')
                        <span style="color:orange;font-weight:bold;">
                            Pending
                        </span>

                    @elseif($order->status == 'diproses')
                        <span style="color:blue;font-weight:bold;">
                            Diproses
                        </span>

                    @elseif($order->status == 'dikirim')
                        <span style="color:#ff7a00;font-weight:bold;">
                            Dikirim
                        </span>

                    @elseif($order->status == 'selesai')
                        <span style="color:green;font-weight:bold;">
                            Selesai
                        </span>

                    @else
                        {{ ucfirst($order->status) }}
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