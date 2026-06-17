@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- ================= HEADER ================= --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-azwara-darkest dark:text-azwara-lightest">
                Promo Banners
            </h1>
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Kelola banner, popup, dan modal promosi
            </p>
        </div>

        <a href="{{ route('promo-banners.create') }}"
           class="inline-flex items-center gap-2 px-4 py-2 rounded-lg
                  bg-primary text-white text-sm font-medium
                  hover:bg-azwara-light transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Promo
        </a>
    </div>

    {{-- ================= TABLE CARD ================= --}}
    <div class="bg-white dark:bg-azwara-darker shadow-sm rounded-xl border border-azwara-lighter/60 dark:border-white/10 overflow-hidden">

        {{-- TABLE (DESKTOP) --}}
        <div class="hidden md:block overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-azwara-lightest dark:bg-azwara-darkest">
                    <tr class="text-left text-gray-700 dark:text-gray-300">
                        <th class="px-4 py-3 font-medium">Promo</th>
                        <th class="px-4 py-3 font-medium">Tipe</th>
                        <th class="px-4 py-3 font-medium">Landing</th>
                        <th class="px-4 py-3 font-medium">Status</th>
                        <th class="px-4 py-3 font-medium">Periode</th>
                        <th class="px-4 py-3 font-medium text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-azwara-lighter/60 dark:divide-white/10">

                    @forelse($promos as $promo)
                        <tr class="hover:bg-azwara-lightest/50 dark:hover:bg-white/5 transition">

                            {{-- PROMO INFO --}}
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $promo->image_url }}"
                                         class="h-12 w-20 rounded-md object-cover border border-azwara-lighter/50"
                                         alt="{{ $promo->title }}">

                                    <div>
                                        <div class="font-medium text-azwara-darkest dark:text-azwara-lightest">
                                            {{ $promo->title }}
                                        </div>
                                        @if($promo->description)
                                            <div class="text-xs text-gray-500 dark:text-gray-400 line-clamp-1">
                                                {{ $promo->description }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            {{-- TYPE --}}
                            <td class="px-4 py-3">
                                <span class="inline-flex px-2 py-1 rounded-md text-xs font-medium
                                    bg-azwara-lightest text-azwara-darkest
                                    dark:bg-white/10 dark:text-gray-200">
                                    {{ ucfirst($promo->type) }}
                                </span>
                            </td>

                            {{-- LANDING --}}
                            <td class="px-4 py-3">
                                @if($promo->show_on_landing)
                                    <span class="inline-flex items-center gap-1 text-green-600 dark:text-green-400 text-xs font-medium">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M5 13l4 4L19 7"/>
                                        </svg>
                                        Ya
                                    </span>
                                @else
                                    <span class="text-xs text-gray-500">Tidak</span>
                                @endif
                            </td>

                            {{-- STATUS --}}
                            <td class="px-4 py-3">
                                @if($promo->is_active)
                                    <span class="inline-flex px-2 py-1 rounded-md text-xs font-medium
                                        bg-green-100 text-green-700
                                        dark:bg-green-500/10 dark:text-green-400">
                                        Aktif
                                    </span>
                                @else
                                    <span class="inline-flex px-2 py-1 rounded-md text-xs font-medium
                                        bg-gray-200 text-gray-600
                                        dark:bg-white/10 dark:text-gray-400">
                                        Nonaktif
                                    </span>
                                @endif
                            </td>

                            {{-- PERIOD --}}
                            <td class="px-4 py-3 text-xs text-gray-600 dark:text-gray-400">
                                @if($promo->starts_at || $promo->ends_at)
                                    {{ optional($promo->starts_at)->format('d M Y') ?? '—' }}
                                    <br>
                                    {{ optional($promo->ends_at)->format('d M Y') ?? '—' }}
                                @else
                                    Tanpa batas
                                @endif
                            </td>

                            {{-- ACTION --}}
                            <td class="px-4 py-3 text-right">
                                <div class="inline-flex items-center gap-2">
                                    <a href="{{ route('promo-banners.edit', $promo) }}"
                                       class="p-2 rounded-md hover:bg-azwara-lightest dark:hover:bg-white/10">
                                        <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M11 5h2m-1 0v14m7-7H5"/>
                                        </svg>
                                    </a>

                                    <form action="{{ route('promo-banners.toggle-status', $promo) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button class="p-2 rounded-md hover:bg-azwara-lightest dark:hover:bg-white/10">
                                            <svg class="w-4 h-4 {{ $promo->is_active ? 'text-red-500' : 'text-green-500' }}"
                                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M18 12H6"/>
                                            </svg>
                                        </button>
                                    </form>

                                    <form action="{{ route('promo-banners.destroy', $promo) }}" method="POST"
                                          onsubmit="return confirm('Hapus promo ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="p-2 rounded-md hover:bg-red-50 dark:hover:bg-red-500/10">
                                            <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-gray-500">
                                Belum ada promo banner
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

        {{-- MOBILE LIST --}}
        <div class="md:hidden divide-y divide-azwara-lighter/60 dark:divide-white/10">
            @foreach($promos as $promo)
                <div class="p-4 flex gap-4">
                    <img src="{{ $promo->image_url }}"
                         class="h-16 w-24 rounded-md object-cover border">

                    <div class="flex-1">
                        <div class="font-medium text-azwara-darkest dark:text-azwara-lightest">
                            {{ $promo->title }}
                        </div>
                        <div class="text-xs text-gray-500 mb-2">
                            {{ ucfirst($promo->type) }} · {{ $promo->is_active ? 'Aktif' : 'Nonaktif' }}
                        </div>

                        <div class="flex gap-3">
                            <a href="{{ route('promo-banners.edit', $promo) }}" class="text-primary text-xs">
                                Edit
                            </a>
                            <form action="{{ route('promo-banners.toggle-status', $promo) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button class="text-xs text-secondary">
                                    Toggle
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- PAGINATION --}}
    <div class="mt-6">
        {{ $promos->links() }}
    </div>
</div>
@endsection
