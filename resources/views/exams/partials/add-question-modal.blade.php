<div
    x-show="openAddQuestion"
    x-cloak
    class="absolute inset-0 z-50 flex items-center justify-center
           bg-black/40 backdrop-blur-sm">

    <div
        x-data="examQuestionPicker({
            examCode: '{{ $exam->exam_code }}',
            usedIds: @js($usedQuestionIds ?? []),
            categories: @js($categories)
        })"
        x-init="init()"
        @click.outside="openAddQuestion = false"
        class="bg-azwara-lightest dark:bg-secondary
               w-full max-w-6xl
               max-h-[90vh]
               rounded-2xl shadow-xl
               flex flex-col overflow-hidden">

        {{-- HEADER --}}
        <div class="px-6 py-4 border-b dark:border-white/10 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">
                Tambah Soal Ujian
            </h3>
            <button @click="openAddQuestion = false" class="text-xl dark:text-white">&times;</button>
        </div>

        <div class="px-6 py-2 text-sm bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300">
            Soal yang ditampilkan sudah disesuaikan dengan tipe ujian:
            <strong class="uppercase">{{ $exam->test_type }}</strong>
        </div>

        {{-- FILTER (hanya kategori dan materi) --}}
        <div class="px-6 py-4 border-b dark:border-white/10
                    grid grid-cols-1 md:grid-cols-2 gap-4">

            {{-- CATEGORY --}}
            <div
                x-data="{ open:false }"
                class="relative">

                <button
                    @click="open=!open"
                    class="w-full text-left px-3 py-2 text-sm rounded-lg
                        border bg-white text-gray-800
                        dark:bg-slate-800 dark:text-gray-100
                        dark:border-white/10">

                    <span x-text="
                        categoryId
                        ? categories.find(c => c.id == categoryId)?.name
                        : 'Pilih Kategori'
                    "></span>
                </button>

                <div x-show="open" @click.outside="open=false"
                    class="absolute z-50 mt-1 w-full max-h-48 overflow-y-auto
                        bg-white dark:bg-slate-800
                        border dark:border-white/10 rounded-lg">

                    <template x-for="c in categories" :key="c.id">
                        <div
                            @click="
                                categoryId = c.id;
                                open = false;
                                onCategoryChange();
                            "
                            class="px-3 py-2 text-sm cursor-pointer
                                text-gray-800 dark:text-gray-100
                                hover:bg-gray-100 dark:hover:bg-white/10"
                            x-text="c.name">
                        </div>
                    </template>
                </div>
            </div>

            {{-- MATERIAL --}}
            <div x-data="{ open:false }" class="relative">

                <button
                    :disabled="!materials.length"
                    @click="if(materials.length) open=!open"
                    class="w-full text-left px-3 py-2 text-sm rounded-lg
                        border bg-white text-gray-800
                        disabled:opacity-50
                        dark:bg-slate-800 dark:text-gray-100
                        dark:border-white/10">

                    <span x-text="
                        materialId
                        ? materials.find(m => m.id == materialId)?.name
                        : 'Pilih Materi'
                    "></span>
                </button>

                <div x-show="open" @click.outside="open=false"
                    class="absolute z-50 mt-1 w-full max-h-48 overflow-y-auto
                        bg-white dark:bg-slate-800
                        border dark:border-white/10 rounded-lg">

                    <template x-for="m in materials" :key="m.id">
                        <div
                            @click="
                                materialId = m.id;
                                open = false;
                                onMaterialChange();
                            "
                            class="px-3 py-2 text-sm cursor-pointer
                                text-gray-800 dark:text-gray-100
                                hover:bg-gray-100 dark:hover:bg-white/10"
                            x-text="m.name">
                        </div>
                    </template>
                </div>
            </div>
        </div>

        {{-- LIST --}}
        <div class="flex-1 overflow-y-auto p-6 space-y-4">
            <template x-if="!materialId && !categoryId">
                <p class="text-center text-gray-500 dark:text-white">
                    Pilih kategori & materi terlebih dahulu
                </p>
            </template>

            <template x-if="categoryId && !materialId">
                <p class="text-center text-gray-500 dark:text-white">
                    Pilih materi dari kategori yang dipilih
                </p>
            </template>

            <template x-if="materialId && questions.length > 0">
                <div
                    class="flex items-center justify-between
                        p-3 rounded-lg
                        bg-gray-50 dark:bg-white/5
                        border dark:border-white/10">

                    <span class="text-sm text-gray-600 dark:text-gray-300">
                        {{ __('Aksi Materi') }}
                    </span>

                    <div class="flex gap-2">
                        <button
                            @click="selectAllFromMaterial()"
                            :disabled="questions.every(q => q.is_selected)"
                            class="px-3 py-1.5 text-sm rounded
                                bg-primary/10 text-primary
                                disabled:opacity-50">
                            Pilih Semua
                        </button>

                        <button
                            @click="unselectAllFromMaterial()"
                            class="px-3 py-1.5 text-sm rounded
                                bg-gray-200 dark:bg-white/10
                                hover:bg-gray-300 dark:hover:bg-white/20">
                            Batal Pilih
                        </button>
                    </div>
                </div>
            </template>
            <template x-for="q in questions" :key="q.id">
                <label
                    class="block p-4 rounded-xl border
                           hover:bg-gray-50 dark:text-white dark:hover:bg-white/5
                           cursor-pointer">
                    <div class="flex gap-3">
                        <input type="checkbox"
                               :checked="q.is_selected"
                               @change="toggleQuestion(q.id)">

                        <div class="flex-1">
                            <div class="flex justify-between mb-2">
                                <span class="font-semibold">Soal #<span x-text="q.id"></span></span>
                                <div class="flex items-center gap-2">
                                    <span class="text-xs px-2 py-1 rounded bg-primary/10 text-primary font-semibold">
                                        <span x-text="q.type"></span>
                                        <template x-if="q.type === 'compound' && q.sub_items_count">
                                            <span class="ml-1">(<span x-text="q.sub_items_count"></span> sub)</span>
                                        </template>
                                    </span>

                                    <span class="text-xs px-2 py-1 rounded
                                            bg-gray-100 dark:bg-white/10
                                            text-gray-600 dark:text-gray-300"
                                        title="Jumlah ujian yang menggunakan soal ini">
                                        Dipakai <span x-text="q.exam_questions_count"></span>x
                                    </span>
                                </div>
                            </div>

                            <template x-if="q.image_url">
                                <img :src="q.image_url"
                                     class="max-h-48 mx-auto mb-3 rounded">
                            </template>

                            <div class="prose dark:prose-invert max-w-none"
                                 x-html="q.question_text"></div>
                        </div>
                    </div>
                </label>
            </template>

            <template x-if="questions.length === 0 && materialId">
                <p class="text-center text-gray-500 dark:text-white">
                    Tidak ada soal tersedia untuk materi ini
                </p>
            </template>
        </div>

        {{-- PAGINATION --}}
        <div class="px-6 py-4 border-t dark:border-white/10
                    flex justify-between items-center"
            x-show="pagination.last_page > 1 && questions.length > 0">
            <button
                @click="fetchQuestions(pagination.current_page - 1)"
                :disabled="pagination.current_page === 1"
                class="px-3 py-1 rounded bg-gray-200 dark:bg-white/10
                       disabled:opacity-50">
                Prev
            </button>

            <span class="text-sm text-gray-600 dark:text-gray-300">
                Halaman <span x-text="pagination.current_page"></span>
                dari <span x-text="pagination.last_page"></span>
            </span>

            <button
                @click="fetchQuestions(pagination.current_page + 1)"
                :disabled="pagination.current_page === pagination.last_page"
                class="px-3 py-1 rounded bg-gray-200 dark:bg-white/10
                       disabled:opacity-50">
                Next
            </button>
        </div>

        {{-- FOOTER --}}
        <div class="px-6 py-4 border-t dark:border-white/10 flex justify-end gap-3">
            <button @click="openAddQuestion = false"
                    class="px-4 py-2 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-white/10">
                Batal
            </button>

            <button @click="save()"
                    :disabled="selected.length === 0"
                    class="px-5 py-2 rounded-lg bg-primary text-white
                           disabled:opacity-50 hover:bg-primary/90">
                Tambahkan <span x-text="selected.length"></span> Soal
            </button>
        </div>
    </div>
</div>
