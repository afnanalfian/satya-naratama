@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mathquill/0.10.1/mathquill.min.css">
@endpush

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
    const QUESTION = @json($question ?? null);

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
            if (e.target.dataset.target) {
                activeTextarea = document.getElementById(e.target.dataset.target);
            } else {
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

    mathModal.addEventListener('click', function(e) {
        if (e.target === this) closeMathModal();
    });

    /* =====================
       QUESTION TYPE & SECTIONS
    ====================== */
    const typeSelect = document.getElementById('question-type');
    const optionsSection = document.getElementById('options-section');
    const shortAnswerSection = document.getElementById('short-answer-section');
    const compoundSection = document.getElementById('compound-section');

    function toggleSections() {
        const type = typeSelect.value;

        optionsSection.classList.add('hidden');
        shortAnswerSection.classList.add('hidden');
        compoundSection.classList.add('hidden');

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
        optionIndex = 0;

        if (type === 'truefalse') {
            renderTrueFalse();
            addBtn.classList.add('hidden');
        } else {
            addBtn.classList.remove('hidden');
            if (QUESTION && ['mcq', 'mcma'].includes(QUESTION.type)) {
                QUESTION.options.forEach((option, index) => {
                    addOption({
                        id: option.id,
                        text: option.option_text,
                        is_correct: option.is_correct,
                        image: option.image,
                        weight: option.weight
                    }, index);
                });
            } else {
                addOption();
                addOption();
            }
        }
    }

    function addOption(option = null, customIndex = null) {
        const testType = document.getElementById('test-type').value;
        const type = typeSelect.value;

        const isTkp  = testType === 'tkp';
        const isMcq  = type === 'mcq';
        const isMcma = type === 'mcma';
        const index  = customIndex !== null ? customIndex : optionIndex;
        const optionId = option?.id ?? '';

        const html = `
            <div class="option-item flex gap-3 items-start p-4 rounded-xl border border-primary-200 dark:border-primary-700/30 bg-primary-50/30 dark:bg-primary-800/20 hover:bg-primary-50/50 dark:hover:bg-primary-800/30 transition-colors">
                <input type="hidden" name="options[${index}][id]" value="${optionId}">

                ${!isTkp ? `
                    <input type="${isMcq ? 'radio' : 'checkbox'}"
                        name="${isMcq ? 'correct' : 'correct[]'}"
                        value="${index}"
                        class="mt-3 w-4 h-4 rounded border-primary-300 dark:border-primary-600 text-primary-600 focus:ring-primary-500 focus:ring-offset-2 dark:focus:ring-offset-primary-900"
                        ${option?.is_correct ? 'checked' : ''}>
                ` : ''}

                <div class="flex-1 space-y-3">
                    <textarea name="options[${index}][text]"
                        class="option-text w-full px-4 py-2.5 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-primary-800 dark:text-primary-50 placeholder-secondary-400 focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all duration-200"
                        placeholder="Teks opsi..." rows="2">${option?.text ?? ''}</textarea>

                    ${!isTkp ? `
                        <div>
                            <input type="file"
                                name="options[${index}][image]"
                                accept="image/*"
                                class="text-sm text-secondary-500 dark:text-secondary-400 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary-50 file:text-primary-700 dark:file:bg-primary-800/50 dark:file:text-primary-300 hover:file:bg-primary-100 dark:hover:file:bg-primary-700/50 transition-all duration-200">
                            ${option?.image ? `
                                <p class="mt-1 text-xs text-secondary-500 dark:text-secondary-400">Gambar saat ini: ${option.image.split('/').pop()}</p>
                            ` : ''}
                        </div>
                    ` : ''}

                    ${isTkp ? `
                        <div>
                            <label class="text-xs text-secondary-500 dark:text-secondary-400">Bobot</label>
                            <input type="number"
                                name="options[${index}][weight]"
                                value="${option?.weight ?? ''}"
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

        optionsWrapper.insertAdjacentHTML('beforeend', html);

        if (customIndex === null) optionIndex++;
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

    addBtn?.addEventListener('click', () => addOption());

    function renderTrueFalse() {
        optionsWrapper.innerHTML = `
            <div class="space-y-3 p-4 rounded-xl bg-primary-50/30 dark:bg-primary-800/20 border border-primary-200 dark:border-primary-700/30">
                <p class="text-sm font-medium text-primary-700 dark:text-primary-300 mb-2">Pilih jawaban yang benar:</p>
                <label class="flex items-center gap-3 p-3 rounded-lg hover:bg-primary-50/50 dark:hover:bg-primary-800/30 cursor-pointer transition-colors">
                    <input type="radio" name="truefalse_correct" value="1"
                        ${(QUESTION && QUESTION.options.find(o => o.option_text === 'Benar' && o.is_correct)) ? 'checked' : ''}
                        class="w-4 h-4 text-emerald-600 focus:ring-emerald-500">
                    <span class="text-base font-medium text-primary-800 dark:text-primary-100">Benar</span>
                </label>
                <label class="flex items-center gap-3 p-3 rounded-lg hover:bg-primary-50/50 dark:hover:bg-primary-800/30 cursor-pointer transition-colors">
                    <input type="radio" name="truefalse_correct" value="0"
                        ${(QUESTION && QUESTION.options.find(o => o.option_text === 'Salah' && o.is_correct)) ? 'checked' : ''}
                        class="w-4 h-4 text-red-600 focus:ring-red-500">
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

        if (QUESTION && QUESTION.type === 'short_answer') {
            const correctOptions = QUESTION.options.filter(opt => opt.is_correct);
            if (correctOptions.length > 0) {
                correctOptions.forEach((option, index) => {
                    addShortAnswer({
                        id: option.id,
                        text: option.option_text
                    }, index);
                });
                return;
            }
        }
        addShortAnswer();
    }

    function addShortAnswer(option = null, customIndex = null) {
        const index = customIndex !== null ? customIndex : shortAnswersWrapper.children.length;
        const optionId = option ? option.id : '';

        const html = `
            <div class="short-answer-item flex items-center gap-3 p-3 rounded-xl border border-primary-200 dark:border-primary-700/30 bg-primary-50/30 dark:bg-primary-800/20">
                <input type="hidden" name="short_answers[${index}][id]" value="${optionId}">
                <span class="text-sm font-medium text-secondary-500 dark:text-secondary-400 w-6">${String.fromCharCode(65 + index)}.</span>
                <input type="text" name="short_answers[${index}][text]"
                       value="${option ? option.text : ''}"
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

    addShortAnswerBtn?.addEventListener('click', () => addShortAnswer());

    document.addEventListener('click', e => {
        if (e.target.classList.contains('remove-short-answer')) {
            e.target.closest('.short-answer-item')?.remove();
            const items = shortAnswersWrapper.querySelectorAll('.short-answer-item');
            items.forEach((item, index) => {
                const inputs = item.querySelectorAll('input[name]');
                inputs.forEach(input => {
                    const name = input.getAttribute('name');
                    const newName = name.replace(/short_answers\[\d+\]/, `short_answers[${index}]`);
                    input.setAttribute('name', newName);
                });
                const label = item.querySelector('span:first-child');
                if (label) label.textContent = `${String.fromCharCode(65 + index)}.`;
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

        if (QUESTION && QUESTION.type === 'compound' && QUESTION.subItems) {
            QUESTION.subItems.forEach((subItem, index) => {
                addCompoundItem(subItem, index);
            });
        } else {
            addCompoundItem();
        }
    }

    function addCompoundItem(subItem = null, customIndex = null) {
        const index = customIndex !== null ? customIndex : compoundIndex;
        const label = subItem ? subItem.label : String.fromCharCode(65 + index);

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

                <input type="hidden" name="sub_items[${index}][id]" value="${subItem ? subItem.id : ''}">
                <input type="hidden" name="sub_items[${index}][label]" value="${label}">

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-primary-700 dark:text-primary-300 mb-1.5">Jenis Sub</label>
                        <select name="sub_items[${index}][type]"
                                class="sub-type-select w-full px-4 py-2.5 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-primary-800 dark:text-primary-50 focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all duration-200 appearance-none">
                            <option value="truefalse" ${subItem && subItem.type === 'truefalse' ? 'selected' : ''}>Benar/Salah</option>
                            <option value="short_answer" ${subItem && subItem.type === 'short_answer' ? 'selected' : ''}>Isian Singkat</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-primary-700 dark:text-primary-300 mb-1.5">Pertanyaan</label>
                        <textarea name="sub_items[${index}][prompt]"
                                  rows="2"
                                  class="prompt-text w-full px-4 py-2.5 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-primary-800 dark:text-primary-50 placeholder-secondary-400 focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all duration-200"
                                  placeholder="Tulis pertanyaan sub...">${subItem ? subItem.prompt : ''}</textarea>
                        <button type="button" class="btn-open-math mt-1.5 text-sm text-primary-600 hover:text-primary-700 dark:text-primary-400 dark:hover:text-primary-300 transition-colors font-medium">
                            + Sisipkan Rumus
                        </button>
                    </div>

                    <div class="sub-answer-section" data-index="${index}"></div>
                </div>
            </div>
        `;

        compoundItemsWrapper.insertAdjacentHTML('beforeend', html);

        const newItem = compoundItemsWrapper.lastElementChild;
        renderCompoundAnswerSection(index, subItem ? subItem.type : 'truefalse', subItem);

        compoundIndex++;
        updateCompoundButtons();

        const typeSelectSub = newItem.querySelector('.sub-type-select');
        typeSelectSub.addEventListener('change', function() {
            const parent = this.closest('.compound-item');
            const idx = parseInt(parent.dataset.index);
            renderCompoundAnswerSection(idx, this.value);
        });
    }

    function renderCompoundAnswerSection(index, type, subItem = null) {
        const item = compoundItemsWrapper.querySelector(`.compound-item[data-index="${index}"]`);
        const section = item.querySelector('.sub-answer-section');

        if (type === 'truefalse') {
            let booleanAnswer = 1;
            if (subItem && subItem.answers && subItem.answers.length > 0) {
                booleanAnswer = subItem.answers[0].boolean_answer ? 1 : 0;
            }

            section.innerHTML = `
                <div class="space-y-3 p-4 rounded-xl bg-primary-50/30 dark:bg-primary-800/20 border border-primary-200 dark:border-primary-700/30">
                    <label class="block text-sm font-medium text-primary-700 dark:text-primary-300">Jawaban Benar</label>
                    <div class="flex gap-6">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="sub_items[${index}][boolean_answer]" value="1" ${booleanAnswer == 1 ? 'checked' : ''} class="w-4 h-4 text-emerald-600 focus:ring-emerald-500">
                            <span class="text-sm font-medium text-primary-800 dark:text-primary-100">Benar</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="sub_items[${index}][boolean_answer]" value="0" ${booleanAnswer == 0 ? 'checked' : ''} class="w-4 h-4 text-red-600 focus:ring-red-500">
                            <span class="text-sm font-medium text-primary-800 dark:text-primary-100">Salah</span>
                        </label>
                    </div>
                </div>
            `;
        } else if (type === 'short_answer') {
            const answers = subItem && subItem.answers ? subItem.answers : [];
            const primaryIndex = answers.findIndex(a => a.is_primary);

            let answersHtml = '';
            if (answers.length === 0) {
                answersHtml = `
                    <div class="flex items-center gap-3">
                        <input type="radio" name="sub_items[${index}][primary_index]" value="0" checked class="w-4 h-4 text-primary-600 focus:ring-primary-500">
                        <input type="text" name="sub_items[${index}][answers][0][text]"
                               class="flex-1 px-4 py-2.5 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-primary-800 dark:text-primary-50 placeholder-secondary-400 focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all duration-200"
                               placeholder="Jawaban...">
                        <button type="button" class="remove-compound-answer text-red-500 hover:text-red-600 transition-colors font-medium hidden">Hapus</button>
                    </div>
                `;
            } else {
                answers.forEach((answer, i) => {
                    const answerId = answer.id ? answer.id : '';
                    answersHtml += `
                        <div class="flex items-center gap-3">
                            <input type="hidden" name="sub_items[${index}][answers][${i}][id]" value="${answerId}">
                            <input type="radio" name="sub_items[${index}][primary_index]" value="${i}" ${i === primaryIndex ? 'checked' : ''} class="w-4 h-4 text-primary-600 focus:ring-primary-500">
                            <input type="text" name="sub_items[${index}][answers][${i}][text]"
                                   value="${answer.answer_text || ''}"
                                   class="flex-1 px-4 py-2.5 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-primary-800 dark:text-primary-50 placeholder-secondary-400 focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all duration-200"
                                   placeholder="Jawaban...">
                            <button type="button" class="remove-compound-answer text-red-500 hover:text-red-600 transition-colors font-medium ${i === 0 ? 'hidden' : ''}">Hapus</button>
                        </div>
                    `;
                });
            }

            section.innerHTML = `
                <div class="space-y-3 p-4 rounded-xl bg-primary-50/30 dark:bg-primary-800/20 border border-primary-200 dark:border-primary-700/30">
                    <label class="block text-sm font-medium text-primary-700 dark:text-primary-300">Jawaban Isian Singkat</label>
                    <p class="text-xs text-secondary-500 dark:text-secondary-400">Tambahkan semua kemungkinan jawaban yang benar</p>

                    <div class="compound-short-answers space-y-3" data-index="${index}">
                        ${answersHtml}
                    </div>

                    <button type="button" class="add-compound-answer-btn text-sm text-primary-600 hover:text-primary-700 dark:text-primary-400 dark:hover:text-primary-300 transition-colors font-medium" data-index="${index}">
                        + Tambah Jawaban Lain
                    </button>
                </div>
            `;

            const addBtn = section.querySelector('.add-compound-answer-btn');
            addBtn.addEventListener('click', function() {
                const idx = this.dataset.index;
                addCompoundShortAnswer(idx);
            });
        }
    }

    function addCompoundShortAnswer(index, answer = null) {
        const item = compoundItemsWrapper.querySelector(`.compound-item[data-index="${index}"]`);
        const container = item.querySelector('.compound-short-answers');
        const answerCount = container.children.length;
        const answerId = answer ? answer.id : '';

        const html = `
            <div class="flex items-center gap-3">
                <input type="hidden" name="sub_items[${index}][answers][${answerCount}][id]" value="${answerId}">
                <input type="radio" name="sub_items[${index}][primary_index]" value="${answerCount}" class="w-4 h-4 text-primary-600 focus:ring-primary-500">
                <input type="text" name="sub_items[${index}][answers][${answerCount}][text]"
                       value="${answer ? answer.answer_text : ''}"
                       class="flex-1 px-4 py-2.5 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-primary-800 dark:text-primary-50 placeholder-secondary-400 focus:ring-2 focus:ring-primary-500/30 focus:border-primary-500 transition-all duration-200"
                       placeholder="Jawaban...">
                <button type="button" class="remove-compound-answer text-red-500 hover:text-red-600 transition-colors font-medium">Hapus</button>
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

    addCompoundItemBtn?.addEventListener('click', () => addCompoundItem());

    // Event delegation
    compoundItemsWrapper.addEventListener('click', e => {
        if (e.target.classList.contains('remove-compound-item')) {
            const item = e.target.closest('.compound-item');
            const removedIndex = parseInt(item.dataset.index);

            item.remove();
            compoundIndex--;

            const items = compoundItemsWrapper.querySelectorAll('.compound-item');
            items.forEach((item, newIndex) => {
                item.dataset.index = newIndex;
                const label = String.fromCharCode(65 + newIndex);
                const title = item.querySelector('h3');
                const hiddenInput = item.querySelector('input[name*="[label]"]');

                if (title) title.textContent = `Sub Pertanyaan ${label}`;
                if (hiddenInput) hiddenInput.value = label;

                const inputs = item.querySelectorAll('[name]');
                inputs.forEach(input => {
                    const name = input.getAttribute('name');
                    const newName = name.replace(/sub_items\[\d+\]/, `sub_items[${newIndex}]`);
                    input.setAttribute('name', newName);
                });
            });

            updateCompoundButtons();
        }

        if (e.target.classList.contains('remove-compound-answer')) {
            const answerItem = e.target.closest('.flex.items-center.gap-3');
            const container = answerItem.closest('.compound-short-answers');
            const compoundItem = container.closest('.compound-item');
            const index = compoundItem.dataset.index;

            answerItem.remove();

            const answers = container.querySelectorAll('.flex.items-center.gap-3');
            answers.forEach((itm, i) => {
                const radio = itm.querySelector('input[type="radio"]');
                const textInput = itm.querySelector('input[type="text"]');

                if (radio) {
                    radio.value = i;
                    radio.name = `sub_items[${index}][primary_index]`;
                    if (i === 0) radio.checked = true;
                }
                if (textInput) {
                    textInput.name = `sub_items[${index}][answers][${i}][text]`;
                }
            });

            updateCompoundAnswerButtons(index);
        }
    });

    compoundItemsWrapper.addEventListener('click', e => {
        if (e.target.classList.contains('add-compound-answer-btn')) {
            const index = e.target.dataset.index;
            addCompoundShortAnswer(index);
        }
    });

    /* =====================
       OPTIONS REMOVE DELEGATION
    ====================== */
    optionsWrapper.addEventListener('click', e => {
        if (e.target.classList.contains('btn-remove-option')) {
            const item = e.target.closest('.option-item');
            item.remove();

            const items = optionsWrapper.querySelectorAll('.option-item');
            items.forEach((item, index) => {
                const textarea = item.querySelector('textarea');
                const radio = item.querySelector('input[type="radio"], input[type="checkbox"]');
                const hiddenId = item.querySelector('input[type="hidden"]');

                if (textarea) textarea.name = `options[${index}][text]`;
                if (hiddenId) hiddenId.name = `options[${index}][id]`;
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
    const testTypeSelect = document.getElementById('test-type');
    if (testTypeSelect && typeSelect) {
        const allowed = {
            general: ['mcq','mcma','truefalse','short_answer','compound'],
            tiu: ['mcq'],
            twk: ['mcq'],
            mtk_stis: ['mcq'],
            tkp: ['mcq'],
            mtk_tka: ['mcq','mcma','truefalse','compound'],
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

        // Initially applied via inline script
    }

    /* =====================
       INITIALIZE
    ====================== */
    if (QUESTION) {
        typeSelect.value = QUESTION.type;
    }
    toggleSections();
    renderPreview();
    renderExplanationPreview();

    const docs = document.getElementById('math-docs');
    const docsBtn = document.getElementById('btn-open-docs');
    const closeDocsBtn = document.getElementById('close-docs');

    if (docsBtn) {
        docsBtn.onclick = () => { if (docs) docs.classList.remove('translate-x-full'); };
    }
    if (closeDocsBtn) {
        closeDocsBtn.onclick = () => { if (docs) docs.classList.add('translate-x-full'); };
    }
});
</script>
@endpush
