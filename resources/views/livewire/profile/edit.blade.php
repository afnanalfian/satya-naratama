<div>
    <x-page-header title="Ubah Profil" sub="Perbarui data akun dan data pendaftaranmu." :back="route('profile.show')"/>
    <form wire:submit="save" class="grid gap-6 lg:grid-cols-3">
        <div class="card card-pad h-fit text-center">
            <label class="relative mx-auto block w-fit cursor-pointer">
                <img src="{{ $avatar && method_exists($avatar, 'temporaryUrl') ? $avatar->temporaryUrl() : auth()->user()->avatar_url }}" class="h-32 w-32 rounded-[2rem] object-cover ring-4 ring-saffron-100" alt="">
                <span class="absolute -bottom-2 -right-2 grid h-10 w-10 place-items-center rounded-2xl bg-garnet-600 text-white shadow-glow"><x-icon name="image" class="h-5 w-5"/></span>
                <input type="file" wire:model="avatar" accept="image/*" class="hidden">
            </label>
            <p class="mt-4 text-xs text-ink-400">Klik foto untuk mengganti · maks 2 MB</p>
            <p wire:loading wire:target="avatar" class="text-xs font-bold text-garnet-600">Mengunggah…</p>
            @error('avatar')<p class="error">{{ $message }}</p>@enderror
        </div>
        <div class="space-y-6 lg:col-span-2">
            <div class="card card-pad">
                <p class="section-title">Akun</p>
                <div class="mt-4 grid gap-4 sm:grid-cols-2">
                    <x-field label="Nama tampilan" name="name" required><input wire:model="name" class="input"></x-field>
                    <x-field label="No. HP" name="phone"><input wire:model="phone" class="input"></x-field>
                    <x-field label="Provinsi" name="province_id"><select wire:model.live="province_id" class="select"><option value="">—</option>@foreach($provinces as $p)<option value="{{ $p->id }}">{{ $p->name }}</option>@endforeach</select></x-field>
                    <x-field label="Kabupaten/Kota" name="regency_id"><select wire:model="regency_id" class="select"><option value="">—</option>@foreach($regencies as $r)<option value="{{ $r->id }}">{{ $r->name }}</option>@endforeach</select></x-field>
                </div>
            </div>
            @if($hasRegistration)
                <div class="card card-pad">
                    <p class="section-title">Data pendaftaran</p>
                    <div class="mt-4 grid gap-4 sm:grid-cols-2">
                        <x-field label="Nama lengkap" name="reg.full_name"><input wire:model="reg.full_name" class="input"></x-field>
                        <x-field label="Nama panggilan" name="reg.nickname"><input wire:model="reg.nickname" class="input"></x-field>
                        <x-field label="Tanggal lahir" name="reg.birth_date"><input type="date" wire:model="reg.birth_date" class="input"></x-field>
                        <x-field label="Jenis kelamin" name="reg.gender"><select wire:model="reg.gender" class="select"><option value="L">Laki-laki</option><option value="P">Perempuan</option></select></x-field>
                        <x-field label="Asal sekolah" name="reg.school_origin"><input wire:model="reg.school_origin" class="input"></x-field>
                        <x-field label="Kelas" name="reg.class"><select wire:model="reg.class" class="select">@foreach(config('satya.classes') as $c)<option>{{ $c }}</option>@endforeach</select></x-field>
                        <x-field label="No. WA siswa" name="reg.phone"><input wire:model="reg.phone" class="input"></x-field>
                        <x-field label="Ukuran baju" name="reg.shirt_size"><select wire:model="reg.shirt_size" class="select"><option value="">—</option>@foreach(config('satya.shirt_sizes') as $s)<option>{{ $s }}</option>@endforeach</select></x-field>
                        <x-field label="Kecamatan" name="reg.kecamatan_id"><select wire:model.live="reg.kecamatan_id" class="select"><option value="">—</option>@foreach($kecamatans as $k)<option value="{{ $k->id }}">{{ $k->name }}</option>@endforeach</select></x-field>
                        <x-field label="Kelurahan/Desa" name="reg.kelurahan_id"><select wire:model="reg.kelurahan_id" class="select"><option value="">—</option>@foreach($kelurahans as $k)<option value="{{ $k->id }}">{{ $k->name }}</option>@endforeach</select></x-field>
                        <x-field label="Tinggi (cm)" name="reg.height_cm"><input type="number" wire:model="reg.height_cm" class="input"></x-field>
                        <x-field label="Berat (kg)" name="reg.weight_kg"><input type="number" wire:model="reg.weight_kg" class="input"></x-field>
                        <x-field label="Kampus impian 1" name="reg.priority_university_1"><select wire:model="reg.priority_university_1" class="select"><option value="">—</option>@foreach(config('satya.universities') as $u)<option>{{ $u }}</option>@endforeach</select></x-field>
                        <x-field label="Kampus impian 2" name="reg.priority_university_2"><select wire:model="reg.priority_university_2" class="select"><option value="">—</option>@foreach(config('satya.universities') as $u)<option>{{ $u }}</option>@endforeach</select></x-field>
                        <x-field label="Nama orang tua" name="reg.parent_name"><input wire:model="reg.parent_name" class="input"></x-field>
                        <x-field label="Pekerjaan orang tua" name="reg.parent_occupation"><input wire:model="reg.parent_occupation" class="input"></x-field>
                        <x-field label="No. HP orang tua" name="reg.parent_phone"><input wire:model="reg.parent_phone" class="input"></x-field>
                    </div>
                </div>
            @endif
            <div class="flex justify-end gap-2">
                <a href="{{ route('profile.show') }}" class="btn-soft">Batal</a>
                <button class="btn-primary" wire:loading.attr="disabled"><x-icon name="check" class="h-4 w-4"/> Simpan perubahan</button>
            </div>
        </div>
    </form>
</div>
