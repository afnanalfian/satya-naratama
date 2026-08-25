<!-- resources/views/auth/check-status.blade.php -->
@extends('layouts.guest')

@section('title', 'Cek Status Pendaftaran – Satya Naratama')
@section('content')

<style>
    .status-container {
        width: 100%;
        padding: 3rem 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #F8FAFC 0%, #EFF6FF 50%, #F8FAFC 100%);
        position: relative;
        overflow: hidden;
        min-height: 100vh;
    }

    .status-container::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(37, 99, 235, 0.06) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }

    .status-container::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -10%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(139, 92, 246, 0.05) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }

    .status-card {
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
        .status-card {
            padding: 2.5rem 2.5rem;
        }
    }

    .status-card:hover {
        box-shadow: 0 8px 48px rgba(37, 99, 235, 0.12), 0 2px 8px rgba(0, 0, 0, 0.04);
    }

    .status-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #2563EB, #8B5CF6, #2563EB);
        border-radius: 1.5rem 1.5rem 0 0;
    }

    .status-title {
        font-size: 1.75rem;
        font-weight: 800;
        color: #0F172A;
        letter-spacing: -0.02em;
        margin-bottom: 0.25rem;
    }

    .status-subtitle {
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

    .form-label .required {
        color: #EF4444;
        margin-left: 0.125rem;
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

    .input-wrapper .form-input:focus ~ .input-icon {
        color: #2563EB;
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

    .alert-info {
        background: #EFF6FF;
        color: #1E40AF;
        padding: 0.75rem 1rem;
        border-radius: 0.75rem;
        font-size: 0.875rem;
        border: 1px solid #BFDBFE;
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
    .alert-success svg,
    .alert-info svg {
        flex-shrink: 0;
        width: 1.25rem;
        height: 1.25rem;
    }

    .link-primary {
        color: #2563EB;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s ease;
        position: relative;
    }

    .link-primary::after {
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

    .link-primary:hover::after {
        transform: scaleX(1);
    }

    .link-primary:hover {
        color: #1D4ED8;
    }

    .link-secondary {
        color: #64748B;
        text-decoration: none;
        transition: color 0.2s ease;
        font-size: 0.875rem;
    }

    .link-secondary:hover {
        color: #2563EB;
        text-decoration: underline;
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

    /* Dark mode */
    @media (prefers-color-scheme: dark) {
        .status-container {
            background: linear-gradient(135deg, #0F172A 0%, #1E293B 50%, #0F172A 100%);
        }

        .status-container::before {
            background: radial-gradient(circle, rgba(37, 99, 235, 0.12) 0%, transparent 70%);
        }

        .status-container::after {
            background: radial-gradient(circle, rgba(139, 92, 246, 0.08) 0%, transparent 70%);
        }

        .status-card {
            background: rgba(30, 41, 59, 0.95);
            backdrop-filter: blur(20px);
            border-color: rgba(37, 99, 235, 0.15);
        }

        .status-title {
            color: #F8FAFC;
        }

        .status-subtitle {
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

        .form-input.error {
            border-color: #F87171;
            background: #450A0A;
        }

        .form-input.error:focus {
            box-shadow: 0 0 0 4px rgba(248, 113, 113, 0.15);
        }

        .alert-error {
            background: #7F1D1D;
            color: #FCA5A5;
            border-color: #991B1B;
        }

        .alert-success {
            background: #064E3B;
            color: #86EFAC;
            border-color: #065F46;
        }

        .alert-info {
            background: rgba(37, 99, 235, 0.15);
            color: #93BBFC;
            border-color: rgba(37, 99, 235, 0.2);
        }

        .link-primary {
            color: #60A5FA;
        }

        .link-primary::after {
            background: #60A5FA;
        }

        .link-primary:hover {
            color: #93BBFC;
        }

        .link-secondary {
            color: #94A3B8;
        }

        .link-secondary:hover {
            color: #60A5FA;
        }

        .divider::before,
        .divider::after {
            background: #334155;
        }

        .divider-text {
            color: #64748B;
        }

        .input-wrapper .input-icon {
            color: #64748B;
        }
    }
</style>

<div class="status-container">

    <div class="status-card">

        {{-- Title --}}
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-[#2563EB]/10 mb-4">
                <svg class="w-7 h-7 text-[#2563EB]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
            <h2 class="status-title">
                Cek Pendaftaran 🔍
            </h2>
            <p class="status-subtitle">
                Masukkan email untuk melihat status pendaftaran
            </p>
        </div>

        {{-- Form --}}
        <form action="{{ route('daftar.status.check') }}" method="POST" class="space-y-5" id="statusForm" novalidate>
            @csrf

            @if(session('error'))
                <div class="alert-error">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="alert-success">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('info'))
                <div class="alert-info">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ session('info') }}
                </div>
            @endif

            <div>
                <label class="form-label">
                    Email <span class="required">*</span>
                </label>
                <div class="input-wrapper">
                    <svg class="input-icon w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <input
                        type="email"
                        name="email"
                        required
                        value="{{ old('email') }}"
                        placeholder="email@example.com"
                        class="form-input @error('email') error @enderror"
                        id="emailInput"
                    >
                </div>
            </div>

            <button type="submit" class="btn-submit" id="submitBtn">
                <span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Cek Status
                </span>
            </button>
        </form>

        {{-- Divider --}}
        <div class="divider">
            <span class="divider-text">Belum mendaftar?</span>
        </div>

        {{-- Links --}}
        <div class="text-center space-y-2">
            <p class="text-sm text-[#475569] dark:text-[#94A3B8]">
                <a href="{{ route('daftar.form') }}" class="link-primary">
                    Daftar Sekarang
                </a>
            </p>
            <p class="text-sm">
                <a href="{{ route('login') }}" class="link-secondary">
                    Login
                </a>
            </p>
        </div>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('statusForm');
    const submitBtn = document.getElementById('submitBtn');
    const emailInput = document.getElementById('emailInput');

    // Remove error state on input
    if (emailInput) {
        emailInput.addEventListener('input', function() {
            this.classList.remove('error');
        });
    }

    // Form validation
    if (form) {
        form.addEventListener('submit', function(e) {
            if (!emailInput || !emailInput.value.trim()) {
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

            // Show loading state
            submitBtn.disabled = true;
            submitBtn.querySelector('span').innerHTML = `
                <span class="spinner"></span>
                Memeriksa...
            `;
        });
    }

    // Auto-dismiss alerts after 5 seconds
    const alerts = document.querySelectorAll('.alert-error, .alert-success, .alert-info');
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

    // Handle Enter key
    if (emailInput) {
        emailInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                form.dispatchEvent(new Event('submit'));
            }
        });
    }
});
</script>

@endsection
