@push('script')
<script>
/* =====================================================
   FULLSCREEN FUNCTION
===================================================== */
const fullscreenBtn = document.getElementById('fullscreenBtn');
fullscreenBtn?.addEventListener('click', () => {
    if (!document.fullscreenElement) {
        document.documentElement.requestFullscreen().catch(err => {
            console.log(`Error attempting to enable fullscreen: ${err.message}`);
        });
    } else {
        if (document.exitFullscreen) {
            document.exitFullscreen();
        }
    }
});

// Update fullscreen button icon
document.addEventListener('fullscreenchange', () => {
    const icon = fullscreenBtn?.querySelector('svg');
    if (icon) {
        if (document.fullscreenElement) {
            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 9V4.5a.5.5 0 00-1 0V9H4.5a.5.5 0 000 1H8v4.5a.5.5 0 001 0V10h3.5a.5.5 0 000-1H9z"/>';
        } else {
            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/>';
        }
    }
});

/* =====================================================
   TIMER
===================================================== */
const timerEl = document.getElementById('timer');
let remaining = parseInt(timerEl.dataset.remaining, 10);

function formatTime(seconds) {
    const h = Math.floor(seconds / 3600);
    const m = Math.floor((seconds % 3600) / 60);
    const s = seconds % 60;
    return h > 0
        ? `${h}:${m.toString().padStart(2, '0')}:${s.toString().padStart(2, '0')}`
        : `${m}:${s.toString().padStart(2, '0')}`;
}

timerEl.innerText = formatTime(remaining);

const timerInterval = setInterval(() => {
    if (remaining <= 0) {
        clearInterval(timerInterval);
        document.getElementById('auto-submit-form')?.submit();
        return;
    }
    remaining--;
    timerEl.innerText = formatTime(remaining);

    // Warning colors
    if (remaining <= 300) { // 5 minutes
        timerEl.classList.add('text-red-400');
        timerEl.classList.remove('text-white');
    } else if (remaining <= 600) { // 10 minutes
        timerEl.classList.add('text-yellow-400');
        timerEl.classList.remove('text-white');
    }
}, 1000);

/* =====================================================
   SIDEBAR MANAGEMENT
===================================================== */
const sidebar = document.getElementById('sidebar');
const overlay = document.getElementById('sidebarOverlay');
const toggleBtn = document.getElementById('toggleSidebar');
const closeBtn = document.getElementById('closeSidebar');

function showSidebar() {
    sidebar.classList.remove('translate-x-full');
    overlay.classList.remove('hidden');
}

function hideSidebar() {
    sidebar.classList.add('translate-x-full');
    overlay.classList.add('hidden');
}

toggleBtn?.addEventListener('click', showSidebar);
closeBtn?.addEventListener('click', hideSidebar);
overlay?.addEventListener('click', hideSidebar);

/* =====================================================
   QUESTION NAVIGATION
===================================================== */
let currentIndex = 0;
const slides = document.querySelectorAll('.question-slide');
const navButtons = document.querySelectorAll('.nav-btn');
const totalQuestions = slides.length;

// Show submit button only on last question
function updateSubmitButtonVisibility() {
    const submitForm = document.getElementById('auto-submit-form');
    const nextBtn = document.getElementById('nextBtn');

    if (currentIndex === totalQuestions - 1) {
        submitForm?.classList.remove('hidden');
        nextBtn?.classList.add('hidden');
    } else {
        submitForm?.classList.add('hidden');
        nextBtn?.classList.remove('hidden');
    }
}

function setActiveNav(index) {
    navButtons.forEach(btn => {
        btn.classList.remove('ring-4', 'ring-primary/30', 'scale-110', 'shadow-lg');
    });

    navButtons[index]?.classList.add('ring-4', 'ring-primary/30', 'scale-110', 'shadow-lg');
}

function updateQuestionCounters() {
    let answeredCount = 0;
    navButtons.forEach(btn => {
        if (btn.classList.contains('bg-green-100') || btn.classList.contains('dark:bg-green-900/30')) {
            answeredCount++;
        }
    });

    document.getElementById('answeredCount').textContent = answeredCount;
    document.getElementById('unansweredCount').textContent = totalQuestions - answeredCount;
}

function showQuestion(index) {
    slides.forEach(s => s.classList.add('hidden'));
    slides[index]?.classList.remove('hidden');
    currentIndex = index;
    setActiveNav(index);
    updateSubmitButtonVisibility();
    hideSidebar();

    // Update button states
    document.getElementById('prevBtn').disabled = index === 0;
}

setActiveNav(0);
updateSubmitButtonVisibility();
updateQuestionCounters();

navButtons.forEach(btn => {
    btn.addEventListener('click', () => {
        showQuestion(parseInt(btn.dataset.index));
    });
});

document.getElementById('prevBtn').addEventListener('click', () => {
    if (currentIndex > 0) showQuestion(currentIndex - 1);
});

document.getElementById('nextBtn').addEventListener('click', () => {
    if (currentIndex < totalQuestions - 1) showQuestion(currentIndex + 1);
});

/* =====================================================
   ANSWER HANDLING
===================================================== */
async function saveAnswer(payload) {
    try {
        const response = await fetch("{{ route('exams.answer.save', $attempt->exam) }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify(payload)
        });

        if (!response.ok) {
            const err = await response.json().catch(() => ({}));
            console.error('Save answer failed:', err);

            if (response.status === 403 && err.expired) {
                clearInterval(timerInterval);
                document.getElementById('auto-submit-form')?.submit();
            }
        }
    } catch (e) {
        console.error('Save answer error:', e);
    }
}

function markAnswered(questionId, answered = true) {
    const slide = document.querySelector(`.question-slide[data-question-id="${questionId}"]`);
    const navBtn = document.querySelector(`.nav-btn[data-index="${slide?.dataset.index}"]`);

    if (navBtn) {
        if (answered) {
            navBtn.classList.remove('bg-gray-100', 'dark:bg-azwara-medium/30', 'text-gray-700', 'dark:text-gray-300', 'border-gray-200', 'dark:border-azwara-medium');
            navBtn.classList.add('bg-green-100', 'dark:bg-green-900/30', 'text-green-800', 'dark:text-green-300', 'border-green-300', 'dark:border-green-700');
        } else {
            navBtn.classList.remove('bg-green-100', 'dark:bg-green-900/30', 'text-green-800', 'dark:text-green-300', 'border-green-300', 'dark:border-green-700');
            navBtn.classList.add('bg-gray-100', 'dark:bg-azwara-medium/30', 'text-gray-700', 'dark:text-gray-300', 'border-gray-200', 'dark:border-azwara-medium');
        }
    }

    updateQuestionCounters();
}

/* =====================================================
   MCQ / MCMA / TRUEFALSE - BUTTON STYLE
===================================================== */
document.querySelectorAll('.option-button').forEach(container => {
    const input = container.querySelector('input[type="radio"], input[type="checkbox"]');
    const label = container.querySelector('label');
    const questionSlide = container.closest('.question-slide');
    const questionId = questionSlide?.dataset.questionId;
    const questionType = questionSlide?.dataset.questionType;

    if (!input || !label) return;

    label.addEventListener('click', (e) => {
        if (input.type === 'radio') {
            // Deselect all other options in this question
            questionSlide?.querySelectorAll('.option-button input[type="radio"]').forEach(otherInput => {
                if (otherInput !== input) {
                    otherInput.checked = false;
                    otherInput.closest('.option-button')?.classList.remove('selected');
                }
            });
        }

        // Toggle current option
        input.checked = !input.checked;

        // Update visual state
        if (input.checked) {
            container.classList.add('selected');
        } else {
            container.classList.remove('selected');
        }

        // Collect selected options
        const selected = Array.from(
            questionSlide?.querySelectorAll('.answer-section input:checked') || []
        ).map(i => parseInt(i.value));

        // Save answer
        if (selected.length > 0 || input.type === 'radio') {
            saveAnswer({
                question_id: questionId,
                answer_type: questionType,
                selected_options: selected
            });

            markAnswered(questionId, true);
        } else {
            markAnswered(questionId, false);
        }
    });
});

/* =====================================================
   SHORT ANSWER
===================================================== */
document.querySelectorAll('.short-answer-input').forEach(textarea => {
    let timeout;

    textarea.addEventListener('input', function () {
        clearTimeout(timeout);

        timeout = setTimeout(() => {
            const slide = this.closest('.question-slide');
            const questionId = slide?.dataset.questionId;
            const value = this.value.trim();

            if (value) {
                saveAnswer({
                    question_id: questionId,
                    answer_type: 'short_answer',
                    short_answer_value: value
                });
                markAnswered(questionId, true);
            } else {
                markAnswered(questionId, false);
            }
        }, 800);
    });
});

/* =====================================================
   COMPOUND QUESTION HANDLING
===================================================== */
// True/False buttons
document.querySelectorAll('.truefalse-btn').forEach(button => {
    button.addEventListener('click', function() {
        const subId = this.dataset.subId;
        const questionSlide = this.closest('.question-slide');
        const questionId = questionSlide?.dataset.questionId;
        const isTrue = this.textContent.includes('Benar');
        const value = isTrue ? 1 : 0;

        // Deselect other button in same group
        const otherBtn = questionSlide?.querySelector(`.truefalse-btn[data-sub-id="${subId}"]:not(:disabled)`);
        if (otherBtn && otherBtn !== this) {
            otherBtn.classList.remove('border-green-500', 'bg-green-50', 'dark:bg-green-900/20', 'text-green-700', 'dark:text-green-300',
                                     'border-red-500', 'bg-red-50', 'dark:bg-red-900/20', 'text-red-700', 'dark:text-red-300');
        }

        // Toggle current button
        const isSelected = this.classList.contains('border-green-500') || this.classList.contains('border-red-500');
        if (isSelected) {
            this.classList.remove(isTrue ? 'border-green-500' : 'border-red-500',
                                 isTrue ? 'bg-green-50' : 'bg-red-50',
                                 isTrue ? 'dark:bg-green-900/20' : 'dark:bg-red-900/20',
                                 isTrue ? 'text-green-700' : 'text-red-700',
                                 isTrue ? 'dark:text-green-300' : 'dark:text-red-300');
        } else {
            this.classList.add(isTrue ? 'border-green-500' : 'border-red-500',
                              isTrue ? 'bg-green-50' : 'bg-red-50',
                              isTrue ? 'dark:bg-green-900/20' : 'dark:bg-red-900/20',
                              isTrue ? 'text-green-700' : 'text-red-700',
                              isTrue ? 'dark:text-green-300' : 'dark:text-red-300');
        }

        collectAndSaveCompoundAnswers(questionSlide);
    });
});

// Short answer in compound
document.querySelectorAll('.compound-short-answer').forEach(textarea => {
    let timeout;

    textarea.addEventListener('input', function() {
        clearTimeout(timeout);

        timeout = setTimeout(() => {
            const slide = this.closest('.question-slide');
            collectAndSaveCompoundAnswers(slide);
        }, 800);
    });
});

function collectAndSaveCompoundAnswers(slide) {
    const questionId = slide?.dataset.questionId;
    const answers = [];

    // Collect true/false answers
    slide?.querySelectorAll('.truefalse-btn').forEach(btn => {
        const subId = btn.dataset.subId;
        const isSelected = btn.classList.contains('border-green-500') || btn.classList.contains('border-red-500');

        if (isSelected) {
            answers.push({
                sub_id: parseInt(subId),
                type: 'truefalse',
                boolean: btn.classList.contains('border-green-500')
            });
        }
    });

    // Collect short answers
    slide?.querySelectorAll('.compound-short-answer').forEach(textarea => {
        const subId = textarea.dataset.subId;
        const value = textarea.value.trim();

        if (value) {
            answers.push({
                sub_id: parseInt(subId),
                type: 'short_answer',
                value: value
            });
        }
    });

    // Save if any answers exist
    if (answers.length > 0) {
        saveAnswer({
            question_id: questionId,
            answer_type: 'compound',
            compound_answers: answers
        });
        markAnswered(questionId, true);
    } else {
        markAnswered(questionId, false);
    }
}

/* =====================================================
   KEYBOARD NAVIGATION
===================================================== */
document.addEventListener('keydown', (e) => {
    if (e.key === 'ArrowLeft' || e.key === 'ArrowUp') {
        e.preventDefault();
        if (currentIndex > 0) showQuestion(currentIndex - 1);
    } else if (e.key === 'ArrowRight' || e.key === 'ArrowDown') {
        e.preventDefault();
        if (currentIndex < totalQuestions - 1) showQuestion(currentIndex + 1);
    } else if (e.key === 'Escape') {
        hideSidebar();
    }
});

/* =====================================================
   INITIALIZATION
===================================================== */
// Initialize MathJax if available
if (typeof MathJax !== 'undefined') {
    MathJax.typesetPromise();
}

// Mark initial answered questions
document.querySelectorAll('.question-slide').forEach(slide => {
    const questionId = slide.dataset.questionId;
    const hasAnswer = slide.querySelector('input:checked') ||
                     slide.querySelector('.short-answer-input')?.value.trim() ||
                     slide.querySelector('.truefalse-btn.selected') ||
                     slide.querySelector('.compound-short-answer')?.value.trim();

    if (hasAnswer) {
        markAnswered(questionId, true);
    }
});
</script>
<script>
window.MathJax = {
    tex: {
        inlineMath: [['\\(', '\\)']],
        displayMath: [['\\[', '\\]']]
    },
    options: {
        skipHtmlTags: ['script', 'noscript', 'style', 'textarea', 'pre'],
        ignoreHtmlClass: 'tex2jax_ignore',
        processHtmlClass: 'tex2jax_process'
    }
};
</script>

<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>

<script>
document.addEventListener('DOMContentLoaded', () => {
    if (window.MathJax && MathJax.typeset) {
        MathJax.typeset();
    }

    // Re-render MathJax when accordion opens
    document.addEventListener('alpine:init', () => {
        Alpine.data('mathJaxRenderer', () => ({
            renderMath() {
                if (window.MathJax && MathJax.typesetPromise) {
                    MathJax.typesetPromise();
                }
            }
        }));
    });
});
</script>
@endpush
