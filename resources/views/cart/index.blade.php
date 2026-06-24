<x-app-layout>

<x-slot name="header">
    <h2>Keranjang</h2>
</x-slot>

<div style="width:80%; margin:30px auto; background:white; padding:20px; border-radius:10px;">

    <h2>Keranjang Belanja</h2>

    @if(empty($cart))
        <p>Keranjang kosong</p>
    @else

    <form action="{{ route('checkout.index') }}" method="POST">
    @csrf

    <table width="100%" cellpadding="15" style="border-collapse:collapse;">

        <!-- HEADER -->
        <tr style="background:#ff7a00; color:black;">
            <th>Pilih</th>
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

            <td align="center">
                <input
                    type="checkbox"
                    class="product-check"
                    data-subtotal="{{ $subtotal }}"
                    name="selected_items[]"
                    value="{{ $id }}"
                    checked
                >
            </td>

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

                    <a href="{{ route('cart.decrease', $id) }}"
                    style="
                    padding:5px 10px;
                    background:#eee;
                    border-radius:5px;
                    text-decoration:none;
                    color:black;
                    ">
                    -
                    </a>

                    {{ $item['quantity'] }}

                    <a href="{{ route('cart.increase', $id) }}"
                    style="
                    padding:5px 10px;
                    background:#eee;
                    border-radius:5px;
                    text-decoration:none;
                    color:black;
                    ">
                    +
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
        <h2 id="total-price">
            Total: Rp {{ number_format($total, 0, ',', '.') }}
        </h2>

        <button type="submit" style="
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
    </div>

   </form>

    @endif

    </div>

    <script>

        function updateTotal() {

            let total = 0;

            document.querySelectorAll('.product-check').forEach(function(item){

                if(item.checked){
                    total += parseInt(item.dataset.subtotal);
                }

            });

            document.getElementById('total-price').innerHTML =
                'Total: Rp ' + total.toLocaleString('id-ID');

        }

        document.querySelectorAll('.product-check').forEach(function(item){

            item.addEventListener('change', updateTotal);

        });

        updateTotal();

        </script>

</x-app-layout>