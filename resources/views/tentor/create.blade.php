@extends('layouts.app')

@section('content')
<div class="py-6 md:py-8">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Navigation --}}
        <nav class="flex items-center gap-2 text-sm mb-6">
            <a href="{{ route('tentor.index') }}" class="text-secondary-500 hover:text-primary-600 dark:text-secondary-400 dark:hover:text-primary-300 transition-colors">Tentor</a>
            <span class="text-secondary-300 dark:text-secondary-600">/</span>
            <span class="text-primary-600 dark:text-primary-300 font-medium">Tambah</span>
        </nav>

        {{-- Form Card --}}
        <div class="bg-white dark:bg-primary-900/30 rounded-2xl border border-primary-100 dark:border-primary-800/30 overflow-hidden shadow-sm">

            {{-- Header --}}
            <div class="px-6 py-5 border-b border-primary-100 dark:border-primary-800/30">
                <div class="flex items-center gap-3">
                    <div class="p-2.5 rounded-xl bg-primary-500/10 text-primary-600 dark:bg-primary-400/10 dark:text-primary-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-primary-800 dark:text-primary-100">Tambah Tentor</h2>
                        <p class="text-sm text-secondary-500 dark:text-secondary-400">Tambahkan tentor baru ke platform</p>
                    </div>
                </div>
            </div>

            {{-- Form --}}
            <form method="POST" action="{{ route('tentor.store') }}" class="p-6 space-y-6">
                @csrf

                {{-- User Selection --}}
                <div>
                    <label class="block text-sm font-medium text-primary-700 dark:text-primary-300 mb-1.5">
                        Pilih User <span class="text-accent-500">*</span>
                    </label>
                    <select name="user_id"
                        class="w-full px-4 py-3 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-primary-50/50 dark:bg-primary-800/20 text-primary-800 dark:text-primary-100 focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all duration-200 appearance-none">
                        <option value="">-- Pilih User --</option>
                        @foreach ($users as $u)
                            <option value="{{ $u->id }}">
                                {{ $u->name }}
                                <span class="text-secondary-400">({{ $u->email }})</span>
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Courses --}}
                <div>
                    <label class="block text-sm font-medium text-primary-700 dark:text-primary-300 mb-1.5">
                        Course yang Diajar
                    </label>
                    <select name="course_id[]" id="course-select" multiple
                        class="w-full px-4 py-3 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-primary-50/50 dark:bg-primary-800/20 text-primary-800 dark:text-primary-100 focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all duration-200">
                        @foreach ($courses as $c)
                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                        @endforeach
                    </select>
                    <p class="mt-1 text-xs text-secondary-400 dark:text-secondary-500">Pilih satu atau lebih course</p>
                </div>

                {{-- Bio --}}
                <div>
                    <label class="block text-sm font-medium text-primary-700 dark:text-primary-300 mb-1.5">
                        Bio Tentor
                    </label>
                    <textarea name="bio" rows="5"
                        class="w-full px-4 py-3 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-primary-50/50 dark:bg-primary-800/20 text-primary-800 dark:text-primary-100 placeholder-secondary-400 focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all duration-200">{{ trim(old('bio')) }}</textarea>
                    <p class="mt-1 text-xs text-secondary-400 dark:text-secondary-500">Deskripsi singkat tentang tentor</p>
                </div>

                {{-- Submit --}}
                <div class="border-t border-primary-100 dark:border-primary-800/30 pt-6 flex flex-col sm:flex-row gap-3">
                    <button type="submit"
                            class="flex-1 inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-primary-600 hover:bg-primary-700 text-white font-medium transition-all duration-200 hover:shadow-lg hover:shadow-primary-500/25 active:scale-[0.98]">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan
                    </button>
                    <a href="{{ route('tentor.index') }}"
                       class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl border border-primary-200 dark:border-primary-700/50 text-secondary-600 dark:text-secondary-400 hover:bg-primary-50 dark:hover:bg-primary-800/20 transition-all duration-200">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css">
<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>

<script>
    new TomSelect('#course-select', {
        plugins: ['remove_button'],
        placeholder: "Pilih course...",
        create: false,
    });
</script>
@endpush

@push('styles')
<style>
    .ts-control {
        background-color: #f9fafb !important;
        border-radius: 0.75rem !important;
        border-color: #D7CBBC !important;
        padding: 0.5rem 0.75rem !important;
        min-height: 48px !important;
        color: #0D1B0D !important;
        box-shadow: none !important;
    }
    .ts-control:focus {
        border-color: #418741 !important;
        box-shadow: 0 0 0 2px rgba(65, 135, 65, 0.25) !important;
    }
    .ts-dropdown {
        background-color: #ffffff !important;
        border-color: #D7CBBC !important;
        border-radius: 0.75rem !important;
    }
    .ts-dropdown .ts-option {
        padding: 8px 12px;
        border-radius: 6px;
        color: #0D1B0D !important;
    }
    .ts-dropdown .ts-option:hover {
        background-color: #ECF3EC !important;
    }
    .ts-dropdown .ts-option.active {
        background-color: #418741 !important;
        color: #ffffff !important;
    }
    .ts-control .item {
        background-color: #418741 !important;
        color: #ffffff !important;
        border-radius: 0.5rem !important;
        padding: 2px 8px !important;
        font-weight: 500 !important;
    }
    .ts-control .item .remove {
        color: #ffffff !important;
        margin-left: 4px;
        opacity: 0.7;
    }
    .ts-control .item .remove:hover {
        opacity: 1;
    }

    html.dark .ts-control {
        background-color: rgba(26, 54, 26, 0.3) !important;
        border-color: rgba(65, 135, 65, 0.4) !important;
        color: #F1F2F4 !important;
    }
    html.dark .ts-dropdown {
        background-color: #1A361A !important;
        border-color: rgba(65, 135, 65, 0.3) !important;
    }
    html.dark .ts-dropdown .ts-option {
        color: #F1F2F4 !important;
    }
    html.dark .ts-dropdown .ts-option:hover {
        background-color: rgba(65, 135, 65, 0.2) !important;
    }
    html.dark .ts-dropdown .ts-option.active {
        background-color: #418741 !important;
    }
    html.dark .ts-control input {
        color: #F1F2F4 !important;
    }
    html.dark .ts-control input::placeholder {
        color: #6F7276 !important;
    }
</style>
@endpush
@endsection
