@extends('layouts.app')

@section('content')
<div class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-azwara-darker dark:text-white">
                Manajemen Pendaftaran
            </h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Kelola semua pendaftaran siswa baru
            </p>
        </div>

        <div class="flex gap-2">
            <a href="{{ route('admin.registrations.export') }}"
               class="px-4 py-2 rounded-xl bg-green-600 text-white font-medium hover:bg-green-700 transition">
                <svg class="inline-block w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                </svg>
                Export
            </a>
        </div>
    </div>

    {{-- Stats --}}
    <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
        <div class="bg-azwara-lightest dark:bg-azwara-darker rounded-xl p-4 border border-gray-200 dark:border-gray-700">
            <p class="text-2xl font-bold text-azwara-darker dark:text-white">{{ $stats['total'] }}</p>
            <p class="text-sm text-gray-500 dark:text-gray-400">Total</p>
        </div>
        <div class="bg-blue-50 dark:bg-blue-900/20 rounded-xl p-4 border border-blue-200 dark:border-blue-800">
            <p class="text-2xl font-bold text-blue-700 dark:text-blue-400">{{ $stats['pending_payment'] }}</p>
            <p class="text-sm text-blue-600 dark:text-blue-300">Menunggu Bayar</p>
        </div>
        <div class="bg-yellow-50 dark:bg-yellow-900/20 rounded-xl p-4 border border-yellow-200 dark:border-yellow-800">
            <p class="text-2xl font-bold text-yellow-700 dark:text-yellow-400">{{ $stats['awaiting_verification'] }}</p>
            <p class="text-sm text-yellow-600 dark:text-yellow-300">Menunggu Verifikasi</p>
        </div>
        <div class="bg-green-50 dark:bg-green-900/20 rounded-xl p-4 border border-green-200 dark:border-green-800">
            <p class="text-2xl font-bold text-green-700 dark:text-green-400">{{ $stats['verified'] }}</p>
            <p class="text-sm text-green-600 dark:text-green-300">Terverifikasi</p>
        </div>
        <div class="bg-red-50 dark:bg-red-900/20 rounded-xl p-4 border border-red-200 dark:border-red-800">
            <p class="text-2xl font-bold text-red-700 dark:text-red-400">{{ $stats['rejected'] }}</p>
            <p class="text-sm text-red-600 dark:text-red-300">Ditolak</p>
        </div>
    </div>

    {{-- Filter & Search --}}
    <div class="bg-azwara-lightest dark:bg-azwara-darker rounded-xl p-4 border border-gray-200 dark:border-gray-700">
        <form method="GET" action="{{ route('admin.registrations.index') }}"
            class="flex flex-wrap gap-3 items-end">

            <div class="flex-1 min-w-[200px]">
                <label class="text-xs font-medium text-gray-600 dark:text-gray-400">Cari</label>
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Nama / Email / No HP"
                    class="w-full px-4 py-2 rounded-xl
                        bg-white dark:bg-gray-800
                        border-gray-300 dark:border-gray-700
                        text-sm text-azwara-darkest dark:text-white
                        focus:ring-primary focus:border-primary">
            </div>

            <div>
                <label class="text-xs font-medium text-gray-600 dark:text-gray-400">Status</label>
                <select name="status"
                    class="px-4 py-2 rounded-xl
                        bg-white dark:bg-gray-800
                        border-gray-300 dark:border-gray-700
                        text-sm text-azwara-darkest dark:text-white
                        focus:ring-primary focus:border-primary">
                    <option value="all">Semua Status</option>
                    @foreach($statuses as $key => $label)
                        <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="text-xs font-medium text-gray-600 dark:text-gray-400">Pembayaran</label>
                <select name="payment_status"
                    class="px-4 py-2 rounded-xl
                        bg-white dark:bg-gray-800
                        border-gray-300 dark:border-gray-700
                        text-sm text-azwara-darkest dark:text-white
                        focus:ring-primary focus:border-primary">
                    <option value="all">Semua Pembayaran</option>
                    @foreach($paymentStatuses as $key => $label)
                        <option value="{{ $key }}" {{ request('payment_status') == $key ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit"
                class="px-6 py-2 rounded-xl bg-primary text-white font-medium hover:bg-azwara-medium transition">
                Filter
            </button>

            <a href="{{ route('admin.registrations.index') }}"
               class="px-4 py-2 rounded-xl border border-gray-300 dark:border-gray-700 text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                Reset
            </a>
        </form>
    </div>

    {{-- Table --}}
    <div class="bg-azwara-lightest dark:bg-azwara-darker border border-gray-200 dark:border-azwara-darkest rounded-2xl shadow-lg dark:shadow-black/40 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-primary dark:bg-azwara-darkest text-white dark:text-azwara-light">
                    <tr>
                        <th class="px-6 py-4 text-left font-semibold">No</th>
                        <th class="px-6 py-4 text-left font-semibold">Nama</th>
                        <th class="px-6 py-4 text-left font-semibold hidden md:table-cell">Email</th>
                        <th class="px-6 py-4 text-center font-semibold hidden sm:table-cell">Status</th>
                        <th class="px-6 py-4 text-center font-semibold hidden sm:table-cell">Pembayaran</th>
                        <th class="px-6 py-4 text-left font-semibold hidden lg:table-cell">Tanggal</th>
                        <th class="px-6 py-4 text-center font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($registrations as $index => $reg)
                        <tr class="hover:bg-azwara-lighter/30 dark:hover:bg-azwara-darkest/50 transition">
                            <td class="px-6 py-4 text-gray-600 dark:text-gray-400">
                                {{ $registrations->firstItem() + $index }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $reg->avatar ? asset('storage/' . $reg->avatar) : asset('img/user.png') }}"
                                         class="w-8 h-8 rounded-full object-cover">
                                    <div>
                                        <div class="font-medium text-azwara-darkest dark:text-white">
                                            {{ $reg->full_name }}
                                        </div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">
                                            {{ $reg->phone }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-gray-600 dark:text-gray-300 hidden md:table-cell">
                                {{ $reg->email }}
                            </td>
                            <td class="px-6 py-4 text-center hidden sm:table-cell">
                                @php
                                    $statusColors = [
                                        'pending_payment' => 'blue',
                                        'awaiting_verification' => 'yellow',
                                        'verified' => 'green',
                                        'rejected' => 'red',
                                        'draft' => 'gray',
                                    ];
                                    $color = $statusColors[$reg->registration_status] ?? 'gray';
                                @endphp
                                <span class="px-3 py-1 rounded-full text-xs font-medium
                                    bg-{{ $color }}-100 text-{{ $color }}-700
                                    dark:bg-{{ $color }}-900/30 dark:text-{{ $color }}-400">
                                    {{ $reg->registration_status_label }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center hidden sm:table-cell">
                                @php
                                    $paymentColors = [
                                        'pending' => 'blue',
                                        'paid' => 'yellow',
                                        'verified' => 'green',
                                        'rejected' => 'red',
                                        'expired' => 'red',
                                    ];
                                    $pColor = $paymentColors[$reg->payment_status] ?? 'gray';
                                @endphp
                                <span class="px-3 py-1 rounded-full text-xs font-medium
                                    bg-{{ $pColor }}-100 text-{{ $pColor }}-700
                                    dark:bg-{{ $pColor }}-900/30 dark:text-{{ $pColor }}-400">
                                    {{ $reg->payment_status_label }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-500 dark:text-gray-400 hidden lg:table-cell text-sm">
                                {{ $reg->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.registrations.show', $reg->id) }}"
                                       class="text-primary hover:text-azwara-medium transition"
                                       title="Detail">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </a>

                                    @if($reg->registration_status == 'awaiting_verification')
                                        <a href="{{ route('admin.registrations.verify.form', $reg->id) }}"
                                           class="text-green-600 hover:text-green-700 transition"
                                           title="Verifikasi">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </a>

                                        <a href="{{ route('admin.registrations.reject.form', $reg->id) }}"
                                           class="text-red-600 hover:text-red-700 transition"
                                           title="Tolak">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </a>
                                    @endif

                                    @if($reg->payment_proof)
                                        <a href="{{ route('admin.registrations.download-proof', $reg->id) }}"
                                           class="text-blue-600 hover:text-blue-700 transition"
                                           title="Download Bukti">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                            </svg>
                                        </a>
                                    @endif

                                    @if(in_array($reg->registration_status, ['draft', 'rejected']))
                                        <form action="{{ route('admin.registrations.destroy', $reg->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus pendaftaran ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="text-red-600 hover:text-red-700 transition"
                                                    title="Hapus">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center gap-2">
                                    <div class="w-14 h-14 rounded-full bg-azwara-light/30 dark:bg-azwara-darkest flex items-center justify-center text-azwara-medium text-2xl">
                                        📋
                                    </div>
                                    <p class="text-base font-semibold text-azwara-darkest dark:text-white">
                                        Belum Ada Pendaftaran
                                    </p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        Pendaftaran baru akan muncul di sini
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    <div>
        {{ $registrations->links() }}
    </div>

</div>
@endsection