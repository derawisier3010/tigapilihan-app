<x-app-layout>

<x-slot name="header">
    <h2>Upload Ulang Bukti Transfer</h2>
</x-slot>

<div style="display:flex;justify-content:center;margin-top:40px;">

    <div style="
        width:550px;
        background:white;
        padding:30px;
        border-radius:15px;
        box-shadow:0 5px 20px rgba(0,0,0,.1);
    ">

        <a href="{{ route('orders.show',$order->id) }}"
           style="
                text-decoration:none;
                color:#ff7a00;
                font-weight:bold;
           ">
            ← Kembali ke Detail Pesanan
        </a>

        <h3 style="margin-top:20px;">
            Upload Bukti Transfer Baru
        </h3>

        <p>
            Silakan upload ulang bukti transfer sesuai alasan dari admin.
        </p>

        @if(session('success'))

            <div style="
                background:#d4edda;
                color:#155724;
                padding:12px;
                border-radius:8px;
                margin-bottom:15px;
            ">
                {{ session('success') }}
            </div>

        @endif

        @if($errors->any())

            <div style="
                background:#f8d7da;
                color:#721c24;
                padding:12px;
                border-radius:8px;
                margin-bottom:15px;
            ">

                {{ $errors->first() }}

            </div>

        @endif

        <form
            action="{{ route('orders.upload.proof.save',$order->id) }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf

            <label>
                Bukti Transfer Baru
            </label>

            <br><br>

            <input
                type="file"
                name="transfer_proof"
                accept=".jpg,.jpeg,.png"
                required
            >

            <br><br>

            <button
                type="submit"
                style="
                    background:#ff7a00;
                    color:white;
                    border:none;
                    padding:12px 25px;
                    border-radius:8px;
                    cursor:pointer;
                ">
                Upload Bukti Baru
            </button>

        </form>

    </div>

</div>

</x-app-layout>