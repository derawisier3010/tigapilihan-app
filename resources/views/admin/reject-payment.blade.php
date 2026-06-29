<x-app-layout>

<x-slot name="header">
    <h2>Tolak Pembayaran</h2>
</x-slot>

<div style="display:flex;justify-content:center;margin-top:40px;">

    <div style="
        width:550px;
        background:white;
        padding:30px;
        border-radius:12px;
        box-shadow:0 5px 20px rgba(0,0,0,.1);
    ">

        <h3>Alasan Penolakan</h3>

        <form
            action="{{ route('admin.reject.payment.save',$order->id) }}"
            method="POST">

            @csrf

            <textarea
                name="payment_note"
                rows="5"
                required
                style="
                    width:100%;
                    padding:12px;
                    border-radius:8px;
                    border:1px solid #ccc;
                "
                placeholder="Contoh:
Bukti transfer buram,
Nominal transfer tidak sesuai,
Rekening tujuan salah."></textarea>

            <br><br>

            <button
                type="submit"
                style="
                    background:#dc3545;
                    color:white;
                    border:none;
                    padding:12px 25px;
                    border-radius:8px;
                    cursor:pointer;
                ">
                Tolak Pembayaran
            </button>

        </form>

    </div>

</div>

</x-app-layout>