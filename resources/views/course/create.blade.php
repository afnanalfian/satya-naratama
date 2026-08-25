@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-6">

    {{-- ================= BACK BUTTON ================= --}}
    <a href="{{ route('course.index') }}"
       class="inline-flex items-center gap-2
              text-sm font-medium
              text-primary-700 dark:text-primary-300
              hover:text-primary-500 dark:hover:text-primary-400
              transition-all duration-200
              group mb-6">
        <svg xmlns="http://www.w3.org/2000/svg"
             class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform duration-200"
             fill="none" viewBox="0 0 24 24"
             stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M15 19l-7-7 7-7" />
        </svg>
        Kembali ke Daftar Course
    </a>

    {{-- ================= CARD ================= --}}
    <div class="bg-white/80 dark:bg-primary-950/60 backdrop-blur-sm
                rounded-2xl border border-primary-200/30 dark:border-primary-800/30
                shadow-sm hover:shadow-xl transition-all duration-300
                overflow-hidden">

        {{-- Header --}}
        <div class="px-6 py-5 border-b border-primary-200/30 dark:border-primary-800/30
                    bg-gradient-to-r from-primary-50/30 to-accent-50/30
                    dark:from-primary-900/20 dark:to-accent-900/20">
            <div class="flex items-center gap-3">
                <div class="p-2.5 rounded-xl bg-primary-100/50 dark:bg-primary-800/30
                            text-primary-600 dark:text-primary-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-primary-800 dark:text-primary-100">
                        Tambah Course
                    </h1>
                    <p class="text-sm text-secondary-500 dark:text-secondary-400">
                        Buat course baru untuk siswa belajar
                    </p>
                </div>
            </div>
        </div>

        {{-- Body --}}
        <div class="p-6">

            {{-- GLOBAL VALIDATION ERROR --}}
            @if ($errors->any())
                <div class="mb-6 p-4 rounded-xl
                            bg-red-50/80 dark:bg-red-900/20
                            border border-red-200/50 dark:border-red-800/30
                            backdrop-blur-sm">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <p class="font-medium text-red-700 dark:text-red-300">Terjadi kesalahan:</p>
                            <ul class="list-disc pl-5 mt-1 space-y-0.5 text-sm text-red-600 dark:text-red-400">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <form action="{{ route('course.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                {{-- Nama Course --}}
                <div class="space-y-1.5">
                    <label class="flex items-center gap-2 text-sm font-semibold text-primary-800 dark:text-primary-200">
                        Nama Course
                        <span class="text-red-500">*</span>
                        <span class="text-[10px] font-normal text-secondary-400 dark:text-secondary-500">(required)</span>
                    </label>
                    <div class="relative">
                        <div class="absolute left-3 top-1/2 -translate-y-1/2 text-secondary-400 dark:text-secondary-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <input type="text"
                               name="name"
                               value="{{ old('name') }}"
                               required
                               placeholder="Masukkan nama course..."
                               class="w-full pl-10 pr-4 py-2.5 rounded-xl
                                      bg-white/90 dark:bg-primary-900/50
                                      border border-primary-200/30 dark:border-primary-700/30
                                      text-primary-800 dark:text-primary-200
                                      placeholder:text-secondary-400 dark:placeholder:text-secondary-500
                                      focus:ring-2 focus:ring-primary-500/40 focus:border-primary-500
                                      transition-all duration-200 outline-none">
                    </div>
                    @error('name')
                        <p class="text-sm text-red-500 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Slug --}}
                <div class="space-y-1.5">
                    <label class="flex items-center gap-2 text-sm font-semibold text-primary-800 dark:text-primary-200">
                        Slug
                        <span class="text-red-500">*</span>
                        <span class="text-[10px] font-normal text-secondary-400 dark:text-secondary-500">(URL friendly)</span>
                    </label>
                    <div class="relative">
                        <div class="absolute left-3 top-1/2 -translate-y-1/2 text-secondary-400 dark:text-secondary-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                            </svg>
                        </div>
                        <input type="text"
                               name="slug"
                               value="{{ old('slug') }}"
                               required
                               placeholder="contoh: course-matematika-dasar"
                               class="w-full pl-10 pr-4 py-2.5 rounded-xl
                                      bg-white/90 dark:bg-primary-900/50
                                      border border-primary-200/30 dark:border-primary-700/30
                                      text-primary-800 dark:text-primary-200
                                      placeholder:text-secondary-400 dark:placeholder:text-secondary-500
                                      focus:ring-2 focus:ring-primary-500/40 focus:border-primary-500
                                      transition-all duration-200 outline-none">
                    </div>
                    <p class="text-xs text-secondary-400 dark:text-secondary-500">
                        Slug akan digunakan sebagai URL course. Gunakan huruf kecil dan tanda hubung (-).
                    </p>
                    @error('slug')
                        <p class="text-sm text-red-500 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Deskripsi --}}
                <div class="space-y-1.5">
                    <label class="flex items-center gap-2 text-sm font-semibold text-primary-800 dark:text-primary-200">
                        Deskripsi
                        <span class="text-red-500">*</span>
                        <span class="text-[10px] font-normal text-secondary-400 dark:text-secondary-500">(required)</span>
                    </label>
                    <div class="relative">
                        <textarea name="description"
                                  rows="5"
                                  required
                                  placeholder="Tuliskan deskripsi course..."
                                  class="w-full px-4 py-2.5 rounded-xl
                                         bg-white/90 dark:bg-primary-900/50
                                         border border-primary-200/30 dark:border-primary-700/30
                                         text-primary-800 dark:text-primary-200
                                         placeholder:text-secondary-400 dark:placeholder:text-secondary-500
                                         focus:ring-2 focus:ring-primary-500/40 focus:border-primary-500
                                         transition-all duration-200 outline-none
                                         resize-y">{{ old('description') }}</textarea>
                    </div>
                    <p class="text-xs text-secondary-400 dark:text-secondary-500">
                        Jelaskan secara singkat tentang course ini.
                    </p>
                    @error('description')
                        <p class="text-sm text-red-500 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- FREE COURSE --}}
                <div class="p-4 rounded-xl
                            bg-primary-50/30 dark:bg-primary-900/20
                            border border-primary-200/30 dark:border-primary-700/30">
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <input type="checkbox"
                               name="is_free"
                               value="1"
                               {{ old('is_free') ? 'checked' : '' }}
                               class="w-4 h-4 rounded
                                      border-primary-300 dark:border-primary-600
                                      text-primary-600 dark:text-primary-400
                                      focus:ring-primary-500/40 focus:ring-2
                                      transition-all duration-200
                                      cursor-pointer">
                        <div>
                            <span class="font-medium text-primary-800 dark:text-primary-200 group-hover:text-primary-600 dark:group-hover:text-primary-300 transition-colors">
                                Course Gratis
                            </span>
                            <p class="text-xs text-secondary-500 dark:text-secondary-400">
                                Jika dicentang, semua user dapat mengakses course ini tanpa membeli.
                            </p>
                        </div>
                    </label>
                </div>

                {{-- Submit Button --}}
                <div class="pt-2">
                    <button type="submit"
                            class="w-full py-3 rounded-xl
                                   bg-gradient-to-r from-primary-500 to-accent-500
                                   hover:from-primary-600 hover:to-accent-600
                                   text-white font-semibold text-sm
                                   shadow-sm shadow-primary-500/20 hover:shadow-md hover:shadow-primary-500/30
                                   transition-all duration-200
                                   flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                        </svg>
                        Simpan Course
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
    // Auto generate slug from name
    document.querySelector('input[name="name"]').addEventListener('input', function() {
        const slugInput = document.querySelector('input[name="slug"]');
        // Only auto-fill if slug is empty or was auto-generated
        if (!slugInput.dataset.manuallyEdited) {
            const slug = this.value
                .toLowerCase()
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/^-+|-+$/g, '');
            slugInput.value = slug;
        }
    });

    // Mark slug as manually edited when user types in it
    document.querySelector('input[name="slug"]').addEventListener('input', function() {
        this.dataset.manuallyEdited = 'true';
    });
</script>
@endpush
