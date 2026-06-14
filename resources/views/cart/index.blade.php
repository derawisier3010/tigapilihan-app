<x-app-layout>

<x-slot name="header">
    <h2>Keranjang</h2>
</x-slot>

<div style="width:80%; margin:30px auto; background:white; padding:20px; border-radius:10px;">

    <h2>Keranjang Belanja</h2>

    @if(empty($cart))
        <p>Keranjang kosong</p>
    @else

    <table width="100%" cellpadding="15" style="border-collapse:collapse;">

        <!-- HEADER -->
        <tr style="background:#ff7a00; color:black;">
            <th align="left">Produk</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th align="right">Subtotal</th>
        </tr>

        @php $total = 0; @endphp

        @foreach ($cart as $id => $item)
        @php 
            $subtotal = $item['price'] * $item['quantity'];
            $total += $subtotal;
        @endphp

        <tr style="border-bottom:1px solid #ddd;">

            <!-- PRODUK -->
            <td style="display:flex; align-items:center; gap:15px;">
                
                <div style="width:60px; height:60px; background:#eee; display:flex; align-items:center; justify-content:center;">
                    @if($item['image'])
                        <img src="{{ asset('images/'.$item['image']) }}" style="max-width:100%; max-height:100%;">
                    @endif
                </div>

                {{ $item['name'] }}
            </td>

            <!-- HARGA -->
            <td align="center">
                Rp {{ number_format($item['price'], 0, ',', '.') }}
            </td>

            <!-- JUMLAH -->
            <td align="center">
                <div style="display:flex; justify-content:center; align-items:center; gap:5px;">

                    <a href="{{ route('cart.decrease', $id) }}">
                        <button>-</button>
                    </a>

                    {{ $item['quantity'] }}

                    <a href="{{ route('cart.increase', $id) }}">
                        <button>+</button>
                    </a>

                </div>
            </td>

            <!-- SUBTOTAL -->
            <td align="right">
                <b>Rp {{ number_format($subtotal, 0, ',', '.') }}</b>
            </td>

        </tr>
        @endforeach

    </table>

    <!-- TOTAL -->
    <div style="text-align:right; margin-top:20px;">
        <h2>Total: Rp {{ number_format($total, 0, ',', '.') }}</h2>

        <a href="{{ route('checkout.index') }}">
            <button style="
                background:#ff7a00;
                color:white;
                padding:12px 25px;
                border:none;
                border-radius:8px;
                font-size:16px;
                cursor:pointer;
            ">
                Checkout Sekarang >
            </button>
        </a>
    </div>

    @endif

</div>


</x-app-layout>