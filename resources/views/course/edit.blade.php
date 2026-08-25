@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-6">

    {{-- ================= BACK BUTTON ================= --}}
    <a href="{{ route('course.index') }}"
       class="inline-flex items-center gap-2
              text-sm font-medium
              text-primary-600 dark:text-primary-400
              hover:text-primary-800 dark:hover:text-primary-300
              transition-all duration-200
              group mb-6">
        <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform duration-200"
             fill="none" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
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
                    bg-gradient-to-r from-primary-50/50 to-accent-50/50
                    dark:from-primary-900/30 dark:to-accent-900/30">
            <div class="flex items-center gap-3">
                <div class="p-2.5 rounded-xl bg-primary-100/50 dark:bg-primary-800/50">
                    <svg class="w-6 h-6 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-primary-800 dark:text-primary-100">
                        Edit Course
                    </h1>
                    <p class="text-sm text-secondary-500 dark:text-secondary-400">
                        Perbarui informasi course "{{ $course->name }}"
                    </p>
                </div>
            </div>
        </div>

        {{-- Form --}}
        <form action="{{ route('course.update', $course->slug) }}" method="POST" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            {{-- ===== GLOBAL VALIDATION ERROR ===== --}}
            @if ($errors->any())
            <div class="p-4 rounded-xl bg-red-50/80 dark:bg-red-900/20
                        border border-red-200/50 dark:border-red-800/30
                        flex items-start gap-3">
                <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div>
                    <p class="text-sm font-medium text-red-700 dark:text-red-400">Mohon periksa kembali data berikut:</p>
                    <ul class="list-disc pl-5 mt-1 space-y-0.5 text-sm text-red-600 dark:text-red-400">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif

            {{-- ===== NAMA COURSE ===== --}}
            <div class="space-y-1.5">
                <label class="block text-sm font-semibold text-primary-700 dark:text-primary-300">
                    Nama Course <span class="text-red-500">*</span>
                </label>
                <input type="text"
                       name="name"
                       value="{{ old('name', $course->name) }}"
                       required
                       placeholder="Masukkan nama course..."
                       class="w-full px-4 py-2.5 rounded-xl
                              bg-white/80 dark:bg-primary-900/50
                              border border-primary-200/30 dark:border-primary-700/30
                              text-primary-800 dark:text-primary-200
                              placeholder:text-secondary-400 dark:placeholder:text-secondary-500
                              focus:ring-2 focus:ring-primary-500/40 focus:border-primary-500
                              transition-all duration-200 outline-none">
                @error('name')
                    <p class="text-sm text-red-500 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- ===== SLUG ===== --}}
            <div class="space-y-1.5">
                <label class="block text-sm font-semibold text-primary-700 dark:text-primary-300">
                    Slug <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <div class="absolute left-4 top-1/2 -translate-y-1/2 text-secondary-400 dark:text-secondary-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                        </svg>
                    </div>
                    <input type="text"
                           name="slug"
                           value="{{ old('slug', $course->slug) }}"
                           required
                           placeholder="contoh: matematika-dasar"
                           class="w-full pl-11 pr-4 py-2.5 rounded-xl
                                  bg-white/80 dark:bg-primary-900/50
                                  border border-primary-200/30 dark:border-primary-700/30
                                  text-primary-800 dark:text-primary-200
                                  placeholder:text-secondary-400 dark:placeholder:text-secondary-500
                                  focus:ring-2 focus:ring-primary-500/40 focus:border-primary-500
                                  transition-all duration-200 outline-none">
                </div>
                <p class="text-xs text-secondary-500 dark:text-secondary-400 flex items-center gap-1 mt-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Slug adalah URL unik untuk course ini. Akan otomatis terisi dari nama course.
                </p>
                @error('slug')
                    <p class="text-sm text-red-500 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- ===== DESKRIPSI ===== --}}
            <div class="space-y-1.5">
                <label class="block text-sm font-semibold text-primary-700 dark:text-primary-300">
                    Deskripsi <span class="text-red-500">*</span>
                </label>
                <textarea name="description"
                          rows="5"
                          required
                          placeholder="Masukkan deskripsi course..."
                          class="w-full px-4 py-2.5 rounded-xl
                                 bg-white/80 dark:bg-primary-900/50
                                 border border-primary-200/30 dark:border-primary-700/30
                                 text-primary-800 dark:text-primary-200
                                 placeholder:text-secondary-400 dark:placeholder:text-secondary-500
                                 focus:ring-2 focus:ring-primary-500/40 focus:border-primary-500
                                 transition-all duration-200 outline-none resize-y">{{ old('description', $course->description) }}</textarea>
                @error('description')
                    <p class="text-sm text-red-500 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- ===== FREE COURSE ===== --}}
            <div class="p-4 rounded-xl bg-primary-50/30 dark:bg-primary-800/20
                        border border-primary-200/30 dark:border-primary-700/30">
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="checkbox"
                           name="is_free"
                           value="1"
                           {{ old('is_free', $course->is_free) ? 'checked' : '' }}
                           class="w-4 h-4 rounded
                                  border-primary-300 dark:border-primary-600
                                  text-primary-600 dark:text-primary-400
                                  focus:ring-2 focus:ring-primary-500/40
                                  transition-all duration-200">
                    <span class="font-semibold text-sm text-primary-700 dark:text-primary-300">
                        Course Gratis
                    </span>
                </label>
                <p class="text-xs text-secondary-500 dark:text-secondary-400 mt-1.5 flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Jika dicentang, semua user dapat mengakses course ini tanpa membeli.
                </p>
            </div>

            {{-- ===== SUBMIT ===== --}}
            <div class="pt-4 flex flex-col sm:flex-row items-center gap-3">
                <button type="submit"
                        class="w-full sm:w-auto px-8 py-3 rounded-xl
                               bg-gradient-to-r from-primary-500 to-accent-500
                               hover:from-primary-600 hover:to-accent-600
                               text-white font-medium
                               shadow-sm shadow-primary-500/20 hover:shadow-md hover:shadow-primary-500/30
                               transition-all duration-200
                               flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                    Update Course
                </button>

                <a href="{{ route('course.index') }}"
                   class="w-full sm:w-auto px-6 py-3 rounded-xl text-center
                          text-secondary-600 dark:text-secondary-400
                          hover:bg-primary-50/50 dark:hover:bg-primary-800/30
                          transition-all duration-200
                          text-sm font-medium">
                    Batal
                </a>
            </div>

        </form>
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
            let slug = this.value
                .toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .replace(/^-+|-+$/g, '');

            if (slug.length > 0) {
                slugInput.value = slug;
            }
        });
    }
});
</script>
@endpush
