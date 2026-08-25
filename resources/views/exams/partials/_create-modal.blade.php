<div
    x-show="open"
    x-cloak
    @keydown.escape.window="open = false"
    class="fixed inset-0 z-50 flex items-center justify-center px-4">

    {{-- Backdrop --}}
    <div
        @click="open = false"
        x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="absolute inset-0 bg-primary-950/60 backdrop-blur-sm">
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
               bg-white dark:bg-primary-950
               border border-neutral-200 dark:border-white/10
               shadow-2xl shadow-primary-950/20 dark:shadow-black/50
               overflow-hidden">

        @csrf
        <input type="hidden" name="type" value="{{ $type }}">

        {{-- Accent bar --}}
        <div class="h-1 w-full bg-brand-gradient"></div>

        <div class="p-6">

            {{-- Header --}}
            <div class="mb-6 flex items-start gap-3.5">
                <div class="flex-shrink-0 w-10 h-10 rounded-xl
                            bg-primary-50 dark:bg-primary-500/10
                            border border-primary-100 dark:border-primary-400/20
                            flex items-center justify-center
                            text-primary-600 dark:text-primary-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>

                <div>
                    <h2 class="text-lg font-bold tracking-tight text-primary-900 dark:text-primary-50">
                        Buat {{ ucfirst($type) }}
                    </h2>
                    <p class="text-sm text-neutral-700 dark:text-neutral-500 mt-0.5">
                        Lengkapi informasi ujian sebelum disimpan
                    </p>
                </div>
            </div>

            {{-- Form --}}
            <div class="space-y-5">

                {{-- Tipe Tes --}}
                <div>
                    <label class="block mb-1.5 text-xs font-semibold uppercase tracking-[0.08em]
                                text-neutral-700 dark:text-neutral-500">
                        Tipe Tes
                    </label>

                    <select
                        name="test_type"
                        required
                        class="w-full rounded-xl
                            border border-neutral-300 dark:border-white/10
                            bg-white dark:bg-white/5
                            px-3.5 py-2.5 text-sm
                            text-neutral-900 dark:text-neutral-100
                            shadow-sm
                            focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20
                            transition">

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

                    <p class="mt-1.5 text-xs text-neutral-700 dark:text-neutral-600">
                        Tipe tes menentukan jenis soal yang boleh dimasukkan
                    </p>
                </div>

                {{-- Judul --}}
                <div>
                    <label class="block mb-1.5 text-xs font-semibold uppercase tracking-[0.08em]
                                  text-neutral-700 dark:text-neutral-500">
                        Judul Ujian
                    </label>
                    <input
                        name="title"
                        required
                        placeholder="Contoh: Tryout SKD Nasional 1"
                        class="w-full rounded-xl
                               border border-neutral-300 dark:border-white/10
                               bg-white dark:bg-white/5
                               px-3.5 py-2.5 text-sm
                               text-neutral-900 dark:text-neutral-100
                               placeholder:text-neutral-600 dark:placeholder:text-neutral-600
                               shadow-sm
                               focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20
                               transition">
                </div>

                {{-- Tanggal --}}
                <div>
                    <label class="block mb-1.5 text-xs font-semibold uppercase tracking-[0.08em]
                                  text-neutral-700 dark:text-neutral-500">
                        Tanggal & Waktu
                    </label>
                    <input
                        type="datetime-local"
                        name="exam_date"
                        required
                        class="w-full rounded-xl
                               border border-neutral-300 dark:border-white/10
                               bg-white dark:bg-white/5
                               px-3.5 py-2.5 text-sm
                               text-neutral-900 dark:text-neutral-100
                               shadow-sm
                               focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20
                               transition">
                </div>

            </div>

            {{-- Actions --}}
            <div class="mt-7 pt-5 border-t border-neutral-200 dark:border-white/10 flex justify-end gap-2.5">

                <button
                    type="button"
                    @click="open = false"
                    class="px-4 py-2.5 rounded-xl
                           text-sm font-semibold
                           text-neutral-800 dark:text-neutral-300
                           border border-neutral-300 dark:border-white/15
                           bg-white dark:bg-white/5
                           hover:bg-neutral-50 dark:hover:bg-white/10
                           focus:outline-none focus:ring-2 focus:ring-neutral-400/30
                           transition">
                    Batal
                </button>

                <button
                    type="submit"
                    class="px-5 py-2.5 rounded-xl
                           bg-primary-600 text-white
                           text-sm font-semibold
                           shadow-sm hover:bg-primary-700 active:bg-primary-800
                           focus:outline-none focus:ring-2 focus:ring-primary-500/40
                           transition">
                    Simpan
                </button>
            </div>
        </div>

    </form>
</div>
