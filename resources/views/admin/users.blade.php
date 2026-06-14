<x-app-layout>

<x-slot name="header">
    <h2>Data User</h2>
</x-slot>

<div style="padding:30px;">

    @if(session('success'))
        <div style="
            background:#d4edda;
            padding:10px;
            margin-bottom:15px;
            border-radius:5px;
        ">
            {{ session('success') }}
        </div>
    @endif

    <table border="1" width="100%" cellpadding="10"
        style="border-collapse:collapse; background:white;">

        <tr style="background:#ff7a00; color:white;">
            <th>Nama</th>
            <th>Email</th>
            <th>No HP</th>
            <th>Role</th>
            <th>Aksi</th>
        </tr>

        @foreach($users as $user)

        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->phone }}</td>
            <td>{{ $user->role }}</td>

           <td style="display:flex; gap:5px;">

            <a href="{{ route('admin.role', $user->id) }}"
                style="
                    background:#ff7a00;
                    color:white;
                    padding:6px 10px;
                    border-radius:5px;
                    text-decoration:none;
                ">
                Ubah Role
            </a>

            <form action="{{ route('admin.user.delete', $user->id) }}"
                method="POST">

                @csrf
                @method('DELETE')

                <button
                    onclick="return confirm('Yakin ingin menghapus user ini?')"
                    style="
                        background:red;
                        color:white;
                        border:none;
                        padding:6px 10px;
                        border-radius:5px;
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