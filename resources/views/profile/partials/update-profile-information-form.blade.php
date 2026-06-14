<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Profile Information
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Update informasi akun Anda.
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <!-- Nama -->
        <div>
            <x-input-label for="name" value="Nama" />
            <x-text-input
                id="name"
                name="name"
                type="text"
                class="mt-1 block w-full"
                :value="old('name', $user->name)"
                required
            />
        </div>

        <!-- Email -->
        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input
                id="email"
                name="email"
                type="email"
                class="mt-1 block w-full"
                :value="old('email', $user->email)"
                required
            />
        </div>

        <!-- No HP -->
        <x-input-label for="phone" value="No HP" />
            <x-text-input
                id="phone"
                name="phone"
                type="text"
                class="mt-1 block w-full"
                :value="old('phone', $user->phone)"
            />

        <!-- Alamat -->
        <div>
            <x-input-label for="address" value="Alamat" />

           <textarea
                id="address"
                name="address"
                class="mt-1 block w-full border-gray-300 rounded-md"
                rows="4"
            >{{ old('address', $user->address) }}
        
        </textarea>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>
                Simpan
            </x-primary-button>

            @if (session('status') === 'profile-updated')
                <p class="text-sm text-green-600">
                    Data berhasil disimpan.
                </p>
            @endif
        </div>

    </form>
</section>