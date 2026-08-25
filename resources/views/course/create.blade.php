@extends('layouts.app')

@section('content')
<div class="py-6 md:py-8">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Navigation --}}
        <nav class="flex items-center gap-2 text-sm mb-6">
            <a href="{{ route('course.index') }}"
               class="text-secondary-500 hover:text-primary-600 dark:text-secondary-400 dark:hover:text-primary-300 transition-colors group">
                <span class="inline-flex items-center gap-1.5">
                    <svg class="w-4 h-4 group-hover:-translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Daftar Course
                </span>
            </a>
            <span class="text-secondary-300 dark:text-secondary-600">/</span>
            <span class="text-primary-600 dark:text-primary-300 font-medium">Tambah</span>
        </nav>

        {{-- Main Card --}}
        <div class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 overflow-hidden shadow-sm">

            {{-- Header --}}
            <div class="px-6 py-5 border-b border-primary-100 dark:border-primary-800/30 bg-primary-50/30 dark:bg-primary-900/20">
                <div class="flex items-center gap-3">
                    <div class="p-2.5 rounded-xl bg-primary-100/50 dark:bg-primary-800/50 text-primary-600 dark:text-primary-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-primary-800 dark:text-primary-100">Tambah Course</h1>
                        <p class="text-sm text-secondary-500 dark:text-secondary-400">Buat course baru untuk siswa belajar</p>
                    </div>
                </div>
            </div>

            {{-- Form --}}
            <form action="{{ route('course.store') }}" method="POST" class="p-6 space-y-6">
                @csrf

                {{-- Global Validation --}}
                @if ($errors->any())
                <div class="p-4 rounded-xl bg-red-50/80 dark:bg-red-900/20 border border-red-200/50 dark:border-red-800/30 flex items-start gap-3">
                    <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div>
                        <p class="text-sm font-medium text-red-700 dark:text-red-400">Mohon periksa kembali:</p>
                        <ul class="list-disc pl-5 mt-1 space-y-0.5 text-sm text-red-600 dark:text-red-400">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif

                {{-- Nama Course --}}
                <div>
                    <label class="block text-sm font-medium text-primary-700 dark:text-primary-300 mb-1.5">
                        Nama Course <span class="text-accent-500">*</span>
                    </label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                           placeholder="Masukkan nama course..."
                           class="w-full px-4 py-3 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-primary-800 dark:text-primary-50 placeholder-secondary-400 focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all duration-200">
                </div>

                {{-- Slug --}}
                <div>
                    <label class="block text-sm font-medium text-primary-700 dark:text-primary-300 mb-1.5">
                        Slug <span class="text-accent-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-secondary-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                            </svg>
                        </div>
                        <input type="text" name="slug" value="{{ old('slug') }}" required
                               placeholder="contoh: matematika-dasar"
                               class="w-full pl-11 pr-4 py-3 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-primary-800 dark:text-primary-50 placeholder-secondary-400 focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all duration-200">
                    </div>
                    <p class="mt-1 text-xs text-secondary-500 dark:text-secondary-400">Slug adalah URL unik untuk course ini. Gunakan huruf kecil dan tanda hubung (-).</p>
                </div>

                {{-- Deskripsi --}}
                <div>
                    <label class="block text-sm font-medium text-primary-700 dark:text-primary-300 mb-1.5">
                        Deskripsi <span class="text-accent-500">*</span>
                    </label>
                    <textarea name="description" rows="5" required
                              placeholder="Tuliskan deskripsi course..."
                              class="w-full px-4 py-3 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-primary-800 dark:text-primary-50 placeholder-secondary-400 focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all duration-200 resize-y">{{ old('description') }}</textarea>
                </div>

                {{-- Free Course --}}
                <div class="p-4 rounded-xl bg-primary-50/30 dark:bg-primary-800/20 border border-primary-200/30 dark:border-primary-700/30">
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" name="is_free" value="1" {{ old('is_free') ? 'checked' : '' }}
                               class="w-4 h-4 rounded border-primary-300 dark:border-primary-600 text-primary-600 focus:ring-primary-500 focus:ring-offset-2 dark:focus:ring-offset-primary-900">
                        <span class="font-medium text-primary-800 dark:text-primary-200">Course Gratis</span>
                    </label>
                    <p class="text-xs text-secondary-500 dark:text-secondary-400 mt-1.5 ml-7">Jika dicentang, semua user dapat mengakses course ini tanpa membeli.</p>
                </div>

                {{-- Actions --}}
                <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-primary-100 dark:border-primary-800/30">
                    <button type="submit"
                            class="flex-1 inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-primary-600 hover:bg-primary-700 text-white font-medium transition-all duration-200 hover:shadow-lg hover:shadow-primary-500/25 active:scale-[0.98]">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan Course
                    </button>
                    <a href="{{ route('course.index') }}"
                       class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl border border-primary-200 dark:border-primary-700/50 text-secondary-600 dark:text-secondary-400 hover:bg-primary-50 dark:hover:bg-primary-800/20 transition-all duration-200">
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
document.addEventListener('DOMContentLoaded', function() {
    const nameInput = document.querySelector('input[name="name"]');
    const slugInput = document.querySelector('input[name="slug"]');

    if (nameInput && slugInput) {
        nameInput.addEventListener('input', function() {
            if (!slugInput.dataset.manuallyEdited) {
                let slug = this.value.toLowerCase()
                    .replace(/[^a-z0-9\s-]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-')
                    .replace(/^-+|-+$/g, '');
                slugInput.value = slug;
            }
        });

        slugInput.addEventListener('input', function() {
            this.dataset.manuallyEdited = 'true';
        });
    }
});
</script>
@endpush
