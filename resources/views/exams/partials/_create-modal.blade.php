<div
    x-show="open"
    x-cloak
    @keydown.escape.window="open = false"
    class="fixed inset-0 z-50 flex items-center justify-center px-4">

    {{-- Backdrop --}}
    <div
        @click="open = false"
        class="absolute inset-0 bg-black/40 backdrop-blur-sm">
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
               bg-azwara-lightest dark:bg-azwara-darker
               border border-gray-200 dark:border-azwara-darkest
               shadow-xl dark:shadow-black/50
               p-6">

        @csrf
        <input type="hidden" name="type" value="{{ $type }}">

        {{-- Header --}}
        <div class="mb-6">
            <h2 class="text-lg font-semibold
                       text-azwara-darkest dark:text-azwara-lighter">
                Buat {{ ucfirst($type) }}
            </h2>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Lengkapi informasi ujian sebelum disimpan
            </p>
        </div>

        {{-- Form --}}
        <div class="space-y-4">

            {{-- Tipe Tes --}}
            <div>
                <label class="block mb-1 text-sm font-medium
                            text-azwara-darkest dark:text-azwara-light">
                    Tipe Tes
                </label>

                <select
                    name="test_type"
                    required
                    class="w-full rounded-xl
                        border-gray-300 dark:border-gray-700
                        bg-white dark:bg-azwara-darkest
                        px-3 py-2 text-sm
                        text-azwara-darkest dark:text-azwara-lighter
                        focus:ring-primary focus:border-primary">

                    <option value="" disabled selected>
                        Pilih tipe tes
                    </option>

                    <option value="skd">SKD </option>
                    <option value="tpa">TPA</option>
                    <option value="tbi">TBI</option>
                    <option value="mtk_stis">MTK STIS</option>
                    <option value="mtk_tka">MTK TKA</option>
                    <option value="general">General</option>
                </select>

                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                    Tipe tes menentukan jenis soal yang boleh dimasukkan
                </p>
            </div>

            {{-- Judul --}}
            <div>
                <label class="block mb-1 text-sm font-medium
                              text-azwara-darkest dark:text-azwara-light">
                    Judul Ujian
                </label>
                <input
                    name="title"
                    required
                    class="w-full rounded-xl
                           border-gray-300 dark:border-gray-700
                           bg-white dark:bg-azwara-darkest
                           px-3 py-2 text-sm
                           text-azwara-darkest dark:text-azwara-lighter
                           focus:ring-primary focus:border-primary">
            </div>

            {{-- Tanggal --}}
            <div>
                <label class="block mb-1 text-sm font-medium
                              text-azwara-darkest dark:text-azwara-light">
                    Tanggal & Waktu
                </label>
                <input
                    type="datetime-local"
                    name="exam_date"
                    required
                    class="w-full rounded-xl
                           border-gray-300 dark:border-gray-700
                           bg-white dark:bg-azwara-darkest
                           px-3 py-2 text-sm
                           text-azwara-darkest dark:text-azwara-lighter
                           focus:ring-primary focus:border-primary">
            </div>

        </div>

        {{-- Actions --}}
        <div class="mt-6 flex justify-end gap-2">

            <button
                type="button"
                @click="open = false"
                class="px-4 py-2 rounded-xl
                       text-sm font-medium
                       text-gray-600 dark:text-gray-300
                       border border-gray-300 dark:border-gray-600
                       hover:bg-gray-100 dark:hover:bg-azwara-darkest
                       transition">
                Batal
            </button>

            <button
                type="submit"
                class="px-4 py-2 rounded-xl
                       bg-primary text-white
                       text-sm font-medium
                       hover:opacity-90
                       transition">
                Simpan
            </button>
        </div>

    </form>
</div>
