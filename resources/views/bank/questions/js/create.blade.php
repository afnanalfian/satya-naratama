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

    document.getElementById('btn-cancel-math')
        .onclick = closeMathModal;

    document.getElementById('close-math-modal')
        .onclick = closeMathModal;

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

        optionsWrapper.insertAdjacentHTML('beforeend', `
            <div class="option-item flex gap-3 items-start">

                ${!isTkp ? `
                    <input type="${isMcq ? 'radio' : 'checkbox'}"
                        name="${isMcq ? 'correct' : 'correct[]'}"
                        value="${optionIndex}"
                        class="mt-3">
                ` : ''}

                <div class="flex-1 space-y-2">

                    <textarea name="options[${optionIndex}][text]"
                        class="option-text w-full rounded-lg border p-2
                            bg-azwara-lightest dark:bg-secondary/30
                            text-slate-800 dark:text-white"
                        placeholder="Teks opsi..."></textarea>

                    ${!isTkp ? `
                        <input type="file"
                            name="options[${optionIndex}][image]"
                            accept="image/*"
                            class="block text-xs text-gray-600">
                    ` : ''}

                    ${isTkp ? `
                        <input type="number"
                            name="options[${optionIndex}][weight]"
                            class="w-32 rounded border p-1 text-sm"
                            placeholder="Bobot">
                    ` : ''}

                    <div class="flex gap-3 text-xs">
                        <button type="button"
                                class="btn-open-math underline">
                            + Rumus
                        </button>

                        <button type="button"
                                class="btn-remove-option text-red-500 ${optionIndex < 2 ? 'hidden' : ''}">
                            Hapus
                        </button>
                    </div>
                </div>
            </div>
        `);

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
        <div class="space-y-2">
            <label class="flex gap-2 items-center">
                <input type="radio" name="truefalse_correct" value="1" checked class="mt-1">
                <span class="text-lg">Benar</span>
            </label>
            <label class="flex gap-2 items-center">
                <input type="radio" name="truefalse_correct" value="0" class="mt-1">
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
        addShortAnswer();
    }

    function addShortAnswer() {
        const index = shortAnswersWrapper.children.length;

        shortAnswersWrapper.insertAdjacentHTML('beforeend', `
        <div class="short-answer-item flex items-center gap-3 p-3 border rounded-lg">
            <input type="text" name="short_answers[${index}][text]"
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

    addShortAnswerBtn?.addEventListener('click', addShortAnswer);

    document.addEventListener('click', e => {
        if (e.target.classList.contains('remove-short-answer')) {
            e.target.closest('.short-answer-item')?.remove();
            // Re-index inputs
            const items = shortAnswersWrapper.querySelectorAll('.short-answer-item');
            items.forEach((item, index) => {
                const input = item.querySelector('input[type="text"]');
                input.setAttribute('name', `short_answers[${index}][text]`);
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

        compoundItemsWrapper.insertAdjacentHTML('beforeend', `
        <div class="compound-item border rounded-lg p-4 bg-white/50 dark:bg-secondary/20" data-index="${index}">
            <div class="flex justify-between items-center mb-3">
                <h3 class="font-semibold">Sub Pertanyaan ${label}</h3>
                <button type="button" class="remove-compound-item text-red-500 ${index === 0 ? 'hidden' : ''}">
                    Hapus
                </button>
            </div>

            <input type="hidden" name="sub_items[${index}][id]" value="">
            <input type="hidden" name="sub_items[${index}][label]" value="${label}">

            <div class="space-y-3">
                <div>
                    <label class="block text-sm font-medium mb-1">Jenis Sub</label>
                    <select name="sub_items[${index}][type]"
                            class="sub-type-select w-full rounded-lg border p-2
                                   bg-azwara-lightest dark:bg-secondary/30
                                   text-slate-800 dark:text-white">
                        <option value="truefalse">Benar/Salah</option>
                        <option value="short_answer">Isian Singkat</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Pertanyaan</label>
                    <textarea name="sub_items[${index}][prompt]"
                              rows="2"
                              class="prompt-text w-full rounded-lg border p-2
                                     bg-azwara-lightest dark:bg-secondary/30
                                     text-slate-800 dark:text-white"
                              placeholder="Tulis pertanyaan sub..."></textarea>
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

        // Initialize answer section for this sub item
        renderCompoundAnswerSection(index, 'truefalse');

        compoundIndex++;
        updateCompoundButtons();

        // Add event listener for type change
        const subItem = compoundItemsWrapper.lastElementChild;
        const typeSelect = subItem.querySelector('.sub-type-select');

        typeSelect.addEventListener('change', function() {
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
            <div class="space-y-2">
                <label class="block text-sm font-medium mb-1">Jawaban Benar</label>
                <div class="flex gap-4">
                    <label class="flex gap-2 items-center">
                        <input type="radio" name="sub_items[${index}][boolean_answer]" value="1" checked>
                        <span>Benar</span>
                    </label>
                    <label class="flex gap-2 items-center">
                        <input type="radio" name="sub_items[${index}][boolean_answer]" value="0">
                        <span>Salah</span>
                    </label>
                </div>
            </div>
            `;
        } else if (type === 'short_answer') {
            section.innerHTML = `
            <div class="space-y-3">
                <label class="block text-sm font-medium mb-1">Jawaban Isian Singkat</label>
                <p class="text-xs text-gray-600 dark:text-gray-300">
                    Tambahkan semua kemungkinan jawaban yang benar
                </p>

                <div class="compound-short-answers space-y-2" data-index="${index}">
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
                </div>

                <button type="button" class="add-compound-answer-btn text-sm text-primary" data-index="${index}">
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

        container.insertAdjacentHTML('beforeend', `
        <div class="flex items-center gap-2">
            <input type="radio" name="sub_items[${index}][primary_index]" value="${answerCount}">
            <input type="text" name="sub_items[${index}][answers][${answerCount}][text]"
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

                textarea.name = `options[${index}][text]`;
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
    toggleSections();

    // sidebar docs
    const docs = document.getElementById('math-docs');
    document.getElementById('btn-open-docs').onclick =
        () => docs.classList.remove('translate-x-full');
    document.getElementById('close-docs').onclick =
        () => docs.classList.add('translate-x-full');

});
</script>
@endpush
