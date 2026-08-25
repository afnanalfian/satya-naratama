@extends('layouts.app')

@section('content')
<div class="min-h-screen py-8 bg-gradient-to-b from-primary-50/50 to-neutral-50 dark:from-primary-900/20 dark:to-neutral-900">
    <div class="max-w-5xl mx-auto px-4 sm:px-6">

        {{-- Back Button --}}
        <div class="mb-6">
            <a href="{{ route('siswa.show', $user->id) }}"
               class="inline-flex items-center gap-2 text-sm font-medium text-secondary-600 dark:text-secondary-300 hover:text-primary-600 dark:hover:text-primary-300 transition-colors group">
                <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali ke Profil Siswa
            </a>
        </div>

        {{-- Main Card --}}
        <div class="bg-white dark:bg-primary-900/30 backdrop-blur-sm rounded-3xl shadow-2xl dark:shadow-primary-900/30 border border-primary-200/50 dark:border-primary-700/30 overflow-hidden transition-all">

            {{-- Header --}}
            <div class="px-6 sm:px-8 pt-8 pb-6 border-b border-primary-100 dark:border-primary-700/30">
                <div class="flex items-center gap-3">
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-brand-gradient text-white shadow-lg shadow-primary-500/30">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </span>
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-bold text-primary-800 dark:text-primary-100 font-display tracking-tight">
                            Edit Data Siswa
                        </h1>
                        <p class="text-sm text-secondary-500 dark:text-secondary-300 mt-0.5">
                            Perbarui informasi untuk <span class="font-semibold text-primary-600 dark:text-primary-300">{{ $user->name }}</span>
                        </p>
                    </div>
                </div>
            </div>

            {{-- Form --}}
            <form method="POST" enctype="multipart/form-data" action="{{ route('admin.students.update', $user->id) }}" class="px-6 sm:px-8 py-6 space-y-8">
                @csrf

                {{-- Section: Data Akun --}}
                <div>
                    <div class="flex items-center gap-3 mb-5">
                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-xl bg-primary-100 text-primary-600 dark:bg-primary-900/40 dark:text-primary-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </span>
                        <h3 class="text-lg font-bold text-primary-800 dark:text-primary-100 font-display">
                            Data Akun
                        </h3>
                        <span class="text-xs text-secondary-500 dark:text-secondary-400 ml-auto">Informasi login dasar</span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-primary-700 dark:text-primary-300 mb-1.5">
                                Nama <span class="text-accent-500">*</span>
                            </label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                   class="w-full px-4 py-3 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-primary-800 dark:text-primary-50 placeholder-secondary-400 focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-primary-700 dark:text-primary-300 mb-1.5">
                                Email <span class="text-accent-500">*</span>
                            </label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                   class="w-full px-4 py-3 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-primary-800 dark:text-primary-50 placeholder-secondary-400 focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-primary-700 dark:text-primary-300 mb-1.5">
                                No HP
                            </label>
                            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                                   class="w-full px-4 py-3 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-primary-800 dark:text-primary-50 placeholder-secondary-400 focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-primary-700 dark:text-primary-300 mb-1.5">
                                Status Akun
                            </label>
                            <div class="relative">
                                <select name="is_active"
                                        class="w-full px-4 py-3 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-primary-800 dark:text-primary-50 focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200 appearance-none">
                                    <option value="1" {{ $user->is_active ? 'selected' : '' }}>🟢 Aktif</option>
                                    <option value="0" {{ !$user->is_active ? 'selected' : '' }}>🔴 Nonaktif</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-primary-700 dark:text-primary-300 mb-1.5">
                                Password Baru
                            </label>
                            <input type="password" name="password" placeholder="Kosongkan jika tidak diubah"
                                   class="w-full px-4 py-3 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-primary-800 dark:text-primary-50 placeholder-secondary-400 focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200">
                            <p class="mt-1 text-xs text-secondary-500 dark:text-secondary-400">Minimal 8 karakter</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-primary-700 dark:text-primary-300 mb-1.5">
                                Konfirmasi Password
                            </label>
                            <input type="password" name="password_confirmation" placeholder="Ulangi password baru"
                                   class="w-full px-4 py-3 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-primary-800 dark:text-primary-50 placeholder-secondary-400 focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-primary-700 dark:text-primary-300 mb-1.5">
                                Provinsi
                            </label>
                            <select name="province_id" id="province_id"
                                    class="w-full px-4 py-3 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-primary-800 dark:text-primary-50 focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200 appearance-none">
                                <option value="">-- Pilih Provinsi --</option>
                                @foreach($provinces as $prov)
                                    <option value="{{ $prov->id }}" {{ old('province_id', $user->province_id) == $prov->id ? 'selected' : '' }}>
                                        {{ $prov->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-primary-700 dark:text-primary-300 mb-1.5">
                                Kabupaten/Kota
                            </label>
                            <select name="regency_id" id="regency_id"
                                    class="w-full px-4 py-3 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-primary-800 dark:text-primary-50 focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200 appearance-none">
                                <option value="">-- Pilih Kabupaten/Kota --</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-primary-700 dark:text-primary-300 mb-1.5">
                                Foto Profil
                            </label>
                            <div class="flex items-center gap-4">
                                <div class="relative w-14 h-14 rounded-full overflow-hidden border-2 border-primary-200 dark:border-primary-700/50 shrink-0">
                                    <img src="{{ $user->avatar_url }}" alt="Current avatar" class="w-full h-full object-cover">
                                </div>
                                <input type="file" name="avatar" accept="image/*"
                                       class="flex-1 text-sm text-secondary-500 dark:text-secondary-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-medium file:bg-primary-50 file:text-primary-700 dark:file:bg-primary-800/50 dark:file:text-primary-300 hover:file:bg-primary-100 dark:hover:file:bg-primary-700/50 transition-all duration-200">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Section: Data Pribadi --}}
                <div class="border-t-2 border-primary-100 dark:border-primary-700/30 pt-6">
                    <div class="flex items-center gap-3 mb-5">
                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-xl bg-accent-100 text-accent-600 dark:bg-accent-900/40 dark:text-accent-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </span>
                        <h3 class="text-lg font-bold text-primary-800 dark:text-primary-100 font-display">
                            Data Pribadi
                        </h3>
                        <span class="text-xs text-secondary-500 dark:text-secondary-400 ml-auto">Informasi identitas siswa</span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-primary-700 dark:text-primary-300 mb-1.5">
                                Nama Lengkap <span class="text-accent-500">*</span>
                            </label>
                            <input type="text" name="full_name" value="{{ old('full_name', $user->studentRegistration->full_name ?? '') }}"
                                   class="w-full px-4 py-3 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-primary-800 dark:text-primary-50 placeholder-secondary-400 focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-primary-700 dark:text-primary-300 mb-1.5">
                                Nama Panggilan
                            </label>
                            <input type="text" name="nickname" value="{{ old('nickname', $user->studentRegistration->nickname ?? '') }}"
                                   class="w-full px-4 py-3 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-primary-800 dark:text-primary-50 placeholder-secondary-400 focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-primary-700 dark:text-primary-300 mb-1.5">
                                Tanggal Lahir <span class="text-accent-500">*</span>
                            </label>
                            <input type="date" name="birth_date" value="{{ old('birth_date', $user->studentRegistration->birth_date ? $user->studentRegistration->birth_date->format('Y-m-d') : '') }}"
                                   class="w-full px-4 py-3 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-primary-800 dark:text-primary-50 focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-primary-700 dark:text-primary-300 mb-1.5">
                                Jenis Kelamin <span class="text-accent-500">*</span>
                            </label>
                            <div class="flex gap-6 mt-1.5">
                                <label class="flex items-center gap-2 text-sm text-primary-700 dark:text-primary-300 cursor-pointer">
                                    <input type="radio" name="gender" value="L" {{ old('gender', $user->studentRegistration->gender ?? '') == 'L' ? 'checked' : '' }}
                                           class="w-4 h-4 text-primary-500 focus:ring-primary-500 border-primary-300 dark:border-primary-600">
                                    Laki-laki
                                </label>
                                <label class="flex items-center gap-2 text-sm text-primary-700 dark:text-primary-300 cursor-pointer">
                                    <input type="radio" name="gender" value="P" {{ old('gender', $user->studentRegistration->gender ?? '') == 'P' ? 'checked' : '' }}
                                           class="w-4 h-4 text-primary-500 focus:ring-primary-500 border-primary-300 dark:border-primary-600">
                                    Perempuan
                                </label>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-primary-700 dark:text-primary-300 mb-1.5">
                                Asal Sekolah <span class="text-accent-500">*</span>
                            </label>
                            <input type="text" name="school_origin" value="{{ old('school_origin', $user->studentRegistration->school_origin ?? '') }}"
                                   class="w-full px-4 py-3 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-primary-800 dark:text-primary-50 placeholder-secondary-400 focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-primary-700 dark:text-primary-300 mb-1.5">
                                Kelas <span class="text-accent-500">*</span>
                            </label>
                            <select name="class"
                                    class="w-full px-4 py-3 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-primary-800 dark:text-primary-50 focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200 appearance-none">
                                <option value="">-- Pilih Kelas --</option>
                                @foreach($classes as $class)
                                    <option value="{{ $class }}" {{ old('class', $user->studentRegistration->class ?? '') == $class ? 'selected' : '' }}>
                                        {{ $class }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-primary-700 dark:text-primary-300 mb-1.5">
                                No WhatsApp <span class="text-accent-500">*</span>
                            </label>
                            <input type="text" name="registration_phone" value="{{ old('registration_phone', $user->studentRegistration->phone ?? '') }}"
                                   class="w-full px-4 py-3 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-primary-800 dark:text-primary-50 placeholder-secondary-400 focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-primary-700 dark:text-primary-300 mb-1.5">
                                Kecamatan <span class="text-accent-500">*</span>
                            </label>
                            <select name="kecamatan_id" id="kecamatan_id"
                                    class="w-full px-4 py-3 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-primary-800 dark:text-primary-50 focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200 appearance-none">
                                <option value="">-- Pilih Kecamatan --</option>
                                @foreach($kecamatans as $kec)
                                    <option value="{{ $kec->id }}" {{ old('kecamatan_id', $user->studentRegistration->kecamatan_id ?? '') == $kec->id ? 'selected' : '' }}>
                                        {{ $kec->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-primary-700 dark:text-primary-300 mb-1.5">
                                Kelurahan/Desa <span class="text-accent-500">*</span>
                            </label>
                            <select name="kelurahan_id" id="kelurahan_id"
                                    class="w-full px-4 py-3 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-primary-800 dark:text-primary-50 focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200 appearance-none">
                                <option value="">-- Pilih Kelurahan --</option>
                                @foreach($kelurahans as $kel)
                                    <option value="{{ $kel->id }}" {{ old('kelurahan_id', $user->studentRegistration->kelurahan_id ?? '') == $kel->id ? 'selected' : '' }}>
                                        {{ $kel->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-primary-700 dark:text-primary-300 mb-1.5">
                                Tinggi Badan (cm)
                            </label>
                            <input type="number" name="height_cm" value="{{ old('height_cm', $user->studentRegistration->height_cm ?? '') }}"
                                   class="w-full px-4 py-3 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-primary-800 dark:text-primary-50 placeholder-secondary-400 focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-primary-700 dark:text-primary-300 mb-1.5">
                                Berat Badan (kg)
                            </label>
                            <input type="number" name="weight_kg" value="{{ old('weight_kg', $user->studentRegistration->weight_kg ?? '') }}"
                                   class="w-full px-4 py-3 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-primary-800 dark:text-primary-50 placeholder-secondary-400 focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-primary-700 dark:text-primary-300 mb-1.5">
                                Ukuran Baju
                            </label>
                            <select name="shirt_size"
                                    class="w-full px-4 py-3 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-primary-800 dark:text-primary-50 focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200 appearance-none">
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

                {{-- Section: Kampus Impian --}}
                <div class="border-t-2 border-primary-100 dark:border-primary-700/30 pt-6">
                    <div class="flex items-center gap-3 mb-5">
                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-xl bg-gold-100 text-gold-600 dark:bg-gold-900/40 dark:text-gold-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </span>
                        <h3 class="text-lg font-bold text-primary-800 dark:text-primary-100 font-display">
                            Kampus Impian
                        </h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-primary-700 dark:text-primary-300 mb-1.5">
                                Prioritas 1 <span class="text-accent-500">*</span>
                            </label>
                            <select name="priority_university_1"
                                    class="w-full px-4 py-3 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-primary-800 dark:text-primary-50 focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200 appearance-none">
                                <option value="">-- Pilih Kampus --</option>
                                @foreach($universities as $uni)
                                    <option value="{{ $uni }}" {{ old('priority_university_1', $user->studentRegistration->priority_university_1 ?? '') == $uni ? 'selected' : '' }}>
                                        {{ $uni }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-primary-700 dark:text-primary-300 mb-1.5">
                                Prioritas 2
                            </label>
                            <select name="priority_university_2"
                                    class="w-full px-4 py-3 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-primary-800 dark:text-primary-50 focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200 appearance-none">
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

                {{-- Section: Data Orangtua --}}
                <div class="border-t-2 border-primary-100 dark:border-primary-700/30 pt-6">
                    <div class="flex items-center gap-3 mb-5">
                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-xl bg-secondary-100 text-secondary-600 dark:bg-secondary-900/40 dark:text-secondary-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </span>
                        <h3 class="text-lg font-bold text-primary-800 dark:text-primary-100 font-display">
                            Data Orangtua
                        </h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-primary-700 dark:text-primary-300 mb-1.5">
                                Nama Orangtua <span class="text-accent-500">*</span>
                            </label>
                            <input type="text" name="parent_name" value="{{ old('parent_name', $user->studentRegistration->parent_name ?? '') }}"
                                   class="w-full px-4 py-3 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-primary-800 dark:text-primary-50 placeholder-secondary-400 focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-primary-700 dark:text-primary-300 mb-1.5">
                                Pekerjaan Orangtua
                            </label>
                            <input type="text" name="parent_occupation" value="{{ old('parent_occupation', $user->studentRegistration->parent_occupation ?? '') }}"
                                   class="w-full px-4 py-3 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-primary-800 dark:text-primary-50 placeholder-secondary-400 focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-primary-700 dark:text-primary-300 mb-1.5">
                                No Telepon Orangtua <span class="text-accent-500">*</span>
                            </label>
                            <input type="text" name="parent_phone" value="{{ old('parent_phone', $user->studentRegistration->parent_phone ?? '') }}"
                                   class="w-full px-4 py-3 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-primary-800 dark:text-primary-50 placeholder-secondary-400 focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200">
                        </div>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="flex flex-wrap gap-4 pt-4 border-t-2 border-primary-100 dark:border-primary-700/30">
                    <button type="submit"
                            class="inline-flex items-center justify-center gap-3 px-8 py-4 rounded-2xl text-white font-semibold bg-brand-gradient hover:shadow-xl hover:shadow-primary-500/30 hover:scale-[1.02] transition-all duration-200 flex-1 sm:flex-none">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('siswa.show', $user->id) }}"
                       class="inline-flex items-center justify-center gap-2 px-6 py-4 rounded-2xl border-2 border-secondary-200 dark:border-secondary-700 text-secondary-600 dark:text-secondary-400 hover:bg-secondary-50 dark:hover:bg-secondary-900/20 hover:border-secondary-300 dark:hover:border-secondary-600 transition-all duration-200 flex-1 sm:flex-none">
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
