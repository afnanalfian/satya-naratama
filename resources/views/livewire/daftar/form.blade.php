@php
    $steps = [1 => ['Data Diri', 'user'], 2 => ['Domisili & Fisik', 'map'], 3 => ['Target & Orang Tua', 'target'], 4 => ['Akun', 'lock']];
@endphp
<div x-data x-on:scroll-top.window="window.scrollTo({ top: 0, behavior: 'smooth' })" class="relative">
    <div class="absolute inset-x-0 top-0 -z-10 h-[420px] bg-ink-950">
        <div class="absolute inset-0 bg-grid-ink [background-size:36px_36px]"></div>
        <div class="blob left-10 top-10 h-72 w-72 bg-garnet-600/40"></div>
        <div class="blob right-10 top-20 h-72 w-72 bg-saffron-500/25"></div>
    </div>

    <div class="mx-auto max-w-4xl px-4 pb-16 pt-10 sm:px-6">
        <div class="text-center text-white">
            <span class="badge bg-white/10 text-saffron-300 ring-1 ring-white/15">Pendaftaran Bimbel Reguler</span>
            <h1 class="mt-4 font-display text-3xl font-extrabold sm:text-5xl">Gabung <span class="text-saffron-400">Satya Naratama</span></h1>
            <p class="mx-auto mt-3 max-w-xl text-sm text-ink-200 sm:text-base">Isi data dalam 4 langkah singkat. Setelah membayar & diverifikasi admin, akunmu langsung aktif.</p>
        </div>

        {{-- Stepper --}}
        <ol class="mt-8 grid grid-cols-4 gap-2">
            @foreach($steps as $n => [$label, $icon])
                <li>
                    <button type="button" wire:click="goTo({{ $n }})" class="group flex w-full flex-col items-center gap-2 text-center">
                        <span class="grid h-11 w-11 place-items-center rounded-2xl transition sm:h-12 sm:w-12
                            {{ $step > $n ? 'bg-lagoon-500 text-white' : ($step === $n ? 'bg-saffron-400 text-ink-900 shadow-glow-gold scale-110' : 'bg-white/10 text-ink-300') }}">
                            @if($step > $n)<x-icon name="check" class="h-5 w-5" stroke="2.5"/>@else<x-icon :name="$icon" class="h-5 w-5"/>@endif
                        </span>
                        <span class="hidden text-xs font-bold sm:block {{ $step >= $n ? 'text-white' : 'text-ink-400' }}">{{ $label }}</span>
                    </button>
                </li>
            @endforeach
        </ol>

        <div class="card mt-6 p-5 sm:p-8">
            <form wire:submit="{{ $step < 4 ? 'next' : 'submit' }}">
                {{-- STEP 1 --}}
                @if($step === 1)
                    <h2 class="section-title">Data diri calon siswa</h2>
                    <p class="text-sm text-ink-500">Pastikan sesuai identitas resmi.</p>
                    <div class="mt-6 flex items-center gap-4">
                        <label class="relative cursor-pointer">
                            <img src="{{ $avatar && method_exists($avatar, 'temporaryUrl') ? $avatar->temporaryUrl() : asset('img/user.png') }}" class="h-20 w-20 rounded-3xl object-cover ring-4 ring-saffron-100" alt="">
                            <span class="absolute -bottom-1 -right-1 grid h-8 w-8 place-items-center rounded-xl bg-garnet-600 text-white shadow-glow"><x-icon name="image" class="h-4 w-4"/></span>
                            <input type="file" wire:model="avatar" accept="image/*" class="hidden">
                        </label>
                        <div class="text-sm"><p class="font-bold">Pas foto (opsional)</p><p class="text-xs text-ink-400">JPG/PNG maks. 2 MB</p>
                            <p wire:loading wire:target="avatar" class="text-xs font-bold text-garnet-600">Mengunggah…</p>@error('avatar')<p class="error">{{ $message }}</p>@enderror</div>
                    </div>
                    <div class="mt-6 grid gap-4 sm:grid-cols-2">
                        <x-field label="Nama lengkap" name="full_name" required class="sm:col-span-2"><input wire:model="full_name" class="input" placeholder="Sesuai akta/ijazah"></x-field>
                        <x-field label="Nama panggilan" name="nickname"><input wire:model="nickname" class="input"></x-field>
                        <x-field label="Tanggal lahir" name="birth_date" required><input wire:model="birth_date" type="date" class="input" max="{{ now()->subDay()->toDateString() }}"></x-field>
                        <x-field label="Jenis kelamin" name="gender" required>
                            <div class="grid grid-cols-2 gap-2">
                                @foreach(['L' => 'Laki-laki', 'P' => 'Perempuan'] as $k => $v)
                                    <label class="flex cursor-pointer items-center gap-2 rounded-2xl border-2 px-4 py-2.5 text-sm font-bold transition {{ $gender === $k ? 'border-garnet-500 bg-garnet-50 text-garnet-700' : 'border-ink-100 hover:border-ink-300' }}">
                                        <input type="radio" wire:model.live="gender" value="{{ $k }}" class="radio"> {{ $v }}
                                    </label>
                                @endforeach
                            </div>
                        </x-field>
                        <x-field label="No. WhatsApp siswa" name="phone" required><input wire:model="phone" inputmode="numeric" class="input" placeholder="08xxxxxxxxxx"></x-field>
                        <x-field label="Asal sekolah" name="school_origin" required><input wire:model="school_origin" class="input" placeholder="SMA Negeri 1 …"></x-field>
                        <x-field label="Kelas" name="class" required>
                            <div class="grid grid-cols-4 gap-2">
                                @foreach($classes as $c)
                                    <label class="cursor-pointer rounded-2xl border-2 py-2.5 text-center text-sm font-bold transition {{ $class === $c ? 'border-ink-900 bg-ink-900 text-white' : 'border-ink-100 hover:border-ink-300' }}">
                                        <input type="radio" wire:model.live="class" value="{{ $c }}" class="hidden">{{ $c }}
                                    </label>
                                @endforeach
                            </div>
                        </x-field>
                        <x-field label="Ukuran baju" name="shirt_size" hint="Untuk seragam latihan">
                            <div class="flex flex-wrap gap-2">
                                @foreach($sizes as $s)
                                    <label class="cursor-pointer rounded-xl border-2 px-3.5 py-2 text-sm font-bold transition {{ $shirt_size === $s ? 'border-saffron-500 bg-saffron-50 text-saffron-800' : 'border-ink-100 hover:border-ink-300' }}">
                                        <input type="radio" wire:model.live="shirt_size" value="{{ $s }}" class="hidden">{{ $s }}
                                    </label>
                                @endforeach
                            </div>
                        </x-field>
                    </div>
                @endif

                {{-- STEP 2 --}}
                @if($step === 2)
                    <h2 class="section-title">Domisili & data fisik</h2>
                    <p class="text-sm text-ink-500">Wilayah Kabupaten Pangkajene dan Kepulauan.</p>
                    <div class="mt-6 grid gap-4 sm:grid-cols-2">
                        <x-field label="Kecamatan" name="kecamatan_id" required>
                            <select wire:model.live="kecamatan_id" class="select"><option value="">Pilih kecamatan</option>@foreach($kecamatans as $k)<option value="{{ $k->id }}">{{ $k->name }}</option>@endforeach</select>
                        </x-field>
                        <x-field label="Kelurahan / Desa" name="kelurahan_id" required>
                            <select wire:model="kelurahan_id" class="select" @disabled(! $kecamatan_id) wire:loading.attr="disabled" wire:target="kecamatan_id">
                                <option value="">{{ $kecamatan_id ? 'Pilih kelurahan/desa' : 'Pilih kecamatan dulu' }}</option>
                                @foreach($kelurahans as $k)<option value="{{ $k->id }}">{{ $k->name }}</option>@endforeach
                            </select>
                        </x-field>
                        <x-field label="Tinggi badan (cm)" name="height_cm"><div class="relative"><input wire:model="height_cm" type="number" class="input pr-12" placeholder="170"><span class="absolute right-4 top-1/2 -translate-y-1/2 text-xs font-bold text-ink-400">cm</span></div></x-field>
                        <x-field label="Berat badan (kg)" name="weight_kg"><div class="relative"><input wire:model="weight_kg" type="number" class="input pr-12" placeholder="60"><span class="absolute right-4 top-1/2 -translate-y-1/2 text-xs font-bold text-ink-400">kg</span></div></x-field>
                    </div>
                    <div class="mt-5 flex gap-3 rounded-2xl bg-saffron-50 p-4 text-sm text-saffron-900 ring-1 ring-saffron-200"><x-icon name="info" class="h-5 w-5 shrink-0"/>Data fisik membantu pelatih menyusun program jasmani. Kamu bisa memperbaruinya tiap bulan setelah akun aktif.</div>
                @endif

                {{-- STEP 3 --}}
                @if($step === 3)
                    <h2 class="section-title">Kampus impian</h2>
                    <div class="mt-4 grid grid-cols-3 gap-2 sm:grid-cols-4 md:grid-cols-6">
                        @foreach($universities as $u)
                            @php $sel = $priority_university_1 === $u ? 1 : ($priority_university_2 === $u ? 2 : 0); @endphp
                            <button type="button"
                                wire:click="$set('{{ $sel === 1 ? 'priority_university_1' : ($sel === 2 ? 'priority_university_2' : ($priority_university_1 ? 'priority_university_2' : 'priority_university_1')) }}', '{{ $sel ? '' : $u }}')"
                                class="relative rounded-2xl border-2 px-2 py-3 text-xs font-extrabold transition {{ $sel === 1 ? 'border-garnet-500 bg-garnet-600 text-white shadow-glow' : ($sel === 2 ? 'border-saffron-400 bg-saffron-50 text-saffron-800' : 'border-ink-100 hover:border-ink-300') }}">
                                {{ $u }}
                                @if($sel)<span class="absolute -right-1.5 -top-1.5 grid h-5 w-5 place-items-center rounded-full bg-ink-900 text-[10px] text-white">{{ $sel }}</span>@endif
                            </button>
                        @endforeach
                    </div>
                    <p class="hint">Klik sekali untuk pilihan 1, klik kampus lain untuk pilihan 2. Klik lagi untuk membatalkan.</p>
                    @error('priority_university_1')<p class="error">{{ $message }}</p>@enderror
                    @error('priority_university_2')<p class="error">{{ $message }}</p>@enderror

                    <div class="divider my-6"></div>
                    <h2 class="section-title">Data orang tua / wali</h2>
                    <div class="mt-4 grid gap-4 sm:grid-cols-2">
                        <x-field label="Nama orang tua/wali" name="parent_name" required><input wire:model="parent_name" class="input"></x-field>
                        <x-field label="Pekerjaan" name="parent_occupation"><input wire:model="parent_occupation" class="input"></x-field>
                        <x-field label="No. HP/WA orang tua" name="parent_phone" required hint="Untuk info perkembangan & link pantauan belajar."><input wire:model="parent_phone" inputmode="numeric" class="input" placeholder="08xxxxxxxxxx"></x-field>
                    </div>
                @endif

                {{-- STEP 4 --}}
                @if($step === 4)
                    <h2 class="section-title">Buat akun belajar</h2>
                    <p class="text-sm text-ink-500">Akun aktif setelah pembayaran diverifikasi admin.</p>
                    <div class="mt-6 grid gap-4 sm:grid-cols-2">
                        <x-field label="Email aktif" name="email" required class="sm:col-span-2"><input wire:model="email" type="email" class="input" placeholder="nama@email.com"></x-field>
                        <x-field label="Password" name="password" required hint="Minimal 8 karakter"><input wire:model="password" type="password" class="input" autocomplete="new-password"></x-field>
                        <x-field label="Ulangi password" name="password_confirmation" required><input wire:model="password_confirmation" type="password" class="input" autocomplete="new-password"></x-field>
                    </div>

                    <div class="mt-6 rounded-3xl bg-ink-900 p-5 text-white">
                        <p class="text-xs font-bold uppercase tracking-widest text-saffron-400">Ringkasan</p>
                        <dl class="mt-3 grid gap-x-6 gap-y-2 text-sm sm:grid-cols-2">
                            <div class="flex justify-between gap-2"><dt class="text-ink-300">Nama</dt><dd class="font-bold">{{ $full_name }}</dd></div>
                            <div class="flex justify-between gap-2"><dt class="text-ink-300">Sekolah</dt><dd class="font-bold">{{ $school_origin }} ({{ $class }})</dd></div>
                            <div class="flex justify-between gap-2"><dt class="text-ink-300">Kampus impian</dt><dd class="font-bold">{{ $priority_university_1 }}{{ $priority_university_2 ? ' / '.$priority_university_2 : '' }}</dd></div>
                            <div class="flex justify-between gap-2"><dt class="text-ink-300">Orang tua</dt><dd class="font-bold">{{ $parent_name }}</dd></div>
                        </dl>
                        <div class="mt-4 flex items-end justify-between border-t border-white/10 pt-4">
                            <span class="text-sm text-ink-300">Biaya pendaftaran</span>
                            <span class="font-display text-2xl font-extrabold text-saffron-400">Rp {{ number_format(config('satya.registration_fee'), 0, ',', '.') }}</span>
                        </div>
                    </div>
                    <label class="mt-5 flex items-start gap-3 text-sm">
                        <input type="checkbox" wire:model="agree" class="checkbox mt-0.5">
                        <span>Saya menyatakan data di atas benar dan bersedia mengikuti peraturan bimbel Satya Naratama.</span>
                    </label>
                    @error('agree')<p class="error">{{ $message }}</p>@enderror
                @endif

                <div class="mt-8 flex items-center justify-between gap-3 border-t border-ink-50 pt-6">
                    @if($step > 1)
                        <button type="button" wire:click="back" class="btn-soft"><x-icon name="arrow-left" class="h-4 w-4"/> Kembali</button>
                    @else
                        <a href="{{ route('daftar.status.form') }}" class="text-sm font-bold text-ink-500 hover:text-garnet-600">Sudah daftar? Cek status</a>
                    @endif
                    <button class="{{ $step < 4 ? 'btn-ink' : 'btn-primary btn-lg' }}" wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="next,submit">{{ $step < 4 ? 'Lanjut' : 'Daftar & Lanjut Bayar' }}</span>
                        <span wire:loading wire:target="next,submit">Memproses…</span>
                        <x-icon name="arrow-right" class="h-4 w-4"/>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
