@extends('layouts.app')

@section('content')
<div class="min-h-screen">
    <div class="max-w-4xl mx-auto">

        {{-- Header --}}
        <div class="text-center mb-8">
            <h1 class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-emerald-600 to-green-500 bg-clip-text text-transparent">
                🐍 Snake Evolution
            </h1>
            <p class="text-gray-600 dark:text-gray-400 mt-2">
                Kontrol ular dan makan sebanyak-banyaknya!
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            {{-- Left Panel: Stats & Controls --}}
            <div class="md:col-span-1 space-y-6">
                {{-- Game Stats --}}
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-4 flex items-center">
                        <span class="mr-2">📊</span> Game Stats
                    </h2>

                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 dark:text-gray-400">Score</span>
                            <span class="text-2xl font-bold text-emerald-600" id="score">0</span>
                        </div>

                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 dark:text-gray-400">High Score</span>
                            <span class="text-xl font-bold text-purple-600" id="highScore">0</span>
                        </div>

                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 dark:text-gray-400">Length</span>
                            <span class="text-xl font-bold text-blue-600" id="snakeLength">1</span>
                        </div>

                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 dark:text-gray-400">Speed</span>
                            <span class="text-xl font-bold text-orange-600" id="gameSpeed">Normal</span>
                        </div>

                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 dark:text-gray-400">Food Eaten</span>
                            <span class="text-xl font-bold text-red-600" id="foodEaten">0</span>
                        </div>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="space-y-3">
                    <button onclick="resetGame()"
                            class="w-full py-3 bg-gradient-to-r from-emerald-500 to-green-600 text-white font-semibold rounded-xl hover:from-emerald-600 hover:to-green-700 transition transform hover:-translate-y-0.5 shadow-lg">
                        <div class="flex items-center justify-center space-x-2">
                            <span>🔄</span>
                            <span>Restart Game</span>
                        </div>
                    </button>

                    <button onclick="togglePause()"
                            id="pauseBtn"
                            class="w-full py-3 bg-gradient-to-r from-blue-500 to-cyan-600 text-white font-semibold rounded-xl hover:from-blue-600 hover:to-cyan-700 transition transform hover:-translate-y-0.5 shadow-lg">
                        <div class="flex items-center justify-center space-x-2">
                            <span>⏸️</span>
                            <span>Pause Game</span>
                        </div>
                    </button>

                    <button onclick="changeSpeed()"
                            class="w-full py-3 bg-gradient-to-r from-purple-500 to-pink-600 text-white font-semibold rounded-xl hover:from-purple-600 hover:to-pink-700 transition transform hover:-translate-y-0.5 shadow-lg">
                        <div class="flex items-center justify-center space-x-2">
                            <span>⚡</span>
                            <span>Change Speed</span>
                        </div>
                    </button>
                </div>
            </div>

            {{-- Game Canvas --}}
            <div class="md:col-span-2">
                <div class="relative bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-xl">
                    {{-- Game Info Bar --}}
                    <div class="flex justify-between items-center mb-4 px-2">
                        <div class="flex items-center space-x-2">
                            <div class="w-3 h-3 bg-emerald-500 rounded-full animate-pulse"></div>
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300" id="gameStatus">Playing</span>
                        </div>
                        <div class="text-sm text-gray-500">
                            Grid: <span id="gridSize">20×20</span>
                        </div>
                    </div>

                    {{-- Canvas Container --}}
                    <div class="relative">
                        <canvas
                            id="gameCanvas"
                            width="600"
                            height="600"
                            class="w-full max-w-full bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-900 dark:to-gray-800 border-2 border-gray-300 dark:border-gray-700 rounded-xl shadow-inner">
                        </canvas>

                        {{-- Pause Overlay --}}
                        <div id="pauseOverlay" class="hidden absolute inset-0 bg-black/70 flex items-center justify-center rounded-xl">
                            <div class="text-center p-8 bg-white/90 dark:bg-gray-800/90 rounded-2xl backdrop-blur-sm">
                                <div class="text-4xl mb-4">⏸️</div>
                                <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-2">Game Paused</h3>
                                <p class="text-gray-600 dark:text-gray-400 mb-4">Press space or click resume to continue</p>
                                <button onclick="togglePause()"
                                        class="px-6 py-2 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600 transition">
                                    Resume
                                </button>
                            </div>
                        </div>

                        {{-- Game Over Overlay --}}
                        <div id="gameOverOverlay" class="hidden absolute inset-0 bg-black/80 flex items-center justify-center rounded-xl">
                            <div class="text-center p-8 bg-gradient-to-br from-white to-gray-100 dark:from-gray-800 dark:to-gray-900 rounded-2xl max-w-md">
                                <div class="text-6xl mb-4">🎮</div>
                                <h3 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">Game Over!</h3>
                                <p class="text-gray-600 dark:text-gray-400 mb-6">Ular kamu menabrak dinding!</p>

                                <div class="space-y-3 mb-6">
                                    <div class="flex justify-between">
                                        <span>Final Score:</span>
                                        <span class="font-bold text-emerald-600" id="finalScore">0</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Snake Length:</span>
                                        <span class="font-bold text-blue-600" id="finalLength">1</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Food Eaten:</span>
                                        <span class="font-bold text-red-600" id="finalFood">0</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>High Score:</span>
                                        <span class="font-bold text-purple-600" id="finalHighScore">0</span>
                                    </div>
                                </div>

                                <button onclick="resetGame()"
                                        class="w-full py-3 bg-gradient-to-r from-emerald-500 to-green-600 text-white font-semibold rounded-xl hover:from-emerald-600 hover:to-green-700 transition mb-3">
                                    Play Again
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Mobile Touch Controls (Hidden on Desktop) --}}
        <div class="mt-8 md:hidden">
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg">
                <h3 class="text-center font-semibold text-gray-800 dark:text-white mb-4">Touch Controls</h3>
                <div class="grid grid-cols-3 gap-3">
                    <div></div>
                    <button onclick="changeDirection('UP')"
                            class="p-6 bg-gray-100 dark:bg-gray-700 rounded-xl active:bg-gray-200">
                        <span class="text-2xl">⬆️</span>
                    </button>
                    <div></div>

                    <button onclick="changeDirection('LEFT')"
                            class="p-6 bg-gray-100 dark:bg-gray-700 rounded-xl active:bg-gray-200">
                        <span class="text-2xl">⬅️</span>
                    </button>
                    <div class="flex items-center justify-center text-sm text-gray-500">Tap to move</div>
                    <button onclick="changeDirection('RIGHT')"
                            class="p-6 bg-gray-100 dark:bg-gray-700 rounded-xl active:bg-gray-200">
                        <span class="text-2xl">➡️</span>
                    </button>

                    <div></div>
                    <button onclick="changeDirection('DOWN')"
                            class="p-6 bg-gray-100 dark:bg-gray-700 rounded-xl active:bg-gray-200">
                        <span class="text-2xl">⬇️</span>
                    </button>
                    <div></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    @keyframes pulse-glow {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.7; }
    }

    @keyframes food-spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    @keyframes score-pop {
        0% { transform: scale(1); }
        50% { transform: scale(1.2); }
        100% { transform: scale(1); }
    }

    .snake-head {
        border-radius: 8px 8px 4px 4px;
    }

    .snake-body {
        border-radius: 6px;
    }

    .food-item {
        border-radius: 50%;
        animation: pulse-glow 2s infinite;
    }
</style>
@endpush

@push('scripts')
<script>
/* ================== CONFIGURATION ================== */
const canvas = document.getElementById('gameCanvas');
const ctx = canvas.getContext('2d');
const gridSize = 20;
const box = canvas.width / gridSize;

/* ================== GAME STATE ================== */
let snake = [];
let direction = 'RIGHT';
let nextDirection = 'RIGHT';
let food = {};
let score = 0;
let highScore = localStorage.getItem('snakeHighScore') || 0;
let foodEaten = 0;
let gameLoop = null;
let isPaused = false;
let gameOver = false;
let speed = 120; // ms
let speedLevels = [
    { name: "Slow", value: 180 },
    { name: "Normal", value: 120 },
    { name: "Fast", value: 80 },
    { name: "Extreme", value: 50 }
];
let currentSpeedIndex = 1;

/* ================== ELEMENTS ================== */
const scoreEl = document.getElementById('score');
const highScoreEl = document.getElementById('highScore');
const snakeLengthEl = document.getElementById('snakeLength');
const gameSpeedEl = document.getElementById('gameSpeed');
const foodEatenEl = document.getElementById('foodEaten');
const gameStatusEl = document.getElementById('gameStatus');
const pauseOverlay = document.getElementById('pauseOverlay');
const gameOverOverlay = document.getElementById('gameOverOverlay');
const pauseBtn = document.getElementById('pauseBtn');
const gridSizeEl = document.getElementById('gridSize');

/* ================== INITIALIZATION ================== */
function init() {
    // Reset game state
    snake = [
        { x: 10 * box, y: 10 * box }
    ];
    direction = 'RIGHT';
    nextDirection = 'RIGHT';
    score = 0;
    foodEaten = 0;
    gameOver = false;
    isPaused = false;

    // Update UI
    updateUI();
    generateFood();
    gameStatusEl.textContent = 'Playing';
    pauseOverlay.classList.add('hidden');
    gameOverOverlay.classList.add('hidden');
    pauseBtn.innerHTML = '<span>⏸️</span><span>Pause Game</span>';

    // Start game loop
    if (gameLoop) clearInterval(gameLoop);
    gameLoop = setInterval(update, speed);

    // Draw initial state
    draw();
}

/* ================== FOOD GENERATION ================== */
function generateFood() {
    let newFood;
    let onSnake;

    do {
        newFood = {
            x: Math.floor(Math.random() * gridSize) * box,
            y: Math.floor(Math.random() * gridSize) * box,
            type: Math.random() > 0.9 ? 'special' : 'normal' // 10% chance for special food
        };

        onSnake = snake.some(segment =>
            segment.x === newFood.x && segment.y === newFood.y
        );
    } while (onSnake);

    food = newFood;
}

/* ================== CONTROLS ================== */
function changeDirection(newDirection) {
    // Prevent 180-degree turns
    if (
        (newDirection === 'UP' && direction !== 'DOWN') ||
        (newDirection === 'DOWN' && direction !== 'UP') ||
        (newDirection === 'LEFT' && direction !== 'RIGHT') ||
        (newDirection === 'RIGHT' && direction !== 'LEFT')
    ) {
        nextDirection = newDirection;
    }
}

document.addEventListener('keydown', e => {
    if (gameOver) return;

    switch(e.key) {
        case 'ArrowUp': changeDirection('UP'); break;
        case 'ArrowDown': changeDirection('DOWN'); break;
        case 'ArrowLeft': changeDirection('LEFT'); break;
        case 'ArrowRight': changeDirection('RIGHT'); break;
        case ' ': togglePause(); break; // Space to pause
        case 'r': case 'R': resetGame(); break;
        case 's': case 'S': changeSpeed(); break;
    }
});

// Swipe controls for mobile
let touchStartX = 0;
let touchStartY = 0;

canvas.addEventListener('touchstart', e => {
    touchStartX = e.touches[0].clientX;
    touchStartY = e.touches[0].clientY;
    e.preventDefault();
});

canvas.addEventListener('touchmove', e => {
    e.preventDefault(); // Prevent scrolling while playing
});

canvas.addEventListener('touchend', e => {
    if (!touchStartX || gameOver || isPaused) return;

    const touchEndX = e.changedTouches[0].clientX;
    const touchEndY = e.changedTouches[0].clientY;

    const dx = touchEndX - touchStartX;
    const dy = touchEndY - touchStartY;

    // Determine swipe direction
    if (Math.abs(dx) > Math.abs(dy)) {
        // Horizontal swipe
        if (dx > 0) changeDirection('RIGHT');
        else changeDirection('LEFT');
    } else {
        // Vertical swipe
        if (dy > 0) changeDirection('DOWN');
        else changeDirection('UP');
    }

    touchStartX = 0;
    touchStartY = 0;
});

/* ================== GAME LOGIC ================== */
function update() {
    if (isPaused || gameOver) return;

    // Update direction
    direction = nextDirection;

    // Calculate new head position
    const head = { ...snake[0] };

    switch(direction) {
        case 'UP': head.y -= box; break;
        case 'DOWN': head.y += box; break;
        case 'LEFT': head.x -= box; break;
        case 'RIGHT': head.x += box; break;
    }

    // Check wall collision
    if (
        head.x < 0 || head.y < 0 ||
        head.x >= canvas.width || head.y >= canvas.height
    ) {
        endGame();
        return;
    }

    // Check self collision
    for (let segment of snake) {
        if (segment.x === head.x && segment.y === head.y) {
            endGame();
            return;
        }
    }

    // Add new head
    snake.unshift(head);

    // Check food collision
    if (head.x === food.x && head.y === food.y) {
        // Increase score based on food type
        const points = food.type === 'special' ? 5 : 1;
        score += points;
        foodEaten++;

        // Update high score
        if (score > highScore) {
            highScore = score;
            localStorage.setItem('snakeHighScore', highScore);
        }

        // Update UI with animation
        scoreEl.style.animation = 'score-pop 0.3s ease';
        setTimeout(() => scoreEl.style.animation = '', 300);

        // Increase speed every 5 foods
        if (foodEaten % 5 === 0 && currentSpeedIndex < speedLevels.length - 1) {
            currentSpeedIndex++;
            speed = speedLevels[currentSpeedIndex].value;
            clearInterval(gameLoop);
            gameLoop = setInterval(update, speed);
            gameSpeedEl.textContent = speedLevels[currentSpeedIndex].name;
        }

        generateFood();
        updateUI();
    } else {
        // Remove tail if no food eaten
        snake.pop();
    }

    // Update UI
    updateUI();
    draw();
}

/* ================== DRAWING ================== */
function draw() {
    // Clear canvas with gradient
    const gradient = ctx.createLinearGradient(0, 0, canvas.width, canvas.height);
    gradient.addColorStop(0, '#f8fafc');
    gradient.addColorStop(1, '#f1f5f9');
    ctx.fillStyle = gradient;
    ctx.fillRect(0, 0, canvas.width, canvas.height);

    // Draw grid (subtle)
    ctx.strokeStyle = 'rgba(0, 0, 0, 0.05)';
    ctx.lineWidth = 0.5;

    for (let x = 0; x <= canvas.width; x += box) {
        ctx.beginPath();
        ctx.moveTo(x, 0);
        ctx.lineTo(x, canvas.height);
        ctx.stroke();
    }

    for (let y = 0; y <= canvas.height; y += box) {
        ctx.beginPath();
        ctx.moveTo(0, y);
        ctx.lineTo(canvas.width, y);
        ctx.stroke();
    }

    // Draw snake
    snake.forEach((segment, index) => {
        if (index === 0) {
            // Snake head
            ctx.fillStyle = '#16a34a';
            ctx.fillRect(segment.x + 2, segment.y + 2, box - 4, box - 4);

            // Eyes
            ctx.fillStyle = 'white';
            const eyeSize = box / 8;
            const eyeOffset = box / 4;

            // Draw eyes based on direction
            let leftEyeX, leftEyeY, rightEyeX, rightEyeY;

            switch(direction) {
                case 'RIGHT':
                    leftEyeX = segment.x + box - eyeOffset;
                    leftEyeY = segment.y + eyeOffset;
                    rightEyeX = segment.x + box - eyeOffset;
                    rightEyeY = segment.y + box - eyeOffset * 2;
                    break;
                case 'LEFT':
                    leftEyeX = segment.x + eyeOffset;
                    leftEyeY = segment.y + eyeOffset;
                    rightEyeX = segment.x + eyeOffset;
                    rightEyeY = segment.y + box - eyeOffset * 2;
                    break;
                case 'UP':
                    leftEyeX = segment.x + eyeOffset;
                    leftEyeY = segment.y + eyeOffset;
                    rightEyeX = segment.x + box - eyeOffset * 2;
                    rightEyeY = segment.y + eyeOffset;
                    break;
                case 'DOWN':
                    leftEyeX = segment.x + eyeOffset;
                    leftEyeY = segment.y + box - eyeOffset;
                    rightEyeX = segment.x + box - eyeOffset * 2;
                    rightEyeY = segment.y + box - eyeOffset;
                    break;
            }

            ctx.beginPath();
            ctx.arc(leftEyeX, leftEyeY, eyeSize, 0, Math.PI * 2);
            ctx.fill();

            ctx.beginPath();
            ctx.arc(rightEyeX, rightEyeY, eyeSize, 0, Math.PI * 2);
            ctx.fill();

            // Pupils
            ctx.fillStyle = 'black';
            ctx.beginPath();
            ctx.arc(leftEyeX, leftEyeY, eyeSize / 2, 0, Math.PI * 2);
            ctx.fill();

            ctx.beginPath();
            ctx.arc(rightEyeX, rightEyeY, eyeSize / 2, 0, Math.PI * 2);
            ctx.fill();
        } else {
            // Snake body with gradient color
            const colorIntensity = Math.max(150, 255 - index * 3);
            ctx.fillStyle = `rgb(34, 197, ${colorIntensity})`;
            ctx.fillRect(segment.x + 3, segment.y + 3, box - 6, box - 6);

            // Body pattern
            if (index % 2 === 0) {
                ctx.fillStyle = 'rgba(255, 255, 255, 0.2)';
                ctx.fillRect(segment.x + box/3, segment.y + box/3, box/3, box/3);
            }
        }
    });

    // Draw food
    if (food.type === 'special') {
        // Special food (apple)
        ctx.fillStyle = '#ef4444';
        ctx.beginPath();
        ctx.arc(food.x + box/2, food.y + box/2, box/2 - 2, 0, Math.PI * 2);
        ctx.fill();

        // Apple stem
        ctx.fillStyle = '#8b5a2b';
        ctx.fillRect(food.x + box/2 - 1, food.y + 2, 2, 4);

        // Apple shine
        ctx.fillStyle = 'rgba(255, 255, 255, 0.3)';
        ctx.beginPath();
        ctx.arc(food.x + box/2 - 3, food.y + box/2 - 3, 2, 0, Math.PI * 2);
        ctx.fill();
    } else {
        // Normal food
        ctx.fillStyle = '#ef4444';
        ctx.beginPath();
        ctx.arc(food.x + box/2, food.y + box/2, box/2 - 2, 0, Math.PI * 2);
        ctx.fill();

        // Food shine
        ctx.fillStyle = 'rgba(255, 255, 255, 0.5)';
        ctx.beginPath();
        ctx.arc(food.x + box/2 - 2, food.y + box/2 - 2, 2, 0, Math.PI * 2);
        ctx.fill();
    }

    // Draw score on canvas
    ctx.fillStyle = '#6b7280';
    ctx.font = 'bold 16px Arial';
    ctx.textAlign = 'right';
    ctx.fillText(`Score: ${score}`, canvas.width - 10, 25);
    ctx.fillText(`High: ${highScore}`, canvas.width - 10, 45);
}

/* ================== GAME CONTROLS ================== */
function togglePause() {
    if (gameOver) return;

    isPaused = !isPaused;

    if (isPaused) {
        gameStatusEl.textContent = 'Paused';
        pauseOverlay.classList.remove('hidden');
        pauseBtn.innerHTML = '<span>▶️</span><span>Resume Game</span>';
    } else {
        gameStatusEl.textContent = 'Playing';
        pauseOverlay.classList.add('hidden');
        pauseBtn.innerHTML = '<span>⏸️</span><span>Pause Game</span>';
    }
}

function changeSpeed() {
    currentSpeedIndex = (currentSpeedIndex + 1) % speedLevels.length;
    speed = speedLevels[currentSpeedIndex].value;
    gameSpeedEl.textContent = speedLevels[currentSpeedIndex].name;

    if (!isPaused && !gameOver) {
        clearInterval(gameLoop);
        gameLoop = setInterval(update, speed);
    }
}

function resetGame() {
    init();
}

/* ================== GAME OVER ================== */
function endGame() {
    gameOver = true;
    gameStatusEl.textContent = 'Game Over';
    clearInterval(gameLoop);

    // Update final stats
    document.getElementById('finalScore').textContent = score;
    document.getElementById('finalLength').textContent = snake.length;
    document.getElementById('finalFood').textContent = foodEaten;
    document.getElementById('finalHighScore').textContent = highScore;

    // Show game over overlay
    setTimeout(() => {
        gameOverOverlay.classList.remove('hidden');
    }, 500);
}

/* ================== UI UPDATES ================== */
function updateUI() {
    scoreEl.textContent = score;
    highScoreEl.textContent = highScore;
    snakeLengthEl.textContent = snake.length;
    foodEatenEl.textContent = foodEaten;
    gridSizeEl.textContent = `${gridSize}×${gridSize}`;
}

/* ================== START GAME ================== */
// Initialize game
highScoreEl.textContent = highScore;
init();

// Handle window resize
window.addEventListener('resize', () => {
    draw();
});
</script>
@endpush
