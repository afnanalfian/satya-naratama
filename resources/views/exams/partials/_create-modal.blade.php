{{-- exams/partials/_create-modal.blade.php --}}
<div
    x-show="open"
    x-cloak
    @keydown.escape.window="open = false"
    class="fixed inset-0 z-50 flex items-center justify-center px-4">

    {{-- Backdrop --}}
    <div
        @click="open = false"
        class="absolute inset-0 bg-black/50 backdrop-blur-sm transition-opacity"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0">
    </div>

    {{-- Modal --}}
    <form
        method="POST"
        action="{{ route('exams.store') }}"
        x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="relative w-full max-w-md
               rounded-2xl
               bg-white dark:bg-neutral-900
               border border-neutral-200 dark:border-neutral-700
               shadow-2xl
               p-6">

        @csrf
        <input type="hidden" name="type" value="{{ $type }}">

        {{-- Header --}}
        <div class="mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-semibold text-neutral-900 dark:text-white">
                        Buat {{ ucfirst($type) }}
                    </h2>
                    <p class="mt-1 text-sm text-neutral-500 dark:text-neutral-400">
                        Lengkapi informasi ujian sebelum disimpan
                    </p>
                </div>
                <button
                    type="button"
                    @click="open = false"
                    class="p-2 rounded-lg hover:bg-neutral-100 dark:hover:bg-neutral-800 transition-colors">
                    <svg class="w-5 h-5 text-neutral-400 dark:text-neutral-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Form --}}
        <div class="space-y-5">

            {{-- Tipe Tes --}}
            <div>
                <label class="block mb-1.5 text-sm font-medium text-neutral-700 dark:text-neutral-300">
                    Tipe Tes
                </label>
                <select
                    name="test_type"
                    required
                    class="w-full rounded-xl
                        border border-neutral-200 dark:border-neutral-700
                        bg-white dark:bg-neutral-900
                        px-4 py-2.5 text-sm
                        text-neutral-900 dark:text-white
                        focus:ring-2 focus:ring-primary/20 focus:border-primary
                        transition-all duration-200
                        appearance-none">
                    <option value="" disabled selected class="text-neutral-400">Pilih tipe tes</option>
                    <option value="skd">SKD</option>
                    <option value="tpa">TPA</option>
                    <option value="tbi">TBI</option>
                    <option value="mtk_stis">MTK STIS</option>
                    <option value="mtk_tka">MTK TKA</option>
                    <option value="general">General</option>
                </select>
                <p class="mt-1.5 text-xs text-neutral-500 dark:text-neutral-400">
                    Tipe tes menentukan jenis soal yang boleh dimasukkan
                </p>
            </div>

            {{-- Judul --}}
            <div>
                <label class="block mb-1.5 text-sm font-medium text-neutral-700 dark:text-neutral-300">
                    Judul Ujian
                </label>
                <input
                    name="title"
                    required
                    class="w-full rounded-xl
                        border border-neutral-200 dark:border-neutral-700
                        bg-white dark:bg-neutral-900
                        px-4 py-2.5 text-sm
                        text-neutral-900 dark:text-white
                        placeholder:text-neutral-400 dark:placeholder:text-neutral-500
                        focus:ring-2 focus:ring-primary/20 focus:border-primary
                        transition-all duration-200"
                    placeholder="Masukkan judul ujian">
            </div>

            {{-- Tanggal --}}
            <div>
                <label class="block mb-1.5 text-sm font-medium text-neutral-700 dark:text-neutral-300">
                    Tanggal & Waktu
                </label>
                <input
                    type="datetime-local"
                    name="exam_date"
                    required
                    class="w-full rounded-xl
                        border border-neutral-200 dark:border-neutral-700
                        bg-white dark:bg-neutral-900
                        px-4 py-2.5 text-sm
                        text-neutral-900 dark:text-white
                        focus:ring-2 focus:ring-primary/20 focus:border-primary
                        transition-all duration-200">
            </div>

        </div>

        {{-- Actions --}}
        <div class="mt-8 flex justify-end gap-3">

            <button
                type="button"
                @click="open = false"
                class="px-5 py-2.5 rounded-xl
                    text-sm font-medium
                    text-neutral-600 dark:text-neutral-400
                    border border-neutral-200 dark:border-neutral-700
                    hover:bg-neutral-50 dark:hover:bg-neutral-800
                    transition-all duration-200">
                Batal
            </button>

            <button
                type="submit"
                class="px-6 py-2.5 rounded-xl
                    bg-primary text-white
                    text-sm font-medium
                    hover:bg-primary-600
                    active:scale-[0.98]
                    transition-all duration-200
                    shadow-sm hover:shadow-md">
                Simpan
            </button>
        </div>

    </form>
</div>
