export default function examQuestionPicker({
    examCode,
    usedIds = [],
    categories = []
}) {
    return {
        /* ================= STATE ================= */
        categoryId: '',
        materialId: '',

        categories,
        materials: [],
        questions: [],

        // semua soal terpilih (lintas halaman)
        selected: [...usedIds],

        loading: false,
        bulkLoading: false,

        pagination: {
            current_page: 1,
            last_page: 1,
        },

        /* ================= INIT ================= */
        init() {
            // data kategori sudah dari blade
        },

        /* ================= CATEGORY ================= */
        onCategoryChange() {
            this.materialId = '';
            this.materials = [];
            this.questions = [];
            this.resetPagination();

            const category = this.categories.find(
                c => c.id == this.categoryId
            );

            this.materials = category ? category.materials : [];
        },

        /* ================= MATERIAL ================= */
        onMaterialChange() {
            this.questions = [];
            this.resetPagination();

            if (this.materialId) {
                this.fetchQuestions(1);
            }
        },

        resetPagination() {
            this.pagination.current_page = 1;
            this.pagination.last_page = 1;
        },

        /* ================= FETCH QUESTIONS ================= */
        async fetchQuestions(page = 1) {
            if (!this.materialId || this.loading) return;

            this.loading = true;

            try {
                const url =
                    `/ajax/exams/${examCode}/questions/by-material/${this.materialId}?page=${page}`;

                console.log('[ExamQuestionPicker] Fetch:', url);

                const res = await fetch(url, {
                    headers: { Accept: 'application/json' }
                });

                if (!res.ok) {
                    throw new Error(`HTTP ${res.status}`);
                }

                const data = await res.json();

                this.questions = data.data.map(q => ({
                    ...q,
                    image_url: q.image ? `/storage/${q.image}` : null,
                    is_selected: this.selected.includes(q.id),
                }));

                this.pagination.current_page = data.current_page;
                this.pagination.last_page = data.last_page;

                this.$nextTick(() => {
                    if (window.MathJax?.typesetPromise) {
                        MathJax.typesetPromise();
                    }
                });

            } catch (e) {
                console.error('[ExamQuestionPicker] Fetch error:', e);
                alert('Gagal memuat soal');
            } finally {
                this.loading = false;
            }
        },

        /* ================= SINGLE SELECT ================= */
        toggleQuestion(questionId) {
            if (this.selected.includes(questionId)) {
                this.selected = this.selected.filter(id => id !== questionId);
            } else {
                this.selected.push(questionId);
            }

            this.syncSelectionState();
        },

        /* ================= BULK SELECT ================= */

        async selectAllFromMaterial() {
            if (!this.materialId || this.bulkLoading) return;

            this.bulkLoading = true;

            try {
                const url =
                    `/ajax/exams/${examCode}/questions/by-material/${this.materialId}/ids`;

                const res = await fetch(url, {
                    headers: { Accept: 'application/json' }
                });

                if (!res.ok) {
                    throw new Error(`HTTP ${res.status}`);
                }

                const response = await res.json();

                // DEFENSIVE PARSING
                const ids = Array.isArray(response)
                    ? response
                    : response.data ?? [];

                this.selected = Array.from(
                    new Set([...this.selected, ...ids])
                );

                this.syncSelectionState();

            } catch (e) {
                console.error('[ExamQuestionPicker] Bulk select error:', e);
                alert('Gagal memilih semua soal');
            } finally {
                this.bulkLoading = false;
            }
        },

        unselectAllFromMaterial() {
            const pageIds = this.questions.map(q => q.id);

            this.selected = this.selected.filter(
                id => !pageIds.includes(id)
            );

            this.syncSelectionState();
        },

        syncSelectionState() {
            this.questions = this.questions.map(q => ({
                ...q,
                is_selected: this.selected.includes(q.id),
            }));
        },

        /* ================= SAVE ================= */
        async save() {
            if (this.selected.length === 0) return;

            try {
                const res = await fetch(
                    `/ajax/exams/${examCode}/questions/attach`,
                    {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document
                                .querySelector('meta[name="csrf-token"]')
                                .getAttribute('content'),
                        },
                        body: JSON.stringify({
                            question_ids: this.selected,
                        }),
                    }
                );

                if (!res.ok) {
                    const error = await res.json().catch(() => ({}));
                    throw new Error(error.message || 'Attach gagal');
                }

                window.location.reload();

            } catch (e) {
                console.error('[ExamQuestionPicker] Save error:', e);
                alert('Gagal menyimpan soal');
            }
        }
    };
}
