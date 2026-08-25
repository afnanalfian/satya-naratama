{{-- SIDEBAR DOKUMENTASI MATH (FULL & AMAN UNTUK MATHQUILL) --}}
<div id="math-docs"
     class="fixed top-0 right-0 h-full w-[380px]
            bg-white dark:bg-primary-950/95
            text-primary-800 dark:text-primary-100
            shadow-2xl border-l border-primary-200/50 dark:border-primary-700/30
            transform translate-x-full
            transition-transform duration-300 ease-in-out
            z-50 flex flex-col">

    {{-- HEADER --}}
    <div class="flex items-center justify-between p-5 border-b border-primary-200/50 dark:border-primary-700/30 bg-primary-50/30 dark:bg-primary-900/20">
        <h3 class="font-bold text-lg text-primary-800 dark:text-primary-100 flex items-center gap-2">
            <svg class="w-5 h-5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
            </svg>
            MathQuill · Cheat Sheet
        </h3>
        <button id="close-docs"
                class="text-secondary-400 hover:text-red-500 dark:text-secondary-500 dark:hover:text-red-400 transition-colors duration-200 p-1 rounded-lg hover:bg-red-50 dark:hover:bg-red-900/20">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    {{-- CONTENT --}}
    <div class="flex-1 overflow-y-auto p-4 space-y-3 text-sm scrollbar-thin scrollbar-thumb-primary-300/50 dark:scrollbar-thumb-primary-600/30 scrollbar-track-transparent">

        {{-- AKAR & PANGKAT --}}
        <details class="group bg-primary-50/50 dark:bg-primary-800/20 rounded-xl border border-primary-200/30 dark:border-primary-700/30 overflow-hidden transition-all hover:border-primary-300/50 dark:hover:border-primary-600/50">
            <summary class="cursor-pointer px-4 py-3 font-semibold flex justify-between items-center text-primary-800 dark:text-primary-100 hover:text-primary-600 dark:hover:text-primary-300 transition-colors">
                <span class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                    √ · ⁿ√ · x² · xᵢ
                </span>
                <span class="group-open:rotate-90 transition-transform duration-200 text-secondary-400">›</span>
            </summary>
            <div class="px-4 pb-4 space-y-2.5">
                <div class="flex items-center justify-between p-2 rounded-lg bg-white dark:bg-primary-800/20 border border-primary-100 dark:border-primary-700/30">
                    <span>√x</span>
                    <code class="text-xs bg-primary-100 dark:bg-primary-800/50 px-2 py-1 rounded text-primary-700 dark:text-primary-300">\sqrt{x}</code>
                </div>
                <div class="flex items-center justify-between p-2 rounded-lg bg-white dark:bg-primary-800/20 border border-primary-100 dark:border-primary-700/30">
                    <span>³√x (akar pangkat n)</span>
                    <code class="text-xs bg-primary-100 dark:bg-primary-800/50 px-2 py-1 rounded text-primary-700 dark:text-primary-300">\nthroot{3}{x}</code>
                </div>
                <div class="flex items-center justify-between p-2 rounded-lg bg-white dark:bg-primary-800/20 border border-primary-100 dark:border-primary-700/30">
                    <span>x²</span>
                    <code class="text-xs bg-primary-100 dark:bg-primary-800/50 px-2 py-1 rounded text-primary-700 dark:text-primary-300">x^2</code>
                </div>
                <div class="flex items-center justify-between p-2 rounded-lg bg-white dark:bg-primary-800/20 border border-primary-100 dark:border-primary-700/30">
                    <span>xⁿ</span>
                    <code class="text-xs bg-primary-100 dark:bg-primary-800/50 px-2 py-1 rounded text-primary-700 dark:text-primary-300">x^n</code>
                </div>
                <div class="flex items-center justify-between p-2 rounded-lg bg-white dark:bg-primary-800/20 border border-primary-100 dark:border-primary-700/30">
                    <span>xᵢ</span>
                    <code class="text-xs bg-primary-100 dark:bg-primary-800/50 px-2 py-1 rounded text-primary-700 dark:text-primary-300">x_i</code>
                </div>
                <div class="flex items-center justify-between p-2 rounded-lg bg-white dark:bg-primary-800/20 border border-primary-100 dark:border-primary-700/30">
                    <span>xᵢⱼ</span>
                    <code class="text-xs bg-primary-100 dark:bg-primary-800/50 px-2 py-1 rounded text-primary-700 dark:text-primary-300">x_{i,j}</code>
                </div>
                <div class="mt-2 p-3 rounded-lg bg-accent-50/50 dark:bg-accent-900/20 border border-accent-200/50 dark:border-accent-800/30 text-xs text-accent-700 dark:text-accent-300">
                    <span class="font-semibold">⚠️ Penting:</span> Untuk akar berpangkat, <strong>JANGAN</strong> ketik <code class="bg-accent-100 dark:bg-accent-800/30 px-1.5 py-0.5 rounded">\sqrt[n]{x}</code> secara manual. Gunakan <code class="bg-accent-100 dark:bg-accent-800/30 px-1.5 py-0.5 rounded">\nthroot{n}{x}</code>.
                </div>
            </div>
        </details>

        {{-- PECAHAN & DELIMITER --}}
        <details class="group bg-primary-50/50 dark:bg-primary-800/20 rounded-xl border border-primary-200/30 dark:border-primary-700/30 overflow-hidden transition-all hover:border-primary-300/50 dark:hover:border-primary-600/50">
            <summary class="cursor-pointer px-4 py-3 font-semibold flex justify-between items-center text-primary-800 dark:text-primary-100 hover:text-primary-600 dark:hover:text-primary-300 transition-colors">
                <span class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    a/b · ( ) · |x|
                </span>
                <span class="group-open:rotate-90 transition-transform duration-200 text-secondary-400">›</span>
            </summary>
            <div class="px-4 pb-4 space-y-2.5">
                <div class="flex items-center justify-between p-2 rounded-lg bg-white dark:bg-primary-800/20 border border-primary-100 dark:border-primary-700/30">
                    <span>a/b</span>
                    <code class="text-xs bg-primary-100 dark:bg-primary-800/50 px-2 py-1 rounded text-primary-700 dark:text-primary-300">\frac{a}{b}</code>
                </div>
                <div class="flex items-center justify-between p-2 rounded-lg bg-white dark:bg-primary-800/20 border border-primary-100 dark:border-primary-700/30">
                    <span>(x)</span>
                    <code class="text-xs bg-primary-100 dark:bg-primary-800/50 px-2 py-1 rounded text-primary-700 dark:text-primary-300">(x)</code>
                </div>
                <div class="flex items-center justify-between p-2 rounded-lg bg-white dark:bg-primary-800/20 border border-primary-100 dark:border-primary-700/30">
                    <span>[x]</span>
                    <code class="text-xs bg-primary-100 dark:bg-primary-800/50 px-2 py-1 rounded text-primary-700 dark:text-primary-300">[x]</code>
                </div>
                <div class="flex items-center justify-between p-2 rounded-lg bg-white dark:bg-primary-800/20 border border-primary-100 dark:border-primary-700/30">
                    <span>{x}</span>
                    <code class="text-xs bg-primary-100 dark:bg-primary-800/50 px-2 py-1 rounded text-primary-700 dark:text-primary-300">\{x\}</code>
                </div>
                <div class="flex items-center justify-between p-2 rounded-lg bg-white dark:bg-primary-800/20 border border-primary-100 dark:border-primary-700/30">
                    <span>|x|</span>
                    <code class="text-xs bg-primary-100 dark:bg-primary-800/50 px-2 py-1 rounded text-primary-700 dark:text-primary-300">|x| (pakai tanda pipa)</code>
                </div>
            </div>
        </details>

        {{-- KALKULUS --}}
        <details class="group bg-primary-50/50 dark:bg-primary-800/20 rounded-xl border border-primary-200/30 dark:border-primary-700/30 overflow-hidden transition-all hover:border-primary-300/50 dark:hover:border-primary-600/50">
            <summary class="cursor-pointer px-4 py-3 font-semibold flex justify-between items-center text-primary-800 dark:text-primary-100 hover:text-primary-600 dark:hover:text-primary-300 transition-colors">
                <span class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-6 3v-3m-5 7h16a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    ∑ · ∫ · lim
                </span>
                <span class="group-open:rotate-90 transition-transform duration-200 text-secondary-400">›</span>
            </summary>
            <div class="px-4 pb-4 space-y-2.5">
                <div class="flex items-center justify-between p-2 rounded-lg bg-white dark:bg-primary-800/20 border border-primary-100 dark:border-primary-700/30">
                    <span>∑</span>
                    <code class="text-xs bg-primary-100 dark:bg-primary-800/50 px-2 py-1 rounded text-primary-700 dark:text-primary-300">\sum</code>
                </div>
                <div class="flex items-center justify-between p-2 rounded-lg bg-white dark:bg-primary-800/20 border border-primary-100 dark:border-primary-700/30">
                    <span>∑ᵢⁿ</span>
                    <code class="text-xs bg-primary-100 dark:bg-primary-800/50 px-2 py-1 rounded text-primary-700 dark:text-primary-300">\sum_{i=1}^{n}</code>
                </div>
                <div class="flex items-center justify-between p-2 rounded-lg bg-white dark:bg-primary-800/20 border border-primary-100 dark:border-primary-700/30">
                    <span>∫</span>
                    <code class="text-xs bg-primary-100 dark:bg-primary-800/50 px-2 py-1 rounded text-primary-700 dark:text-primary-300">\int</code>
                </div>
                <div class="flex items-center justify-between p-2 rounded-lg bg-white dark:bg-primary-800/20 border border-primary-100 dark:border-primary-700/30">
                    <span>∫ₐᵇ</span>
                    <code class="text-xs bg-primary-100 dark:bg-primary-800/50 px-2 py-1 rounded text-primary-700 dark:text-primary-300">\int_a^b</code>
                </div>
                <div class="flex items-center justify-between p-2 rounded-lg bg-white dark:bg-primary-800/20 border border-primary-100 dark:border-primary-700/30">
                    <span>lim</span>
                    <code class="text-xs bg-primary-100 dark:bg-primary-800/50 px-2 py-1 rounded text-primary-700 dark:text-primary-300">\lim_{x \to 0}</code>
                </div>
            </div>
        </details>

        {{-- TRIGONOMETRI --}}
        <details class="group bg-primary-50/50 dark:bg-primary-800/20 rounded-xl border border-primary-200/30 dark:border-primary-700/30 overflow-hidden transition-all hover:border-primary-300/50 dark:hover:border-primary-600/50">
            <summary class="cursor-pointer px-4 py-3 font-semibold flex justify-between items-center text-primary-800 dark:text-primary-100 hover:text-primary-600 dark:hover:text-primary-300 transition-colors">
                <span class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    sin · cos · tan
                </span>
                <span class="group-open:rotate-90 transition-transform duration-200 text-secondary-400">›</span>
            </summary>
            <div class="px-4 pb-4 space-y-2.5">
                <div class="flex items-center justify-between p-2 rounded-lg bg-white dark:bg-primary-800/20 border border-primary-100 dark:border-primary-700/30">
                    <span>sin x</span>
                    <code class="text-xs bg-primary-100 dark:bg-primary-800/50 px-2 py-1 rounded text-primary-700 dark:text-primary-300">\sin x</code>
                </div>
                <div class="flex items-center justify-between p-2 rounded-lg bg-white dark:bg-primary-800/20 border border-primary-100 dark:border-primary-700/30">
                    <span>cos x</span>
                    <code class="text-xs bg-primary-100 dark:bg-primary-800/50 px-2 py-1 rounded text-primary-700 dark:text-primary-300">\cos x</code>
                </div>
                <div class="flex items-center justify-between p-2 rounded-lg bg-white dark:bg-primary-800/20 border border-primary-100 dark:border-primary-700/30">
                    <span>tan x</span>
                    <code class="text-xs bg-primary-100 dark:bg-primary-800/50 px-2 py-1 rounded text-primary-700 dark:text-primary-300">\tan x</code>
                </div>
                <div class="flex items-center justify-between p-2 rounded-lg bg-white dark:bg-primary-800/20 border border-primary-100 dark:border-primary-700/30">
                    <span>log x</span>
                    <code class="text-xs bg-primary-100 dark:bg-primary-800/50 px-2 py-1 rounded text-primary-700 dark:text-primary-300">\log x</code>
                </div>
                <div class="flex items-center justify-between p-2 rounded-lg bg-white dark:bg-primary-800/20 border border-primary-100 dark:border-primary-700/30">
                    <span>ln x</span>
                    <code class="text-xs bg-primary-100 dark:bg-primary-800/50 px-2 py-1 rounded text-primary-700 dark:text-primary-300">\ln x</code>
                </div>
            </div>
        </details>

        {{-- RELASI --}}
        <details class="group bg-primary-50/50 dark:bg-primary-800/20 rounded-xl border border-primary-200/30 dark:border-primary-700/30 overflow-hidden transition-all hover:border-primary-300/50 dark:hover:border-primary-600/50">
            <summary class="cursor-pointer px-4 py-3 font-semibold flex justify-between items-center text-primary-800 dark:text-primary-100 hover:text-primary-600 dark:hover:text-primary-300 transition-colors">
                <span class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                    </svg>
                    = · ≠ · ≤ · ≥
                </span>
                <span class="group-open:rotate-90 transition-transform duration-200 text-secondary-400">›</span>
            </summary>
            <div class="px-4 pb-4 space-y-2.5">
                <div class="flex items-center justify-between p-2 rounded-lg bg-white dark:bg-primary-800/20 border border-primary-100 dark:border-primary-700/30">
                    <span>=</span>
                    <code class="text-xs bg-primary-100 dark:bg-primary-800/50 px-2 py-1 rounded text-primary-700 dark:text-primary-300">=</code>
                </div>
                <div class="flex items-center justify-between p-2 rounded-lg bg-white dark:bg-primary-800/20 border border-primary-100 dark:border-primary-700/30">
                    <span>≠</span>
                    <code class="text-xs bg-primary-100 dark:bg-primary-800/50 px-2 py-1 rounded text-primary-700 dark:text-primary-300">\neq</code>
                </div>
                <div class="flex items-center justify-between p-2 rounded-lg bg-white dark:bg-primary-800/20 border border-primary-100 dark:border-primary-700/30">
                    <span>≤</span>
                    <code class="text-xs bg-primary-100 dark:bg-primary-800/50 px-2 py-1 rounded text-primary-700 dark:text-primary-300">\leq</code>
                </div>
                <div class="flex items-center justify-between p-2 rounded-lg bg-white dark:bg-primary-800/20 border border-primary-100 dark:border-primary-700/30">
                    <span>≥</span>
                    <code class="text-xs bg-primary-100 dark:bg-primary-800/50 px-2 py-1 rounded text-primary-700 dark:text-primary-300">\geq</code>
                </div>
                <div class="flex items-center justify-between p-2 rounded-lg bg-white dark:bg-primary-800/20 border border-primary-100 dark:border-primary-700/30">
                    <span>≈</span>
                    <code class="text-xs bg-primary-100 dark:bg-primary-800/50 px-2 py-1 rounded text-primary-700 dark:text-primary-300">\approx</code>
                </div>
            </div>
        </details>

        {{-- SIMBOL UMUM --}}
        <details class="group bg-primary-50/50 dark:bg-primary-800/20 rounded-xl border border-primary-200/30 dark:border-primary-700/30 overflow-hidden transition-all hover:border-primary-300/50 dark:hover:border-primary-600/50">
            <summary class="cursor-pointer px-4 py-3 font-semibold flex justify-between items-center text-primary-800 dark:text-primary-100 hover:text-primary-600 dark:hover:text-primary-300 transition-colors">
                <span class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"/>
                    </svg>
                    → · ∞ · π
                </span>
                <span class="group-open:rotate-90 transition-transform duration-200 text-secondary-400">›</span>
            </summary>
            <div class="px-4 pb-4 space-y-2.5">
                <div class="flex items-center justify-between p-2 rounded-lg bg-white dark:bg-primary-800/20 border border-primary-100 dark:border-primary-700/30">
                    <span>→</span>
                    <code class="text-xs bg-primary-100 dark:bg-primary-800/50 px-2 py-1 rounded text-primary-700 dark:text-primary-300">\to</code>
                </div>
                <div class="flex items-center justify-between p-2 rounded-lg bg-white dark:bg-primary-800/20 border border-primary-100 dark:border-primary-700/30">
                    <span>∞</span>
                    <code class="text-xs bg-primary-100 dark:bg-primary-800/50 px-2 py-1 rounded text-primary-700 dark:text-primary-300">\infty</code>
                </div>
                <div class="flex items-center justify-between p-2 rounded-lg bg-white dark:bg-primary-800/20 border border-primary-100 dark:border-primary-700/30">
                    <span>π</span>
                    <code class="text-xs bg-primary-100 dark:bg-primary-800/50 px-2 py-1 rounded text-primary-700 dark:text-primary-300">\pi</code>
                </div>
                <div class="flex items-center justify-between p-2 rounded-lg bg-white dark:bg-primary-800/20 border border-primary-100 dark:border-primary-700/30">
                    <span>θ</span>
                    <code class="text-xs bg-primary-100 dark:bg-primary-800/50 px-2 py-1 rounded text-primary-700 dark:text-primary-300">\theta</code>
                </div>
                <div class="flex items-center justify-between p-2 rounded-lg bg-white dark:bg-primary-800/20 border border-primary-100 dark:border-primary-700/30">
                    <span>α β γ</span>
                    <code class="text-xs bg-primary-100 dark:bg-primary-800/50 px-2 py-1 rounded text-primary-700 dark:text-primary-300">\alpha \beta \gamma</code>
                </div>
            </div>
        </details>

        {{-- HIMPUNAN --}}
        <details class="group bg-primary-50/50 dark:bg-primary-800/20 rounded-xl border border-primary-200/30 dark:border-primary-700/30 overflow-hidden transition-all hover:border-primary-300/50 dark:hover:border-primary-600/50">
            <summary class="cursor-pointer px-4 py-3 font-semibold flex justify-between items-center text-primary-800 dark:text-primary-100 hover:text-primary-600 dark:hover:text-primary-300 transition-colors">
                <span class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                    </svg>
                    ℝ · ℕ · ℤ
                </span>
                <span class="group-open:rotate-90 transition-transform duration-200 text-secondary-400">›</span>
            </summary>
            <div class="px-4 pb-4 space-y-2.5">
                <div class="flex items-center justify-between p-2 rounded-lg bg-white dark:bg-primary-800/20 border border-primary-100 dark:border-primary-700/30">
                    <span>ℝ</span>
                    <code class="text-xs bg-primary-100 dark:bg-primary-800/50 px-2 py-1 rounded text-primary-700 dark:text-primary-300">\mathbb{R}</code>
                </div>
                <div class="flex items-center justify-between p-2 rounded-lg bg-white dark:bg-primary-800/20 border border-primary-100 dark:border-primary-700/30">
                    <span>ℕ</span>
                    <code class="text-xs bg-primary-100 dark:bg-primary-800/50 px-2 py-1 rounded text-primary-700 dark:text-primary-300">\mathbb{N}</code>
                </div>
                <div class="flex items-center justify-between p-2 rounded-lg bg-white dark:bg-primary-800/20 border border-primary-100 dark:border-primary-700/30">
                    <span>ℤ</span>
                    <code class="text-xs bg-primary-100 dark:bg-primary-800/50 px-2 py-1 rounded text-primary-700 dark:text-primary-300">\mathbb{Z}</code>
                </div>
                <div class="flex items-center justify-between p-2 rounded-lg bg-white dark:bg-primary-800/20 border border-primary-100 dark:border-primary-700/30">
                    <span>∈</span>
                    <code class="text-xs bg-primary-100 dark:bg-primary-800/50 px-2 py-1 rounded text-primary-700 dark:text-primary-300">\in</code>
                </div>
                <div class="flex items-center justify-between p-2 rounded-lg bg-white dark:bg-primary-800/20 border border-primary-100 dark:border-primary-700/30">
                    <span>∉</span>
                    <code class="text-xs bg-primary-100 dark:bg-primary-800/50 px-2 py-1 rounded text-primary-700 dark:text-primary-300">\notin</code>
                </div>
            </div>
        </details>

        {{-- TIPS --}}
        <div class="mt-6 p-5 rounded-xl bg-primary-50/50 dark:bg-primary-800/20 border border-primary-200/30 dark:border-primary-700/30">
            <h4 class="font-bold text-primary-800 dark:text-primary-100 mb-3 flex items-center gap-2">
                <svg class="w-5 h-5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                💡 Tips
            </h4>
            <ul class="space-y-2 text-sm text-secondary-600 dark:text-secondary-300">
                <li class="flex items-start gap-2">
                    <span class="text-primary-500">•</span>
                    <span>Ketik <code class="px-1.5 py-0.5 rounded bg-primary-100 dark:bg-primary-800/50 text-primary-700 dark:text-primary-300 text-xs">\</code> lalu lanjutkan nama simbol</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="text-primary-500">•</span>
                    <span>Gunakan MathQuill hanya untuk rumus</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="text-primary-500">•</span>
                    <span>Teks biasa tetap diketik di textarea</span>
                </li>
                <li class="flex items-start gap-2">
                    <span class="text-primary-500">•</span>
                    <span>Rumus otomatis dirender di preview</span>
                </li>
            </ul>
        </div>

    </div>
</div>
