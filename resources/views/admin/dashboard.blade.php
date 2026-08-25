@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto space-y-8 p-4 md:p-6">

    {{-- ================= HEADER ================= --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4
                bg-white/60 dark:bg-primary-950/40 backdrop-blur-sm
                rounded-2xl p-6 border border-primary-200/30 dark:border-primary-800/30">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-primary-800 dark:text-primary-100">
                Admin Dashboard
            </h1>
            <p class="text-sm text-secondary-500 dark:text-secondary-400 mt-1 flex items-center gap-2">
                <span class="inline-block w-2 h-2 rounded-full bg-accent-500 animate-pulse"></span>
                Overview & weekly activity monitoring
            </p>
        </div>

        <div class="flex items-center gap-2 bg-primary-50/50 dark:bg-primary-800/30 p-1.5 rounded-xl
                    border border-primary-200/30 dark:border-primary-700/30">
            <a href="?week={{ $weekOffset - 1 }}"
               class="px-4 py-2 rounded-lg text-sm font-medium
                      text-primary-700 dark:text-primary-300
                      hover:bg-primary-100/50 dark:hover:bg-primary-700/50
                      transition-all duration-200">
                ← Prev
            </a>
            <span class="px-4 py-2 bg-primary-500/10 dark:bg-primary-500/20
                         text-primary-700 dark:text-primary-300
                         rounded-lg text-sm font-semibold
                         border border-primary-200/30 dark:border-primary-600/30">
                {{ $weekLabel }}
            </span>
            <a href="?week={{ $weekOffset + 1 }}"
               class="px-4 py-2 rounded-lg text-sm font-medium
                      text-primary-700 dark:text-primary-300
                      hover:bg-primary-100/50 dark:hover:bg-primary-700/50
                      transition-all duration-200">
                Next →
            </a>
        </div>
    </div>

    {{-- ================= STATS CARDS ================= --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
        {{-- Total Siswa --}}
        <div class="group bg-gradient-to-br from-white to-primary-50/50
                    dark:from-primary-900/50 dark:to-primary-800/30
                    rounded-2xl p-6 border border-primary-200/30 dark:border-primary-700/30
                    shadow-sm hover:shadow-xl hover:scale-[1.02]
                    transition-all duration-300 cursor-default">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-primary-600 dark:text-primary-400 font-medium">Total Siswa</p>
                    <h3 class="text-2xl font-bold text-primary-800 dark:text-primary-100 mt-1">
                        {{ $stats['total_siswa'] }}
                    </h3>
                </div>
                <div class="p-3 bg-primary-100/50 dark:bg-primary-800/50 rounded-xl
                            group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-6 h-6 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
            </div>
            <p class="text-xs text-secondary-500 dark:text-secondary-400 mt-3 flex items-center gap-1">
                <span class="inline-block w-1.5 h-1.5 rounded-full bg-primary-500"></span>
                Active students
            </p>
        </div>

        {{-- Total Tentor --}}
        <div class="group bg-gradient-to-br from-white to-secondary-50/50
                    dark:from-primary-900/50 dark:to-primary-800/30
                    rounded-2xl p-6 border border-secondary-200/30 dark:border-primary-700/30
                    shadow-sm hover:shadow-xl hover:scale-[1.02]
                    transition-all duration-300 cursor-default">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-secondary-600 dark:text-secondary-400 font-medium">Total Tentor</p>
                    <h3 class="text-2xl font-bold text-primary-800 dark:text-primary-100 mt-1">
                        {{ $stats['total_tentor'] }}
                    </h3>
                </div>
                <div class="p-3 bg-secondary-100/50 dark:bg-primary-800/50 rounded-xl
                            group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-6 h-6 text-secondary-600 dark:text-secondary-400" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
            </div>
            <p class="text-xs text-secondary-500 dark:text-secondary-400 mt-3 flex items-center gap-1">
                <span class="inline-block w-1.5 h-1.5 rounded-full bg-secondary-500"></span>
                Active tutors
            </p>
        </div>

        {{-- Total Course --}}
        <div class="group bg-gradient-to-br from-white to-accent-50/50
                    dark:from-primary-900/50 dark:to-primary-800/30
                    rounded-2xl p-6 border border-accent-200/30 dark:border-primary-700/30
                    shadow-sm hover:shadow-xl hover:scale-[1.02]
                    transition-all duration-300 cursor-default">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-accent-600 dark:text-accent-400 font-medium">Total Course</p>
                    <h3 class="text-2xl font-bold text-primary-800 dark:text-primary-100 mt-1">
                        {{ $stats['total_course'] }}
                    </h3>
                </div>
                <div class="p-3 bg-accent-100/50 dark:bg-primary-800/50 rounded-xl
                            group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-6 h-6 text-accent-600 dark:text-accent-400" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
            </div>
            <p class="text-xs text-secondary-500 dark:text-secondary-400 mt-3 flex items-center gap-1">
                <span class="inline-block w-1.5 h-1.5 rounded-full bg-accent-500"></span>
                Available courses
            </p>
        </div>

        {{-- Meetings --}}
        <div class="group bg-gradient-to-br from-white to-gold-50/50
                    dark:from-primary-900/50 dark:to-primary-800/30
                    rounded-2xl p-6 border border-gold-200/30 dark:border-primary-700/30
                    shadow-sm hover:shadow-xl hover:scale-[1.02]
                    transition-all duration-300 cursor-default">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gold-600 dark:text-gold-400 font-medium">Meetings</p>
                    <h3 class="text-2xl font-bold text-primary-800 dark:text-primary-100 mt-1">
                        {{ $stats['done_meeting'] }}<span class="text-lg text-secondary-400 dark:text-secondary-500">/{{ $stats['total_meeting'] }}</span>
                    </h3>
                </div>
                <div class="p-3 bg-gold-100/50 dark:bg-primary-800/50 rounded-xl
                            group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-6 h-6 text-gold-600 dark:text-gold-400" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>
            <p class="text-xs text-secondary-500 dark:text-secondary-400 mt-3 flex items-center gap-1">
                <span class="inline-block w-1.5 h-1.5 rounded-full bg-gold-500"></span>
                Completed / Total
            </p>
        </div>
    </div>

    {{-- ================= WEEKLY SALES ================= --}}
    <div class="bg-white/80 dark:bg-primary-950/60 backdrop-blur-sm
                rounded-2xl p-6 border border-primary-200/30 dark:border-primary-800/30
                shadow-sm hover:shadow-xl transition-all duration-300">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-6 gap-4">
            <div>
                <h3 class="text-lg font-semibold text-primary-800 dark:text-primary-100 flex items-center gap-2">
                    <span class="inline-block w-2 h-2 rounded-full bg-accent-500"></span>
                    Weekly Sales
                </h3>
                <p class="text-sm text-secondary-500 dark:text-secondary-400">Revenue overview for {{ $weekLabel }}</p>
            </div>
            <div class="flex items-center gap-2">
                <div class="flex items-center gap-2 px-3 py-1.5 bg-primary-50/50 dark:bg-primary-800/30 rounded-lg
                            border border-primary-200/30 dark:border-primary-700/30">
                    <div class="w-3 h-3 rounded-full bg-gradient-to-r from-primary-500 to-accent-500"></div>
                    <span class="text-sm text-primary-700 dark:text-primary-300 font-medium">Total Revenue</span>
                </div>
            </div>
        </div>

        <div class="h-72">
            <canvas id="weeklySalesChart"></canvas>
        </div>
    </div>

    {{-- ================= TABLES ================= --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- MEETINGS THIS WEEK --}}
        <div class="bg-white/80 dark:bg-primary-950/60 backdrop-blur-sm
                    rounded-2xl p-6 border border-primary-200/30 dark:border-primary-800/30
                    shadow-sm hover:shadow-xl transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-primary-800 dark:text-primary-100 flex items-center gap-2">
                    <span class="inline-block w-2 h-2 rounded-full bg-primary-500"></span>
                    Meetings This Week
                </h3>
                <span class="text-sm bg-primary-100/50 dark:bg-primary-800/30
                             text-primary-700 dark:text-primary-300
                             px-3 py-1 rounded-lg font-medium">
                    {{ $meetingsThisWeek->count() }} meetings
                </span>
            </div>

            <div class="overflow-x-auto rounded-xl">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-primary-200/30 dark:border-primary-700/30">
                            <th class="text-left py-3 px-4 text-xs font-medium text-secondary-500 dark:text-secondary-400 uppercase tracking-wider">Meeting</th>
                            <th class="text-left py-3 px-4 text-xs font-medium text-secondary-500 dark:text-secondary-400 uppercase tracking-wider">Course</th>
                            <th class="text-left py-3 px-4 text-xs font-medium text-secondary-500 dark:text-secondary-400 uppercase tracking-wider">Status</th>
                            <th class="text-left py-3 px-4 text-xs font-medium text-secondary-500 dark:text-secondary-400 uppercase tracking-wider">Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($meetingsThisWeek as $meeting)
                            <tr class="border-b border-primary-100/30 dark:border-primary-800/20
                                       hover:bg-primary-50/30 dark:hover:bg-primary-800/20
                                       cursor-pointer transition-all duration-200 group"
                                onclick="window.location='{{ route('meeting.show', $meeting) }}'">
                                <td class="py-3 px-4">
                                    <div class="font-medium text-primary-800 dark:text-primary-100 group-hover:text-primary-600 dark:group-hover:text-primary-300 transition-colors">
                                        {{ $meeting->title }}
                                    </div>
                                </td>
                                <td class="py-3 px-4">
                                    <div class="text-sm text-secondary-600 dark:text-secondary-400">{{ $meeting->course->name ?? '-' }}</div>
                                </td>
                                <td class="py-3 px-4">
                                    @php
                                        $statusColors = [
                                            'live' => 'bg-accent-100 text-accent-800 dark:bg-accent-500/20 dark:text-accent-300',
                                            'upcoming' => 'bg-primary-100 text-primary-800 dark:bg-primary-500/20 dark:text-primary-300',
                                            'done' => 'bg-secondary-100 text-secondary-800 dark:bg-secondary-500/20 dark:text-secondary-300',
                                            'cancelled' => 'bg-red-100 text-red-800 dark:bg-red-500/20 dark:text-red-300'
                                        ];
                                        $color = $statusColors[$meeting->status] ?? 'bg-secondary-100 text-secondary-800';
                                    @endphp
                                    <span class="px-3 py-1 text-xs font-medium rounded-full {{ $color }}">
                                        {{ ucfirst($meeting->status) }}
                                    </span>
                                </td>
                                <td class="py-3 px-4">
                                    <div class="text-sm text-secondary-600 dark:text-secondary-400">
                                        {{ $meeting->scheduled_at->format('d M H:i') }}
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-8 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg class="w-12 h-12 text-secondary-300 dark:text-secondary-600 mb-3" fill="none" stroke="currentColor" stroke-width="1.5">
                                            <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <p class="text-secondary-500 dark:text-secondary-400">No meetings scheduled this week</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- PENDING ORDERS --}}
        <div class="bg-white/80 dark:bg-primary-950/60 backdrop-blur-sm
                    rounded-2xl p-6 border border-primary-200/30 dark:border-primary-800/30
                    shadow-sm hover:shadow-xl transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-primary-800 dark:text-primary-100 flex items-center gap-2">
                    <span class="inline-block w-2 h-2 rounded-full bg-gold-500"></span>
                    Orders Waiting Confirmation
                </h3>
                <span class="px-3 py-1 bg-gold-100/50 dark:bg-gold-500/20
                             text-gold-700 dark:text-gold-300 text-sm font-medium rounded-lg">
                    {{ $pendingOrders->count() }} pending
                </span>
            </div>

            <div class="overflow-x-auto rounded-xl">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-primary-200/30 dark:border-primary-700/30">
                            <th class="text-left py-3 px-4 text-xs font-medium text-secondary-500 dark:text-secondary-400 uppercase tracking-wider">User</th>
                            <th class="text-left py-3 px-4 text-xs font-medium text-secondary-500 dark:text-secondary-400 uppercase tracking-wider">Total</th>
                            <th class="text-left py-3 px-4 text-xs font-medium text-secondary-500 dark:text-secondary-400 uppercase tracking-wider">Status</th>
                            <th class="text-left py-3 px-4 text-xs font-medium text-secondary-500 dark:text-secondary-400 uppercase tracking-wider">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pendingOrders as $order)
                            <tr class="border-b border-primary-100/30 dark:border-primary-800/20
                                       hover:bg-primary-50/30 dark:hover:bg-primary-800/20
                                       cursor-pointer transition-all duration-200 group"
                                onclick="window.location='{{ route('orders.show', $order) }}'">
                                <td class="py-3 px-4">
                                    <div class="font-medium text-primary-800 dark:text-primary-100 group-hover:text-primary-600 dark:group-hover:text-primary-300 transition-colors">
                                        {{ $order->user->name }}
                                    </div>
                                </td>
                                <td class="py-3 px-4">
                                    <div class="font-semibold text-primary-800 dark:text-primary-100">
                                        Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                    </div>
                                </td>
                                <td class="py-3 px-4">
                                    <span class="px-3 py-1 bg-gold-100/50 dark:bg-gold-500/20
                                                 text-gold-700 dark:text-gold-300 text-xs font-medium rounded-full
                                                 border border-gold-200/30 dark:border-gold-500/30">
                                        PAID
                                    </span>
                                </td>
                                <td class="py-3 px-4">
                                    <div class="text-sm text-secondary-600 dark:text-secondary-400">
                                        {{ $order->created_at->format('d M Y') }}
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-8 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg class="w-12 h-12 text-secondary-300 dark:text-secondary-600 mb-3" fill="none" stroke="currentColor" stroke-width="1.5">
                                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <p class="text-secondary-500 dark:text-secondary-400">All orders are verified</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</div>
@endsection

@push('styles')
<style>
    /* Custom Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Stagger animation untuk cards */
    .group {
        animation: fadeInUp 0.5s ease-out forwards;
        opacity: 0;
    }

    .grid .group:nth-child(1) { animation-delay: 0.05s; }
    .grid .group:nth-child(2) { animation-delay: 0.10s; }
    .grid .group:nth-child(3) { animation-delay: 0.15s; }
    .grid .group:nth-child(4) { animation-delay: 0.20s; }

    /* Custom scrollbar untuk tables */
    .overflow-x-auto::-webkit-scrollbar {
        height: 4px;
    }

    .overflow-x-auto::-webkit-scrollbar-track {
        @apply bg-primary-100/30 dark:bg-primary-800/30 rounded-full;
    }

    .overflow-x-auto::-webkit-scrollbar-thumb {
        @apply bg-primary-400/50 dark:bg-primary-600/50 rounded-full;
    }

    .overflow-x-auto::-webkit-scrollbar-thumb:hover {
        @apply bg-primary-500 dark:bg-primary-500;
    }

    /* Table row hover effect */
    tbody tr {
        transition: all 0.2s ease;
    }

    tbody tr:hover {
        transform: translateX(2px);
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('weeklySalesChart');

        // Data dari controller
        const labels = @json(array_column($allDays, 'day'));
        const dates = @json(array_column($allDays, 'date'));
        const data = @json(array_column($allDays, 'total'));

        // Format untuk tooltip
        const formattedData = data.map(value => {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(value);
        });

        // Cek dark mode
        const isDark = document.documentElement.classList.contains('dark');
        const textColor = isDark ? '#94A3B8' : '#64748B';
        const gridColor = isDark ? 'rgba(255,255,255,0.05)' : 'rgba(0,0,0,0.05)';

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Revenue',
                    data: data,
                    backgroundColor: 'rgba(65, 135, 65, 0.15)',
                    borderColor: '#418741',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#418741',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 8,
                    pointHoverBackgroundColor: '#A54B19'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                        backgroundColor: isDark ? '#1A361A' : '#FFFFFF',
                        titleColor: isDark ? '#D9E7D9' : '#1A361A',
                        bodyColor: isDark ? '#D9E7D9' : '#1A361A',
                        borderColor: isDark ? '#418741' : '#418741',
                        borderWidth: 1,
                        padding: 12,
                        cornerRadius: 12,
                        callbacks: {
                            label: function(context) {
                                return `Revenue: ${formattedData[context.dataIndex]}`;
                            },
                            title: function(context) {
                                return dates[context[0].dataIndex];
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: gridColor
                        },
                        ticks: {
                            color: textColor,
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        }
                    },
                    x: {
                        grid: {
                            color: gridColor
                        },
                        ticks: {
                            color: textColor
                        }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index'
                }
            }
        });

        // Update chart on theme change
        document.addEventListener('themeChanged', function() {
            // Refresh chart dengan warna baru
            const isDarkNow = document.documentElement.classList.contains('dark');
            // Logic untuk update chart jika diperlukan
        });
    });
</script>
@endpush
