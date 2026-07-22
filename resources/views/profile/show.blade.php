@extends('layouts.app')

@section('content')
<div class="min-h-screen">

    <div class="max-w-3xl mx-auto">

        {{-- Card --}}
        <div
                class="relative bg-azwara-lightest dark:bg-azwara-darker
                   rounded-3xl shadow-xl dark:shadow-black/30
                   border border-gray-200 dark:border-azwara-darkest
                   p-6 sm:p-8">

            {{-- Header --}}
            <div class="mb-8">
                <h1 class="text-2xl sm:text-3xl font-bold
                           text-azwara-darkest dark:text-azwara-lighter">
                    Profil Saya
                </h1>

                <p class="text-sm mt-1 text-azwara-medium dark:text-azwara-light">
                    Informasi akun pribadi Anda
                </p>
            </div>

            {{-- Profile Row --}}
            <div class="flex flex-col sm:flex-row items-center gap-6">

            {{-- Avatar --}}
            <div class="relative shrink-0">
                <img src="{{ auth()->user()->avatar_url }}"
                    alt="Avatar"
                    class="w-24 h-24 rounded-full object-cover
                        border-4 border-primary
                        shadow-lg" />
            </div>

                {{-- Identity --}}
                <div class="text-center sm:text-left">
                    <p class="text-xl font-semibold
                              text-azwara-darkest dark:text-white">
                        {{ auth()->user()->name }}
                    </p>

                    <p class="text-sm text-gray-500 dark:text-gray-300">
                        {{ auth()->user()->email }}
                    </p>
                </div>

            </div>
            {{-- Divider --}}
            <hr class="my-8 border-gray-200 dark:border-azwara-darkest">

            {{-- Student Registration Data --}}
            @php
                $registration = auth()->user()->studentRegistration;
            @endphp

            @if($registration)
                <div class="mt-6">
                    <h3 class="text-lg font-semibold text-azwara-darkest dark:text-azwara-lighter mb-4">
                        Data Pendaftaran
                    </h3>

                    <div class="grid sm:grid-cols-2 gap-4 text-sm">
                        <div class="p-4 rounded-xl bg-gray-50 dark:bg-azwara-darkest/50 border border-gray-200 dark:border-azwara-darkest">
                            <p class="text-xs uppercase tracking-wide text-gray-500 dark:text-azwara-light">Nama Lengkap</p>
                            <p class="font-medium text-azwara-darkest dark:text-white">{{ $registration->full_name }}</p>
                        </div>
                        <div class="p-4 rounded-xl bg-gray-50 dark:bg-azwara-darkest/50 border border-gray-200 dark:border-azwara-darkest">
                            <p class="text-xs uppercase tracking-wide text-gray-500 dark:text-azwara-light">Nama Panggilan</p>
                            <p class="font-medium text-azwara-darkest dark:text-white">{{ $registration->nickname ?? '-' }}</p>
                        </div>
                        <div class="p-4 rounded-xl bg-gray-50 dark:bg-azwara-darkest/50 border border-gray-200 dark:border-azwara-darkest">
                            <p class="text-xs uppercase tracking-wide text-gray-500 dark:text-azwara-light">Tanggal Lahir</p>
                            <p class="font-medium text-azwara-darkest dark:text-white">{{ $registration->birth_date->format('d M Y') }}</p>
                        </div>
                        <div class="p-4 rounded-xl bg-gray-50 dark:bg-azwara-darkest/50 border border-gray-200 dark:border-azwara-darkest">
                            <p class="text-xs uppercase tracking-wide text-gray-500 dark:text-azwara-light">Jenis Kelamin</p>
                            <p class="font-medium text-azwara-darkest dark:text-white">{{ $registration->gender_label }}</p>
                        </div>
                        <div class="p-4 rounded-xl bg-gray-50 dark:bg-azwara-darkest/50 border border-gray-200 dark:border-azwara-darkest">
                            <p class="text-xs uppercase tracking-wide text-gray-500 dark:text-azwara-light">Asal Sekolah</p>
                            <p class="font-medium text-azwara-darkest dark:text-white">{{ $registration->school_origin }}</p>
                        </div>
                        <div class="p-4 rounded-xl bg-gray-50 dark:bg-azwara-darkest/50 border border-gray-200 dark:border-azwara-darkest">
                            <p class="text-xs uppercase tracking-wide text-gray-500 dark:text-azwara-light">Kelas</p>
                            <p class="font-medium text-azwara-darkest dark:text-white">{{ $registration->class }}</p>
                        </div>
                        <div class="p-4 rounded-xl bg-gray-50 dark:bg-azwara-darkest/50 border border-gray-200 dark:border-azwara-darkest">
                            <p class="text-xs uppercase tracking-wide text-gray-500 dark:text-azwara-light">Kecamatan</p>
                            <p class="font-medium text-azwara-darkest dark:text-white">{{ $registration->kecamatan->name ?? '-' }}</p>
                        </div>
                        <div class="p-4 rounded-xl bg-gray-50 dark:bg-azwara-darkest/50 border border-gray-200 dark:border-azwara-darkest">
                            <p class="text-xs uppercase tracking-wide text-gray-500 dark:text-azwara-light">Kelurahan/Desa</p>
                            <p class="font-medium text-azwara-darkest dark:text-white">{{ $registration->kelurahan->name ?? '-' }}</p>
                        </div>
                        <div class="p-4 rounded-xl bg-gray-50 dark:bg-azwara-darkest/50 border border-gray-200 dark:border-azwara-darkest">
                            <p class="text-xs uppercase tracking-wide text-gray-500 dark:text-azwara-light">Tinggi Badan</p>
                            <p class="font-medium text-azwara-darkest dark:text-white">{{ $registration->height_cm ? $registration->height_cm . ' cm' : '-' }}</p>
                        </div>
                        <div class="p-4 rounded-xl bg-gray-50 dark:bg-azwara-darkest/50 border border-gray-200 dark:border-azwara-darkest">
                            <p class="text-xs uppercase tracking-wide text-gray-500 dark:text-azwara-light">Berat Badan</p>
                            <p class="font-medium text-azwara-darkest dark:text-white">{{ $registration->weight_kg ? $registration->weight_kg . ' kg' : '-' }}</p>
                        </div>
                        <div class="p-4 rounded-xl bg-gray-50 dark:bg-azwara-darkest/50 border border-gray-200 dark:border-azwara-darkest">
                            <p class="text-xs uppercase tracking-wide text-gray-500 dark:text-azwara-light">Ukuran Baju</p>
                            <p class="font-medium text-azwara-darkest dark:text-white">{{ $registration->shirt_size_label ?? '-' }}</p>
                        </div>
                        <div class="p-4 rounded-xl bg-gray-50 dark:bg-azwara-darkest/50 border border-gray-200 dark:border-azwara-darkest">
                            <p class="text-xs uppercase tracking-wide text-gray-500 dark:text-azwara-light">Kampus Impian 1</p>
                            <p class="font-medium text-azwara-darkest dark:text-white">{{ $registration->priority_university_1 }}</p>
                        </div>
                        <div class="p-4 rounded-xl bg-gray-50 dark:bg-azwara-darkest/50 border border-gray-200 dark:border-azwara-darkest">
                            <p class="text-xs uppercase tracking-wide text-gray-500 dark:text-azwara-light">Kampus Impian 2</p>
                            <p class="font-medium text-azwara-darkest dark:text-white">{{ $registration->priority_university_2 ?? '-' }}</p>
                        </div>
                        <div class="p-4 rounded-xl bg-gray-50 dark:bg-azwara-darkest/50 border border-gray-200 dark:border-azwara-darkest">
                            <p class="text-xs uppercase tracking-wide text-gray-500 dark:text-azwara-light">Nama Orangtua</p>
                            <p class="font-medium text-azwara-darkest dark:text-white">{{ $registration->parent_name }}</p>
                        </div>
                        <div class="p-4 rounded-xl bg-gray-50 dark:bg-azwara-darkest/50 border border-gray-200 dark:border-azwara-darkest">
                            <p class="text-xs uppercase tracking-wide text-gray-500 dark:text-azwara-light">Pekerjaan Orangtua</p>
                            <p class="font-medium text-azwara-darkest dark:text-white">{{ $registration->parent_occupation ?? '-' }}</p>
                        </div>
                        <div class="p-4 rounded-xl bg-gray-50 dark:bg-azwara-darkest/50 border border-gray-200 dark:border-azwara-darkest">
                            <p class="text-xs uppercase tracking-wide text-gray-500 dark:text-azwara-light">No Telepon Orangtua</p>
                            <p class="font-medium text-azwara-darkest dark:text-white">{{ $registration->parent_phone }}</p>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Info Grid --}}
            <div class="grid sm:grid-cols-2 gap-4 text-sm">

                <div class="p-4 rounded-xl
                            bg-gray-50 dark:bg-azwara-darkest/50
                            border border-gray-200 dark:border-azwara-darkest">
                    <p class="text-xs uppercase tracking-wide
                              text-gray-500 dark:text-azwara-light">
                        Phone
                    </p>
                    <p class="font-medium text-azwara-darkest dark:text-white">
                        {{ auth()->user()->phone ?? '-' }}
                    </p>
                </div>

                <div class="p-4 rounded-xl
                            bg-gray-50 dark:bg-azwara-darkest/50
                            border border-gray-200 dark:border-azwara-darkest">
                    <p class="text-xs uppercase tracking-wide
                              text-gray-500 dark:text-azwara-light">
                        Provinsi
                    </p>
                    <p class="font-medium text-azwara-darkest dark:text-white">
                        {{ auth()->user()->province->name ?? '-' }}
                    </p>
                </div>

                <div class="p-4 rounded-xl
                            bg-gray-50 dark:bg-azwara-darkest/50
                            border border-gray-200 dark:border-azwara-darkest">
                    <p class="text-xs uppercase tracking-wide
                              text-gray-500 dark:text-azwara-light">
                        Kabupaten / Kota
                    </p>
                    <p class="font-medium text-azwara-darkest dark:text-white">
                        {{ auth()->user()->regency->name ?? '-' }}
                    </p>
                </div>

            </div>

            {{-- Actions --}}
            <div class="flex flex-wrap gap-3 mt-10">

                <a href="{{ route('profile.edit') }}"
                   class="inline-flex items-center justify-center gap-2
                          px-5 py-3 rounded-xl font-semibold
                          text-white
                          bg-gradient-to-r from-primary to-azwara-medium
                          hover:shadow-lg hover:scale-[1.02]
                          transition">
                    Edit Profil
                </a>

                <a href="{{ route('profile.password') }}"
                   class="inline-flex items-center justify-center gap-2
                          px-5 py-3 rounded-xl font-semibold
                          text-white
                          bg-azwara-darker hover:bg-azwara-medium
                          transition">
                    Ganti Password
                </a>

                <a href="{{ route('profile.delete') }}"
                   class="inline-flex items-center justify-center gap-2
                          px-5 py-3 rounded-xl font-semibold
                          text-red-700 dark:text-red-400
                          bg-red-100 dark:bg-red-950/30
                          hover:bg-red-200 dark:hover:bg-red-950/60
                          transition">
                    Hapus Akun
                </a>

            </div>

        </div>
        {{-- End Card --}}

    </div>
</div>
@endsection
