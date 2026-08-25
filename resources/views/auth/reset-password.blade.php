@extends('layouts.guest')

@section('title', 'Reset Password – Satya Naratama')
@section('content')

<style>
    .reset-container {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0 1rem;
        background: linear-gradient(135deg, #F8FAFC 0%, #EFF6FF 50%, #F8FAFC 100%);
        position: relative;
        overflow: hidden;
    }

    .reset-container::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(37, 99, 235, 0.06) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }

    .reset-container::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -10%;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(139, 92, 246, 0.05) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }

    .reset-card {
        position: relative;
        z-index: 1;
        width: 100%;
        max-width: 440px;
        margin: 0 auto;
        padding: 2rem 1.5rem;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 1.5rem;
        box-shadow: 0 4px 24px rgba(37, 99, 235, 0.08), 0 1px 4px rgba(0, 0, 0, 0.04);
        border: 1px solid rgba(37, 99, 235, 0.08);
        transition: all 0.3s ease;
    }

    @media (min-width: 640px) {
        .reset-card {
            padding: 2.5rem 2.5rem;
        }
    }

    .reset-card:hover {
        box-shadow: 0 8px 48px rgba(37, 99, 235, 0.12), 0 2px 8px rgba(0, 0, 0, 0.04);
    }

    /* Decorative top accent */
    .reset-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #2563EB, #8B5CF6, #2563EB);
        border-radius: 1.5rem 1.5rem 0 0;
    }

    .reset-title {
        font-size: 1.75rem;
        font-weight: 800;
        color: #0F172A;
        letter-spacing: -0.02em;
        margin-bottom: 0.25rem;
    }

    .reset-subtitle {
        font-size: 0.875rem;
        color: #64748B;
        margin-top: 0.25rem;
        line-height: 1.6;
    }

    .form-label {
        display: block;
        font-size: 0.875rem;
        font-weight: 600;
        color: #1E293B;
        margin-bottom: 0.375rem;
    }

    .form-input {
        width: 100%;
        padding: 0.75rem 1rem;
        border-radius: 0.75rem;
        background: #F8FAFC;
        border: 2px solid #E2E8F0;
        color: #0F172A;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        outline: none;
    }

    .form-input:focus {
        border-color: #2563EB;
        background: #FFFFFF;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
    }

    .form-input::placeholder {
        color: #94A3B8;
    }

    .form-input.error {
        border-color: #EF4444;
        background: #FEF2F2;
    }

    .form-input.error:focus {
        box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1);
    }

    .form-input.success {
        border-color: #22C55E;
        background: #F0FDF4;
    }

    .form-input.success:focus {
        box-shadow: 0 0 0 4px rgba(34, 197, 94, 0.1);
    }

    .btn-submit {
        width: 100%;
        padding: 0.875rem 1.5rem;
        border-radius: 0.75rem;
        font-weight: 700;
        font-size: 1rem;
        color: white;
        background: linear-gradient(135deg, #2563EB, #1D4ED8);
        border: none;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 16px rgba(37, 99, 235, 0.25);
        position: relative;
        overflow: hidden;
    }

    .btn-submit::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, #1D4ED8, #1E40AF);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 32px rgba(37, 99, 235, 0.35);
    }

    .btn-submit:hover::after {
        opacity: 1;
    }

    .btn-submit span {
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .btn-submit:active {
        transform: scale(0.98);
    }

    .btn-submit:disabled {
        opacity: 0.7;
        cursor: not-allowed;
        transform: none !important;
    }

    .btn-submit:disabled::after {
        opacity: 0;
    }

    .btn-submit .spinner {
        display: inline-block;
        width: 1.25rem;
        height: 1.25rem;
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-top-color: white;
        border-radius: 50%;
        animation: spin 0.8s linear infinite;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    .input-wrapper {
        position: relative;
    }

    .input-wrapper .input-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #94A3B8;
        pointer-events: none;
        transition: color 0.3s ease;
    }

    .input-wrapper .form-input {
        padding-left: 2.75rem;
    }

    .input-wrapper .form-input:focus ~ .input-icon,
    .input-wrapper .form-input:focus + .input-icon {
        color: #2563EB;
    }

    .input-wrapper .form-input.success ~ .input-icon {
        color: #22C55E;
    }

    .toggle-password {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #94A3B8;
        cursor: pointer;
        padding: 0.25rem;
        transition: color 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .toggle-password:hover {
        color: #475569;
    }

    .password-strength {
        margin-top: 0.5rem;
        display: flex;
        gap: 0.25rem;
        align-items: center;
        height: 4px;
    }

    .password-strength-bar {
        flex: 1;
        height: 100%;
        border-radius: 9999px;
        background: #E2E8F0;
        transition: all 0.3s ease;
    }

    .password-strength-bar.active.weak {
        background: #EF4444;
    }

    .password-strength-bar.active.medium {
        background: #F59E0B;
    }

    .password-strength-bar.active.strong {
        background: #22C55E;
    }

    .password-strength-label {
        font-size: 0.7rem;
        font-weight: 600;
        margin-top: 0.25rem;
        text-align: right;
        color: #94A3B8;
        transition: color 0.3s ease;
    }

    .password-strength-label.weak { color: #EF4444; }
    .password-strength-label.medium { color: #F59E0B; }
    .password-strength-label.strong { color: #22C55E; }

    .alert-error {
        background: #FEF2F2;
        color: #991B1B;
        padding: 0.75rem 1rem;
        border-radius: 0.75rem;
        font-size: 0.875rem;
        border: 1px solid #FECACA;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        animation: slideDown 0.4s ease-out;
    }

    .alert-success {
        background: #F0FDF4;
        color: #166534;
        padding: 0.75rem 1rem;
        border-radius: 0.75rem;
        font-size: 0.875rem;
        border: 1px solid #BBF7D0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        animation: slideDown 0.4s ease-out;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .alert-error svg,
    .alert-success svg {
        flex-shrink: 0;
        width: 1.25rem;
        height: 1.25rem;
    }

    .link-back {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: #2563EB;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s ease;
        font-size: 0.875rem;
        margin-top: 0.5rem;
    }

    .link-back:hover {
        color: #1D4ED8;
        gap: 0.75rem;
    }

    .link-back svg {
        transition: transform 0.2s ease;
    }

    .link-back:hover svg {
        transform: translateX(-4px);
    }

    .divider {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin: 0.5rem 0;
    }

    .divider::before,
    .divider::after {
        content: '';
        flex: 1;
        height: 1px;
        background: #E2E8F0;
    }

    .divider-text {
        font-size: 0.75rem;
        color: #94A3B8;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-weight: 600;
        white-space: nowrap;
    }

    /* Dark mode support */
    @media (prefers-color-scheme: dark) {
        .reset-container {
            background: linear-gradient(135deg, #0F172A 0%, #1E293B 50%, #0F172A 100%);
        }

        .reset-container::before {
            background: radial-gradient(circle, rgba(37, 99, 235, 0.12) 0%, transparent 70%);
        }

        .reset-container::after {
            background: radial-gradient(circle, rgba(139, 92, 246, 0.08) 0%, transparent 70%);
        }

        .reset-card {
            background: rgba(30, 41, 59, 0.95);
            backdrop-filter: blur(20px);
            border-color: rgba(37, 99, 235, 0.15);
        }

        .reset-title {
            color: #F8FAFC;
        }

        .reset-subtitle {
            color: #94A3B8;
        }

        .form-label {
            color: #E2E8F0;
        }

        .form-input {
            background: #1E293B;
            border-color: #334155;
            color: #F8FAFC;
        }

        .form-input:focus {
            border-color: #3B82F6;
            background: #1E293B;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.15);
        }

        .form-input::placeholder {
            color: #64748B;
        }

        .form-input.success {
            border-color: #4ADE80;
            background: #052E16;
        }

        .form-input.success:focus {
            box-shadow: 0 0 0 4px rgba(74, 222, 128, 0.15);
        }

        .form-input.error {
            border-color: #F87171;
            background: #450A0A;
        }

        .form-input.error:focus {
            box-shadow: 0 0 0 4px rgba(248, 113, 113, 0.15);
        }

        .alert-success {
            background: #064E3B;
            color: #86EFAC;
            border-color: #065F46;
        }

        .alert-error {
            background: #7F1D1D;
            color: #FCA5A5;
            border-color: #991B1B;
        }

        .divider::before,
        .divider::after {
            background: #334155;
        }

        .divider-text {
            color: #64748B;
        }

        .link-back {
            color: #60A5FA;
        }

        .link-back:hover {
            color: #93BBFC;
        }

        .input-wrapper .input-icon {
            color: #64748B;
        }

        .toggle-password {
            color: #64748B;
        }

        .toggle-password:hover {
            color: #94A3B8;
        }

        .password-strength-bar {
            background: #334155;
        }

        .password-strength-label {
            color: #64748B;
        }
    }
</style>

<div class="reset-container">

    <div class="reset-card">

        {{-- Title --}}
        <div class="text-center mb-7">
            <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-[#2563EB]/10 mb-4">
                <svg class="w-7 h-7 text-[#2563EB]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                </svg>
            </div>
            <h2 class="reset-title">
                Reset Password 🔑
            </h2>
            <p class="reset-subtitle">
                Buat password baru untuk akun Anda.
            </p>
        </div>

        {{-- Error --}}
        @if ($errors->any())
            <div class="alert-error mb-4">
                <svg class="flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}" class="space-y-5" id="resetForm" novalidate>
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            {{-- Email --}}
            <div>
                <label class="form-label">
                    <span>Email</span>
                </label>
                <div class="input-wrapper">
                    <svg class="input-icon w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <input
                        type="email"
                        name="email"
                        required
                        autofocus
                        placeholder="Masukkan email terdaftar..."
                        class="form-input @error('email') error @enderror"
                        value="{{ old('email', $email ?? '') }}"
                        id="emailInput"
                    >
                </div>
            </div>

            {{-- Password Baru --}}
            <div>
                <label class="form-label">
                    <span>Password Baru</span>
                </label>
                <div class="input-wrapper">
                    <svg class="input-icon w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    <input
                        type="password"
                        name="password"
                        required
                        placeholder="Minimal 8 karakter..."
                        class="form-input @error('password') error @enderror"
                        id="passwordInput"
                        minlength="8"
                    >
                    <button
                        type="button"
                        class="toggle-password"
                        data-target="passwordInput"
                        aria-label="Toggle password visibility"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </button>
                </div>

                {{-- Password Strength Indicator --}}
                <div class="password-strength" id="strengthBars">
                    <span class="password-strength-bar" data-index="0"></span>
                    <span class="password-strength-bar" data-index="1"></span>
                    <span class="password-strength-bar" data-index="2"></span>
                    <span class="password-strength-bar" data-index="3"></span>
                </div>
                <div class="password-strength-label" id="strengthLabel">Minimal 8 karakter</div>
            </div>

            {{-- Konfirmasi Password --}}
            <div>
                <label class="form-label">
                    <span>Konfirmasi Password</span>
                </label>
                <div class="input-wrapper">
                    <svg class="input-icon w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                    <input
                        type="password"
                        name="password_confirmation"
                        required
                        placeholder="Konfirmasi password baru..."
                        class="form-input @error('password') error @enderror"
                        id="confirmInput"
                    >
                    <button
                        type="button"
                        class="toggle-password"
                        data-target="confirmInput"
                        aria-label="Toggle password visibility"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </button>
                </div>
                <div class="text-xs text-[#94A3B8] mt-1" id="confirmMessage"></div>
            </div>

            {{-- Submit --}}
            <button type="submit" class="btn-submit" id="submitBtn">
                <span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                    Reset Password
                </span>
            </button>
        </form>

        {{-- Divider --}}
        <div class="divider">
            <span class="divider-text">atau</span>
        </div>

        {{-- Back to Login --}}
        <a href="{{ route('login') }}" class="link-back">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Login
        </a>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('resetForm');
    const submitBtn = document.getElementById('submitBtn');
    const emailInput = document.getElementById('emailInput');
    const passwordInput = document.getElementById('passwordInput');
    const confirmInput = document.getElementById('confirmInput');
    const strengthBars = document.querySelectorAll('#strengthBars .password-strength-bar');
    const strengthLabel = document.getElementById('strengthLabel');
    const confirmMessage = document.getElementById('confirmMessage');

    // Toggle password visibility
    document.querySelectorAll('.toggle-password').forEach(btn => {
        btn.addEventListener('click', function() {
            const targetId = this.dataset.target;
            const input = document.getElementById(targetId);
            if (!input) return;

            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);

            // Update icon
            const icon = this.querySelector('svg');
            if (type === 'text') {
                icon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                `;
            } else {
                icon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                `;
            }
        });
    });

    // Password strength checker
    function checkPasswordStrength(password) {
        let score = 0;

        if (password.length >= 8) score++;
        if (/[a-z]/.test(password) && /[A-Z]/.test(password)) score++;
        if (/\d/.test(password)) score++;
        if (/[^a-zA-Z0-9]/.test(password)) score++;

        return score;
    }

    function updateStrengthIndicator(password) {
        const score = checkPasswordStrength(password);

        strengthBars.forEach((bar, index) => {
            bar.classList.remove('active', 'weak', 'medium', 'strong');
            if (index < score) {
                bar.classList.add('active');
                if (score <= 1) bar.classList.add('weak');
                else if (score <= 2) bar.classList.add('medium');
                else bar.classList.add('strong');
            }
        });

        const labels = ['Lemah', 'Kurang', 'Cukup', 'Kuat'];
        const classes = ['weak', 'medium', 'medium', 'strong'];

        if (password.length === 0) {
            strengthLabel.textContent = 'Minimal 8 karakter';
            strengthLabel.className = 'password-strength-label';
        } else if (score === 0) {
            strengthLabel.textContent = 'Minimal 8 karakter';
            strengthLabel.className = 'password-strength-label';
        } else {
            strengthLabel.textContent = labels[Math.min(score - 1, labels.length - 1)];
            strengthLabel.className = 'password-strength-label ' + classes[Math.min(score - 1, classes.length - 1)];
        }
    }

    passwordInput.addEventListener('input', function() {
        updateStrengthIndicator(this.value);

        // Check confirmation match
        if (confirmInput.value.length > 0) {
            checkPasswordMatch();
        }

        // Remove error state
        this.classList.remove('error');
    });

    function checkPasswordMatch() {
        const password = passwordInput.value;
        const confirm = confirmInput.value;

        if (confirm.length === 0) {
            confirmMessage.textContent = '';
            confirmInput.classList.remove('success', 'error');
            return;
        }

        if (password === confirm) {
            confirmMessage.textContent = '✓ Password cocok';
            confirmMessage.className = 'text-xs text-[#22C55E] mt-1';
            confirmInput.classList.remove('error');
            confirmInput.classList.add('success');
        } else {
            confirmMessage.textContent = '✗ Password tidak cocok';
            confirmMessage.className = 'text-xs text-[#EF4444] mt-1';
            confirmInput.classList.remove('success');
            confirmInput.classList.add('error');
        }
    }

    confirmInput.addEventListener('input', checkPasswordMatch);
    confirmInput.addEventListener('input', function() {
        this.classList.remove('error');
    });

    // Remove error state on email input
    emailInput.addEventListener('input', function() {
        this.classList.remove('error');
    });

    // Form validation
    form.addEventListener('submit', function(e) {
        // Validate email
        if (!emailInput.value.trim()) {
            e.preventDefault();
            emailInput.classList.add('error');
            emailInput.focus();
            return;
        }

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(emailInput.value.trim())) {
            e.preventDefault();
            emailInput.classList.add('error');
            emailInput.focus();
            return;
        }

        // Validate password
        if (passwordInput.value.length < 8) {
            e.preventDefault();
            passwordInput.classList.add('error');
            passwordInput.focus();
            return;
        }

        // Validate password match
        if (passwordInput.value !== confirmInput.value) {
            e.preventDefault();
            confirmInput.classList.add('error');
            confirmInput.focus();
            return;
        }

        // Show loading state
        submitBtn.disabled = true;
        submitBtn.querySelector('span').innerHTML = `
            <span class="spinner"></span>
            Mereset Password...
        `;
    });

    // Handle Enter key on inputs
    [emailInput, passwordInput, confirmInput].forEach(input => {
        input.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                form.dispatchEvent(new Event('submit'));
            }
        });
    });

    // Initial strength check if password has value
    if (passwordInput.value) {
        updateStrengthIndicator(passwordInput.value);
    }
});
</script>

@endsection
