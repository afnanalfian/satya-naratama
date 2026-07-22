@extends('layouts.app')

@section('content')
<div class="min-h-screen">
    <div class="max-w-4xl mx-auto">
        {{-- Tombol Kembali --}}
        <div class="mb-4">
            <a href="{{ route('siswa.show', $user->id) }}"
               class="inline-flex items-center gap-2
                      text-sm font-medium
                      text-azwara-darkest dark:text-azwara-lighter
                      hover:text-primary transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali
            </a>
        </div>

        <div class="bg-azwara-lightest dark:bg-azwara-darker
                    border border-gray-200 dark:border-azwara-darkest
                    rounded-3xl shadow-xl dark:shadow-black/30
                    p-6 sm:p-8">

            <h1 class="text-2xl font-bold text-azwara-darkest dark:text-azwara-lighter mb-6">
                Edit Data Siswa: {{ $user->name }}
            </h1>

            <form method="POST" enctype="multipart/form-data" action="{{ route('admin.students.update', $user->id) }}">
                @csrf

                {{-- Data Akun --}}
                <div class="border-b border-gray-200 dark:border-gray-700 pb-4 mb-4">
                    <h3 class="text-lg font-semibold text-azwara-darkest dark:text-white mb-4">Data Akun</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Nama <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                   class="mt-1 w-full px-4 py-3 rounded-xl bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 focus:ring-primary focus:border-primary">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                   class="mt-1 w-full px-4 py-3 rounded-xl bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 focus:ring-primary focus:border-primary">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                No HP
                            </label>
                            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                                   class="mt-1 w-full px-4 py-3 rounded-xl bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 focus:ring-primary focus:border-primary">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Password Baru (kosongkan jika tidak diubah)
                            </label>
                            <input type="password" name="password"
                                   class="mt-1 w-full px-4 py-3 rounded-xl bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 focus:ring-primary focus:border-primary">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Konfirmasi Password
                            </label>
                            <input type="password" name="password_confirmation"
                                   class="mt-1 w-full px-4 py-3 rounded-xl bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 focus:ring-primary focus:border-primary">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Status Akun
                            </label>
                            <select name="is_active" class="mt-1 w-full px-4 py-3 rounded-xl bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 focus:ring-primary focus:border-primary">
                                <option value="1" {{ $user->is_active ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ !$user->is_active ? 'selected' : '' }}>Nonaktif</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Provinsi
                            </label>
                            <select name="province_id" id="province_id" class="mt-1 w-full px-4 py-3 rounded-xl bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 focus:ring-primary focus:border-primary">
                                <option value="">-- Pilih Provinsi --</option>
                                @foreach($provinces as $prov)
                                    <option value="{{ $prov->id }}" {{ old('province_id', $user->province_id) == $prov->id ? 'selected' : '' }}>
                                        {{ $prov->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Kabupaten/Kota
                            </label>
                            <select name="regency_id" id="regency_id" class="mt-1 w-full px-4 py-3 rounded-xl bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 focus:ring-primary focus:border-primary">
                                <option value="">-- Pilih Kabupaten/Kota --</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Foto Profil
                            </label>
                            <input type="file" name="avatar" accept="image/*"
                                   class="mt-1 block w-full text-sm file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-primary file:text-white hover:file:bg-azwara-medium bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-xl cursor-pointer">
                        </div>
                    </div>
                </div>

                {{-- Data Pribadi --}}
                <div class="border-b border-gray-200 dark:border-gray-700 pb-4 mb-4">
                    <h3 class="text-lg font-semibold text-azwara-darkest dark:text-white mb-4">Data Pribadi</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Nama Lengkap <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="full_name" value="{{ old('full_name', $user->studentRegistration->full_name ?? '') }}"
                                   class="mt-1 w-full px-4 py-3 rounded-xl bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 focus:ring-primary focus:border-primary">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Nama Panggilan
                            </label>
                            <input type="text" name="nickname" value="{{ old('nickname', $user->studentRegistration->nickname ?? '') }}"
                                   class="mt-1 w-full px-4 py-3 rounded-xl bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 focus:ring-primary focus:border-primary">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Tanggal Lahir <span class="text-red-500">*</span>
                            </label>
                            <input type="date" name="birth_date" value="{{ old('birth_date', $user->studentRegistration->birth_date ? $user->studentRegistration->birth_date->format('Y-m-d') : '') }}"
                                   class="mt-1 w-full px-4 py-3 rounded-xl bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 focus:ring-primary focus:border-primary">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Jenis Kelamin <span class="text-red-500">*</span>
                            </label>
                            <div class="flex gap-4 mt-1">
                                <label class="flex items-center gap-2 text-sm text-gray-700 dark:text-gray-300">
                                    <input type="radio" name="gender" value="L" {{ old('gender', $user->studentRegistration->gender ?? '') == 'L' ? 'checked' : '' }}
                                           class="text-primary focus:ring-primary">
                                    Laki-laki
                                </label>
                                <label class="flex items-center gap-2 text-sm text-gray-700 dark:text-gray-300">
                                    <input type="radio" name="gender" value="P" {{ old('gender', $user->studentRegistration->gender ?? '') == 'P' ? 'checked' : '' }}
                                           class="text-primary focus:ring-primary">
                                    Perempuan
                                </label>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Asal Sekolah <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="school_origin" value="{{ old('school_origin', $user->studentRegistration->school_origin ?? '') }}"
                                   class="mt-1 w-full px-4 py-3 rounded-xl bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 focus:ring-primary focus:border-primary">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Kelas <span class="text-red-500">*</span>
                            </label>
                            <select name="class" class="mt-1 w-full px-4 py-3 rounded-xl bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 focus:ring-primary focus:border-primary">
                                <option value="">-- Pilih Kelas --</option>
                                @foreach($classes as $class)
                                    <option value="{{ $class }}" {{ old('class', $user->studentRegistration->class ?? '') == $class ? 'selected' : '' }}>
                                        {{ $class }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                No WhatsApp <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="registration_phone" value="{{ old('registration_phone', $user->studentRegistration->phone ?? '') }}"
                                   class="mt-1 w-full px-4 py-3 rounded-xl bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 focus:ring-primary focus:border-primary">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Kecamatan <span class="text-red-500">*</span>
                            </label>
                            <select name="kecamatan_id" id="kecamatan_id" class="mt-1 w-full px-4 py-3 rounded-xl bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 focus:ring-primary focus:border-primary">
                                <option value="">-- Pilih Kecamatan --</option>
                                @foreach($kecamatans as $kec)
                                    <option value="{{ $kec->id }}" {{ old('kecamatan_id', $user->studentRegistration->kecamatan_id ?? '') == $kec->id ? 'selected' : '' }}>
                                        {{ $kec->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Kelurahan/Desa <span class="text-red-500">*</span>
                            </label>
                            <select name="kelurahan_id" id="kelurahan_id" class="mt-1 w-full px-4 py-3 rounded-xl bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 focus:ring-primary focus:border-primary">
                                <option value="">-- Pilih Kelurahan --</option>
                                @foreach($kelurahans as $kel)
                                    <option value="{{ $kel->id }}" {{ old('kelurahan_id', $user->studentRegistration->kelurahan_id ?? '') == $kel->id ? 'selected' : '' }}>
                                        {{ $kel->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Tinggi Badan (cm)
                            </label>
                            <input type="number" name="height_cm" value="{{ old('height_cm', $user->studentRegistration->height_cm ?? '') }}"
                                   class="mt-1 w-full px-4 py-3 rounded-xl bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 focus:ring-primary focus:border-primary">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Berat Badan (kg)
                            </label>
                            <input type="number" name="weight_kg" value="{{ old('weight_kg', $user->studentRegistration->weight_kg ?? '') }}"
                                   class="mt-1 w-full px-4 py-3 rounded-xl bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 focus:ring-primary focus:border-primary">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Ukuran Baju
                            </label>
                            <select name="shirt_size" class="mt-1 w-full px-4 py-3 rounded-xl bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 focus:ring-primary focus:border-primary">
                                <option value="">-- Pilih Ukuran --</option>
                                @foreach($shirtSizes as $size)
                                    <option value="{{ $size }}" {{ old('shirt_size', $user->studentRegistration->shirt_size ?? '') == $size ? 'selected' : '' }}>
                                        {{ $size }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                {{-- Kampus Impian --}}
                <div class="border-b border-gray-200 dark:border-gray-700 pb-4 mb-4">
                    <h3 class="text-lg font-semibold text-azwara-darkest dark:text-white mb-4">Kampus Impian</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Prioritas 1 <span class="text-red-500">*</span>
                            </label>
                            <select name="priority_university_1" class="mt-1 w-full px-4 py-3 rounded-xl bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 focus:ring-primary focus:border-primary">
                                <option value="">-- Pilih Kampus --</option>
                                @foreach($universities as $uni)
                                    <option value="{{ $uni }}" {{ old('priority_university_1', $user->studentRegistration->priority_university_1 ?? '') == $uni ? 'selected' : '' }}>
                                        {{ $uni }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Prioritas 2
                            </label>
                            <select name="priority_university_2" class="mt-1 w-full px-4 py-3 rounded-xl bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 focus:ring-primary focus:border-primary">
                                <option value="">-- Pilih Kampus --</option>
                                @foreach($universities as $uni)
                                    <option value="{{ $uni }}" {{ old('priority_university_2', $user->studentRegistration->priority_university_2 ?? '') == $uni ? 'selected' : '' }}>
                                        {{ $uni }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                {{-- Data Orangtua --}}
                <div class="border-b border-gray-200 dark:border-gray-700 pb-4 mb-4">
                    <h3 class="text-lg font-semibold text-azwara-darkest dark:text-white mb-4">Data Orangtua</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Nama Orangtua <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="parent_name" value="{{ old('parent_name', $user->studentRegistration->parent_name ?? '') }}"
                                   class="mt-1 w-full px-4 py-3 rounded-xl bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 focus:ring-primary focus:border-primary">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Pekerjaan Orangtua
                            </label>
                            <input type="text" name="parent_occupation" value="{{ old('parent_occupation', $user->studentRegistration->parent_occupation ?? '') }}"
                                   class="mt-1 w-full px-4 py-3 rounded-xl bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 focus:ring-primary focus:border-primary">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                No Telepon Orangtua <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="parent_phone" value="{{ old('parent_phone', $user->studentRegistration->parent_phone ?? '') }}"
                                   class="mt-1 w-full px-4 py-3 rounded-xl bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 focus:ring-primary focus:border-primary">
                        </div>
                    </div>
                </div>

                <div class="flex gap-3">
                    <button type="submit" class="btn-primary">
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('siswa.show', $user->id) }}" class="px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-700 text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function() {
    // Load regencies based on province
    const provinceSelect = document.getElementById('province_id');
    const regencySelect = document.getElementById('regency_id');
    const currentRegency = "{{ old('regency_id', $user->regency_id) }}";

    function loadRegencies() {
        const provinceId = provinceSelect.value;
        regencySelect.innerHTML = '<option value="">Loading...</option>';

        if (!provinceId) {
            regencySelect.innerHTML = '<option value="">-- Pilih Kabupaten/Kota --</option>';
            return;
        }

        fetch(`/get-regencies/${provinceId}`)
            .then(res => res.json())
            .then(data => {
                regencySelect.innerHTML = '<option value="">-- Pilih Kabupaten/Kota --</option>';
                data.forEach(reg => {
                    regencySelect.innerHTML += `<option value="${reg.id}" ${reg.id == currentRegency ? 'selected' : ''}>${reg.name}</option>`;
                });
            });
    }

    provinceSelect.addEventListener('change', loadRegencies);
    if (provinceSelect.value) {
        loadRegencies();
    }

    // Load kelurahan based on kecamatan
    const kecamatanSelect = document.getElementById('kecamatan_id');
    const kelurahanSelect = document.getElementById('kelurahan_id');
    const currentKelurahan = "{{ old('kelurahan_id', $user->studentRegistration->kelurahan_id ?? '') }}";

    function loadKelurahan() {
        const kecamatanId = kecamatanSelect.value;
        kelurahanSelect.innerHTML = '<option value="">Loading...</option>';

        if (!kecamatanId) {
            kelurahanSelect.innerHTML = '<option value="">-- Pilih Kelurahan --</option>';
            return;
        }

        fetch(`/daftar/kelurahan?kecamatan_id=${kecamatanId}`)
            .then(res => res.json())
            .then(data => {
                kelurahanSelect.innerHTML = '<option value="">-- Pilih Kelurahan --</option>';
                data.forEach(kel => {
                    kelurahanSelect.innerHTML += `<option value="${kel.id}" ${kel.id == currentKelurahan ? 'selected' : ''}>${kel.name}</option>`;
                });
            });
    }

    kecamatanSelect.addEventListener('change', loadKelurahan);
    if (kecamatanSelect.value) {
        loadKelurahan();
    }
});
</script>
@endpush
