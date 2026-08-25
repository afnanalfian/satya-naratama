<div
    x-show="openAddQuestion"
    x-cloak
    class="absolute inset-0 z-50 flex items-center justify-center p-4
           bg-primary-950/60 backdrop-blur-sm">

    <div
        x-data="examQuestionPicker({
            examCode: '{{ $exam->exam_code }}',
            usedIds: @js($usedQuestionIds ?? []),
            categories: @js($categories)
        })"
        x-init="init()"
        @click.outside="openAddQuestion = false"
        class="bg-white dark:bg-primary-950
               w-full max-w-6xl
               max-h-[90vh]
               rounded-2xl
               border border-neutral-200 dark:border-white/10
               shadow-2xl shadow-primary-950/25 dark:shadow-black/60
               flex flex-col overflow-hidden">

        {{-- HEADER --}}
        <div class="px-6 py-4 border-b border-neutral-200 dark:border-white/10
                    flex justify-between items-center
                    bg-neutral-50 dark:bg-white/[0.03]">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl
                            bg-primary-50 dark:bg-primary-500/10
                            border border-primary-100 dark:border-primary-400/20
                            flex items-center justify-center
                            text-primary-600 dark:text-primary-300">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 5v14m-7-7h14"/>
                    </svg>
                </div>

                <div>
                    <h3 class="text-base font-bold tracking-tight text-primary-900 dark:text-primary-50">
                        Tambah Soal Ujian
                    </h3>
                    <p class="text-xs text-neutral-700 dark:text-neutral-600">
                        Pilih soal dari bank soal sesuai materi
                    </p>
                </div>
            </div>

            <button @click="openAddQuestion = false"
                    class="w-9 h-9 rounded-xl flex items-center justify-center
                           text-neutral-700 dark:text-neutral-400
                           hover:bg-neutral-200/60 dark:hover:bg-white/10
                           transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <div class="px-6 py-2.5 text-sm flex items-center gap-2
                    bg-primary-50/70 dark:bg-primary-500/10
                    text-primary-700 dark:text-primary-200
                    border-b border-primary-100 dark:border-primary-400/15">
            <svg class="w-4 h-4 flex-shrink-0 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span>
                Soal yang ditampilkan sudah disesuaikan dengan tipe ujian:
                <strong class="uppercase font-semibold tracking-wide">{{ $exam->test_type }}</strong>
            </span>
        </div>

        {{-- FILTER (hanya kategori dan materi) --}}
        <div class="px-6 py-4 border-b border-neutral-200 dark:border-white/10
                    grid grid-cols-1 md:grid-cols-2 gap-4">

            {{-- CATEGORY --}}
            <div
                x-data="{ open:false }"
                class="relative">

                <label class="block mb-1.5 text-[11px] font-semibold uppercase tracking-[0.1em]
                              text-neutral-700 dark:text-neutral-500">
                    Kategori
                </label>

                <button
                    @click="open=!open"
                    class="w-full flex items-center justify-between gap-2
                        px-3.5 py-2.5 text-sm rounded-xl
                        border border-neutral-300 dark:border-white/10
                        bg-white dark:bg-white/5
                        text-neutral-900 dark:text-neutral-100
                        shadow-sm hover:border-neutral-400 dark:hover:border-white/20
                        focus:outline-none focus:ring-2 focus:ring-primary-500/20
                        transition">

                    <span class="truncate" x-text="
                        categoryId
                        ? categories.find(c => c.id == categoryId)?.name
                        : 'Pilih Kategori'
                    "></span>

                    <svg class="w-4 h-4 flex-shrink-0 text-neutral-600 transition-transform"
                         :class="{ 'rotate-180': open }"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <div x-show="open" @click.outside="open=false" x-cloak
                    x-transition:enter="transition ease-out duration-150"
                    x-transition:enter-start="opacity-0 -translate-y-1"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    class="absolute z-50 mt-1.5 w-full max-h-48 overflow-y-auto p-1
                        bg-white dark:bg-primary-900
                        border border-neutral-200 dark:border-white/10
                        rounded-xl shadow-lg shadow-primary-950/10 dark:shadow-black/40">

                    <template x-for="c in categories" :key="c.id">
                        <div
                            @click="
                                categoryId = c.id;
                                open = false;
                                onCategoryChange();
                            "
                            class="px-3 py-2 text-sm cursor-pointer rounded-lg
                                text-neutral-800 dark:text-neutral-200
                                hover:bg-primary-50 dark:hover:bg-white/10
                                hover:text-primary-700 dark:hover:text-primary-200
                                transition-colors"
                            x-text="c.name">
                        </div>
                    </template>
                </div>
            </div>

            {{-- MATERIAL --}}
            <div x-data="{ open:false }" class="relative">

                <label class="block mb-1.5 text-[11px] font-semibold uppercase tracking-[0.1em]
                              text-neutral-700 dark:text-neutral-500">
                    Materi
                </label>

                <button
                    :disabled="!materials.length"
                    @click="if(materials.length) open=!open"
                    class="w-full flex items-center justify-between gap-2
                        px-3.5 py-2.5 text-sm rounded-xl
                        border border-neutral-300 dark:border-white/10
                        bg-white dark:bg-white/5
                        text-neutral-900 dark:text-neutral-100
                        shadow-sm hover:border-neutral-400 dark:hover:border-white/20
                        disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:border-neutral-300
                        focus:outline-none focus:ring-2 focus:ring-primary-500/20
                        transition">

                    <span class="truncate" x-text="
                        materialId
                        ? materials.find(m => m.id == materialId)?.name
                        : 'Pilih Materi'
                    "></span>

                    <svg class="w-4 h-4 flex-shrink-0 text-neutral-600 transition-transform"
                         :class="{ 'rotate-180': open }"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <div x-show="open" @click.outside="open=false" x-cloak
                    x-transition:enter="transition ease-out duration-150"
                    x-transition:enter-start="opacity-0 -translate-y-1"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    class="absolute z-50 mt-1.5 w-full max-h-48 overflow-y-auto p-1
                        bg-white dark:bg-primary-900
                        border border-neutral-200 dark:border-white/10
                        rounded-xl shadow-lg shadow-primary-950/10 dark:shadow-black/40">

                    <template x-for="m in materials" :key="m.id">
                        <div
                            @click="
                                materialId = m.id;
                                open = false;
                                onMaterialChange();
                            "
                            class="px-3 py-2 text-sm cursor-pointer rounded-lg
                                text-neutral-800 dark:text-neutral-200
                                hover:bg-primary-50 dark:hover:bg-white/10
                                hover:text-primary-700 dark:hover:text-primary-200
                                transition-colors"
                            x-text="m.name">
                        </div>
                    </template>
                </div>
            </div>
        </div>

        {{-- LIST --}}
        <div class="flex-1 overflow-y-auto p-6 space-y-4 bg-neutral-50/60 dark:bg-transparent">
            <template x-if="!materialId && !categoryId">
                <p class="text-center py-12 text-sm text-neutral-700 dark:text-neutral-500">
                    Pilih kategori &amp; materi terlebih dahulu
                </p>
            </template>

            <template x-if="categoryId && !materialId">
                <p class="text-center py-12 text-sm text-neutral-700 dark:text-neutral-500">
                    Pilih materi dari kategori yang dipilih
                </p>
            </template>

            <template x-if="materialId && questions.length > 0">
                <div
                    class="flex items-center justify-between
                        px-4 py-3 rounded-xl
                        bg-white dark:bg-white/5
                        border border-neutral-200 dark:border-white/10
                        shadow-sm">

                    <span class="text-sm font-medium text-neutral-800 dark:text-neutral-300">
                        {{ __('Aksi Materi') }}
                    </span>

                    <div class="flex gap-2">
                        <button
                            @click="selectAllFromMaterial()"
                            :disabled="questions.every(q => q.is_selected)"
                            class="px-3.5 py-1.5 text-xs font-semibold rounded-lg
                                bg-primary-50 dark:bg-primary-500/15
                                text-primary-700 dark:text-primary-200
                                border border-primary-100 dark:border-primary-400/20
                                hover:bg-primary-100 dark:hover:bg-primary-500/25
                                disabled:opacity-50 disabled:cursor-not-allowed
                                transition">
                            Pilih Semua
                        </button>

                        <button
                            @click="unselectAllFromMaterial()"
                            class="px-3.5 py-1.5 text-xs font-semibold rounded-lg
                                bg-neutral-100 dark:bg-white/10
                                text-neutral-800 dark:text-neutral-300
                                border border-neutral-200 dark:border-white/10
                                hover:bg-neutral-200 dark:hover:bg-white/20
                                transition">
                            Batal Pilih
                        </button>
                    </div>
                </div>
            </template>
            <template x-for="q in questions" :key="q.id">
                <label
                    class="block p-4 rounded-xl
                           bg-white dark:bg-white/[0.03]
                           border border-neutral-200 dark:border-white/10
                           text-neutral-900 dark:text-neutral-100
                           shadow-sm
                           hover:border-primary-300 dark:hover:border-primary-400/30
                           hover:shadow-md hover:shadow-primary-900/5
                           has-[input:checked]:border-primary-500
                           has-[input:checked]:bg-primary-50/50
                           dark:has-[input:checked]:bg-primary-500/10
                           has-[input:checked]:ring-1 has-[input:checked]:ring-primary-500/30
                           cursor-pointer transition-all duration-150">
                    <div class="flex gap-3.5">
                        <input type="checkbox"
                               :checked="q.is_selected"
                               @change="toggleQuestion(q.id)"
                               class="mt-0.5 w-4 h-4 rounded
                                      border-neutral-300 dark:border-white/20
                                      text-primary-600
                                      focus:ring-primary-500/30">

                        <div class="flex-1 min-w-0">
                            <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                                <span class="text-sm font-semibold text-neutral-900 dark:text-neutral-100">
                                    Soal #<span x-text="q.id"></span>
                                </span>
                                <div class="flex items-center gap-2">
                                    <span class="text-[11px] px-2 py-1 rounded-md font-semibold uppercase tracking-wide
                                                 bg-primary-50 dark:bg-primary-500/15
                                                 text-primary-700 dark:text-primary-200
                                                 ring-1 ring-inset ring-primary-600/15 dark:ring-primary-400/20">
                                        <span x-text="q.type"></span>
                                        <template x-if="q.type === 'compound' && q.sub_items_count">
                                            <span class="ml-1 normal-case">(<span x-text="q.sub_items_count"></span> sub)</span>
                                        </template>
                                    </span>

                                    <span class="text-[11px] px-2 py-1 rounded-md
                                            bg-neutral-100 dark:bg-white/10
                                            text-neutral-800 dark:text-neutral-400"
                                        title="Jumlah ujian yang menggunakan soal ini">
                                        Dipakai <span x-text="q.exam_questions_count"></span>x
                                    </span>
                                </div>
                            </div>

                            <template x-if="q.image_url">
                                <img :src="q.image_url"
                                     class="max-h-48 mx-auto mb-3 rounded-lg
                                            border border-neutral-200 dark:border-white/10">
                            </template>

                            <div class="prose prose-sm dark:prose-invert max-w-none"
                                 x-html="q.question_text"></div>
                        </div>
                    </div>
                </label>
            </template>

            <template x-if="questions.length === 0 && materialId">
                <p class="text-center py-12 text-sm text-neutral-700 dark:text-neutral-500">
                    Tidak ada soal tersedia untuk materi ini
                </p>
            </template>
        </div>

        {{-- PAGINATION --}}
        <div class="px-6 py-3 border-t border-neutral-200 dark:border-white/10
                    flex justify-between items-center
                    bg-white dark:bg-primary-950"
            x-show="pagination.last_page > 1 && questions.length > 0">
            <button
                @click="fetchQuestions(pagination.current_page - 1)"
                :disabled="pagination.current_page === 1"
                class="inline-flex items-center gap-1.5 px-3.5 py-1.5 text-sm font-medium rounded-lg
                       border border-neutral-300 dark:border-white/15
                       bg-white dark:bg-white/5
                       text-neutral-800 dark:text-neutral-300
                       hover:bg-neutral-50 dark:hover:bg-white/10
                       disabled:opacity-40 disabled:cursor-not-allowed
                       transition">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Prev
            </button>

            <span class="text-sm text-neutral-700 dark:text-neutral-500 tabular-nums">
                Halaman <span class="font-semibold text-neutral-900 dark:text-neutral-200" x-text="pagination.current_page"></span>
                dari <span x-text="pagination.last_page"></span>
            </span>

            <button
                @click="fetchQuestions(pagination.current_page + 1)"
                :disabled="pagination.current_page === pagination.last_page"
                class="inline-flex items-center gap-1.5 px-3.5 py-1.5 text-sm font-medium rounded-lg
                       border border-neutral-300 dark:border-white/15
                       bg-white dark:bg-white/5
                       text-neutral-800 dark:text-neutral-300
                       hover:bg-neutral-50 dark:hover:bg-white/10
                       disabled:opacity-40 disabled:cursor-not-allowed
                       transition">
                Next
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>
        </div>

        {{-- FOOTER --}}
        <div class="px-6 py-4 border-t border-neutral-200 dark:border-white/10
                    flex justify-end gap-3
                    bg-neutral-50 dark:bg-white/[0.03]">
            <button @click="openAddQuestion = false"
                    class="px-4 py-2.5 rounded-xl text-sm font-semibold
                           text-neutral-800 dark:text-neutral-300
                           border border-neutral-300 dark:border-white/15
                           bg-white dark:bg-white/5
                           hover:bg-neutral-100 dark:hover:bg-white/10
                           transition">
                Batal
            </button>

            <button @click="save()"
                    :disabled="selected.length === 0"
                    class="inline-flex items-center gap-2
                           px-5 py-2.5 rounded-xl bg-primary-600 text-white text-sm font-semibold
                           shadow-sm hover:bg-primary-700 active:bg-primary-800
                           disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:bg-primary-600
                           focus:outline-none focus:ring-2 focus:ring-primary-500/40
                           transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v14m-7-7h14"/>
                </svg>
                Tambahkan <span x-text="selected.length"></span> Soal
            </button>
        </div>
    </div>
</div>
