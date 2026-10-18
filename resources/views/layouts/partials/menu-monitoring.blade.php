{{-- ================= ABSENSI & MONITORING (admin + tentor) ================= --}}
@php
    $monActive = request()->routeIs('attendance.*', 'meeting.attendance.*', 'jasmani.*', 'physical.index', 'physical.student', 'monitor.*');
    $isAdminMenu = auth()->user()->hasRole('admin');
@endphp
<a href="{{ route('attendance.hub') }}"
   class="menu-item {{ request()->routeIs('attendance.hub', 'meeting.attendance.*') ? 'active' : '' }}">
    <svg class="menu-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M3 9V5a2 2 0 012-2h4M15 3h4a2 2 0 012 2v4M21 15v4a2 2 0 01-2 2h-4M9 21H5a2 2 0 01-2-2v-4M7 12h10"/>
    </svg>
    Scan Absensi
</a>

<div x-data="{ open: {{ $monActive ? 'true' : 'false' }} }" class="relative">
    <button @click="open = !open" class="menu-item w-full flex justify-between items-center {{ $monActive ? 'active' : '' }}">
        <div class="flex items-center gap-2">
            <svg class="menu-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3v18h18M7 15l4-4 3 3 5-6"/>
            </svg>
            Monitoring
        </div>
        <svg :class="open ? 'rotate-180' : ''" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
    </button>
    <div x-show="open" x-transition class="ml-6 mt-2 space-y-1 border-l border-azwara-medium/30 dark:border-azwara-light/20 pl-4">
        <a href="{{ route('attendance.index') }}" class="menu-subitem {{ request()->routeIs('attendance.index', 'attendance.student') ? 'active' : '' }}">
            Rekap Absensi
        </a>
        <a href="{{ route('jasmani.index') }}" class="menu-subitem {{ request()->routeIs('jasmani.*') ? 'active' : '' }}">
            Evaluasi Jasmani
        </a>
        <a href="{{ route('physical.index') }}" class="menu-subitem {{ request()->routeIs('physical.index', 'physical.student') ? 'active' : '' }}">
            Data Fisik
        </a>
        @if($isAdminMenu)
            <a href="{{ route('attendance.qr-cards') }}" class="menu-subitem {{ request()->routeIs('attendance.qr-cards') ? 'active' : '' }}">
                Kartu QR Siswa
            </a>
            <a href="{{ route('monitor.links') }}" class="menu-subitem {{ request()->routeIs('monitor.links') ? 'active' : '' }}">
                Link Orang Tua
            </a>
        @endif
    </div>
</div>
