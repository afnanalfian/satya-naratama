@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mathquill/0.10.1/mathquill.min.js"></script>

<script>
window.MathJax = {
    tex: { inlineMath: [['\\(', '\\)']] }
};
</script>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>

<script>
document.addEventListener('DOMContentLoaded', () => {

    /* =====================
       MATHQUILL INIT
    ====================== */
    const MQ = MathQuill.getInterface(2);
    const mathField = MQ.MathField(
        document.getElementById('math-editor'),
        { spaceBehavesLikeTab: true }
    );

    const mathModal = document.getElementById('math-modal');
    let activeTextarea = null;

    /* =====================
       CLOSE MODAL FUNCTION
    ====================== */
    function closeMathModal() {
        mathModal.classList.add('hidden');
        mathField.latex('');
        activeTextarea = null;
    }

    /* =====================
       QUESTION PREVIEW
    ====================== */
    const questionInput  = document.getElementById('question-text');
    const previewBox     = document.getElementById('question-preview');

    function renderPreview() {
        if (!questionInput || !previewBox) return;

        if (!questionInput.value.trim()) {
            previewBox.innerHTML =
                '<span class="text-secondary-400 dark:text-secondary-500">Belum ada isi...</span>';
            return;
        }

        previewBox.innerHTML = questionInput.value;
        MathJax.typesetPromise([previewBox]);
    }

    if (questionInput) {
        questionInput.addEventListener('input', renderPreview);
    }

    /* =====================
       EXPLANATION PREVIEW
    ===================== */
    const explanationInput  = document.getElementById('explanation-text');
    const explanationPreview = document.getElementById('explanation-preview');

    function renderExplanationPreview() {
        if (!explanationInput || !explanationPreview) return;

        if (!explanationInput.value.trim()) {
            explanationPreview.innerHTML =
                '<span class="text-secondary-400 dark:text-secondary-500">Belum ada isi...</span>';
            return;
        }

        explanationPreview.innerHTML = explanationInput.value;
        MathJax.typesetPromise([explanationPreview]);
    }

    if (explanationInput) {
        explanationInput.addEventListener('input', renderExplanationPreview);
    }

    /* =====================
       OPEN MATH MODAL
    ====================== */
    document.addEventListener('click', e => {

        if (e.target.classList.contains('btn-open-math')) {

            // Target dari soal
            if (e.target.dataset.target) {
                activeTextarea =
                    document.getElementById(e.target.dataset.target);
            }
            // Target dari opsi
            else {
                activeTextarea = e.target
                    .closest('.option-item, .short-answer-item, .compound-item')
                    ?.querySelector('textarea, input[type="text"]');
            }

            if (!activeTextarea) return;

            mathModal.classList.remove('hidden');
            mathField.focus();
        }
    });

    /* =====================
       CONFIRM MATH
    ====================== */
    document.getElementById('btn-confirm-math').onclick = () => {
        if (!activeTextarea) return;

        if (activeTextarea.tagName === 'TEXTAREA') {
            activeTextarea.value += ` \\(${mathField.latex()}\\) `;
        } else {
            activeTextarea.value += `\\(${mathField.latex()}\\)`;
        }
        mathField.latex('');
        closeMathModal();

        // Trigger preview update
        if (activeTextarea.id === 'question-text') {
            renderPreview();
        } else if (activeTextarea.id === 'explanation-text') {
            renderExplanationPreview();
        }
    };

    /* =====================
       CLOSE MODAL HANDLERS
    ====================== */
    document.getElementById('btn-cancel-math').onclick = closeMathModal;
    document.getElementById('close-math-modal').onclick = closeMathModal;

    // Close on backdrop click
    mathModal.addEventListener('click', function(e) {
        if (e.target === this) {
            closeMathModal();
        }
    });

    /* =====================
       QUESTION TYPE & SECTIONS
    ====================== */
    const testTypeSelect = document.getElementById('test-type');
    const typeSelect = document.getElementById('question-type');
    const optionsSection = document.getElementById('options-section');
    const shortAnswerSection = document.getElementById('short-answer-section');
    const compoundSection = document.getElementById('compound-section');


    function toggleSections() {
        const type = typeSelect.value;

        // Hide all sections
        optionsSection.classList.add('hidden');
        shortAnswerSection.classList.add('hidden');
        compoundSection.classList.add('hidden');

        // Show relevant section
        if (['mcq','mcma','truefalse'].includes(type)) {
            optionsSection.classList.remove('hidden');
            initOptions(type);
        } else if (type === 'short_answer') {
            shortAnswerSection.classList.remove('hidden');
            initShortAnswer();
        } else if (type === 'compound') {
            compoundSection.classList.remove('hidden');
            initCompound();
        }
    }

    typeSelect?.addEventListener('change', toggleSections);

    /* =====================
       OPTIONS HANDLING
    ====================== */
    const optionsWrapper = document.getElementById('options-wrapper');
    const addBtn = document.getElementById('add-option');
    let optionIndex = 0;

    function initOptions(type) {
        optionsWrapper.innerHTML = '';
        addBtn.classList.remove('hidden');
        optionIndex = 0;

        if (['mcq','mcma'].includes(type)) {
            addOption();
            addOption();
        }

        if (type === 'truefalse') {
            renderTrueFalse();
            addBtn.classList.add('hidden');
        }
    }

    function addOption() {
        const testType = document.getElementById('test-type')?.value ?? 'general';
        const type = typeSelect.value;

        const isTkp  = testType === 'tkp';
        const isMcq  = type === 'mcq';
        const isMcma = type === 'mcma';
        const index = optionIndex;

        const optionHtml = `
            <div class="option-item flex gap-3 items-start p-4 rounded-xl border border-primary-200 dark:border-primary-700/30 bg-primary-50/30 dark:bg-primary-800/20 hover:bg-primary-50/50 dark:hover:bg-primary-800/30 transition-colors">
                ${!isTkp ? `
                    <input type="${isMcq ? 'radio' : 'checkbox'}"
                        name="${isMcq ? 'correct' : 'correct[]'}"
                        value="${index}"
                        class="mt-3 w-4 h-4 rounded border-primary-300 dark:border-primary-600 text-primary-600 focus:ring-primary-500 focus:ring-offset-2 dark:focus:ring-offset-primary-900">
                ` : ''}

                <div class="flex-1 space-y-3">
                    <textarea name="options[${index}][text]"
                        class="option-text w-full px-4 py-2.5 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-primary-800 dark:text-primary-50 placeholder-secondary-400 focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all duration-200"
                        placeholder="Teks opsi..." rows="2"></textarea>

                    ${!isTkp ? `
                        <div>
                            <input type="file"
                                name="options[${index}][image]"
                                accept="image/*"
                                class="text-sm text-secondary-500 dark:text-secondary-400 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary-50 file:text-primary-700 dark:file:bg-primary-800/50 dark:file:text-primary-300 hover:file:bg-primary-100 dark:hover:file:bg-primary-700/50 transition-all duration-200">
                        </div>
                    ` : ''}

                    ${isTkp ? `
                        <div>
                            <label class="text-xs text-secondary-500 dark:text-secondary-400">Bobot</label>
                            <input type="number"
                                name="options[${index}][weight]"
                                class="w-32 px-3 py-1.5 rounded-lg border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-primary-800 dark:text-primary-50 focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all duration-200"
                                placeholder="Bobot">
                        </div>
                    ` : ''}

                    <div class="flex gap-3 text-xs">
                        <button type="button"
                                class="btn-open-math text-primary-600 hover:text-primary-700 dark:text-primary-400 dark:hover:text-primary-300 transition-colors font-medium">
                            + Sisipkan Rumus
                        </button>

                        <button type="button"
                                class="btn-remove-option text-red-500 hover:text-red-600 transition-colors font-medium ${index < 2 ? 'hidden' : ''}">
                            Hapus Opsi
                        </button>
                    </div>
                </div>
            </div>
        `;

        optionsWrapper.insertAdjacentHTML('beforeend', optionHtml);
        optionIndex++;
        updateRemoveButtons();
    }

    function updateRemoveButtons() {
        const items = optionsWrapper.querySelectorAll('.option-item');

        items.forEach((item, index) => {
            const removeBtn = item.querySelector('.btn-remove-option');
            if (index < 2) {
                removeBtn.classList.add('hidden');
            } else {
                removeBtn.classList.remove('hidden');
            }
        });
    }

    addBtn?.addEventListener('click', addOption);

    function renderTrueFalse() {
        optionsWrapper.innerHTML = `
        <div class="space-y-3 p-4 rounded-xl bg-primary-50/30 dark:bg-primary-800/20 border border-primary-200 dark:border-primary-700/30">
            <p class="text-sm font-medium text-primary-700 dark:text-primary-300 mb-2">Pilih jawaban yang benar:</p>
            <label class="flex items-center gap-3 p-3 rounded-lg hover:bg-primary-50/50 dark:hover:bg-primary-800/30 cursor-pointer transition-colors">
                <input type="radio" name="truefalse_correct" value="1" checked class="w-4 h-4 text-emerald-600 focus:ring-emerald-500">
                <span class="text-base font-medium text-primary-800 dark:text-primary-100">Benar</span>
            </label>
            <label class="flex items-center gap-3 p-3 rounded-lg hover:bg-primary-50/50 dark:hover:bg-primary-800/30 cursor-pointer transition-colors">
                <input type="radio" name="truefalse_correct" value="0" class="w-4 h-4 text-red-600 focus:ring-red-500">
                <span class="text-base font-medium text-primary-800 dark:text-primary-100">Salah</span>
            </label>
        </div>
        `;
    }

    /* =====================
       SHORT ANSWER HANDLING
    ====================== */
    const shortAnswersWrapper = document.getElementById('short-answers-wrapper');
    const addShortAnswerBtn = document.getElementById('add-short-answer');

    function initShortAnswer() {
        shortAnswersWrapper.innerHTML = '';
        addShortAnswer();
    }

    function addShortAnswer() {
        const index = shortAnswersWrapper.children.length;

        const html = `
        <div class="short-answer-item flex items-center gap-3 p-3 rounded-xl border border-primary-200 dark:border-primary-700/30 bg-primary-50/30 dark:bg-primary-800/20">
            <span class="text-sm font-medium text-secondary-500 dark:text-secondary-400 w-6">${String.fromCharCode(65 + index)}.</span>
            <input type="text" name="short_answers[${index}][text]"
                   class="flex-1 px-4 py-2.5 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-primary-800 dark:text-primary-50 placeholder-secondary-400 focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all duration-200"
                   placeholder="Masukkan jawaban...">
            <button type="button" class="remove-short-answer text-red-500 hover:text-red-600 transition-colors font-medium ${index === 0 ? 'hidden' : ''}">
                Hapus
            </button>
        </div>
        `;

        shortAnswersWrapper.insertAdjacentHTML('beforeend', html);
        updateShortAnswerButtons();
    }

    function updateShortAnswerButtons() {
        const items = shortAnswersWrapper.querySelectorAll('.short-answer-item');
        items.forEach((item, index) => {
            const removeBtn = item.querySelector('.remove-short-answer');
            if (index === 0) {
                removeBtn.classList.add('hidden');
            } else {
                removeBtn.classList.remove('hidden');
            }
        });
    }

    addShortAnswerBtn?.addEventListener('click', addShortAnswer);

    document.addEventListener('click', e => {
        if (e.target.classList.contains('remove-short-answer')) {
            e.target.closest('.short-answer-item')?.remove();
            // Re-index inputs
            const items = shortAnswersWrapper.querySelectorAll('.short-answer-item');
            items.forEach((item, index) => {
                const input = item.querySelector('input[type="text"]');
                input.setAttribute('name', `short_answers[${index}][text]`);
                const label = item.querySelector('span:first-child');
                if (label) {
                    label.textContent = `${String.fromCharCode(65 + index)}.`;
                }
            });
            updateShortAnswerButtons();
        }
    });

    /* =====================
       COMPOUND HANDLING
    ====================== */
    const compoundItemsWrapper = document.getElementById('compound-items-wrapper');
    const addCompoundItemBtn = document.getElementById('add-compound-item');
    let compoundIndex = 0;

    function initCompound() {
        compoundItemsWrapper.innerHTML = '';
        compoundIndex = 0;
        addCompoundItem();
    }

    function addCompoundItem() {
        const index = compoundIndex;
        const label = String.fromCharCode(65 + index); // A, B, C

        const html = `
        <div class="compound-item rounded-xl border border-primary-200 dark:border-primary-700/30 bg-primary-50/30 dark:bg-primary-800/20 p-5" data-index="${index}">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-base font-bold text-primary-800 dark:text-primary-100">
                    Sub Pertanyaan ${label}
                </h3>
                <button type="button" class="remove-compound-item text-red-500 hover:text-red-600 transition-colors font-medium ${index === 0 ? 'hidden' : ''}">
                    Hapus
                </button>
            </div>

            <input type="hidden" name="sub_items[${index}][id]" value="">
            <input type="hidden" name="sub_items[${index}][label]" value="${label}">

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-primary-700 dark:text-primary-300 mb-1.5">Jenis Sub</label>
                    <select name="sub_items[${index}][type]"
                            class="sub-type-select w-full px-4 py-2.5 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-primary-800 dark:text-primary-50 focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all duration-200 appearance-none">
                        <option value="truefalse">Benar/Salah</option>
                        <option value="short_answer">Isian Singkat</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-primary-700 dark:text-primary-300 mb-1.5">Pertanyaan</label>
                    <textarea name="sub_items[${index}][prompt]"
                              rows="2"
                              class="prompt-text w-full px-4 py-2.5 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-primary-800 dark:text-primary-50 placeholder-secondary-400 focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all duration-200"
                              placeholder="Tulis pertanyaan sub..."></textarea>
                    <button type="button" class="btn-open-math mt-1.5 text-sm text-primary-600 hover:text-primary-700 dark:text-primary-400 dark:hover:text-primary-300 transition-colors font-medium">
                        + Sisipkan Rumus
                    </button>
                </div>

                <div class="sub-answer-section" data-index="${index}">
                    <!-- Answer fields will be rendered here based on type -->
                </div>
            </div>
        </div>
        `;

        compoundItemsWrapper.insertAdjacentHTML('beforeend', html);

        // Initialize answer section for this sub item
        renderCompoundAnswerSection(index, 'truefalse');

        compoundIndex++;
        updateCompoundButtons();

        // Add event listener for type change
        const subItem = compoundItemsWrapper.lastElementChild;
        const typeSelectSub = subItem.querySelector('.sub-type-select');

        typeSelectSub.addEventListener('change', function() {
            const parent = this.closest('.compound-item');
            const idx = parseInt(parent.dataset.index);
            renderCompoundAnswerSection(idx, this.value);
        });
    }

    function renderCompoundAnswerSection(index, type) {
        const item = compoundItemsWrapper.querySelector(`.compound-item[data-index="${index}"]`);
        const section = item.querySelector('.sub-answer-section');

        if (type === 'truefalse') {
            section.innerHTML = `
            <div class="space-y-3 p-4 rounded-xl bg-primary-50/30 dark:bg-primary-800/20 border border-primary-200 dark:border-primary-700/30">
                <label class="block text-sm font-medium text-primary-700 dark:text-primary-300">Jawaban Benar</label>
                <div class="flex gap-6">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="sub_items[${index}][boolean_answer]" value="1" checked class="w-4 h-4 text-emerald-600 focus:ring-emerald-500">
                        <span class="text-sm font-medium text-primary-800 dark:text-primary-100">Benar</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="sub_items[${index}][boolean_answer]" value="0" class="w-4 h-4 text-red-600 focus:ring-red-500">
                        <span class="text-sm font-medium text-primary-800 dark:text-primary-100">Salah</span>
                    </label>
                </div>
            </div>
            `;
        } else if (type === 'short_answer') {
            section.innerHTML = `
            <div class="space-y-3 p-4 rounded-xl bg-primary-50/30 dark:bg-primary-800/20 border border-primary-200 dark:border-primary-700/30">
                <label class="block text-sm font-medium text-primary-700 dark:text-primary-300">Jawaban Isian Singkat</label>
                <p class="text-xs text-secondary-500 dark:text-secondary-400">Tambahkan semua kemungkinan jawaban yang benar</p>

                <div class="compound-short-answers space-y-3" data-index="${index}">
                    <div class="flex items-center gap-3">
                        <input type="radio" name="sub_items[${index}][primary_index]" value="0" checked class="w-4 h-4 text-primary-600 focus:ring-primary-500">
                        <input type="text" name="sub_items[${index}][answers][0][text]"
                               class="flex-1 px-4 py-2.5 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-primary-800 dark:text-primary-50 placeholder-secondary-400 focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all duration-200"
                               placeholder="Jawaban...">
                        <button type="button" class="remove-compound-answer text-red-500 hover:text-red-600 transition-colors font-medium hidden">
                            Hapus
                        </button>
                    </div>
                </div>

                <button type="button" class="add-compound-answer-btn text-sm text-primary-600 hover:text-primary-700 dark:text-primary-400 dark:hover:text-primary-300 transition-colors font-medium" data-index="${index}">
                    + Tambah Jawaban Lain
                </button>
            </div>
            `;

            // Add event listener for adding more answers
            const addBtn = section.querySelector('.add-compound-answer-btn');
            addBtn.addEventListener('click', function() {
                const idx = this.dataset.index;
                addCompoundShortAnswer(idx);
            });
        }
    }

    function addCompoundShortAnswer(index) {
        const item = compoundItemsWrapper.querySelector(`.compound-item[data-index="${index}"]`);
        const container = item.querySelector('.compound-short-answers');
        const answerCount = container.children.length;

        const html = `
        <div class="flex items-center gap-3">
            <input type="radio" name="sub_items[${index}][primary_index]" value="${answerCount}" class="w-4 h-4 text-primary-600 focus:ring-primary-500">
            <input type="text" name="sub_items[${index}][answers][${answerCount}][text]"
                   class="flex-1 px-4 py-2.5 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-primary-800 dark:text-primary-50 placeholder-secondary-400 focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all duration-200"
                   placeholder="Jawaban...">
            <button type="button" class="remove-compound-answer text-red-500 hover:text-red-600 transition-colors font-medium">
                Hapus
            </button>
        </div>
        `;

        container.insertAdjacentHTML('beforeend', html);
        updateCompoundAnswerButtons(index);
    }

    function updateCompoundAnswerButtons(index) {
        const item = compoundItemsWrapper.querySelector(`.compound-item[data-index="${index}"]`);
        const container = item.querySelector('.compound-short-answers');
        const items = container.querySelectorAll('.flex.items-center.gap-3');

        items.forEach((item, i) => {
            const removeBtn = item.querySelector('.remove-compound-answer');
            if (i === 0) {
                removeBtn.classList.add('hidden');
            } else {
                removeBtn.classList.remove('hidden');
            }
        });
    }

    function updateCompoundButtons() {
        const items = compoundItemsWrapper.querySelectorAll('.compound-item');
        items.forEach((item, index) => {
            const removeBtn = item.querySelector('.remove-compound-item');
            if (index === 0) {
                removeBtn.classList.add('hidden');
            } else {
                removeBtn.classList.remove('hidden');
            }
        });
    }

    addCompoundItemBtn?.addEventListener('click', addCompoundItem);

    // Remove compound item
    compoundItemsWrapper.addEventListener('click', e => {
        if (e.target.classList.contains('remove-compound-item')) {
            const item = e.target.closest('.compound-item');
            const removedIndex = parseInt(item.dataset.index);

            item.remove();
            compoundIndex--;

            // Re-index remaining items
            const items = compoundItemsWrapper.querySelectorAll('.compound-item');
            items.forEach((item, newIndex) => {
                item.dataset.index = newIndex;
                const label = String.fromCharCode(65 + newIndex);
                const title = item.querySelector('h3');
                const hiddenInput = item.querySelector('input[name*="[label]"]');

                if (title) {
                    title.textContent = `Sub Pertanyaan ${label}`;
                }
                if (hiddenInput) {
                    hiddenInput.value = label;
                }

                // Update all name attributes
                const inputs = item.querySelectorAll('[name]');
                inputs.forEach(input => {
                    const name = input.getAttribute('name');
                    const newName = name.replace(/sub_items\[\d+\]/, `sub_items[${newIndex}]`);
                    input.setAttribute('name', newName);
                });
            });

            updateCompoundButtons();
        }

        // Remove compound short answer
        if (e.target.classList.contains('remove-compound-answer')) {
            const answerItem = e.target.closest('.flex.items-center.gap-3');
            const container = answerItem.closest('.compound-short-answers');
            const compoundItem = container.closest('.compound-item');
            const index = compoundItem.dataset.index;

            answerItem.remove();

            // Re-index answers
            const answers = container.querySelectorAll('.flex.items-center.gap-3');
            answers.forEach((itm, i) => {
                const radio = itm.querySelector('input[type="radio"]');
                const textInput = itm.querySelector('input[type="text"]');

                if (radio) {
                    radio.value = i;
                    radio.name = `sub_items[${index}][primary_index]`;
                }
                if (textInput) {
                    textInput.name = `sub_items[${index}][answers][${i}][text]`;
                }

                if (i === 0 && radio) {
                    radio.checked = true;
                }
            });

            updateCompoundAnswerButtons(index);
        }
    });

    // Add compound short answer
    compoundItemsWrapper.addEventListener('click', e => {
        if (e.target.classList.contains('add-compound-answer-btn')) {
            const index = e.target.dataset.index;
            addCompoundShortAnswer(index);
        }
    });

    /* =====================
       EVENT DELEGATION
    ====================== */
    document.addEventListener('click', e => {
        // Remove options
        if (e.target.classList.contains('btn-remove-option')) {
            e.target.closest('.option-item')?.remove();

            // Re-index options
            const items = optionsWrapper.querySelectorAll('.option-item');
            items.forEach((item, index) => {
                const textarea = item.querySelector('textarea');
                const radio = item.querySelector('input[type="radio"], input[type="checkbox"]');

                if (textarea) {
                    textarea.name = `options[${index}][text]`;
                }
                if (radio) {
                    radio.name = typeSelect.value === 'mcq' ? 'correct' : 'correct[]';
                    radio.value = index;
                }
            });

            optionIndex = items.length;
            updateRemoveButtons();
        }
    });

    /* =====================
       ALLOWED TYPES FILTER
    ====================== */
    if (testTypeSelect && typeSelect) {
        const allowed = {
            general: ['mcq','mcma','truefalse','short_answer','compound'],
            tiu: ['mcq'],
            twk: ['mcq'],
            mtk_stis: ['mcq'],
            tkp: ['mcq'],
            tpa: ['mcq'],
            tbi: ['mcq'],
            mtk_tka: ['mcq','mcma','truefalse','compound']
        };

        function filterQuestionTypes() {
            const testType = testTypeSelect.value;

            [...typeSelect.options].forEach(opt => {
                if (!opt.value) return;
                opt.hidden = !allowed[testType]?.includes(opt.value);
            });

            if (!allowed[testType]?.includes(typeSelect.value)) {
                typeSelect.value = '';
            }
        }

        testTypeSelect.addEventListener('change', filterQuestionTypes);
        filterQuestionTypes();
    }

    /* =====================
       INITIALIZE
    ====================== */
    toggleSections();

    // sidebar docs
    const docs = document.getElementById('math-docs');
    const docsBtn = document.getElementById('btn-open-docs');
    const closeDocsBtn = document.getElementById('close-docs');

    if (docsBtn) {
        docsBtn.onclick = () => {
            if (docs) docs.classList.remove('translate-x-full');
        };
    }
    if (closeDocsBtn) {
        closeDocsBtn.onclick = () => {
            if (docs) docs.classList.add('translate-x-full');
        };
    }

});
</script>
@endpush
