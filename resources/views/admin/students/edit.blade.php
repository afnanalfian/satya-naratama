<x-layouts.app :title="'Ubah Siswa · '.$user->name">
@php $r = $user->studentRegistration; $v = fn ($k, $d = null) => old($k, $d); @endphp
<x-page-header title="Ubah Data Siswa" :sub="$user->display_name" :back="route('siswa.show', $user->id)"/>
<form method="POST" action="{{ route('admin.students.update', $user->id) }}" enctype="multipart/form-data" class="grid gap-6 lg:grid-cols-3" x-data="{ prov: '{{ $v('province_id', $user->province_id) }}', regs: [], reg: '{{ $v('regency_id', $user->regency_id) }}', kec: '{{ $v('kecamatan_id', $r?->kecamatan_id) }}', preview: null,
    async loadRegs() { if (!this.prov) { this.regs = []; return } const r = await fetch('/get-regencies/' + this.prov); this.regs = await r.json(); } }" x-init="loadRegs()">
    @csrf @method('PUT')
    <div class="card card-pad h-fit text-center">
        <label class="relative mx-auto block w-fit cursor-pointer">
            <img :src="preview || '{{ $user->avatar_url }}'" class="h-32 w-32 rounded-[2rem] object-cover ring-4 ring-saffron-100" alt="">
            <span class="absolute -bottom-2 -right-2 grid h-10 w-10 place-items-center rounded-2xl bg-garnet-600 text-white"><x-icon name="image" class="h-5 w-5"/></span>
            <input type="file" name="avatar" accept="image/*" class="hidden" @change="preview = URL.createObjectURL($event.target.files[0])">
        </label>
        <label class="mt-6 flex items-center justify-center gap-2 text-sm font-bold"><input type="hidden" name="is_active" value="0"><input type="checkbox" name="is_active" value="1" class="checkbox" @checked($v('is_active', $user->is_active))> Akun aktif</label>
    </div>
    <div class="space-y-6 lg:col-span-2">
        <div class="card card-pad">
            <p class="section-title">Akun</p>
            <div class="mt-4 grid gap-4 sm:grid-cols-2">
                <x-field label="Nama akun" name="name" required><input name="name" value="{{ $v('name', $user->name) }}" class="input" required></x-field>
                <x-field label="Email" name="email" required><input type="email" name="email" value="{{ $v('email', $user->email) }}" class="input" required></x-field>
                <x-field label="No. HP" name="phone"><input name="phone" value="{{ $v('phone', $user->phone) }}" class="input"></x-field>
                <div></div>
                <x-field label="Provinsi" name="province_id"><select name="province_id" x-model="prov" @change="reg=''; loadRegs()" class="select"><option value="">—</option>@foreach($provinces as $p)<option value="{{ $p->id }}">{{ $p->name }}</option>@endforeach</select></x-field>
                <x-field label="Kabupaten/Kota" name="regency_id"><select name="regency_id" x-model="reg" class="select"><option value="">—</option><template x-for="r in regs" :key="r.id"><option :value="r.id" x-text="r.name" :selected="r.id == reg"></option></template></select></x-field>
                <x-field label="Password baru" name="password" hint="Kosongkan jika tidak diubah"><input type="password" name="password" class="input" autocomplete="new-password"></x-field>
                <x-field label="Ulangi password" name="password_confirmation"><input type="password" name="password_confirmation" class="input" autocomplete="new-password"></x-field>
            </div>
        </div>
        @if($r)
        <div class="card card-pad">
            <p class="section-title">Data pendaftaran</p>
            <div class="mt-4 grid gap-4 sm:grid-cols-2">
                <x-field label="Nama lengkap" name="full_name" required><input name="full_name" value="{{ $v('full_name', $r->full_name) }}" class="input" required></x-field>
                <x-field label="Panggilan" name="nickname"><input name="nickname" value="{{ $v('nickname', $r->nickname) }}" class="input"></x-field>
                <x-field label="Tanggal lahir" name="birth_date" required><input type="date" name="birth_date" value="{{ $v('birth_date', $r->birth_date?->format('Y-m-d')) }}" class="input" required></x-field>
                <x-field label="Jenis kelamin" name="gender" required><select name="gender" class="select">@foreach(['L' => 'Laki-laki', 'P' => 'Perempuan'] as $k => $l)<option value="{{ $k }}" @selected($v('gender', $r->gender) === $k)>{{ $l }}</option>@endforeach</select></x-field>
                <x-field label="Asal sekolah" name="school_origin" required><input name="school_origin" value="{{ $v('school_origin', $r->school_origin) }}" class="input" required></x-field>
                <x-field label="Kelas" name="class" required><select name="class" class="select">@foreach($classes as $c)<option @selected($v('class', $r->class) === $c)>{{ $c }}</option>@endforeach</select></x-field>
                <x-field label="No. WA siswa" name="registration_phone" required><input name="registration_phone" value="{{ $v('registration_phone', $r->phone) }}" class="input" required></x-field>
                <x-field label="Ukuran baju" name="shirt_size"><select name="shirt_size" class="select"><option value="">—</option>@foreach($shirtSizes as $s)<option @selected($v('shirt_size', $r->shirt_size) === $s)>{{ $s }}</option>@endforeach</select></x-field>
                <x-field label="Kecamatan" name="kecamatan_id" required><select name="kecamatan_id" x-model="kec" class="select">@foreach($kecamatans as $k)<option value="{{ $k->id }}">{{ $k->name }}</option>@endforeach</select></x-field>
                <x-field label="Kelurahan/Desa" name="kelurahan_id" required><select name="kelurahan_id" class="select">@foreach($kelurahans as $k)<option value="{{ $k->id }}" x-show="kec == '{{ $k->kecamatan_id }}'" @selected($v('kelurahan_id', $r->kelurahan_id) == $k->id)>{{ $k->name }}</option>@endforeach</select></x-field>
                <x-field label="Tinggi (cm)" name="height_cm"><input type="number" name="height_cm" value="{{ $v('height_cm', $r->height_cm) }}" class="input"></x-field>
                <x-field label="Berat (kg)" name="weight_kg"><input type="number" name="weight_kg" value="{{ $v('weight_kg', $r->weight_kg) }}" class="input"></x-field>
                <x-field label="Kampus impian 1" name="priority_university_1" required><select name="priority_university_1" class="select">@foreach($universities as $u)<option @selected($v('priority_university_1', $r->priority_university_1) === $u)>{{ $u }}</option>@endforeach</select></x-field>
                <x-field label="Kampus impian 2" name="priority_university_2"><select name="priority_university_2" class="select"><option value="">—</option>@foreach($universities as $u)<option @selected($v('priority_university_2', $r->priority_university_2) === $u)>{{ $u }}</option>@endforeach</select></x-field>
                <x-field label="Nama orang tua" name="parent_name" required><input name="parent_name" value="{{ $v('parent_name', $r->parent_name) }}" class="input" required></x-field>
                <x-field label="Pekerjaan orang tua" name="parent_occupation"><input name="parent_occupation" value="{{ $v('parent_occupation', $r->parent_occupation) }}" class="input"></x-field>
                <x-field label="HP orang tua" name="parent_phone" required><input name="parent_phone" value="{{ $v('parent_phone', $r->parent_phone) }}" class="input" required></x-field>
            </div>
        </div>
        @endif
        <div class="flex justify-end gap-2"><a href="{{ route('siswa.show', $user->id) }}" class="btn-soft">Batal</a><button class="btn-primary"><x-icon name="check" class="h-4 w-4"/> Simpan</button></div>
    </div>
</form>
</x-layouts.app>
