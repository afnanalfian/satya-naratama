@extends('layouts.app')

@section('content')
<div class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-azwara-darker dark:text-white">
                Detail Pendaftaran
            </h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                {{ $registration->full_name }} • {{ $registration->created_at->format('d M Y H:i') }}
            </p>
        </div>

        <div class="flex gap-2">
            <a href="{{ route('admin.registrations.index') }}"
               class="px-4 py-2 rounded-xl border border-gray-300 dark:border-gray-700 text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                ← Kembali
            </a>

            @if($registration->registration_status == 'awaiting_verification')
                <a href="{{ route('admin.registrations.verify.form', $registration->id) }}"
                   class="px-4 py-2 rounded-xl bg-green-600 text-white font-medium hover:bg-green-700 transition">
                    ✅ Verifikasi
                </a>
                <a href="{{ route('admin.registrations.reject.form', $registration->id) }}"
                   class="px-4 py-2 rounded-xl bg-red-600 text-white font-medium hover:bg-red-700 transition">
                    ❌ Tolak
                </a>
            @endif
        </div>
    </div>

    {{-- Status --}}
    <div class="bg-azwara-lightest dark:bg-azwara-darker rounded-xl p-4 border border-gray-200 dark:border-gray-700">
        <div class="flex flex-wrap gap-4">
            <div>
                <span class="text-xs text-gray-500 dark:text-gray-400">Status Pendaftaran</span>
                <p class="font-semibold">
                    @php
                        $colors = [
                            'pending_payment' => 'text-blue-600',
                            'awaiting_verification' => 'text-yellow-600',
                            'verified' => 'text-green-600',
                            'rejected' => 'text-red-600',
                            'draft' => 'text-gray-600',
                        ];
                        $color = $colors[$registration->registration_status] ?? 'text-gray-600';
                    @endphp
                    <span class="{{ $color }}">{{ $registration->registration_status_label }}</span>
                </p>
            </div>
            <div>
                <span class="text-xs text-gray-500 dark:text-gray-400">Status Pembayaran</span>
                <p class="font-semibold">
                    @php
                        $pColors = [
                            'pending' => 'text-blue-600',
                            'paid' => 'text-yellow-600',
                            'verified' => 'text-green-600',
                            'rejected' => 'text-red-600',
                            'expired' => 'text-red-600',
                        ];
                        $pColor = $pColors[$registration->payment_status] ?? 'text-gray-600';
                    @endphp
                    <span class="{{ $pColor }}">{{ $registration->payment_status_label }}</span>
                </p>
            </div>
            @if($registration->verified_at)
                <div>
                    <span class="text-xs text-gray-500 dark:text-gray-400">Terverifikasi</span>
                    <p class="font-semibold">{{ $registration->verified_at->format('d M Y H:i') }}</p>
                </div>
            @endif
            @if($registration->rejected_at)
                <div>
                    <span class="text-xs text-gray-500 dark:text-gray-400">Ditolak</span>
                    <p class="font-semibold">{{ $registration->rejected_at->format('d M Y H:i') }}</p>
                </div>
            @endif
        </div>
    </div>

    {{-- Data --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- Data Pribadi --}}
        <div class="bg-azwara-lightest dark:bg-azwara-darker rounded-xl p-6 border border-gray-200 dark:border-gray-700">
            <h3 class="font-semibold text-azwara-darker dark:text-white mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                Data Pribadi
            </h3>
            <div class="space-y-2 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-500 dark:text-gray-400">Nama Lengkap</span>
                    <span class="font-medium">{{ $registration->full_name }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500 dark:text-gray-400">Nama Panggilan</span>
                    <span class="font-medium">{{ $registration->nickname ?? '-' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500 dark:text-gray-400">Tanggal Lahir</span>
                    <span class="font-medium">{{ $registration->birth_date->format('d M Y') }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500 dark:text-gray-400">Jenis Kelamin</span>
                    <span class="font-medium">{{ $registration->gender_label }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500 dark:text-gray-400">Asal Sekolah</span>
                    <span class="font-medium">{{ $registration->school_origin }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500 dark:text-gray-400">Kelas</span>
                    <span class="font-medium">{{ $registration->class }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500 dark:text-gray-400">No WhatsApp</span>
                    <span class="font-medium">{{ $registration->phone }}</span>
                </div>
            </div>
        </div>

        {{-- Data Wilayah & Fisik --}}
        <div class="bg-azwara-lightest dark:bg-azwara-darker rounded-xl p-6 border border-gray-200 dark:border-gray-700">
            <h3 class="font-semibold text-azwara-darker dark:text-white mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Data Wilayah & Fisik
            </h3>
            <div class="space-y-2 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-500 dark:text-gray-400">Kecamatan</span>
                    <span class="font-medium">{{ $registration->kecamatan->name ?? '-' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500 dark:text-gray-400">Kelurahan/Desa</span>
                    <span class="font-medium">{{ $registration->kelurahan->name ?? '-' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500 dark:text-gray-400">Tinggi Badan</span>
                    <span class="font-medium">{{ $registration->height_cm ? $registration->height_cm . ' cm' : '-' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500 dark:text-gray-400">Berat Badan</span>
                    <span class="font-medium">{{ $registration->weight_kg ? $registration->weight_kg . ' kg' : '-' }}</span>
                </div>
            </div>
        </div>

        {{-- Kampus Impian --}}
        <div class="bg-azwara-lightest dark:bg-azwara-darker rounded-xl p-6 border border-gray-200 dark:border-gray-700">
            <h3 class="font-semibold text-azwara-darker dark:text-white mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422M12 14l-6.16-3.422M12 18v-4m0 0l6.16 3.422M12 18l-6.16-3.422"/>
                </svg>
                Kampus Impian
            </h3>
            <div class="space-y-2 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-500 dark:text-gray-400">Prioritas 1</span>
                    <span class="font-medium">{{ $registration->priority_university_1 }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500 dark:text-gray-400">Prioritas 2</span>
                    <span class="font-medium">{{ $registration->priority_university_2 ?? '-' }}</span>
                </div>
            </div>
        </div>

        {{-- Data Orangtua --}}
        <div class="bg-azwara-lightest dark:bg-azwara-darker rounded-xl p-6 border border-gray-200 dark:border-gray-700">
            <h3 class="font-semibold text-azwara-darker dark:text-white mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                Data Orangtua
            </h3>
            <div class="space-y-2 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-500 dark:text-gray-400">Nama Orangtua</span>
                    <span class="font-medium">{{ $registration->parent_name }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500 dark:text-gray-400">Pekerjaan</span>
                    <span class="font-medium">{{ $registration->parent_occupation ?? '-' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500 dark:text-gray-400">No Telepon</span>
                    <span class="font-medium">{{ $registration->parent_phone }}</span>
                </div>
            </div>
        </div>

        {{-- Data Akun --}}
        <div class="bg-azwara-lightest dark:bg-azwara-darker rounded-xl p-6 border border-gray-200 dark:border-gray-700">
            <h3 class="font-semibold text-azwara-darker dark:text-white mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                Data Akun
            </h3>
            <div class="space-y-2 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-500 dark:text-gray-400">Email</span>
                    <span class="font-medium">{{ $registration->email }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500 dark:text-gray-400">Foto Profil</span>
                    <span class="font-medium">
                        @if($registration->avatar)
                            <a href="{{ asset('storage/' . $registration->avatar) }}" target="_blank" class="text-primary hover:underline">
                                Lihat Foto
                            </a>
                        @else
                            -
                        @endif
                    </span>
                </div>
                @if($registration->user)
                    <div class="flex justify-between">
                        <span class="text-gray-500 dark:text-gray-400">Akun Terkait</span>
                        <span class="font-medium text-green-600">
                            ✅ {{ $registration->user->name }}
                        </span>
                    </div>
                @endif
            </div>
        </div>

        {{-- Pembayaran --}}
        <div class="bg-azwara-lightest dark:bg-azwara-darker rounded-xl p-6 border border-gray-200 dark:border-gray-700">
            <h3 class="font-semibold text-azwara-darker dark:text-white mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v1m0 9c-1.657 0-3-.895-3-2s1.343-2 3-2 3-.895 3-2-1.343-2-3-2"/>
                </svg>
                Data Pembayaran
            </h3>
            <div class="space-y-2 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-500 dark:text-gray-400">Biaya</span>
                    <span class="font-bold text-azwara-darker dark:text-white">
                        Rp {{ number_format($registration->registration_fee, 0, ',', '.') }}
                    </span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500 dark:text-gray-400">Status</span>
                    <span class="font-medium {{ $pColor ?? 'text-gray-600' }}">
                        {{ $registration->payment_status_label }}
                    </span>
                </div>
                @if($registration->payment_proof)
                    <div class="flex justify-between">
                        <span class="text-gray-500 dark:text-gray-400">Bukti</span>
                        <a href="{{ route('admin.registrations.download-proof', $registration->id) }}"
                           class="text-primary hover:underline font-medium">
                            📎 Download Bukti
                        </a>
                    </div>
                @endif
                @if($registration->payment_expires_at)
                    <div class="flex justify-between">
                        <span class="text-gray-500 dark:text-gray-400">Batas Bayar</span>
                        <span class="font-medium">{{ $registration->payment_expires_at->format('d M Y H:i') }}</span>
                    </div>
                @endif
            </div>
        </div>

        {{-- Catatan --}}
        @if($registration->verification_notes || $registration->rejection_reason)
            <div class="bg-azwara-lightest dark:bg-azwara-darker rounded-xl p-6 border border-gray-200 dark:border-gray-700 md:col-span-2">
                <h3 class="font-semibold text-azwara-darker dark:text-white mb-2">Catatan</h3>
                <div class="space-y-2 text-sm">
                    @if($registration->verification_notes)
                        <div>
                            <span class="text-gray-500 dark:text-gray-400">Catatan Verifikasi:</span>
                            <p class="mt-1 p-3 bg-white dark:bg-gray-800 rounded-lg">
                                {{ $registration->verification_notes }}
                            </p>
                        </div>
                    @endif
                    @if($registration->rejection_reason)
                        <div>
                            <span class="text-gray-500 dark:text-gray-400">Alasan Penolakan:</span>
                            <p class="mt-1 p-3 bg-white dark:bg-gray-800 rounded-lg text-red-600 dark:text-red-400">
                                {{ $registration->rejection_reason }}
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        @endif

    </div>

</div>
@endsection