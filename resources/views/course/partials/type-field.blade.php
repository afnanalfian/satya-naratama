{{-- Jenis Course: akademik / jasmani --}}
@php $currentType = old('type', $course->type ?? 'akademik'); @endphp
<div>
    <label class="block text-sm font-medium text-primary-700 dark:text-primary-300 mb-1.5">
        Jenis Course <span class="text-accent-500">*</span>
    </label>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
        <label class="relative flex cursor-pointer rounded-xl border p-4 transition-all duration-200
                      has-[:checked]:border-blue-500 has-[:checked]:bg-blue-50/60 dark:has-[:checked]:bg-blue-900/20
                      border-primary-200 dark:border-primary-700/50 hover:bg-primary-50/40 dark:hover:bg-primary-800/20">
            <input type="radio" name="type" value="akademik" class="mt-0.5 h-4 w-4 text-blue-600 focus:ring-blue-500" {{ $currentType === 'akademik' ? 'checked' : '' }}>
            <span class="ml-3">
                <span class="block text-sm font-semibold text-primary-800 dark:text-primary-100">Akademik</span>
                <span class="block text-xs text-secondary-500 dark:text-secondary-400 mt-0.5">Absensi, materi, video, blind test &amp; post test</span>
            </span>
        </label>
        <label class="relative flex cursor-pointer rounded-xl border p-4 transition-all duration-200
                      has-[:checked]:border-orange-500 has-[:checked]:bg-orange-50/60 dark:has-[:checked]:bg-orange-900/20
                      border-primary-200 dark:border-primary-700/50 hover:bg-primary-50/40 dark:hover:bg-primary-800/20">
            <input type="radio" name="type" value="jasmani" class="mt-0.5 h-4 w-4 text-orange-600 focus:ring-orange-500" {{ $currentType === 'jasmani' ? 'checked' : '' }}>
            <span class="ml-3">
                <span class="block text-sm font-semibold text-primary-800 dark:text-primary-100">Jasmani</span>
                <span class="block text-xs text-secondary-500 dark:text-secondary-400 mt-0.5">Hanya absensi &amp; materi (tanpa video / tes)</span>
            </span>
        </label>
    </div>
</div>
