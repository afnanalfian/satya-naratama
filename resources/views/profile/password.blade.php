@extends('layouts.app')

@section('content')
<div class="min-h-screen py-8 bg-gradient-to-b from-primary-50/50 to-neutral-50 dark:from-primary-900/20 dark:to-neutral-900">
    <div class="max-w-2xl mx-auto px-4 sm:px-6">

        {{-- Back Button --}}
        <div class="mb-6">
            <a href="{{ route('profile.show') }}"
               class="inline-flex items-center gap-2 text-sm font-medium text-secondary-600 dark:text-secondary-300 hover:text-primary-600 dark:hover:text-primary-300 transition-colors group">
                <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali ke Profil
            </a>
        </div>

        {{-- Main Card --}}
        <div class="bg-white dark:bg-primary-900/30 backdrop-blur-sm rounded-3xl shadow-2xl dark:shadow-primary-900/30 border border-primary-200/50 dark:border-primary-700/30 overflow-hidden transition-all">

            {{-- Header --}}
            <div class="px-6 sm:px-8 pt-8 pb-6 border-b border-primary-100 dark:border-primary-700/30">
                <div class="flex items-center gap-3">
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-secondary-100 text-secondary-600 dark:bg-secondary-900/40 dark:text-secondary-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                        </svg>
                    </span>
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-bold text-primary-800 dark:text-primary-100 font-display tracking-tight">
                            Ganti Password
                        </h1>
                        <p class="text-sm text-secondary-500 dark:text-secondary-300 mt-0.5">
                            Perbarui kata sandi akun Anda untuk keamanan yang lebih baik
                        </p>
                    </div>
                </div>
            </div>

            {{-- Form --}}
            <form method="POST" action="{{ route('profile.password.update') }}" class="px-6 sm:px-8 py-6 space-y-6">
                @csrf

                {{-- Password Strength Indicator --}}
                <div class="flex items-center gap-3 p-3 rounded-xl bg-secondary-50 dark:bg-secondary-900/20 border border-secondary-200 dark:border-secondary-700/30">
                    <svg class="w-5 h-5 text-secondary-500 dark:text-secondary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                    <p class="text-xs text-secondary-600 dark:text-secondary-400">
                        Gunakan minimal 8 karakter dengan kombinasi huruf, angka, dan simbol
                    </p>
                </div>

                {{-- Current Password --}}
                <div>
                    <label class="block text-sm font-medium text-primary-700 dark:text-primary-300 mb-1.5">
                        Password Saat Ini <span class="text-accent-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="password" name="current_password" id="current_password"
                               class="w-full px-4 py-3 pr-12 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-primary-800 dark:text-primary-50 focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200"
                               autocomplete="current-password" required>
                        <button type="button" onclick="togglePasswordVisibility('current_password')"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-secondary-400 hover:text-primary-600 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- New Password --}}
                <div>
                    <label class="block text-sm font-medium text-primary-700 dark:text-primary-300 mb-1.5">
                        Password Baru <span class="text-accent-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="password" name="password" id="new_password"
                               class="w-full px-4 py-3 pr-12 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-primary-800 dark:text-primary-50 focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200"
                               autocomplete="new-password" required minlength="8">
                        <button type="button" onclick="togglePasswordVisibility('new_password')"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-secondary-400 hover:text-primary-600 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                    <div class="mt-2 flex items-center gap-1.5">
                        <div class="flex-1 h-1.5 rounded-full bg-secondary-200 dark:bg-secondary-700 overflow-hidden">
                            <div id="password-strength" class="h-full w-0 rounded-full bg-red-500 transition-all duration-300"></div>
                        </div>
                        <span id="strength-text" class="text-xs text-secondary-500 dark:text-secondary-400 w-16 text-right">Lemah</span>
                    </div>
                </div>

                {{-- Confirm Password --}}
                <div>
                    <label class="block text-sm font-medium text-primary-700 dark:text-primary-300 mb-1.5">
                        Konfirmasi Password <span class="text-accent-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="password" name="password_confirmation" id="confirm_password"
                               class="w-full px-4 py-3 pr-12 rounded-xl border border-primary-200 dark:border-primary-700/50 bg-white dark:bg-primary-800/30 text-primary-800 dark:text-primary-50 focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200"
                               autocomplete="new-password" required>
                        <button type="button" onclick="togglePasswordVisibility('confirm_password')"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-secondary-400 hover:text-primary-600 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                    <div id="password-match" class="mt-1.5 text-xs hidden">
                        <span class="text-emerald-600 dark:text-emerald-400">✓ Password cocok</span>
                    </div>
                </div>

                {{-- Submit --}}
                <div class="pt-4 border-t-2 border-primary-100 dark:border-primary-700/30">
                    <button type="submit"
                            class="w-full inline-flex items-center justify-center gap-3 px-6 py-4 rounded-2xl text-white font-semibold bg-brand-gradient hover:shadow-xl hover:shadow-primary-500/30 hover:scale-[1.02] transition-all duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        Update Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function togglePasswordVisibility(id) {
    const input = document.getElementById(id);
    const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
    input.setAttribute('type', type);
}

// Password strength indicator
document.addEventListener('DOMContentLoaded', () => {
    const passwordInput = document.getElementById('new_password');
    const confirmInput = document.getElementById('confirm_password');
    const strengthBar = document.getElementById('password-strength');
    const strengthText = document.getElementById('strength-text');
    const matchIndicator = document.getElementById('password-match');

    function checkPasswordStrength(password) {
        let score = 0;
        if (password.length >= 8) score++;
        if (password.match(/[a-z]/)) score++;
        if (password.match(/[A-Z]/)) score++;
        if (password.match(/[0-9]/)) score++;
        if (password.match(/[^a-zA-Z0-9]/)) score++;

        const levels = ['Sangat Lemah', 'Lemah', 'Sedang', 'Kuat', 'Sangat Kuat'];
        const colors = ['#ef4444', '#f59e0b', '#eab308', '#22c55e', '#22c55e'];
        const widths = ['20%', '40%', '60%', '80%', '100%'];

        return { text: levels[score] || 'Sangat Lemah', color: colors[score] || '#ef4444', width: widths[score] || '20%' };
    }

    passwordInput.addEventListener('input', () => {
        const result = checkPasswordStrength(passwordInput.value);
        strengthBar.style.width = result.width;
        strengthBar.style.backgroundColor = result.color;
        strengthText.textContent = result.text;
        strengthText.style.color = result.color;

        checkMatch();
    });

    confirmInput.addEventListener('input', checkMatch);

    function checkMatch() {
        if (confirmInput.value.length === 0) {
            matchIndicator.classList.add('hidden');
            return;
        }

        if (passwordInput.value === confirmInput.value) {
            matchIndicator.classList.remove('hidden');
            matchIndicator.querySelector('span').className = 'text-emerald-600 dark:text-emerald-400';
        } else {
            matchIndicator.classList.remove('hidden');
            matchIndicator.querySelector('span').className = 'text-red-600 dark:text-red-400';
            matchIndicator.querySelector('span').textContent = '✗ Password tidak cocok';
        }
    }

    // Reset match indicator when password changes
    passwordInput.addEventListener('input', () => {
        if (confirmInput.value.length > 0) {
            checkMatch();
        }
    });
});
</script>
@endpush
