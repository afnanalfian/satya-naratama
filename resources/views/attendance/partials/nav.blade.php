{{-- Navigasi modul absensi --}}
@php
    $tabs = [
        ['attendance.index', 'Rekap & Grafik', 'admin|tentor'],
        ['attendance.hub', 'Scan Absensi', 'admin|tentor'],
        ['attendance.qr-cards', 'Kartu QR Siswa', 'admin'],
    ];
@endphp
<div class="flex flex-wrap gap-2 mb-6">
    @foreach($tabs as [$route, $label, $roles])
        @hasanyrole($roles)
            <a href="{{ route($route) }}"
               class="px-4 py-2 rounded-xl text-sm font-medium border transition-all duration-200
                      {{ request()->routeIs($route)
                            ? 'bg-primary-600 text-white border-primary-600 shadow-sm'
                            : 'bg-white dark:bg-primary-900/30 text-secondary-600 dark:text-secondary-300 border-primary-200 dark:border-primary-700/50 hover:bg-primary-50 dark:hover:bg-primary-800/30' }}">
                {{ $label }}
            </a>
        @endhasanyrole
    @endforeach
</div>
