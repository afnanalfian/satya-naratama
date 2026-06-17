@push('styles')
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/mathquill/0.10.1/mathquill.min.css">
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
       QUESTION PREVIEW
    ====================== */
    const questionInput  = document.getElementById('question-text');
    const previewBox     = document.getElementById('question-preview');

    function renderPreview() {
        if (!questionInput || !previewBox) return;

        if (!questionInput.value.trim()) {
            previewBox.innerHTML =
                '<span class="opacity-50">Belum ada isi...</span>';
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
                '<span class="opacity-50">Belum ada isi...</span>';
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
                activeTextarea = document.getElementById(e.target.dataset.target);
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
        renderPreview();
    };

    /* =====================
       CLOSE MODAL
    ====================== */
    function closeMathModal() {
        mathModal.classList.add('hidden');
        mathField.latex('');
        activeTextarea = null;
    }

    document.getElementById('btn-cancel-math').onclick = closeMathModal;
    document.getElementById('close-math-modal').onclick = closeMathModal;

    /* =====================
       QUESTION TYPE & SECTIONS
    ====================== */
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
        optionIndex = 0;

        if (type === 'truefalse') {
            renderTrueFalse();
            addBtn.classList.add('hidden');
        } else {
            addBtn.classList.remove('hidden');
            // Load existing options if editing
            if (QUESTION && ['mcq', 'mcma'].includes(QUESTION.type)) {
                QUESTION.options.forEach((option, index) => {
                    addOption({
                        id: option.id,
                        text: option.option_text,
                        is_correct: option.is_correct
                    }, index);
                });
            } else {
                // Add 2 default options for new question
                addOption();
                addOption();
            }
        }
    }

    function addOption(option = null, customIndex = null) {

        const testType = document.getElementById('test-type').value;
        const type     = typeSelect.value;

        const isTkp  = testType === 'tkp';
        const isMcq  = type === 'mcq';
        const isMcma = type === 'mcma';

        const index   = customIndex !== null ? customIndex : optionIndex;
        const optionId = option?.id ?? '';

        optionsWrapper.insertAdjacentHTML('beforeend', `
            <div class="option-item flex gap-3 items-start">

                <input type="hidden" name="options[${index}][id]" value="${optionId}">

                ${!isTkp ? `
                    <input type="${isMcq ? 'radio' : 'checkbox'}"
                        name="${isMcq ? 'correct' : 'correct[]'}"
                        value="${index}"
                        class="mt-3"
                        ${option?.is_correct ? 'checked' : ''}>
                ` : ''}

                <div class="flex-1 space-y-2">

                    <textarea name="options[${index}][text]"
                        class="option-text w-full rounded-lg border p-2
                            bg-azwara-lightest dark:bg-secondary/30
                            text-slate-800 dark:text-white"
                        placeholder="Teks opsi...">${option?.text ?? ''}</textarea>

                    ${!isTkp ? `
                        <input type="file"
                            name="options[${index}][image]"
                            accept="image/*"
                            class="block text-xs text-gray-600 dark:text-gray-300">
                    ` : ''}

                    ${option?.image && !isTkp ? `
                        <div class="text-xs opacity-70">
                            Gambar saat ini: ${option.image.split('/').pop()}
                        </div>
                    ` : ''}

                    ${isTkp ? `
                        <input type="number"
                            name="options[${index}][weight]"
                            value="${option?.weight ?? ''}"
                            class="input-weight w-32 rounded border p-1 text-sm"
                            placeholder="Bobot">
                    ` : ''}

                    <div class="flex gap-3 text-xs">
                        <button type="button" class="btn-open-math underline">
                            + Rumus
                        </button>

                        <button type="button"
                                class="btn-remove-option text-red-500 ${index < 2 ? 'hidden' : ''}">
                            Hapus
                        </button>
                    </div>
                </div>
            </div>
        `);

        if (customIndex === null) {
            optionIndex++;
        }

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
        <div class="space-y-2">
            <label class="flex gap-2 items-center">
                <input type="radio" name="truefalse_correct" value="1"
                    ${(QUESTION && QUESTION.options.find(o => o.option_text === 'Benar' && o.is_correct)) ? 'checked' : ''}
                    class="mt-1">
                <span class="text-lg">Benar</span>
            </label>
            <label class="flex gap-2 items-center">
                <input type="radio" name="truefalse_correct" value="0"
                    ${(QUESTION && QUESTION.options.find(o => o.option_text === 'Salah' && o.is_correct)) ? 'checked' : ''}
                    class="mt-1">
                <span class="text-lg">Salah</span>
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

        // Load existing short answers if editing
        if (QUESTION && QUESTION.type === 'short_answer') {
            const correctOptions = QUESTION.options.filter(opt => opt.is_correct);
            if (correctOptions.length > 0) {
                correctOptions.forEach((option, index) => {
                    addShortAnswer({
                        id: option.id,
                        text: option.option_text
                    }, index);
                });
            } else {
                addShortAnswer();
            }
        } else {
            addShortAnswer();
        }
    }

    function addShortAnswer(option = null, customIndex = null) {
        const index = customIndex !== null ? customIndex : shortAnswersWrapper.children.length;
        const optionId = option ? option.id : '';

        shortAnswersWrapper.insertAdjacentHTML('beforeend', `
        <div class="short-answer-item flex items-center gap-3 p-3 border rounded-lg">
            <input type="hidden" name="short_answers[${index}][id]" value="${optionId}">
            <input type="text" name="short_answers[${index}][text]"
                   value="${option ? option.text : ''}"
                   class="flex-1 rounded-lg border p-2
                          bg-azwara-lightest dark:bg-secondary/30
                          text-slate-800 dark:text-white"
                   placeholder="Masukkan jawaban...">
            <button type="button" class="remove-short-answer text-red-500 ${index === 0 ? 'hidden' : ''}">
                Hapus
            </button>
        </div>
        `);

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
            // Re-index inputs
            const items = shortAnswersWrapper.querySelectorAll('.short-answer-item');
            items.forEach((item, index) => {
                const inputs = item.querySelectorAll('input[name]');
                inputs.forEach(input => {
                    const name = input.getAttribute('name');
                    const newName = name.replace(/short_answers\[\d+\]/, `short_answers[${index}]`);
                    input.setAttribute('name', newName);
                });
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

        // Load existing sub items if editing
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

        compoundItemsWrapper.insertAdjacentHTML('beforeend', `
        <div class="compound-item border rounded-lg p-4 bg-white/50 dark:bg-secondary/20" data-index="${index}">
            <div class="flex justify-between items-center mb-3">
                <h3 class="font-semibold">Sub Pertanyaan ${label}</h3>
                <button type="button" class="remove-compound-item text-red-500 ${index === 0 ? 'hidden' : ''}">
                    Hapus
                </button>
            </div>

            <input type="hidden" name="sub_items[${index}][id]" value="${subItem ? subItem.id : ''}">
            <input type="hidden" name="sub_items[${index}][label]" value="${label}">

            <div class="space-y-3">
                <div>
                    <label class="block text-sm font-medium mb-1">Jenis Sub</label>
                    <select name="sub_items[${index}][type]"
                            class="sub-type-select w-full rounded-lg border p-2
                                   bg-azwara-lightest dark:bg-secondary/30
                                   text-slate-800 dark:text-white">
                        <option value="truefalse" ${subItem && subItem.type === 'truefalse' ? 'selected' : ''}>Benar/Salah</option>
                        <option value="short_answer" ${subItem && subItem.type === 'short_answer' ? 'selected' : ''}>Isian Singkat</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Pertanyaan</label>
                    <textarea name="sub_items[${index}][prompt]"
                              rows="2"
                              class="prompt-text w-full rounded-lg border p-2
                                     bg-azwara-lightest dark:bg-secondary/30
                                     text-slate-800 dark:text-white"
                              placeholder="Tulis pertanyaan sub...">${subItem ? subItem.prompt : ''}</textarea>
                    <button type="button" class="btn-open-math mt-1 text-sm underline">
                        + Sisipkan Rumus
                    </button>
                </div>

                <div class="sub-answer-section" data-index="${index}">
                    <!-- Answer fields will be rendered here based on type -->
                </div>
            </div>
        </div>
        `);

        // Initialize answer section
        renderCompoundAnswerSection(index, subItem ? subItem.type : 'truefalse', subItem);

        compoundIndex++;
        updateCompoundButtons();

        // Add event listener for type change
        const item = compoundItemsWrapper.lastElementChild;
        const typeSelect = item.querySelector('.sub-type-select');

        typeSelect.addEventListener('change', function() {
            const parent = this.closest('.compound-item');
            const idx = parseInt(parent.dataset.index);
            renderCompoundAnswerSection(idx, this.value);
        });
    }

    function renderCompoundAnswerSection(index, type, subItem = null) {
        const item = compoundItemsWrapper.querySelector(`.compound-item[data-index="${index}"]`);
        const section = item.querySelector('.sub-answer-section');

        if (type === 'truefalse') {
            let booleanAnswer = 1; // default to true
            if (subItem && subItem.answers && subItem.answers.length > 0) {
                booleanAnswer = subItem.answers[0].boolean_answer ? 1 : 0;
            }

            section.innerHTML = `
            <div class="space-y-2">
                <label class="block text-sm font-medium mb-1">Jawaban Benar</label>
                <div class="flex gap-4">
                    <label class="flex gap-2 items-center">
                        <input type="radio" name="sub_items[${index}][boolean_answer]" value="1" ${booleanAnswer == 1 ? 'checked' : ''}>
                        <span>Benar</span>
                    </label>
                    <label class="flex gap-2 items-center">
                        <input type="radio" name="sub_items[${index}][boolean_answer]" value="0" ${booleanAnswer == 0 ? 'checked' : ''}>
                        <span>Salah</span>
                    </label>
                </div>
            </div>
            `;
        } else if (type === 'short_answer') {
            const answers = subItem && subItem.answers ? subItem.answers : [];
            const primaryIndex = answers.findIndex(a => a.is_primary);

            section.innerHTML = `
            <div class="space-y-3">
                <label class="block text-sm font-medium mb-1">Jawaban Isian Singkat</label>
                <p class="text-xs text-gray-600 dark:text-gray-300">
                    Tambahkan semua kemungkinan jawaban yang benar
                </p>

                <div class="compound-short-answers space-y-2" data-index="${index}">
                    ${answers.length > 0 ? '' : `
                    <div class="flex items-center gap-2">
                        <input type="radio" name="sub_items[${index}][primary_index]" value="0" checked>
                        <input type="text" name="sub_items[${index}][answers][0][text]"
                               class="flex-1 rounded-lg border p-2
                                      bg-azwara-lightest dark:bg-secondary/30
                                      text-slate-800 dark:text-white"
                               placeholder="Jawaban...">
                        <button type="button" class="remove-compound-answer text-red-500 text-sm hidden">
                            Hapus
                        </button>
                    </div>
                    `}
                </div>

                <button type="button" class="add-compound-answer-btn text-sm text-primary" data-index="${index}">
                    + Tambah Jawaban Lain
                </button>
            </div>
            `;

            // Populate existing answers
            const container = section.querySelector('.compound-short-answers');
            if (answers.length > 0) {
                answers.forEach((answer, i) => {
                    const answerId = answer.id ? answer.id : '';
                    container.insertAdjacentHTML('beforeend', `
                    <div class="flex items-center gap-2">
                        <input type="hidden" name="sub_items[${index}][answers][${i}][id]" value="${answerId}">
                        <input type="radio" name="sub_items[${index}][primary_index]" value="${i}" ${i === primaryIndex ? 'checked' : ''}>
                        <input type="text" name="sub_items[${index}][answers][${i}][text]"
                               value="${answer.answer_text || ''}"
                               class="flex-1 rounded-lg border p-2
                                      bg-azwara-lightest dark:bg-secondary/30
                                      text-slate-800 dark:text-white"
                               placeholder="Jawaban...">
                        <button type="button" class="remove-compound-answer text-red-500 text-sm ${i === 0 ? 'hidden' : ''}">
                            Hapus
                        </button>
                    </div>
                    `);
                });
            }

            // Add event listener for adding more answers
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

        container.insertAdjacentHTML('beforeend', `
        <div class="flex items-center gap-2">
            <input type="hidden" name="sub_items[${index}][answers][${answerCount}][id]" value="${answerId}">
            <input type="radio" name="sub_items[${index}][primary_index]" value="${answerCount}">
            <input type="text" name="sub_items[${index}][answers][${answerCount}][text]"
                   value="${answer ? answer.answer_text : ''}"
                   class="flex-1 rounded-lg border p-2
                          bg-azwara-lightest dark:bg-secondary/30
                          text-slate-800 dark:text-white"
                   placeholder="Jawaban...">
            <button type="button" class="remove-compound-answer text-red-500 text-sm">
                Hapus
            </button>
        </div>
        `);

        updateCompoundAnswerButtons(index);
    }

    function updateCompoundAnswerButtons(index) {
        const item = compoundItemsWrapper.querySelector(`.compound-item[data-index="${index}"]`);
        const container = item.querySelector('.compound-short-answers');
        const items = container.querySelectorAll('.flex.items-center.gap-2');

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

    // Event delegation for compound section
    compoundItemsWrapper.addEventListener('click', e => {
        // Remove compound item
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

                title.textContent = `Sub Pertanyaan ${label}`;
                hiddenInput.value = label;

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
            const answerItem = e.target.closest('.flex.items-center.gap-2');
            const container = answerItem.closest('.compound-short-answers');
            const compoundItem = container.closest('.compound-item');
            const index = compoundItem.dataset.index;

            answerItem.remove();

            // Re-index answers
            const answers = container.querySelectorAll('.flex.items-center.gap-2');
            answers.forEach((itm, i) => {
                const radio = itm.querySelector('input[type="radio"]');
                const textInput = itm.querySelector('input[type="text"]');

                radio.value = i;
                radio.name = `sub_items[${index}][primary_index]`;
                textInput.name = `sub_items[${index}][answers][${i}][text]`;

                if (i === 0) radio.checked = true;
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
       EVENT DELEGATION FOR OPTIONS
    ====================== */
    optionsWrapper.addEventListener('click', e => {
        // Remove options
        if (e.target.classList.contains('btn-remove-option')) {
            const item = e.target.closest('.option-item');
            item.remove();

            // Re-index options
            const items = optionsWrapper.querySelectorAll('.option-item');
            items.forEach((item, index) => {
                const textarea = item.querySelector('textarea');
                const radio = item.querySelector('input[type="radio"], input[type="checkbox"]');

                textarea.name = `options[${index}][text]`;
                const hiddenId = item.querySelector('input[type="hidden"]');
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
       INITIALIZE
    ====================== */
    // Set initial type and load data
    if (QUESTION) {
        typeSelect.value = QUESTION.type;
    }
    toggleSections();

    // Render initial previews
    renderPreview();
    renderExplanationPreview();

    // sidebar docs
    const docs = document.getElementById('math-docs');
    document.getElementById('btn-open-docs').onclick =
        () => docs.classList.remove('translate-x-full');
    document.getElementById('close-docs').onclick =
        () => docs.classList.add('translate-x-full');
});
</script>
@endpush
