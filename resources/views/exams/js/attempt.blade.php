@push('script')
    <script>
    (function () {
        /* =====================================================
           SIDEBAR MANAGEMENT (navigasi soal, off-canvas mobile)

           Catatan penting soal ID:
           Elemen-nya bernama #examSidebar / #examSidebarOverlay,
           BUKAN #sidebar / #sidebarOverlay. Nama lama bentrok
           dengan aturan global di resources/css/app.css:

               @media (max-width: 767px) {
                   #sidebar:not(.-translate-x-full) {
                       transform: translateX(0);
                   }
               }

           Panel ini tidak memakai class `-translate-x-full`,
           sehingga selektor itu selalu cocok dan mengunci sidebar
           di posisi terbuka. Class `.open` tetap dicopot dengan
           benar oleh hideSidebar(), tapi tampilannya tidak pernah
           ikut tertutup. Kalau suatu saat id-nya diganti kembali
           ke "sidebar", bug itu langsung kambuh.

           Prinsip lain yang dipertahankan:
           1. State disimpan di SATU tempat: class `.open` pada
              panel dan `.active` pada backdrop. Tidak ada utility
              transform Tailwind di elemen yang sama, jadi tidak
              ada dua sistem yang berebut properti `transform`.
           2. Sidebar & backdrop `absolute` di dalam container
              konten yang berada di bawah header, sehingga tombol
              toggle secara struktural tidak mungkin tertutupi.
           3. matchMedia (bukan resize + innerWidth) supaya
              perpindahan mobile<->desktop terdeteksi akurat dan
              tidak ikut "goyang" saat address bar browser mobile
              muncul/hilang.
        ===================================================== */
        const sidebar   = document.getElementById('examSidebar');
        const overlay   = document.getElementById('examSidebarOverlay');
        const toggleBtn = document.getElementById('toggleSidebar');
        const closeBtn  = document.getElementById('closeSidebar');
        const mqDesktop = window.matchMedia('(min-width: 768px)');

        let overlayHideTimer = null;

        function isSidebarOpen() {
            return sidebar?.classList.contains('open') ?? false;
        }

        function showSidebar() {
            if (!sidebar || mqDesktop.matches) return;

            // Batalkan penyembunyian backdrop yang masih tertunda,
            // supaya tap buka-tutup-buka cepat tidak bikin backdrop
            // hilang padahal panelnya sedang terbuka.
            if (overlayHideTimer !== null) {
                window.clearTimeout(overlayHideTimer);
                overlayHideTimer = null;
            }

            sidebar.classList.add('open');
            overlay?.classList.remove('hidden');
            overlay?.classList.add('active');
            document.body.classList.add('sidebar-lock');
            toggleBtn?.setAttribute('aria-expanded', 'true');
            sidebar.setAttribute('aria-hidden', 'false');
        }

        function hideSidebar() {
            if (!sidebar) return;

            sidebar.classList.remove('open');
            overlay?.classList.remove('active');
            document.body.classList.remove('sidebar-lock');
            toggleBtn?.setAttribute('aria-expanded', 'false');
            sidebar.setAttribute('aria-hidden', 'true');

            // Setelah animasi selesai, sembunyikan backdrop dari
            // accessibility tree & interaksi supaya tidak jadi lapisan
            // "tak terlihat tapi masih menghalangi tap" di sebagian
            // browser mobile.
            if (overlayHideTimer !== null) {
                window.clearTimeout(overlayHideTimer);
            }
            overlayHideTimer = window.setTimeout(() => {
                overlayHideTimer = null;
                if (!isSidebarOpen()) overlay?.classList.add('hidden');
            }, 300);
        }

        function toggleSidebar() {
            if (isSidebarOpen()) {
                hideSidebar();
            } else {
                showSidebar();
            }
        }

        toggleBtn?.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            toggleSidebar();
        });

        closeBtn?.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            hideSidebar();
        });

        overlay?.addEventListener('click', function (e) {
            e.stopPropagation();
            hideSidebar();
        });

        // Expose untuk dipakai fungsi lain di file ini & handler lama
        window.showSidebar   = showSidebar;
        window.hideSidebar   = hideSidebar;
        window.isSidebarOpen = isSidebarOpen;

        // Tutup dengan tombol ESC
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && isSidebarOpen()) {
                hideSidebar();
            }
        });

        // Tutup saat tap di luar sidebar (mobile)
        document.addEventListener('click', function (e) {
            if (mqDesktop.matches || !isSidebarOpen()) return;
            if (sidebar?.contains(e.target)) return;
            if (toggleBtn?.contains(e.target)) return;
            hideSidebar();
        });

        // Reset state begitu viewport berpindah ke ukuran desktop
        mqDesktop.addEventListener('change', function (e) {
            if (!e.matches) return;

            if (overlayHideTimer !== null) {
                window.clearTimeout(overlayHideTimer);
                overlayHideTimer = null;
            }
            sidebar?.classList.remove('open');
            overlay?.classList.remove('active');
            overlay?.classList.add('hidden');
            document.body.classList.remove('sidebar-lock');
            sidebar?.removeAttribute('aria-hidden');
            toggleBtn?.setAttribute('aria-expanded', 'false');
        });

        // Pastikan state awal bersih (mis. saat halaman dipulihkan dari
        // bfcache setelah tombol "back", di mana class bisa tertinggal).
        if (mqDesktop.matches) {
            sidebar?.removeAttribute('aria-hidden');
        }
        document.body.classList.remove('sidebar-lock');

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
                forceSubmitNow();
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

        async function syncTimeWithServer() {
            try {
                const res = await fetch("{{ route('exams.time.sync', $attempt->exam) }}", {
                    headers: { 'Accept': 'application/json' }
                });
                if (res.ok) {
                    const data = await res.json();
                    remaining = data.remaining_seconds;
                }
            } catch (e) { /* biarkan, coba lagi nanti */ }
        }

        setInterval(syncTimeWithServer, 30000);

        /* =====================================================
           QUESTION NAVIGATION
        ===================================================== */
        let currentIndex = 0;
        const slides = document.querySelectorAll('.question-slide');
        const navButtons = document.querySelectorAll('.nav-btn');
        const totalQuestions = slides.length;

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

            if (navButtons[index]) {
                navButtons[index].classList.add('ring-4', 'ring-primary/30', 'scale-110', 'shadow-lg');
            }
        }

        function updateQuestionCounters() {
            // FIX: hitung dari attribute `data-answered`, bukan menebak dari
            // kombinasi class Tailwind (bg-green-100 dll). Cara lama gampang
            // desync begitu ada perubahan style/dark-mode, dan itulah kenapa
            // status "terjawab" kadang tidak ke-render lagi di mobile.
            let answeredCount = 0;
            navButtons.forEach(btn => {
                if (btn.dataset.answered === 'true') answeredCount++;
            });

            document.getElementById('answeredCount').textContent = answeredCount;
            document.getElementById('unansweredCount').textContent = totalQuestions - answeredCount;
        }

        function showQuestion(index) {
            slides.forEach(s => s.classList.add('hidden'));
            if (slides[index]) {
                slides[index].classList.remove('hidden');
                currentIndex = index;
                setActiveNav(index);
                updateSubmitButtonVisibility();

                // Tutup sidebar di mobile setelah pindah soal
                if (!mqDesktop.matches) {
                    hideSidebar();
                }

                // Update button states
                document.getElementById('prevBtn').disabled = index === 0;
            }
        }

        // Initialize
        setActiveNav(0);
        updateSubmitButtonVisibility();
        updateQuestionCounters();

        // Nav button click
        navButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                showQuestion(parseInt(btn.dataset.index));
            });
        });

        // Previous/Next buttons
        document.getElementById('prevBtn').addEventListener('click', () => {
            if (currentIndex > 0) showQuestion(currentIndex - 1);
        });

        document.getElementById('nextBtn').addEventListener('click', () => {
            if (currentIndex < totalQuestions - 1) showQuestion(currentIndex + 1);
        });

        /* =====================================================
           ANSWER HANDLING
        ===================================================== */
        let pendingSaves = [];

        async function saveAnswer(payload) {
            let resolveSave, rejectSave;
            const savePromise = new Promise((resolve, reject) => {
                resolveSave = resolve;
                rejectSave = reject;
            });

            pendingSaves.push(savePromise);

            try {
                const response = await fetch("{{ route('exams.answer.save', $attempt->exam) }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify(payload)
                });

                if (!response.ok) {
                    const err = await response.json().catch(() => ({}));
                    if (response.status === 403 && err.expired) {
                        clearInterval(timerInterval);
                        await forceSubmitNow();
                    }
                    resolveSave(false);
                    return false;
                }

                resolveSave(true);
                return true;
            } catch (e) {
                console.error('Save answer error:', e);
                resolveSave(false);
                return false;
            } finally {
                pendingSaves = pendingSaves.filter(p => p !== savePromise);
            }
        }

        async function forceSubmitNow() {
            if (pendingSaves.length > 0) {
                const timeout = new Promise((_, reject) =>
                    setTimeout(() => reject(new Error('Timeout')), 3000)
                );

                try {
                    await Promise.race([
                        Promise.allSettled(pendingSaves),
                        timeout
                    ]);
                } catch (e) {
                    console.warn('Force submit timeout, proceeding anyway');
                }
            }

            document.getElementById('auto-submit-form')?.submit();
        }

        function markAnswered(questionId, answered = true) {
            const slide = document.querySelector(`.question-slide[data-question-id="${questionId}"]`);
            let navBtn = null;

            if (slide) {
                const index = parseInt(slide.dataset.index);
                navBtn = document.querySelector(`.nav-btn[data-index="${index}"]`);
            }

            if (navBtn) {
                // FIX: data-answered adalah sumber kebenaran; class Tailwind
                // di bawah ini cuma untuk tampilan visual, keduanya selalu
                // di-set bersamaan supaya tidak pernah desync di mobile.
                navBtn.dataset.answered = answered ? 'true' : 'false';

                if (answered) {
                    navBtn.classList.remove('bg-gray-100', 'dark:bg-white/10', 'text-gray-700', 'dark:text-gray-300', 'border-gray-200', 'dark:border-white/15');
                    navBtn.classList.add('bg-green-100', 'dark:bg-green-900/30', 'text-green-800', 'dark:text-green-300', 'border-green-300', 'dark:border-green-700');
                } else {
                    navBtn.classList.remove('bg-green-100', 'dark:bg-green-900/30', 'text-green-800', 'dark:text-green-300', 'border-green-300', 'dark:border-green-700');
                    navBtn.classList.add('bg-gray-100', 'dark:bg-white/10', 'text-gray-700', 'dark:text-gray-300', 'border-gray-200', 'dark:border-white/15');
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

            label.addEventListener('click', async (e) => {
                if (input.type === 'radio') {
                    questionSlide?.querySelectorAll('.option-button input[type="radio"]').forEach(otherInput => {
                        if (otherInput !== input) {
                            otherInput.checked = false;
                            otherInput.closest('.option-button')?.classList.remove('selected');
                        }
                    });
                }

                input.checked = !input.checked;

                if (input.checked) {
                    container.classList.add('selected');
                } else {
                    container.classList.remove('selected');
                }

                const selected = Array.from(
                    questionSlide?.querySelectorAll('.answer-section input:checked') || []
                ).map(i => parseInt(i.value));

                if (selected.length > 0 || input.type === 'radio') {
                    const success = await saveAnswer({
                        question_id: questionId,
                        answer_type: questionType,
                        selected_options: selected
                    });
                    markAnswered(questionId, success);
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
                timeout = setTimeout(async () => {
                    const slide = this.closest('.question-slide');
                    const questionId = slide?.dataset.questionId;
                    const value = this.value.trim();

                    if (value) {
                        const success = await saveAnswer({
                            question_id: questionId,
                            answer_type: 'short_answer',
                            short_answer_value: value
                        });
                        markAnswered(questionId, success);
                    } else {
                        markAnswered(questionId, false);
                    }
                }, 500);
            });

            textarea.addEventListener('blur', async function () {
                clearTimeout(timeout);
                const slide = this.closest('.question-slide');
                const questionId = slide?.dataset.questionId;
                const value = this.value.trim();

                if (value) {
                    const success = await saveAnswer({
                        question_id: questionId,
                        answer_type: 'short_answer',
                        short_answer_value: value
                    });
                    markAnswered(questionId, success);
                } else {
                    markAnswered(questionId, false);
                }
            });
        });

        /* =====================================================
           COMPOUND QUESTION HANDLING
        ===================================================== */
        document.querySelectorAll('.truefalse-btn').forEach(button => {
            button.addEventListener('click', async function () {
                const subId = this.dataset.subId;
                const questionSlide = this.closest('.question-slide');
                const questionId = questionSlide?.dataset.questionId;
                const isTrue = this.textContent.includes('Benar');

                const otherBtn = questionSlide?.querySelector(`.truefalse-btn[data-sub-id="${subId}"]:not(:disabled)`);
                if (otherBtn && otherBtn !== this) {
                    otherBtn.classList.remove('border-green-500', 'bg-green-50', 'dark:bg-green-900/20', 'text-green-700', 'dark:text-green-300',
                        'border-red-500', 'bg-red-50', 'dark:bg-red-900/20', 'text-red-700', 'dark:text-red-300');
                }

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

                await collectAndSaveCompoundAnswers(questionSlide);
            });
        });

        document.querySelectorAll('.compound-short-answer').forEach(textarea => {
            let timeout;

            textarea.addEventListener('input', function () {
                clearTimeout(timeout);
                timeout = setTimeout(async () => {
                    const slide = this.closest('.question-slide');
                    await collectAndSaveCompoundAnswers(slide);
                }, 500);
            });

            textarea.addEventListener('blur', async function () {
                clearTimeout(timeout);
                const slide = this.closest('.question-slide');
                await collectAndSaveCompoundAnswers(slide);
            });
        });

        async function collectAndSaveCompoundAnswers(slide) {
            const questionId = slide?.dataset.questionId;
            const answers = [];

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

            if (answers.length > 0) {
                const success = await saveAnswer({
                    question_id: questionId,
                    answer_type: 'compound',
                    compound_answers: answers
                });
                markAnswered(questionId, success);
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
           INITIALIZATION - MARK ANSWERED QUESTIONS

           FIX BUG: sebelumnya cek `.truefalse-btn.selected` padahal
           class yang benar-benar dipakai saat klik adalah
           `border-green-500` / `border-red-500`. Akibatnya soal
           compound (benar/salah) yang sudah dijawab TIDAK PERNAH
           terdeteksi "terjawab" saat halaman dimuat ulang / pindah
           soal di mobile. Sekarang dicek dengan selector yang benar.
        ===================================================== */
        document.querySelectorAll('.question-slide').forEach(slide => {
            const questionId = slide.dataset.questionId;
            const hasAnswer = slide.querySelector('input:checked') ||
                slide.querySelector('.short-answer-input')?.value.trim() ||
                slide.querySelector('.truefalse-btn.border-green-500, .truefalse-btn.border-red-500') ||
                slide.querySelector('.compound-short-answer')?.value.trim();

            markAnswered(questionId, !!hasAnswer);
        });

        // Initialize MathJax if available
        if (typeof MathJax !== 'undefined') {
            MathJax.typesetPromise();
        }
    })();
    </script>
    <script>
    window.MathJax = {
        tex: {
            inlineMath: [['\\(', '\\)']]
        }
    };
    </script>

    <script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        if (typeof MathJax !== 'undefined') {
            MathJax.typesetPromise();
        }
    });
    </script>
@endpush
