<div>
    <p class="eyebrow">Akun umum · tryout & kuis</p>
    <h1 class="mt-2 font-display text-3xl font-extrabold">Buat akun gratis</h1>
    <p class="mt-2 text-sm text-ink-500">Ingin ikut bimbel reguler? Gunakan <a href="{{ route('daftar.form') }}" class="link">formulir pendaftaran bimbel</a>.</p>

    <form wire:submit="register" class="mt-8 space-y-4">
        <div class="flex items-center gap-4">
            <label class="relative cursor-pointer">
                <img src="{{ $avatar && method_exists($avatar, 'temporaryUrl') ? $avatar->temporaryUrl() : asset('img/user.png') }}" class="h-16 w-16 rounded-2xl object-cover ring-2 ring-ink-100" alt="">
                <span class="absolute -bottom-1 -right-1 grid h-7 w-7 place-items-center rounded-xl bg-ink-900 text-white"><x-icon name="image" class="h-4 w-4"/></span>
                <input type="file" wire:model="avatar" accept="image/*" class="hidden">
            </label>
            <div class="text-xs text-ink-500"><p class="font-bold text-ink-700">Foto profil (opsional)</p>JPG/PNG maks. 2 MB <span wire:loading wire:target="avatar" class="text-garnet-600">· mengunggah…</span>@error('avatar')<p class="error">{{ $message }}</p>@enderror</div>
        </div>
        <x-field label="Nama lengkap" name="name" required><input wire:model="name" class="input" autocomplete="name"></x-field>
        <div class="grid gap-4 sm:grid-cols-2">
            <x-field label="Email" name="email" required><input wire:model="email" type="email" class="input" autocomplete="email"></x-field>
            <x-field label="No. HP / WhatsApp" name="phone"><input wire:model="phone" class="input" inputmode="tel" placeholder="08…"></x-field>
        </div>
        <div class="grid gap-4 sm:grid-cols-2">
            <x-field label="Provinsi" name="province_id" required>
                <select wire:model.live="province_id" class="select"><option value="">Pilih provinsi</option>@foreach($provinces as $p)<option value="{{ $p->id }}">{{ $p->name }}</option>@endforeach</select>
            </x-field>
            <x-field label="Kabupaten/Kota" name="regency_id" required>
                <select wire:model="regency_id" class="select" @disabled(! $province_id)><option value="">{{ $province_id ? 'Pilih kabupaten/kota' : 'Pilih provinsi dulu' }}</option>@foreach($regencies as $r)<option value="{{ $r->id }}">{{ $r->name }}</option>@endforeach</select>
            </x-field>
        </div>
        <div class="grid gap-4 sm:grid-cols-2">
            <x-field label="Password" name="password" required><input wire:model="password" type="password" class="input" autocomplete="new-password"></x-field>
            <x-field label="Ulangi password" name="password_confirmation" required><input wire:model="password_confirmation" type="password" class="input" autocomplete="new-password"></x-field>
        </div>
        <button class="btn-primary btn-lg w-full" wire:loading.attr="disabled" wire:target="register,avatar">
            <span wire:loading.remove wire:target="register">Buat akun</span><span wire:loading wire:target="register">Membuat akun…</span>
        </button>
        <p class="text-center text-sm text-ink-500">Sudah punya akun? <a href="{{ route('login') }}" class="link">Masuk</a></p>
    </form>
</div>
