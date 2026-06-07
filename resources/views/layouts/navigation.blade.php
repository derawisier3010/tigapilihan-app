<nav class="bg-white border-b">

    <div style="padding:15px; display:flex; justify-content:space-between; align-items:center;">
        
        <!-- LOGO -->
        <div style="display:flex; align-items:center;">
            <img src="{{ asset('images/logo.png') }}" style="height:65px;">
            <b style="color:#ff7a00; font-size:20px;">TigaPilihan.ptk</b>
        </div>

        <div style="display:flex; align-items:center; gap:20px;">

    <!-- MENU UTAMA -->
   <a href="/dashboard" style="text-decoration:none; font-weight:500;">
    Home
    </a>

    <a href="/products" style="text-decoration:none; font-weight:500;">
        Produk
    </a>

    <a href="/cart" style="text-decoration:none;">
        Keranjang ({{ count(session('cart', [])) }})
    </a>

    <a href="/pesanan" style="text-decoration:none; font-weight:500;">
        Pesanan Saya
    </a>

    <a href="/profile" style="text-decoration:none; font-weight:500;">
        Profile
    </a>

    <!-- ADMIN -->
   @if(auth()->user()->role == 'admin')

    <a href="/admin"
       style="text-decoration:none; color:#ff7a00; font-weight:bold;">
        Admin
    </a>

    <a href="/admin/users"
       style="text-decoration:none; color:#ff7a00; font-weight:bold;">
        Data User
    </a>

@endif

    <!-- USER -->
    <div style="
        display:flex;
        align-items:center;
        gap:10px;
        padding-left:10px;
        border-left:1px solid #ddd;
    ">
        <span style="font-size:14px; color:gray;">
            👤 {{ auth()->user()->name }}
        </span>

        <!-- LOGOUT -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button style="
                background:#ff4d4d;
                color:white;
                border:none;
                padding:6px 12px;
                border-radius:6px;
                cursor:pointer;
                font-size:12px;
            ">
                Logout
            </button>
        </form>
    </div>

</div>

</nav>