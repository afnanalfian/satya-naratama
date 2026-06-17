@extends('layouts.app')

@section('content')
<div class="min-h-screen dark:from-gray-900 dark:to-gray-800 flex items-center justify-center p-4">
    <div class="max-w-lg w-full">
        {{-- Header Game --}}
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent">
                🧠 Math Master Challenge
            </h1>
            <p class="text-gray-500 dark:text-gray-400 mt-2">
                Selesaikan soal matematika sebelum waktu habis!
            </p>
        </div>

        {{-- Game Container --}}
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-6 md:p-8">
            {{-- Score & Timer --}}
            <div class="flex justify-between items-center mb-8">
                <div class="flex items-center space-x-2">
                    <div class="p-3 bg-blue-100 dark:bg-blue-900/30 rounded-xl">
                        <span class="text-2xl">🏆</span>
                    </div>
                    <div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">Skor</div>
                        <div class="text-2xl font-bold text-gray-800 dark:text-white" id="score">0</div>
                    </div>
                </div>

                <div class="flex items-center space-x-2">
                    <div class="p-3 bg-red-100 dark:bg-red-900/30 rounded-xl">
                        <span class="text-2xl">⏱️</span>
                    </div>
                    <div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">Waktu</div>
                        <div class="text-2xl font-bold text-gray-800 dark:text-white">
                            <span id="time">30</span>s
                        </div>
                    </div>
                </div>
            </div>

            {{-- Question Box --}}
            <div class="mb-8">
                <div class="text-sm text-gray-500 dark:text-gray-400 mb-2">Soal Matematika</div>
                <div class="bg-gradient-to-r from-blue-50 to-purple-50 dark:from-gray-700 dark:to-gray-900 rounded-xl p-6 border-2 border-dashed border-gray-200 dark:border-gray-700">
                    <div class="text-4xl font-bold text-gray-800 dark:text-white text-center" id="question">
                        5 + 3 = ?
                    </div>
                </div>
            </div>

            {{-- Input Answer --}}
            <div class="mb-8">
                <div class="text-sm text-gray-500 dark:text-gray-400 mb-2">Jawaban Kamu</div>
                <input
                    id="answer"
                    type="text"
                    inputmode="numeric"
                    pattern="[0-9\-]*"
                    class="w-full text-center text-3xl p-4 rounded-xl border-2 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-purple-500 focus:ring-2 focus:ring-purple-300 focus:outline-none transition"
                    placeholder="Ketik jawaban"
                    disabled
                    autocomplete="off"
                />
                <div class="text-xs text-gray-400 dark:text-gray-500 mt-2 text-center">
                    Tekan Enter untuk submit (Desktop) atau gunakan keyboard virtual di bawah
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="flex space-x-4 mb-6">
                <button
                    id="startBtn"
                    class="flex-1 py-3 bg-gradient-to-r from-green-500 to-emerald-600 text-white font-semibold rounded-xl hover:from-green-600 hover:to-emerald-700 transition transform hover:-translate-y-0.5 shadow-md"
                >
                    <div class="flex items-center justify-center space-x-2">
                        <span>🚀</span>
                        <span>Mulai Game</span>
                    </div>
                </button>

                <button
                    id="submitBtn"
                    class="flex-1 py-3 bg-gradient-to-r from-purple-500 to-pink-600 text-white font-semibold rounded-xl hover:from-purple-600 hover:to-pink-700 transition transform hover:-translate-y-0.5 shadow-md hidden"
                >
                    <div class="flex items-center justify-center space-x-2">
                        <span>✓</span>
                        <span>Submit Jawaban</span>
                    </div>
                </button>
            </div>

            {{-- Virtual Numeric Keyboard --}}
            <div id="keyboard" class="hidden">
                <div class="grid grid-cols-3 gap-3 mb-3">
                    <button class="keyboard-key" data-key="1">1</button>
                    <button class="keyboard-key" data-key="2">2</button>
                    <button class="keyboard-key" data-key="3">3</button>
                    <button class="keyboard-key" data-key="4">4</button>
                    <button class="keyboard-key" data-key="5">5</button>
                    <button class="keyboard-key" data-key="6">6</button>
                    <button class="keyboard-key" data-key="7">7</button>
                    <button class="keyboard-key" data-key="8">8</button>
                    <button class="keyboard-key" data-key="9">9</button>
                    <button class="keyboard-key" data-key="-">-</button>
                    <button class="keyboard-key" data-key="0">0</button>
                    <button class="keyboard-key bg-red-100 dark:bg-red-900/30" id="backspace">
                        ⌫
                    </button>
                </div>
                <div class="flex space-x-3">
                    <button class="flex-1 py-3 bg-gray-200 dark:bg-gray-700 rounded-xl hover:bg-gray-300 dark:hover:bg-gray-600 transition" id="clear">
                        Clear
                    </button>
                    <button class="flex-1 py-3 bg-blue-100 dark:bg-blue-900/30 rounded-xl hover:bg-blue-200 dark:hover:bg-blue-800/50 transition" id="enter">
                        Enter
                    </button>
                </div>
            </div>

            {{-- Game Stats --}}
            <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                <div class="grid grid-cols-3 gap-4 text-center">
                    <div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">Tipe Soal</div>
                        <div class="font-semibold text-gray-800 dark:text-white" id="questionType">-</div>
                    </div>
                    <div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">Level</div>
                        <div class="font-semibold text-gray-800 dark:text-white" id="level">Mudah</div>
                    </div>
                    <div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">Soal Terselesaikan</div>
                        <div class="font-semibold text-gray-800 dark:text-white" id="completed">0</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .keyboard-key {
        @apply py-3 text-xl font-semibold rounded-xl bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 active:bg-gray-300 dark:active:bg-gray-500 transition select-none;
    }

    .correct-answer {
        animation: correctPulse 0.5s ease;
    }

    .wrong-answer {
        animation: wrongShake 0.5s ease;
    }

    @keyframes correctPulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }

    @keyframes wrongShake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-10px); }
        75% { transform: translateX(10px); }
    }

    #answer:disabled {
        @apply opacity-50 cursor-not-allowed;
    }
</style>
@endpush

@push('scripts')
<script>
    let time = 30;
    let score = 0;
    let correctAnswer = null;
    let timer = null;
    let gameActive = false;
    let completedQuestions = 0;
    let questionType = '';

    const timeEl = document.getElementById('time');
    const questionEl = document.getElementById('question');
    const answerEl = document.getElementById('answer');
    const scoreEl = document.getElementById('score');
    const startBtn = document.getElementById('startBtn');
    const submitBtn = document.getElementById('submitBtn');
    const keyboardEl = document.getElementById('keyboard');
    const questionTypeEl = document.getElementById('questionType');
    const levelEl = document.getElementById('level');
    const completedEl = document.getElementById('completed');

    // Tipe soal matematika yang akan digunakan
    const questionTypes = [
        {
            name: 'Penjumlahan',
            generate: () => {
                const a = Math.floor(Math.random() * 20) + 1;
                const b = Math.floor(Math.random() * 20) + 1;
                return {
                    question: `${a} + ${b}`,
                    answer: a + b
                };
            }
        },
        {
            name: 'Pengurangan',
            generate: () => {
                const a = Math.floor(Math.random() * 20) + 10;
                const b = Math.floor(Math.random() * 10) + 1;
                return {
                    question: `${a} - ${b}`,
                    answer: a - b
                };
            }
        },
        {
            name: 'Perkalian',
            generate: () => {
                const a = Math.floor(Math.random() * 10) + 1;
                const b = Math.floor(Math.random() * 10) + 1;
                return {
                    question: `${a} × ${b}`,
                    answer: a * b
                };
            }
        },
        {
            name: 'Pembagian',
            generate: () => {
                const b = Math.floor(Math.random() * 8) + 2;
                const a = b * (Math.floor(Math.random() * 8) + 2);
                return {
                    question: `${a} ÷ ${b}`,
                    answer: a / b
                };
            }
        },
        {
            name: 'Pangkat 2',
            generate: () => {
                const a = Math.floor(Math.random() * 10) + 2;
                return {
                    question: `${a}²`,
                    answer: a * a
                };
            }
        },
        {
            name: 'Akar Kuadrat',
            generate: () => {
                const a = Math.floor(Math.random() * 10) + 2;
                const square = a * a;
                return {
                    question: `√${square}`,
                    answer: a
                };
            }
        },
        {
            name: 'Operasi Campuran',
            generate: () => {
                const a = Math.floor(Math.random() * 10) + 1;
                const b = Math.floor(Math.random() * 10) + 1;
                const c = Math.floor(Math.random() * 10) + 1;

                // Pilih pola operasi acak
                const patterns = [
                    { question: `(${a} + ${b}) × ${c}`, answer: (a + b) * c },
                    { question: `${a} × ${b} + ${c}`, answer: a * b + c },
                    { question: `${a} + ${b} × ${c}`, answer: a + b * c },
                    { question: `(${a} × ${b}) - ${c}`, answer: a * b - c }
                ];

                return patterns[Math.floor(Math.random() * patterns.length)];
            }
        }
    ];

    function randomQuestion() {
        // Pilih tipe soal berdasarkan level
        let typeIndex;
        if (score < 5) {
            typeIndex = Math.floor(Math.random() * 4); // 4 tipe pertama (lebih mudah)
        } else if (score < 10) {
            typeIndex = Math.floor(Math.random() * 6); // 6 tipe pertama
        } else {
            typeIndex = Math.floor(Math.random() * questionTypes.length); // Semua tipe
        }

        const selectedType = questionTypes[typeIndex];
        const questionData = selectedType.generate();

        questionEl.innerText = questionData.question;
        correctAnswer = questionData.answer;
        questionType = selectedType.name;
        questionTypeEl.innerText = questionType;

        // Update level berdasarkan skor
        if (score < 5) levelEl.innerText = "Mudah";
        else if (score < 10) levelEl.innerText = "Medium";
        else if (score < 15) levelEl.innerText = "Sulit";
        else levelEl.innerText = "Expert";
    }

    function startGame() {
        score = 0;
        completedQuestions = 0;
        time = 30;
        gameActive = true;

        scoreEl.innerText = score;
        timeEl.innerText = time;
        completedEl.innerText = completedQuestions;
        answerEl.disabled = false;
        answerEl.value = '';
        answerEl.focus();
        startBtn.disabled = true;
        submitBtn.classList.remove('hidden');
        keyboardEl.classList.remove('hidden');

        randomQuestion();

        // Timer
        timer = setInterval(() => {
            time--;
            timeEl.innerText = time;

            // Visual feedback untuk waktu hampir habis
            if (time <= 10) {
                timeEl.classList.add('text-red-500');
                if (time <= 5) {
                    timeEl.classList.add('animate-pulse');
                }
            }

            if (time <= 0) {
                endGame();
            }
        }, 1000);

        // Reset kelas warna timer
        timeEl.classList.remove('text-red-500', 'animate-pulse');
    }

    function endGame() {
        gameActive = false;
        clearInterval(timer);
        answerEl.disabled = true;
        submitBtn.classList.add('hidden');
        keyboardEl.classList.add('hidden');
        startBtn.disabled = false;

        // Sweet alert untuk hasil game
        const resultsHtml = `
            <div class="text-center">
                <div class="text-6xl mb-4">${score >= 10 ? '🎉' : score >= 5 ? '👍' : '😊'}</div>
                <h3 class="text-xl font-bold mb-2">Game Selesai!</h3>
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span>Skor Akhir:</span>
                        <span class="font-bold text-green-600">${score}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Soal Diselesaikan:</span>
                        <span class="font-bold">${completedQuestions}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Level Tertinggi:</span>
                        <span class="font-bold">${levelEl.innerText}</span>
                    </div>
                </div>
            </div>
        `;

        // Buat modal sederhana
        showModal(resultsHtml);
    }

    function checkAnswer() {
        if (!gameActive) return;

        const userAnswer = parseInt(answerEl.value);

        if (isNaN(userAnswer)) {
            answerEl.classList.add('wrong-answer');
            setTimeout(() => answerEl.classList.remove('wrong-answer'), 500);
            return;
        }

        if (userAnswer === correctAnswer) {
            // Jawaban benar
            score++;
            completedQuestions++;
            scoreEl.innerText = score;
            completedEl.innerText = completedQuestions;

            // Animasi feedback positif
            scoreEl.classList.add('correct-answer');
            setTimeout(() => scoreEl.classList.remove('correct-answer'), 500);

            // Tambah waktu bonus untuk jawaban cepat
            if (time < 25) {
                time += 2;
                timeEl.innerText = time;
            }
        } else {
            // Jawaban salah
            answerEl.classList.add('wrong-answer');
            setTimeout(() => answerEl.classList.remove('wrong-answer'), 500);

            // Kurangi waktu sebagai penalti
            time = Math.max(0, time - 2);
            timeEl.innerText = time;
        }

        // Reset input dan generate soal baru
        answerEl.value = '';
        randomQuestion();

        // Auto focus ke input
        answerEl.focus();
    }

    // Event Listeners
    startBtn.addEventListener('click', startGame);

    submitBtn.addEventListener('click', checkAnswer);

    answerEl.addEventListener('keypress', (e) => {
        if (e.key === 'Enter' && gameActive) {
            checkAnswer();
        }
    });

    // Keyboard virtual event listeners
    document.querySelectorAll('.keyboard-key').forEach(button => {
        button.addEventListener('click', () => {
            if (!gameActive) return;
            const key = button.getAttribute('data-key');
            answerEl.value += key;
            answerEl.focus();
        });
    });

    document.getElementById('backspace').addEventListener('click', () => {
        if (!gameActive) return;
        answerEl.value = answerEl.value.slice(0, -1);
        answerEl.focus();
    });

    document.getElementById('clear').addEventListener('click', () => {
        if (!gameActive) return;
        answerEl.value = '';
        answerEl.focus();
    });

    document.getElementById('enter').addEventListener('click', () => {
        if (!gameActive) return;
        checkAnswer();
    });

    // Fungsi untuk menampilkan modal hasil
    function showModal(content) {
        const modal = document.createElement('div');
        modal.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4';
        modal.innerHTML = `
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 max-w-md w-full transform transition-all scale-95 opacity-0 animate-modal">
                ${content}
                <div class="mt-6 flex space-x-3">
                    <button id="modalRestart" class="flex-1 py-3 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-xl font-semibold hover:from-green-600 hover:to-emerald-700 transition">
                        Main Lagi
                    </button>
                    <button id="modalClose" class="flex-1 py-3 bg-gray-200 dark:bg-gray-700 rounded-xl font-semibold hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                        Tutup
                    </button>
                </div>
            </div>
        `;

        document.body.appendChild(modal);

        // Animasi masuk
        setTimeout(() => {
            modal.querySelector('.animate-modal').classList.remove('scale-95', 'opacity-0');
            modal.querySelector('.animate-modal').classList.add('scale-100', 'opacity-100');
        }, 10);

        // Event listeners untuk tombol modal
        modal.querySelector('#modalRestart').addEventListener('click', () => {
            document.body.removeChild(modal);
            startGame();
        });

        modal.querySelector('#modalClose').addEventListener('click', () => {
            document.body.removeChild(modal);
        });
    }

    // Deteksi perangkat mobile untuk UX yang lebih baik
    function isMobile() {
        return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
    }

    // Inisialisasi berdasarkan perangkat
    if (isMobile()) {
        // Di mobile, fokus ke keyboard virtual
        answerEl.addEventListener('focus', (e) => {
            if (isMobile()) {
                e.preventDefault();
            }
        });
    } else {
        // Di desktop, auto focus ke input saat game dimulai
        // Tidak perlu keyboard virtual kecuali di-request
        keyboardEl.classList.add('hidden');
    }

    // Tambahkan style untuk animasi modal
    const style = document.createElement('style');
    style.textContent = `
        @keyframes modalIn {
            from {
                transform: scale(0.95);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .animate-modal {
            animation: modalIn 0.3s ease forwards;
        }
    `;
    document.head.appendChild(style);
</script>
@endpush
