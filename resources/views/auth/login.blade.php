<!-- resources/views/auth/login.blade.php -->
@extends('layouts.guest')

@section('title', 'Login – Satya Naratama')
@section('content')

<style>
    .login-container {
        min-height: 85vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0 1rem;
        background: linear-gradient(135deg, #F8FAFC 0%, #EFF6FF 50%, #F8FAFC 100%);
        position: relative;
        overflow: hidden;
    }

    .login-container::before {
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

    .login-container::after {
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

    .login-card {
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
        .login-card {
            padding: 2.5rem 2.5rem;
        }
    }

    .login-card:hover {
        box-shadow: 0 8px 48px rgba(37, 99, 235, 0.12), 0 2px 8px rgba(0, 0, 0, 0.04);
    }

    /* Decorative top accent */
    .login-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #2563EB, #8B5CF6, #2563EB);
        border-radius: 1.5rem 1.5rem 0 0;
    }

    .login-title {
        font-size: 1.75rem;
        font-weight: 800;
        color: #0F172A;
        letter-spacing: -0.02em;
        margin-bottom: 0.25rem;
    }

    .login-subtitle {
        font-size: 0.875rem;
        color: #64748B;
        margin-top: 0.25rem;
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

    .btn-login {
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

    .btn-login::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, #1D4ED8, #1E40AF);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 32px rgba(37, 99, 235, 0.35);
    }

    .btn-login:hover::after {
        opacity: 1;
    }

    .btn-login span {
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .btn-login:active {
        transform: scale(0.98);
    }

    .remember-checkbox {
        width: 1.125rem;
        height: 1.125rem;
        border-radius: 0.25rem;
        border: 2px solid #CBD5E1;
        accent-color: #2563EB;
        cursor: pointer;
        transition: all 0.2s ease;
        flex-shrink: 0;
    }

    .remember-checkbox:checked {
        border-color: #2563EB;
    }

    .remember-checkbox:focus {
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
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
    }

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
    }

    .alert-success svg,
    .alert-error svg {
        flex-shrink: 0;
        width: 1.25rem;
        height: 1.25rem;
    }

    .link-forgot {
        color: #2563EB;
        font-weight: 500;
        text-decoration: none;
        transition: color 0.2s ease;
        font-size: 0.875rem;
    }

    .link-forgot:hover {
        color: #1D4ED8;
        text-decoration: underline;
    }

    .link-register {
        color: #2563EB;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s ease;
        position: relative;
    }

    .link-register::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        right: 0;
        height: 2px;
        background: #2563EB;
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }

    .link-register:hover::after {
        transform: scaleX(1);
    }

    .link-register:hover {
        color: #1D4ED8;
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

    /* Icon inside input */
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

    /* Toggle password visibility */
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

    /* Dark mode support via media query */
    @media (prefers-color-scheme: dark) {
        .login-container {
            background: linear-gradient(135deg, #0F172A 0%, #1E293B 50%, #0F172A 100%);
        }

        .login-container::before {
            background: radial-gradient(circle, rgba(37, 99, 235, 0.12) 0%, transparent 70%);
        }

        .login-container::after {
            background: radial-gradient(circle, rgba(139, 92, 246, 0.08) 0%, transparent 70%);
        }

        .login-card {
            background: rgba(30, 41, 59, 0.95);
            backdrop-filter: blur(20px);
            border-color: rgba(37, 99, 235, 0.15);
        }

        .login-title {
            color: #F8FAFC;
        }

        .login-subtitle {
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

        .link-forgot {
            color: #60A5FA;
        }

        .link-forgot:hover {
            color: #93BBFC;
        }

        .link-register {
            color: #60A5FA;
        }

        .link-register::after {
            background: #60A5FA;
        }

        .link-register:hover {
            color: #93BBFC;
        }

        .login-card .form-input.error {
            border-color: #F87171;
            background: #450A0A;
        }

        .login-card .form-input.error:focus {
            box-shadow: 0 0 0 4px rgba(248, 113, 113, 0.15);
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
    }
</style>

<div class="login-container">

    <div class="login-card">

        {{-- Title --}}
        <div class="text-center mb-7">
            <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-[#2563EB]/10 mb-4">
                <svg class="w-7 h-7 text-[#2563EB]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                </svg>
            </div>
            <h2 class="login-title">
                Selamat Datang 👋
            </h2>
            <p class="login-subtitle">
                Masuk untuk melanjutkan pembelajaranmu
            </p>
        </div>

        {{-- Status --}}
        @if(session('status'))
            <div class="alert-success mb-4">
                <svg class="flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ session('status') }}
            </div>
        @endif

        {{-- Error --}}
        @if ($errors->any())
            <div class="alert-error mb-4">
                <svg class="flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

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
                        placeholder="Masukkan email..."
                        class="form-input @error('email') error @enderror"
                        value="{{ old('email') }}"
                    >
                </div>
            </div>

            {{-- Password --}}
            <div>
                <div class="flex items-center justify-between mb-1">
                    <label class="form-label mb-0">
                        <span>Password</span>
                    </label>
                    <a href="{{ route('password.request') }}" class="link-forgot">
                        Lupa password?
                    </a>
                </div>
                <div class="input-wrapper">
                    <svg class="input-icon w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    <input
                        type="password"
                        name="password"
                        required
                        placeholder="••••••••"
                        class="form-input @error('password') error @enderror"
                        id="password-input"
                    >
                    <button
                        type="button"
                        class="toggle-password"
                        id="togglePassword"
                        aria-label="Toggle password visibility"
                    >
                        <svg class="w-5 h-5" id="eyeIcon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Remember --}}
            <div class="flex items-center justify-between">
                <label class="flex items-center gap-2.5 text-sm text-[#475569] dark:text-[#94A3B8] cursor-pointer">
                    <input
                        type="checkbox"
                        name="remember"
                        class="remember-checkbox"
                        {{ old('remember') ? 'checked' : '' }}
                    >
                    <span>Ingat saya</span>
                </label>
            </div>

            {{-- Submit --}}
            <button type="submit" class="btn-login">
                <span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                    </svg>
                    Masuk
                </span>
            </button>
        </form>

        {{-- Divider --}}
        <div class="divider">
            <span class="divider-text">atau</span>
        </div>

        {{-- Footer --}}
        <p class="text-sm text-center text-[#475569] dark:text-[#94A3B8]">
            Belum punya akun?
            <a href="{{ route('daftar.form') }}" class="link-register">
                Daftar sekarang
            </a>
        </p>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle password visibility
    const toggleBtn = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password-input');
    const eyeIcon = document.getElementById('eyeIcon');

    if (toggleBtn && passwordInput) {
        toggleBtn.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            // Toggle icon
            if (type === 'text') {
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                `;
            } else {
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                `;
            }
        });
    }

    // Auto-dismiss alerts after 5 seconds
    const alerts = document.querySelectorAll('.alert-success, .alert-error');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-10px)';
            setTimeout(() => {
                alert.remove();
            }, 500);
        }, 5000);
    });
});
</script>

@endsection
