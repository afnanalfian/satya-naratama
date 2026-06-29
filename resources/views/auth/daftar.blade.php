@extends('layouts.guest')

@section('title', 'Pendaftaran – Satya Naratama')
@section('content')

<div class="w-full py-12 sm:py-20 px-4 flex items-center justify-center">

    <div
        class="w-full max-w-4xl mx-auto
            p-6 sm:p-8
            rounded-3xl shadow-xl
            bg-azwara-lightest dark:bg-azwara-darker
            border border-azwara-light/30
            transition-colors">

        {{-- Title --}}
        <div class="text-center mb-8">
            <div class="flex items-center justify-center gap-3 mb-2">
                <span class="h-px w-8 bg-primary/60"></span>
                <p class="text-xs font-semibold tracking-[0.2em] text-primary uppercase">Pendaftaran</p>
                <span class="h-px w-8 bg-primary/60"></span>
            </div>
            <h2 class="text-3xl font-extrabold text-azwara-darker dark:text-white">
                Daftar Sekarang 🎉
            </h2>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                Isi formulir pendaftaran dengan lengkap dan benar
            </p>
        </div>

        {{-- Form --}}
        <form action="{{ route('daftar.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            {{-- Errors --}}
            @if ($errors->any())
                <div class="bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 rounded-xl p-4 border border-red-200 dark:border-red-800">
                    <ul class="text-sm space-y-1">
                        @foreach ($errors->all() as $err)
                            <li>• {{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Data Pribadi --}}
            <div class="border-b border-azwara-lighter dark:border-gray-700 pb-4">
                <h3 class="text-lg font-semibold text-azwara-darker dark:text-white mb-4">
                    Data Pribadi
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    {{-- Nama Lengkap --}}
                    <div>
                        <label class="text-sm font-medium text-gray-700 dark:text-gray-300">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="full_name" required
                            value="{{ old('full_name') }}"
                            placeholder="Nama lengkap"
                            class="mt-1 w-full px-4 py-3 rounded-xl
                                    bg-white dark:bg-gray-800
                                    border-gray-300 dark:border-gray-700
                                    text-gray-800 dark:text-white
                                    focus:ring-primary focus:border-primary">
                    </div>

                    {{-- Panggilan --}}
                    <div>
                        <label class="text-sm font-medium text-gray-700 dark:text-gray-300">
                            Nama Panggilan
                        </label>
                        <input type="text" name="nickname"
                            value="{{ old('nickname') }}"
                            placeholder="Nama panggilan"
                            class="mt-1 w-full px-4 py-3 rounded-xl
                                    bg-white dark:bg-gray-800
                                    border-gray-300 dark:border-gray-700
                                    text-gray-800 dark:text-white
                                    focus:ring-primary focus:border-primary">
                    </div>

                    {{-- Tanggal Lahir --}}
                    <div>
                        <label class="text-sm font-medium text-gray-700 dark:text-gray-300">
                            Tanggal Lahir <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="birth_date" required
                            value="{{ old('birth_date') }}"
                            class="mt-1 w-full px-4 py-3 rounded-xl
                                    bg-white dark:bg-gray-800
                                    border-gray-300 dark:border-gray-700
                                    text-gray-800 dark:text-white
                                    focus:ring-primary focus:border-primary">
                    </div>

                    {{-- Jenis Kelamin --}}
                    <div>
                        <label class="text-sm font-medium text-gray-700 dark:text-gray-300 block mb-1">
                            Jenis Kelamin <span class="text-red-500">*</span>
                        </label>
                        <div class="flex gap-4 mt-1">
                            <label class="flex items-center gap-2 text-sm text-gray-700 dark:text-gray-300">
                                <input type="radio" name="gender" value="L" 
                                    {{ old('gender') == 'L' ? 'checked' : '' }}
                                    class="text-primary focus:ring-primary">
                                Laki-laki
                            </label>
                            <label class="flex items-center gap-2 text-sm text-gray-700 dark:text-gray-300">
                                <input type="radio" name="gender" value="P"
                                    {{ old('gender') == 'P' ? 'checked' : '' }}
                                    class="text-primary focus:ring-primary">
                                Perempuan
                            </label>
                        </div>
                    </div>

                    {{-- Asal Sekolah --}}
                    <div>
                        <label class="text-sm font-medium text-gray-700 dark:text-gray-300">
                            Asal Sekolah <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="school_origin" required
                            value="{{ old('school_origin') }}"
                            placeholder="Nama sekolah"
                            class="mt-1 w-full px-4 py-3 rounded-xl
                                    bg-white dark:bg-gray-800
                                    border-gray-300 dark:border-gray-700
                                    text-gray-800 dark:text-white
                                    focus:ring-primary focus:border-primary">
                    </div>

                    {{-- Kelas --}}
                    <div>
                        <label class="text-sm font-medium text-gray-700 dark:text-gray-300">
                            Kelas <span class="text-red-500">*</span>
                        </label>
                        <select name="class" required
                            class="mt-1 w-full px-4 py-3 rounded-xl
                                    bg-white dark:bg-gray-800
                                    border-gray-300 dark:border-gray-700
                                    text-gray-800 dark:text-white
                                    focus:ring-primary focus:border-primary">
                            <option value="">-- Pilih Kelas --</option>
                            @foreach($classes as $class)
                                <option value="{{ $class }}" {{ old('class') == $class ? 'selected' : '' }}>
                                    {{ $class }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Nomor WhatsApp --}}
                    <div>
                        <label class="text-sm font-medium text-gray-700 dark:text-gray-300">
                            Nomor WhatsApp <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="phone" required
                            value="{{ old('phone') }}"
                            placeholder="08xxxxxxxxxx"
                            class="mt-1 w-full px-4 py-3 rounded-xl
                                    bg-white dark:bg-gray-800
                                    border-gray-300 dark:border-gray-700
                                    text-gray-800 dark:text-white
                                    focus:ring-primary focus:border-primary">
                    </div>

                    {{-- Kecamatan --}}
                    <div>
                        <label class="text-sm font-medium text-gray-700 dark:text-gray-300">
                            Kecamatan <span class="text-red-500">*</span>
                        </label>
                        <select id="kecamatan_id" name="kecamatan_id" required
                            class="mt-1 w-full px-4 py-3 rounded-xl
                                    bg-white dark:bg-gray-800
                                    border-gray-300 dark:border-gray-700
                                    text-gray-800 dark:text-white
                                    focus:ring-primary focus:border-primary">
                            <option value="">-- Pilih Kecamatan --</option>
                            @foreach($kecamatans as $kec)
                                <option value="{{ $kec->id }}" {{ old('kecamatan_id') == $kec->id ? 'selected' : '' }}>
                                    {{ $kec->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Kelurahan --}}
                    <div>
                        <label class="text-sm font-medium text-gray-700 dark:text-gray-300">
                            Kelurahan/Desa <span class="text-red-500">*</span>
                        </label>
                        <select id="kelurahan_id" name="kelurahan_id" required
                            class="mt-1 w-full px-4 py-3 rounded-xl
                                    bg-white dark:bg-gray-800
                                    border-gray-300 dark:border-gray-700
                                    text-gray-800 dark:text-white
                                    focus:ring-primary focus:border-primary">
                            <option value="">-- Pilih Kelurahan --</option>
                        </select>
                    </div>

                    {{-- Tinggi Badan --}}
                    <div>
                        <label class="text-sm font-medium text-gray-700 dark:text-gray-300">
                            Tinggi Badan (cm)
                        </label>
                        <input type="number" name="height_cm"
                            value="{{ old('height_cm') }}"
                            placeholder="170"
                            min="50" max="300"
                            class="mt-1 w-full px-4 py-3 rounded-xl
                                    bg-white dark:bg-gray-800
                                    border-gray-300 dark:border-gray-700
                                    text-gray-800 dark:text-white
                                    focus:ring-primary focus:border-primary">
                    </div>

                    {{-- Berat Badan --}}
                    <div>
                        <label class="text-sm font-medium text-gray-700 dark:text-gray-300">
                            Berat Badan (kg)
                        </label>
                        <input type="number" name="weight_kg"
                            value="{{ old('weight_kg') }}"
                            placeholder="60"
                            min="10" max="500"
                            class="mt-1 w-full px-4 py-3 rounded-xl
                                    bg-white dark:bg-gray-800
                                    border-gray-300 dark:border-gray-700
                                    text-gray-800 dark:text-white
                                    focus:ring-primary focus:border-primary">
                    </div>
                </div>
            </div>

            {{-- Kampus Impian --}}
            <div class="border-b border-azwara-lighter dark:border-gray-700 pb-4">
                <h3 class="text-lg font-semibold text-azwara-darker dark:text-white mb-4">
                    Kampus Impian
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Prioritas 1 --}}
                    <div>
                        <label class="text-sm font-medium text-gray-700 dark:text-gray-300">
                            Prioritas 1 <span class="text-red-500">*</span>
                        </label>
                        <select name="priority_university_1" required
                            class="mt-1 w-full px-4 py-3 rounded-xl
                                    bg-white dark:bg-gray-800
                                    border-gray-300 dark:border-gray-700
                                    text-gray-800 dark:text-white
                                    focus:ring-primary focus:border-primary">
                            <option value="">-- Pilih Kampus --</option>
                            @foreach($universities as $uni)
                                <option value="{{ $uni }}" {{ old('priority_university_1') == $uni ? 'selected' : '' }}>
                                    {{ $uni }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Prioritas 2 --}}
                    <div>
                        <label class="text-sm font-medium text-gray-700 dark:text-gray-300">
                            Prioritas 2
                        </label>
                        <select name="priority_university_2"
                            class="mt-1 w-full px-4 py-3 rounded-xl
                                    bg-white dark:bg-gray-800
                                    border-gray-300 dark:border-gray-700
                                    text-gray-800 dark:text-white
                                    focus:ring-primary focus:border-primary">
                            <option value="">-- Pilih Kampus --</option>
                            @foreach($universities as $uni)
                                <option value="{{ $uni }}" {{ old('priority_university_2') == $uni ? 'selected' : '' }}>
                                    {{ $uni }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            {{-- Data Orangtua --}}
            <div class="border-b border-azwara-lighter dark:border-gray-700 pb-4">
                <h3 class="text-lg font-semibold text-azwara-darker dark:text-white mb-4">
                    Data Orangtua
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Nama Orangtua --}}
                    <div>
                        <label class="text-sm font-medium text-gray-700 dark:text-gray-300">
                            Nama Orangtua <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="parent_name" required
                            value="{{ old('parent_name') }}"
                            placeholder="Nama ayah/ibu"
                            class="mt-1 w-full px-4 py-3 rounded-xl
                                    bg-white dark:bg-gray-800
                                    border-gray-300 dark:border-gray-700
                                    text-gray-800 dark:text-white
                                    focus:ring-primary focus:border-primary">
                    </div>

                    {{-- Pekerjaan Orangtua --}}
                    <div>
                        <label class="text-sm font-medium text-gray-700 dark:text-gray-300">
                            Pekerjaan Orangtua
                        </label>
                        <input type="text" name="parent_occupation"
                            value="{{ old('parent_occupation') }}"
                            placeholder="Pekerjaan"
                            class="mt-1 w-full px-4 py-3 rounded-xl
                                    bg-white dark:bg-gray-800
                                    border-gray-300 dark:border-gray-700
                                    text-gray-800 dark:text-white
                                    focus:ring-primary focus:border-primary">
                    </div>

                    {{-- Nomor Telepon Orangtua --}}
                    <div>
                        <label class="text-sm font-medium text-gray-700 dark:text-gray-300">
                            Nomor Telepon Orangtua <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="parent_phone" required
                            value="{{ old('parent_phone') }}"
                            placeholder="08xxxxxxxxxx"
                            class="mt-1 w-full px-4 py-3 rounded-xl
                                    bg-white dark:bg-gray-800
                                    border-gray-300 dark:border-gray-700
                                    text-gray-800 dark:text-white
                                    focus:ring-primary focus:border-primary">
                    </div>
                </div>
            </div>

            {{-- Data Akun --}}
            <div class="border-b border-azwara-lighter dark:border-gray-700 pb-4">
                <h3 class="text-lg font-semibold text-azwara-darker dark:text-white mb-4">
                    Data Akun
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Email --}}
                    <div>
                        <label class="text-sm font-medium text-gray-700 dark:text-gray-300">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email" name="email" required
                            value="{{ old('email') }}"
                            placeholder="email@example.com"
                            class="mt-1 w-full px-4 py-3 rounded-xl
                                    bg-white dark:bg-gray-800
                                    border-gray-300 dark:border-gray-700
                                    text-gray-800 dark:text-white
                                    focus:ring-primary focus:border-primary">
                        <p class="text-xs text-gray-500 mt-1">Email akan digunakan untuk login</p>
                    </div>

                    {{-- Password --}}
                    <div>
                        <label class="text-sm font-medium text-gray-700 dark:text-gray-300">
                            Password <span class="text-red-500">*</span>
                        </label>
                        <input type="password" name="password" required
                            placeholder="Minimal 8 karakter"
                            class="mt-1 w-full px-4 py-3 rounded-xl
                                    bg-white dark:bg-gray-800
                                    border-gray-300 dark:border-gray-700
                                    text-gray-800 dark:text-white
                                    focus:ring-primary focus:border-primary">
                    </div>

                    {{-- Konfirmasi Password --}}
                    <div>
                        <label class="text-sm font-medium text-gray-700 dark:text-gray-300">
                            Konfirmasi Password <span class="text-red-500">*</span>
                        </label>
                        <input type="password" name="password_confirmation" required
                            placeholder="Ulangi password"
                            class="mt-1 w-full px-4 py-3 rounded-xl
                                    bg-white dark:bg-gray-800
                                    border-gray-300 dark:border-gray-700
                                    text-gray-800 dark:text-white
                                    focus:ring-primary focus:border-primary">
                    </div>

                    {{-- Upload Foto --}}
                    <div>
                        <label class="text-sm font-medium text-gray-700 dark:text-gray-300">
                            Foto Profil (Opsional)
                        </label>
                        <input type="file" name="avatar" accept="image/*"
                            class="mt-1 block w-full text-sm
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-xl file:border-0
                                    file:bg-primary file:text-white
                                    hover:file:bg-azwara-medium
                                    bg-white dark:bg-gray-800
                                    border border-gray-300 dark:border-gray-700
                                    rounded-xl cursor-pointer">
                        <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, GIF. Maks 2MB</p>
                    </div>
                </div>
            </div>

            {{-- Submit --}}
            <div class="space-y-4">
                <button
                    class="w-full py-3.5 rounded-xl font-bold text-white
                        bg-gradient-to-r from-primary to-azwara-medium
                        hover:shadow-xl hover:scale-[1.01] transition-all duration-300">
                    Daftar Sekarang
                </button>

                <p class="text-sm text-center text-gray-600 dark:text-gray-400">
                    Sudah punya akun?
                    <a href="{{ route('login') }}"
                       class="text-primary font-semibold hover:underline">
                        Login
                    </a>
                </p>

                <p class="text-sm text-center text-gray-500 dark:text-gray-400">
                    Atau
                    <a href="{{ route('daftar.status.form') }}"
                       class="text-primary font-semibold hover:underline">
                        Cek Status Pendaftaran
                    </a>
                </p>
            </div>

        </form>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    // Load kelurahan when kecamatan changes
    $('#kecamatan_id').on('change', function () {
        let kecamatanId = $(this).val();
        let kelurahanSelect = $('#kelurahan_id');

        kelurahanSelect.empty().append('<option value="">Loading...</option>');

        if (!kecamatanId) {
            kelurahanSelect.empty().append('<option value="">-- Pilih Kelurahan --</option>');
            return;
        }

        $.get('/daftar/kelurahan', { kecamatan_id: kecamatanId }, function (data) {
            kelurahanSelect.empty().append('<option value="">-- Pilih Kelurahan --</option>');
            
            data.forEach(function (item) {
                kelurahanSelect.append(new Option(item.name, item.id));
            });
        });
    });

    // Jika ada old value, trigger change untuk load kelurahan
    @if(old('kecamatan_id'))
        $('#kecamatan_id').val('{{ old('kecamatan_id') }}').trigger('change');
        
        // Set kelurahan setelah load
        setTimeout(function() {
            $('#kelurahan_id').val('{{ old('kelurahan_id') }}');
        }, 500);
    @endif
});
</script>
@endpush