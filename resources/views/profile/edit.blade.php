@extends('layouts.app')

@section('content')
<div class="min-h-screen">
    <div class="max-w-3xl mx-auto">
        {{-- Tombol Kembali --}}
        <div class="mb-4">
            <a href="{{ route('profile.show') }}"
               class="inline-flex items-center gap-2
                      text-sm font-medium
                      text-azwara-darkest dark:text-azwara-lighter
                      hover:text-primary
                      transition">
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-4 h-4"
                     fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M15 19l-7-7 7-7" />
                </svg>
                Kembali
            </a>
        </div>

        <div
            class="bg-azwara-lightest dark:bg-azwara-darker
                   border border-gray-200 dark:border-azwara-darkest
                   rounded-3xl
                   shadow-xl dark:shadow-black/30
                   p-6 sm:p-8 transition-colors duration-300">

            {{-- Header --}}
            <div class="mb-8">
                <h1 class="text-2xl sm:text-3xl font-bold
                           text-azwara-darkest dark:text-azwara-lighter">
                    Edit Profil
                </h1>
                <p class="text-sm mt-1 text-azwara-medium dark:text-azwara-light">
                    Perbarui informasi akun Anda
                </p>
            </div>

            <form method="POST" enctype="multipart/form-data" action="{{ route('profile.update') }}" class="space-y-5">
                @csrf

                {{-- Nama --}}
                <div>
                    <label class="form-label-required block text-sm font-medium text-azwara-darkest dark:text-azwara-light">
                        Nama Lengkap
                    </label>
                    <input type="text" name="name" value="{{ auth()->user()->name }}" class="input-primary">
                </div>

                {{-- Phone --}}
                <div>
                    <label class="form-label-required block text-sm font-medium text-azwara-darkest dark:text-azwara-light">
                        No. HP
                    </label>
                    <input type="text" name="phone" value="{{ auth()->user()->phone }}" class="input-primary">
                </div>

                {{-- PROVINCE --}}
                <div>
                    <label class="block text-sm font-medium text-azwara-darkest dark:text-azwara-light">
                        Provinsi
                        <span class="text-xs text-gray-500">(opsional)</span>
                    </label>
                    <select id="province_id" name="province_id" class="select2 input-primary">
                        <option value="">-- pilih provinsi --</option>
                        @foreach ($provinces as $prov)
                            <option value="{{ $prov->id }}"
                                {{ auth()->user()->province_id == $prov->id ? 'selected' : '' }}>
                                {{ $prov->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- REGENCY --}}
                <div>
                    <label class="block text-sm font-medium text-azwara-darkest dark:text-azwara-light">
                        Kabupaten / Kota
                        <span class="text-xs text-gray-500">(opsional)</span>
                    </label>
                    <select id="regency_id" name="regency_id" class="select2 input-primary">
                        <option value="">Pilih provinsi terlebih dahulu</option>
                    </select>
                </div>

                {{-- Avatar --}}
                <div>
                    <label class="block text-sm font-medium text-azwara-darkest dark:text-azwara-light">
                        Foto Profil
                    </label>
                    <input type="file" name="avatar" class="input-file">
                </div>

                {{-- STUDENT REGISTRATION DATA (hanya untuk siswa) --}}
                @if(auth()->user()->hasRole('siswa') && $registration)
                    <div class="border-t border-gray-200 dark:border-gray-700 pt-5 mt-5">
                        <h3 class="text-lg font-semibold text-azwara-darkest dark:text-azwara-lighter mb-4">
                            Data Pendaftaran
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Nama Lengkap <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="full_name" value="{{ old('full_name', $registration->full_name) }}"
                                       class="mt-1 w-full px-4 py-3 rounded-xl bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 focus:ring-primary focus:border-primary">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Nama Panggilan
                                </label>
                                <input type="text" name="nickname" value="{{ old('nickname', $registration->nickname) }}"
                                       class="mt-1 w-full px-4 py-3 rounded-xl bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 focus:ring-primary focus:border-primary">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Tanggal Lahir <span class="text-red-500">*</span>
                                </label>
                                <input type="date" name="birth_date" value="{{ old('birth_date', $registration->birth_date ? $registration->birth_date->format('Y-m-d') : '') }}"
                                       class="mt-1 w-full px-4 py-3 rounded-xl bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 focus:ring-primary focus:border-primary">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Jenis Kelamin <span class="text-red-500">*</span>
                                </label>
                                <div class="flex gap-4 mt-1">
                                    <label class="flex items-center gap-2 text-sm text-gray-700 dark:text-gray-300">
                                        <input type="radio" name="gender" value="L" {{ old('gender', $registration->gender) == 'L' ? 'checked' : '' }}
                                               class="text-primary focus:ring-primary">
                                        Laki-laki
                                    </label>
                                    <label class="flex items-center gap-2 text-sm text-gray-700 dark:text-gray-300">
                                        <input type="radio" name="gender" value="P" {{ old('gender', $registration->gender) == 'P' ? 'checked' : '' }}
                                               class="text-primary focus:ring-primary">
                                        Perempuan
                                    </label>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Asal Sekolah <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="school_origin" value="{{ old('school_origin', $registration->school_origin) }}"
                                       class="mt-1 w-full px-4 py-3 rounded-xl bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 focus:ring-primary focus:border-primary">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Kelas <span class="text-red-500">*</span>
                                </label>
                                <select name="class" class="mt-1 w-full px-4 py-3 rounded-xl bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 focus:ring-primary focus:border-primary">
                                    <option value="">-- Pilih Kelas --</option>
                                    @foreach($classes as $class)
                                        <option value="{{ $class }}" {{ old('class', $registration->class) == $class ? 'selected' : '' }}>
                                            {{ $class }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    No WhatsApp <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="registration_phone" value="{{ old('registration_phone', $registration->phone) }}"
                                       class="mt-1 w-full px-4 py-3 rounded-xl bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 focus:ring-primary focus:border-primary">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Kecamatan <span class="text-red-500">*</span>
                                </label>
                                <select name="kecamatan_id" id="kecamatan_id_profile" class="mt-1 w-full px-4 py-3 rounded-xl bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 focus:ring-primary focus:border-primary">
                                    <option value="">-- Pilih Kecamatan --</option>
                                    @foreach($kecamatans as $kec)
                                        <option value="{{ $kec->id }}" {{ old('kecamatan_id', $registration->kecamatan_id) == $kec->id ? 'selected' : '' }}>
                                            {{ $kec->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Kelurahan/Desa <span class="text-red-500">*</span>
                                </label>
                                <select name="kelurahan_id" id="kelurahan_id_profile" class="mt-1 w-full px-4 py-3 rounded-xl bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 focus:ring-primary focus:border-primary">
                                    <option value="">-- Pilih Kelurahan --</option>
                                    @foreach($kelurahans as $kel)
                                        <option value="{{ $kel->id }}" {{ old('kelurahan_id', $registration->kelurahan_id) == $kel->id ? 'selected' : '' }}>
                                            {{ $kel->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Tinggi Badan (cm)
                                </label>
                                <input type="number" name="height_cm" value="{{ old('height_cm', $registration->height_cm) }}"
                                       class="mt-1 w-full px-4 py-3 rounded-xl bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 focus:ring-primary focus:border-primary">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Berat Badan (kg)
                                </label>
                                <input type="number" name="weight_kg" value="{{ old('weight_kg', $registration->weight_kg) }}"
                                       class="mt-1 w-full px-4 py-3 rounded-xl bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 focus:ring-primary focus:border-primary">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Ukuran Baju
                                </label>
                                <select name="shirt_size" class="mt-1 w-full px-4 py-3 rounded-xl bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 focus:ring-primary focus:border-primary">
                                    <option value="">-- Pilih Ukuran --</option>
                                    @foreach($shirtSizes as $size)
                                        <option value="{{ $size }}" {{ old('shirt_size', $registration->shirt_size) == $size ? 'selected' : '' }}>
                                            {{ $size }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Kampus Impian 1 <span class="text-red-500">*</span>
                                </label>
                                <select name="priority_university_1" class="mt-1 w-full px-4 py-3 rounded-xl bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 focus:ring-primary focus:border-primary">
                                    <option value="">-- Pilih Kampus --</option>
                                    @foreach($universities as $uni)
                                        <option value="{{ $uni }}" {{ old('priority_university_1', $registration->priority_university_1) == $uni ? 'selected' : '' }}>
                                            {{ $uni }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Kampus Impian 2
                                </label>
                                <select name="priority_university_2" class="mt-1 w-full px-4 py-3 rounded-xl bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 focus:ring-primary focus:border-primary">
                                    <option value="">-- Pilih Kampus --</option>
                                    @foreach($universities as $uni)
                                        <option value="{{ $uni }}" {{ old('priority_university_2', $registration->priority_university_2) == $uni ? 'selected' : '' }}>
                                            {{ $uni }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Nama Orangtua <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="parent_name" value="{{ old('parent_name', $registration->parent_name) }}"
                                       class="mt-1 w-full px-4 py-3 rounded-xl bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 focus:ring-primary focus:border-primary">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Pekerjaan Orangtua
                                </label>
                                <input type="text" name="parent_occupation" value="{{ old('parent_occupation', $registration->parent_occupation) }}"
                                       class="mt-1 w-full px-4 py-3 rounded-xl bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 focus:ring-primary focus:border-primary">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    No Telepon Orangtua <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="parent_phone" value="{{ old('parent_phone', $registration->parent_phone) }}"
                                       class="mt-1 w-full px-4 py-3 rounded-xl bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 focus:ring-primary focus:border-primary">
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Action --}}
                <div class="pt-4">
                    <button type="submit" class="btn-primary w-full">
                        Simpan Perubahan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", () => {
    const provinceSelect = document.getElementById("province_id");
    const regencySelect = document.getElementById("regency_id");
    const userRegency = "{{ auth()->user()->regency_id }}";

    function loadRegencies() {
        const provinceId = provinceSelect.value;
        regencySelect.innerHTML = `<option value="">Loading...</option>`;

        if (!provinceId) {
            regencySelect.innerHTML = `<option value="">Pilih provinsi terlebih dahulu</option>`;
            return;
        }

        fetch(`/get-regencies/${provinceId}`)
            .then(res => res.json())
            .then(data => {
                regencySelect.innerHTML = `<option value="">-- pilih kabupaten/kota --</option>`;
                data.forEach(reg => {
                    regencySelect.innerHTML += `
                        <option value="${reg.id}" ${reg.id == userRegency ? 'selected' : ''}>
                            ${reg.name}
                        </option>`;
                });
            });
    }

    provinceSelect.addEventListener("change", loadRegencies);

    if ("{{ auth()->user()->province_id }}") {
        loadRegencies();
    }

    // For profile edit - load kelurahan based on kecamatan
    const kecamatanSelect = document.getElementById('kecamatan_id_profile');
    const kelurahanSelect = document.getElementById('kelurahan_id_profile');
    const currentKelurahan = "{{ old('kelurahan_id', $registration->kelurahan_id ?? '') }}";

    if (kecamatanSelect) {
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
    }
});
</script>
@endpush
