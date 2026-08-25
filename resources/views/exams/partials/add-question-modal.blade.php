{{-- exams/partials/add-question-modal.blade.php --}}
<div
    x-show="openAddQuestion"
    x-cloak
    class="fixed inset-0 z-50 flex items-center justify-center px-4">

    {{-- Backdrop --}}
    <div
        @click="openAddQuestion = false"
        class="absolute inset-0 bg-black/50 backdrop-blur-sm"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0">
    </div>

    {{-- Modal --}}
    <div
        x-data="examQuestionPicker({
            examCode: '{{ $exam->exam_code }}',
            usedIds: @js($usedQuestionIds ?? []),
            categories: @js($categories)
        })"
        x-init="init()"
        @click.outside="openAddQuestion = false"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="relative w-full max-w-6xl
               max-h-[90vh]
               bg-white dark:bg-neutral-900
               rounded-2xl shadow-2xl
               flex flex-col overflow-hidden">

        {{-- HEADER --}}
        <div class="px-6 py-4 border-b border-neutral-200 dark:border-neutral-700 flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold text-neutral-900 dark:text-white">
                    Tambah Soal Ujian
                </h3>
                <p class="text-sm text-neutral-500 dark:text-neutral-400">
                    Pilih soal dari bank soal untuk ditambahkan
                </p>
            </div>
            <button @click="openAddQuestion = false"
                    class="p-2 rounded-lg hover:bg-neutral-100 dark:hover:bg-neutral-800 transition-colors">
                <svg class="w-5 h-5 text-neutral-400 dark:text-neutral-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- INFO BANNER --}}
        <div class="px-6 py-2.5 bg-blue-50 dark:bg-blue-900/20 border-b border-blue-100 dark:border-blue-800/30">
            <p class="text-sm text-blue-700 dark:text-blue-300">
                <svg class="w-4 h-4 inline mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Soal yang ditampilkan sudah disesuaikan dengan tipe ujian:
                <strong class="uppercase">{{ $exam->test_type }}</strong>
            </p>
        </div>

        {{-- FILTER --}}
        <div class="px-6 py-4 border-b border-neutral-200 dark:border-neutral-700
                    grid grid-cols-1 md:grid-cols-2 gap-4 bg-neutral-50 dark:bg-neutral-800/50">

            {{-- CATEGORY --}}
            <div x-data="{ open:false }" class="relative">
                <label class="block text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider mb-1.5">
                    Kategori
                </label>
                <button
                    @click="open=!open"
                    class="w-full text-left px-4 py-2.5 text-sm rounded-xl
                        border border-neutral-200 dark:border-neutral-700
                        bg-white dark:bg-neutral-900
                        text-neutral-900 dark:text-white
                        hover:border-neutral-300 dark:hover:border-neutral-600
                        transition-colors duration-200
                        flex items-center justify-between">
                    <span x-text="categoryId ? categories.find(c => c.id == categoryId)?.name : 'Pilih Kategori'"
                          :class="{ 'text-neutral-400 dark:text-neutral-500': !categoryId }"></span>
                    <svg class="w-4 h-4 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <div x-show="open" @click.outside="open=false"
                    x-transition
                    class="absolute z-50 mt-1 w-full max-h-48 overflow-y-auto
                        bg-white dark:bg-neutral-900
                        border border-neutral-200 dark:border-neutral-700
                        rounded-xl shadow-lg">
                    <template x-for="c in categories" :key="c.id">
                        <div
                            @click="categoryId = c.id; open = false; onCategoryChange();"
                            class="px-4 py-2.5 text-sm cursor-pointer
                                text-neutral-700 dark:text-neutral-300
                                hover:bg-neutral-50 dark:hover:bg-neutral-800
                                transition-colors duration-150"
                            x-text="c.name">
                        </div>
                    </template>
                </div>
            </div>

            {{-- MATERIAL --}}
            <div x-data="{ open:false }" class="relative">
                <label class="block text-xs font-medium text-neutral-500 dark:text-neutral-400 uppercase tracking-wider mb-1.5">
                    Materi
                </label>
                <button
                    :disabled="!materials.length"
                    @click="if(materials.length) open=!open"
                    class="w-full text-left px-4 py-2.5 text-sm rounded-xl
                        border border-neutral-200 dark:border-neutral-700
                        bg-white dark:bg-neutral-900
                        text-neutral-900 dark:text-white
                        disabled:opacity-50 disabled:cursor-not-allowed
                        hover:border-neutral-300 dark:hover:border-neutral-600
                        transition-colors duration-200
                        flex items-center justify-between">
                    <span x-text="materialId ? materials.find(m => m.id == materialId)?.name : 'Pilih Materi'"
                          :class="{ 'text-neutral-400 dark:text-neutral-500': !materialId }"></span>
                    <svg class="w-4 h-4 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <div x-show="open" @click.outside="open=false"
                    x-transition
                    class="absolute z-50 mt-1 w-full max-h-48 overflow-y-auto
                        bg-white dark:bg-neutral-900
                        border border-neutral-200 dark:border-neutral-700
                        rounded-xl shadow-lg">
                    <template x-for="m in materials" :key="m.id">
                        <div
                            @click="materialId = m.id; open = false; onMaterialChange();"
                            class="px-4 py-2.5 text-sm cursor-pointer
                                text-neutral-700 dark:text-neutral-300
                                hover:bg-neutral-50 dark:hover:bg-neutral-800
                                transition-colors duration-150"
                            x-text="m.name">
                        </div>
                    </template>
                </div>
            </div>
        </div>

        {{-- LIST --}}
        <div class="flex-1 overflow-y-auto p-6 space-y-4">
            <template x-if="!materialId && !categoryId">
                <div class="text-center py-12">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-neutral-100 dark:bg-neutral-800 flex items-center justify-center">
                        <svg class="w-8 h-8 text-neutral-400 dark:text-neutral-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                        </svg>
                    </div>
                    <p class="text-neutral-600 dark:text-neutral-400">
                        Pilih kategori & materi terlebih dahulu
                    </p>
                </div>
            </template>

            <template x-if="categoryId && !materialId">
                <div class="text-center py-12">
                    <p class="text-neutral-600 dark:text-neutral-400">
                        Pilih materi dari kategori yang dipilih
                    </p>
                </div>
            </template>

            <template x-if="materialId && questions.length > 0">
                <div class="flex items-center justify-between p-3 rounded-xl
                            bg-neutral-50 dark:bg-neutral-800/50
                            border border-neutral-200 dark:border-neutral-700">
                    <span class="text-sm text-neutral-600 dark:text-neutral-400">
                        <span x-text="questions.length"></span> soal tersedia
                    </span>

                    <div class="flex gap-2">
                        <button
                            @click="selectAllFromMaterial()"
                            :disabled="questions.every(q => q.is_selected)"
                            class="px-3 py-1.5 text-sm rounded-lg
                                bg-primary/10 text-primary
                                hover:bg-primary/20
                                disabled:opacity-50 disabled:cursor-not-allowed
                                transition-colors duration-200">
                            Pilih Semua
                        </button>
                        <button
                            @click="unselectAllFromMaterial()"
                            class="px-3 py-1.5 text-sm rounded-lg
                                bg-neutral-200 dark:bg-neutral-700
                                text-neutral-700 dark:text-neutral-300
                                hover:bg-neutral-300 dark:hover:bg-neutral-600
                                transition-colors duration-200">
                            Batal Pilih
                        </button>
                    </div>
                </div>
            </template>

            <template x-for="q in questions" :key="q.id">
                <label class="block p-4 rounded-xl border
                            hover:bg-neutral-50 dark:hover:bg-neutral-800/50
                            cursor-pointer transition-colors duration-150
                            border-neutral-200 dark:border-neutral-700">
                    <div class="flex gap-3">
                        <div class="pt-0.5">
                            <input type="checkbox"
                                   :checked="q.is_selected"
                                   @change="toggleQuestion(q.id)"
                                   class="w-4 h-4 rounded border-neutral-300 dark:border-neutral-600 text-primary focus:ring-2 focus:ring-primary/20">
                        </div>

                        <div class="flex-1 min-w-0">
                            <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                                <span class="text-sm font-medium text-neutral-900 dark:text-white">
                                    Soal #<span x-text="q.id"></span>
                                </span>
                                <div class="flex items-center gap-2 flex-wrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        bg-primary/10 text-primary dark:bg-primary/20 dark:text-primary-300">
                                        <span x-text="q.type"></span>
                                        <template x-if="q.type === 'compound' && q.sub_items_count">
                                            <span class="ml-1">(<span x-text="q.sub_items_count"></span> sub)</span>
                                        </template>
                                    </span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs
                                        bg-neutral-100 dark:bg-neutral-800
                                        text-neutral-500 dark:text-neutral-400"
                                        title="Jumlah ujian yang menggunakan soal ini">
                                        Dipakai <span x-text="q.exam_questions_count"></span>x
                                    </span>
                                </div>
                            </div>

                            <template x-if="q.image_url">
                                <img :src="q.image_url"
                                     class="max-h-48 mx-auto mb-3 rounded-lg border border-neutral-200 dark:border-neutral-700">
                            </template>

                            <div class="prose prose-sm dark:prose-invert max-w-none"
                                 x-html="q.question_text"></div>
                        </div>
                    </div>
                </label>
            </template>

            <template x-if="questions.length === 0 && materialId">
                <div class="text-center py-12">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-neutral-100 dark:bg-neutral-800 flex items-center justify-center">
                        <svg class="w-8 h-8 text-neutral-400 dark:text-neutral-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <p class="text-neutral-600 dark:text-neutral-400">
                        Tidak ada soal tersedia untuk materi ini
                    </p>
                </div>
            </template>
        </div>

        {{-- PAGINATION --}}
        <div class="px-6 py-4 border-t border-neutral-200 dark:border-neutral-700
                    flex justify-between items-center bg-neutral-50 dark:bg-neutral-800/50"
            x-show="pagination.last_page > 1 && questions.length > 0">
            <button
                @click="fetchQuestions(pagination.current_page - 1)"
                :disabled="pagination.current_page === 1"
                class="px-4 py-2 rounded-xl text-sm font-medium
                    bg-white dark:bg-neutral-900
                    border border-neutral-200 dark:border-neutral-700
                    text-neutral-700 dark:text-neutral-300
                    disabled:opacity-50 disabled:cursor-not-allowed
                    hover:bg-neutral-50 dark:hover:bg-neutral-800
                    transition-colors duration-200">
                Sebelumnya
            </button>

            <span class="text-sm text-neutral-600 dark:text-neutral-400">
                Halaman <span class="font-medium text-neutral-900 dark:text-white" x-text="pagination.current_page"></span>
                dari <span class="font-medium text-neutral-900 dark:text-white" x-text="pagination.last_page"></span>
            </span>

            <button
                @click="fetchQuestions(pagination.current_page + 1)"
                :disabled="pagination.current_page === pagination.last_page"
                class="px-4 py-2 rounded-xl text-sm font-medium
                    bg-white dark:bg-neutral-900
                    border border-neutral-200 dark:border-neutral-700
                    text-neutral-700 dark:text-neutral-300
                    disabled:opacity-50 disabled:cursor-not-allowed
                    hover:bg-neutral-50 dark:hover:bg-neutral-800
                    transition-colors duration-200">
                Selanjutnya
            </button>
        </div>

        {{-- FOOTER --}}
        <div class="px-6 py-4 border-t border-neutral-200 dark:border-neutral-700
                    flex justify-end gap-3 bg-neutral-50 dark:bg-neutral-800/50">
            <button @click="openAddQuestion = false"
                    class="px-5 py-2.5 rounded-xl text-sm font-medium
                        text-neutral-600 dark:text-neutral-400
                        border border-neutral-200 dark:border-neutral-700
                        hover:bg-neutral-100 dark:hover:bg-neutral-800
                        transition-all duration-200">
                Batal
            </button>

            <button @click="save()"
                    :disabled="selected.length === 0"
                    class="px-6 py-2.5 rounded-xl text-sm font-medium
                        bg-primary text-white
                        hover:bg-primary-600
                        active:scale-[0.98]
                        disabled:opacity-50 disabled:cursor-not-allowed
                        transition-all duration-200
                        shadow-sm hover:shadow-md">
                Tambahkan <span x-text="selected.length"></span> Soal
            </button>
        </div>
    </div>
</div>
