@extends('layouts.app')

@section('title', 'QR Absensi Saya')

@section('content')
<div class="py-6 md:py-8">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">

            {{-- QR --}}
            <div class="lg:col-span-2">
                <div class="bg-white dark:bg-primary-900/30 rounded-3xl border border-primary-100 dark:border-primary-800/30 shadow-sm overflow-hidden lg:sticky lg:top-4">
                    <div class="bg-gradient-to-br from-primary-600 to-primary-800 px-6 py-5 text-white">
                        <p class="text-xs uppercase tracking-widest opacity-80">Kartu Absensi</p>
                        <p class="text-lg font-bold mt-0.5">{{ $user->name }}</p>
                        <p class="text-xs opacity-80">{{ $user->studentRegistration?->class ? 'Kelas ' . $user->studentRegistration->class : '' }}</p>
                    </div>
                    <div class="p-6 flex flex-col items-center">
                        <div class="bg-white p-3 rounded-2xl shadow-inner border border-primary-100">
                            <div data-qr="{{ $user->qr_payload }}" data-size="232" class="w-[232px] h-[232px]"></div>
                        </div>
                        <p class="mt-4 text-sm text-center text-secondary-600 dark:text-secondary-300">
                            Tunjukkan QR ini ke tentor saat pertemuan dimulai.
                        </p>
                        <p class="mt-1 text-xs text-center text-secondary-400 dark:text-secondary-500">
                            Naikkan kecerahan layar agar mudah dipindai. Jangan bagikan QR ini ke orang lain.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Ringkasan --}}
            <div class="lg:col-span-3 space-y-6">
                <div>
                    <h1 class="text-xl font-bold text-primary-900 dark:text-white">Kehadiran Saya</h1>
                    <p class="text-sm text-secondary-500 dark:text-secondary-400">Persentase dihitung dari pertemuan yang sudah selesai.</p>
                </div>

                @include('attendance.partials.summary-tiles', ['summary' => $summary])

                <div class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 shadow-sm p-5">
                    <h2 class="font-semibold text-primary-800 dark:text-primary-100">Riwayat Terakhir</h2>
                    @include('attendance.partials.history-list', ['history' => $history])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
@include('attendance.partials.qr-script')
@endpush
