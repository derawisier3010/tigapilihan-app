<!DOCTYPE html>
<html>
<head>
    <title>Login - TigaPilihan.ptk</title>
</head>

<body style="margin:0; font-family:Arial; background:#f5f5f5;">

<!-- NAVBAR -->
<div style="background:white; padding:15px 30px; border-bottom:1px solid #ddd;">
    <div style="display:flex; align-items:center;">
        <img src="{{ asset('images/logo.png') }}" style="height:50px; margin-right:10px;">
        <b style="color:#ff7a00; font-size:24px;">TigaPilihan.ptk</b>
    </div>
</div>

<div style="display:flex; height:90vh;">

    <!-- LEFT -->
    <div style="flex:1; padding:60px;">
        <h1 style="color:#ff7a00;">Selamat Datang!</h1>
        <p>Belanja jadi lebih mudah</p>

        <img src="{{ asset('images/banner.png') }}" style="width:80%; margin-top:20px;">
    </div>

    <!-- RIGHT -->
    <div style="flex:1; display:flex; justify-content:center; align-items:center;">

        <div style="
            width:350px;
            background:white;
            padding:30px;
            border-radius:15px;
            box-shadow:0 5px 20px rgba(0,0,0,0.1);
        ">

            <h2 style="color:#ff7a00;">Login</h2>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <input type="email" name="email" placeholder="Email"
                    style="width:100%; padding:10px; margin-top:10px; border-radius:8px; border:1px solid #ccc;" required>

                <input type="password" name="password" placeholder="Password"
                    style="width:100%; padding:10px; margin-top:10px; border-radius:8px; border:1px solid #ccc;" required>

                <button type="submit" style="
                    width:100%;
                    margin-top:15px;
                    background:#ff7a00;
                    color:white;
                    padding:12px;
                    border:none;
                    border-radius:8px;
                ">
                    LOGIN
                </button>
            </form>

            <p style="text-align:center; margin-top:10px;">
                Belum punya akun?
                <a href="{{ route('register') }}" style="color:#ff7a00;">
                    Daftar
                </a>
            </p>

        </div>

    </div>

</div>

</body>
</html>