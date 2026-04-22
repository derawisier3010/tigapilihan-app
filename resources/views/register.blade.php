<!DOCTYPE html>
<html>
<head>
    <title>Register - TigaPilihan.ptk</title>
</head>

<body style="margin:0; font-family:Arial; background:#f5f5f5;">

<!-- NAVBAR -->
<div style="background:white; padding:15px 30px; border-bottom:1px solid #ddd;">
    <div style="display:flex; align-items:center;">
        <img src="{{ asset('images/logo.png') }}" style="height:45px; margin-right:10px;">
        <b style="color:#ff7a00; font-size:22px;">TigaPilihan.ptk</b>
    </div>
</div>

<div style="display:flex; height:90vh;">

    <!-- LEFT -->
    <div style="flex:1; padding:60px;">
        <h1 style="color:#ff7a00;">
            Bergabung dengan <br> TigaPilihan.ptk!
        </h1>

        <p style="color:#555;">
            Daftar sekarang dan mulai belanja 🚀
        </p>

        <img src="{{ asset('images/banner.png') }}" 
             style="width:80%; margin-top:30px;">
    </div>

    <!-- RIGHT (FORM) -->
    <div style="flex:1; display:flex; justify-content:center; align-items:center;">

        <div style="
            width:350px;
            background:white;
            padding:25px;
            border-radius:15px;
            box-shadow:0 5px 20px rgba(0,0,0,0.1);
        ">

            <h2 style="color:#ff7a00;">REGISTER</h2>
            <p style="font-size:14px; color:gray;">
                Buat akun baru
            </p>

            <!-- ERROR -->
            @if ($errors->any())
                <div style="background:#f8d7da; padding:10px; margin-top:10px;">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <input type="text" name="name" placeholder="Nama"
                    style="width:100%; padding:10px; margin-top:15px; border-radius:8px; border:1px solid #ccc;" required>

                <input type="email" name="email" placeholder="Email"
                    style="width:100%; padding:10px; margin-top:10px; border-radius:8px; border:1px solid #ccc;" required>

                <input type="password" name="password" placeholder="Password"
                    style="width:100%; padding:10px; margin-top:10px; border-radius:8px; border:1px solid #ccc;" required>

                <input type="password" name="password_confirmation" placeholder="Konfirmasi Password"
                    style="width:100%; padding:10px; margin-top:10px; border-radius:8px; border:1px solid #ccc;" required>

                <button type="submit" style="
                    width:100%;
                    margin-top:20px;
                    background:#ff7a00;
                    color:white;
                    padding:12px;
                    border:none;
                    border-radius:8px;
                    font-weight:bold;
                    cursor:pointer;
                ">
                    DAFTAR
                </button>

            </form>

            <p style="text-align:center; margin-top:15px; font-size:13px;">
                Sudah punya akun?
                <a href="/" style="color:#ff7a00; font-weight:bold;">
                    Login
                </a>
            </p>

        </div>

    </div>

</div>

</body>
</html>