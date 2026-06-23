<!DOCTYPE html>
<html>
<head>
    <title>Login - TigaPilihan.ptk</title>
</head>

<body style="margin:0; font-family:Arial; background:#f6f7fb;">

<!-- NAVBAR -->
<div style="background:white; padding:15px 30px; border-bottom:1px solid #ddd;">
    <div style="display:flex; align-items:center;">
        <img src="{{ asset('images/logo.png') }}" style="height:45px; margin-right:10px;">
        <b style="color:#ff7a00; font-size:22px;">TigaPilihan.ptk</b>
    </div>
</div>

<!-- CONTENT -->
<div style="
    display:flex;
    min-height:90vh;
    align-items:center;
    justify-content:space-between;
    padding:50px;
">

    <!-- LEFT -->
<div style="flex:1; padding-right:50px;">
    <h1 style="color:#ff7a00; font-size:40px;">
        Halo!! Selamat Datang <br> di TigaPilihan.ptk!
    </h1>

    <img src="{{ asset('images/banner.png') }}" 
         style="width:100%; max-width:650px; margin-top:30px;">
</div>

    <!-- RIGHT (FORM) -->
    <div style="
    flex:1;
    display:flex;
    justify-content:flex-end;
    align-items:center;
">

    <div style="
        width:420px;
        background:white;
        padding:30px;
        border-radius:15px;
        box-shadow:0 5px 20px rgba(0,0,0,0.1);
        ">

            <h2 style="color:#ff7a00;">LOGIN</h2>
            <p style="font-size:14px; color:gray;">
                Silahkan login untuk melanjutkan
            </p>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <input type="email" name="email" placeholder="Alamat Email" required
                    style="width:100%; padding:10px; margin-top:15px; border-radius:8px; border:1px solid #ccc;">

                <input type="password" name="password" placeholder="Password" required
                    style="width:100%; padding:10px; margin-top:10px; border-radius:8px; border:1px solid #ccc;">

                <button type="submit" style="
                    width:100%;
                    margin-top:20px;
                    background:#ff7a00;
                    color:white;
                    padding:10px;
                    border:none;
                    border-radius:8px;
                    font-weight:bold;
                ">
                    LOGIN
                </button>

            </form>

            <p style="text-align:center; margin-top:15px; font-size:13px;">
                Belum punya akun?
                <a href="{{ route('register') }}" style="color:#ff7a00;">Daftar</a>
            </p>

        </div>

    </div>

</div>

</body>
</html>