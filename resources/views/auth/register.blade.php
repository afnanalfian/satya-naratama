@extends('layouts.guest')

@section('title', 'Register – Satya Naratama')
@section('content')

<style>
    .register-container {
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

    .register-container::before {
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

    .register-container::after {
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

    .register-card {
        position: relative;
        z-index: 1;
        width: 100%;
        max-width: 720px;
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
        .register-card {
            padding: 2.5rem 2.5rem;
        }
    }

    .register-card:hover {
        box-shadow: 0 8px 48px rgba(37, 99, 235, 0.12), 0 2px 8px rgba(0, 0, 0, 0.04);
    }

    /* Decorative top accent */
    .register-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #2563EB, #8B5CF6, #2563EB);
        border-radius: 1.5rem 1.5rem 0 0;
    }

    .register-title {
        font-size: 1.75rem;
        font-weight: 800;
        color: #0F172A;
        letter-spacing: -0.02em;
        margin-bottom: 0.25rem;
    }

    .register-subtitle {
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

    .form-input.success {
        border-color: #22C55E;
        background: #F0FDF4;
    }

    .form-input.success:focus {
        box-shadow: 0 0 0 4px rgba(34, 197, 94, 0.1);
    }

    .form-select {
        width: 100%;
        padding: 0.75rem 1rem;
        border-radius: 0.75rem;
        background: #F8FAFC;
        border: 2px solid #E2E8F0;
        color: #0F172A;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        outline: none;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2364748B' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 1rem center;
        padding-right: 2.5rem;
        cursor: pointer;
    }

    .form-select:focus {
        border-color: #2563EB;
        background-color: #FFFFFF;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
    }

    .form-select.error {
        border-color: #EF4444;
        background-color: #FEF2F2;
    }

    .form-select.error:focus {
        box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1);
    }

    .form-select option {
        color: #0F172A;
        background: white;
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

    .file-upload-wrapper {
        position: relative;
        width: 100%;
    }

    .file-upload-wrapper input[type="file"] {
        position: absolute;
        inset: 0;
        opacity: 0;
        cursor: pointer;
        z-index: 2;
    }

    .file-upload-label {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem 1rem;
        border-radius: 0.75rem;
        background: #F8FAFC;
        border: 2px dashed #E2E8F0;
        color: #64748B;
        font-size: 0.875rem;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .file-upload-label:hover {
        border-color: #2563EB;
        background: #EFF6FF;
    }

    .file-upload-label .file-icon {
        flex-shrink: 0;
        width: 1.25rem;
        height: 1.25rem;
        color: #94A3B8;
    }

    .file-upload-label .file-name {
        color: #0F172A;
        font-weight: 500;
        flex: 1;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .file-upload-label .file-hint {
        color: #94A3B8;
        font-size: 0.75rem;
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

    .alert-error ul {
        margin: 0;
        padding-left: 1.25rem;
        list-style: disc;
    }

    .alert-error li {
        margin: 0.125rem 0;
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

    .alert-error svg {
        flex-shrink: 0;
        width: 1.25rem;
        height: 1.25rem;
        align-self: flex-start;
        margin-top: 0.125rem;
    }

    .link-login {
        color: #2563EB;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s ease;
        position: relative;
    }

    .link-login::after {
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

    .link-login:hover::after {
        transform: scaleX(1);
    }

    .link-login:hover {
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

    /* Password strength */
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

    /* Dark mode support */
    @media (prefers-color-scheme: dark) {
        .register-container {
            background: linear-gradient(135deg, #0F172A 0%, #1E293B 50%, #0F172A 100%);
        }

        .register-container::before {
            background: radial-gradient(circle, rgba(37, 99, 235, 0.12) 0%, transparent 70%);
        }

        .register-container::after {
            background: radial-gradient(circle, rgba(139, 92, 246, 0.08) 0%, transparent 70%);
        }

        .register-card {
            background: rgba(30, 41, 59, 0.95);
            backdrop-filter: blur(20px);
            border-color: rgba(37, 99, 235, 0.15);
        }

        .register-title {
            color: #F8FAFC;
        }

        .register-subtitle {
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

        .form-select {
            background: #1E293B;
            border-color: #334155;
            color: #F8FAFC;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2394A3B8' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
        }

        .form-select:focus {
            border-color: #3B82F6;
            background-color: #1E293B;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.15);
        }

        .form-select option {
            background: #1E293B;
            color: #F8FAFC;
        }

        .form-select.error {
            border-color: #F87171;
            background-color: #450A0A;
        }

        .form-select.error:focus {
            box-shadow: 0 0 0 4px rgba(248, 113, 113, 0.15);
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

        .link-login {
            color: #60A5FA;
        }

        .link-login::after {
            background: #60A5FA;
        }

        .link-login:hover {
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

        .file-upload-label {
            background: #1E293B;
            border-color: #334155;
            color: #94A3B8;
        }

        .file-upload-label:hover {
            border-color: #3B82F6;
            background: #1E293B;
        }

        .file-upload-label .file-icon {
            color: #64748B;
        }

        .file-upload-label .file-name {
            color: #F8FAFC;
        }
    }

    /* Select2 Custom Overrides */
    .select2-container--default .select2-selection--single {
        background: #F8FAFC !important;
        border: 2px solid #E2E8F0 !important;
        border-radius: 0.75rem !important;
        height: 3.25rem !important;
        padding: 0.5rem 1rem !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #0F172A !important;
        line-height: 2rem !important;
        padding-left: 0 !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 3.25rem !important;
        right: 0.75rem !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow b {
        border-color: #94A3B8 transparent transparent transparent !important;
    }

    .select2-container--default.select2-container--open .select2-selection--single .select2-selection__arrow b {
        border-color: transparent transparent #94A3B8 transparent !important;
    }

    .select2-container--default .select2-selection--single:focus {
        border-color: #2563EB !important;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1) !important;
    }

    .select2-dropdown {
        border: 2px solid #E2E8F0 !important;
        border-radius: 0.75rem !important;
        overflow: hidden !important;
    }

    .select2-container--default .select2-results__option--highlighted[aria-selected] {
        background: #2563EB !important;
    }

    .select2-container--default .select2-results__option[aria-selected="true"] {
        background: #EFF6FF !important;
        color: #2563EB !important;
    }

    @media (prefers-color-scheme: dark) {
        .select2-container--default .select2-selection--single {
            background: #1E293B !important;
            border-color: #334155 !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #F8FAFC !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow b {
            border-color: #94A3B8 transparent transparent transparent !important;
        }

        .select2-dropdown {
            background: #1E293B !important;
            border-color: #334155 !important;
        }

        .select2-container--default .select2-results__option {
            color: #E2E8F0 !important;
        }

        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background: #2563EB !important;
        }

        .select2-container--default .select2-results__option[aria-selected="true"] {
            background: rgba(37, 99, 235, 0.2) !important;
            color: #60A5FA !important;
        }

        .select2-container--default .select2-search--dropdown .select2-search__field {
            background: #1E293B !important;
            border-color: #334155 !important;
            color: #F8FAFC !important;
        }
    }
</style>

<div class="register-container">

    <div class="register-card">

        {{-- Title --}}
        <div class="text-center mb-7">
            <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-[#2563EB]/10 mb-4">
                <svg class="w-7 h-7 text-[#2563EB]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                </svg>
            </div>
            <h2 class="register-title">
                Buat Akun Baru ✨
            </h2>
            <p class="register-subtitle">
                Daftar dan mulai perjalanan belajarmu
            </p>
        </div>

        {{-- Errors --}}
        @if ($errors->any())
            <div class="alert-error mb-4">
                <svg class="flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div>
                    <ul>
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        {{-- Form --}}
        <form action="{{ route('register.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5" id="registerForm" novalidate>
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                {{-- Nama Lengkap --}}
                <div class="md:col-span-2">
                    <label class="form-label">
                        Nama Lengkap <span class="required">*</span>
                    </label>
                    <div class="input-wrapper">
                        <svg class="input-icon w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <input
                            type="text"
                            name="name"
                            required
                            placeholder="Nama lengkap..."
                            class="form-input @error('name') error @enderror"
                            value="{{ old('name') }}"
                            id="nameInput"
                        >
                    </div>
                </div>

                {{-- Email --}}
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
                            placeholder="Masukkan email..."
                            class="form-input @error('email') error @enderror"
                            value="{{ old('email') }}"
                            id="emailInput"
                        >
                    </div>
                </div>

                {{-- Phone --}}
                <div>
                    <label class="form-label">
                        No. HP
                    </label>
                    <div class="input-wrapper">
                        <svg class="input-icon w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <input
                            type="text"
                            name="phone"
                            placeholder="08xxxxxxxxxx"
                            class="form-input @error('phone') error @enderror"
                            value="{{ old('phone') }}"
                            id="phoneInput"
                        >
                    </div>
                </div>

                {{-- Password --}}
                <div>
                    <label class="form-label">
                        Password <span class="required">*</span>
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

                    {{-- Password Strength --}}
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
                        Konfirmasi Password <span class="required">*</span>
                    </label>
                    <div class="input-wrapper">
                        <svg class="input-icon w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        <input
                            type="password"
                            name="password_confirmation"
                            required
                            placeholder="Konfirmasi password..."
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

                {{-- Province --}}
                <div>
                    <label class="form-label">
                        Provinsi <span class="required">*</span>
                    </label>
                    <select id="province_id" name="province_id" class="form-select @error('province_id') error @enderror select2" required>
                        <option value="">— Pilih Provinsi —</option>
                        @foreach ($provinces as $prov)
                            <option value="{{ $prov->id }}" {{ old('province_id') == $prov->id ? 'selected' : '' }}>
                                {{ $prov->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Regency --}}
                <div>
                    <label class="form-label">
                        Kabupaten / Kota <span class="required">*</span>
                    </label>
                    <select id="regency_id" name="regency_id" class="form-select @error('regency_id') error @enderror select2" required>
                        <option value="">— Pilih Kab/Kota —</option>
                    </select>
                </div>

                {{-- Avatar --}}
                <div class="md:col-span-2">
                    <label class="form-label">
                        Foto Profil <span class="text-xs text-[#94A3B8] font-normal">(Opsional)</span>
                    </label>
                    <div class="file-upload-wrapper">
                        <input type="file" name="avatar" accept="image/*" id="avatarInput">
                        <div class="file-upload-label" id="fileLabel">
                            <svg class="file-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span class="file-name" id="fileName">Pilih file gambar...</span>
                            <span class="file-hint">JPG, PNG, WEBP • Max 2MB</span>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Submit --}}
            <button type="submit" class="btn-submit" id="submitBtn">
                <span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                    </svg>
                    Daftar Sekarang
                </span>
            </button>

        </form>

        {{-- Divider --}}
        <div class="divider">
            <span class="divider-text">Sudah punya akun?</span>
        </div>

        {{-- Footer --}}
        <p class="text-sm text-center text-[#475569] dark:text-[#94A3B8]">
            <a href="{{ route('login') }}" class="link-login">
                Login di sini
            </a>
        </p>
    </div>

</div>

@endsection

@push('scripts')
{{-- jQuery + Select2 --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$(document).ready(function () {

    // Initialize Select2
    $('.select2').select2({
        placeholder: '— Pilih —',
        allowClear: true,
        width: '100%'
    });

    // Province -> Regency cascade
    $('#province_id').on('change', function () {
        let provinceId = $(this).val();
        let regencySelect = $('#regency_id');

        regencySelect.empty().append('<option value="">Loading...</option>');

        if (!provinceId) {
            regencySelect.empty().append('<option value="">— Pilih Kab/Kota —</option>');
            regencySelect.trigger('change');
            return;
        }

        $.get(`/api/regencies/${provinceId}`, function (data) {
            regencySelect.empty().append('<option value="">— Pilih Kab/Kota —</option>');

            data.forEach(function (item) {
                regencySelect.append(new Option(item.name, item.id));
            });

            // Set old value if exists
            const oldRegency = "{{ old('regency_id') }}";
            if (oldRegency) {
                regencySelect.val(oldRegency);
            }

            regencySelect.trigger('change');
        }).fail(function() {
            regencySelect.empty().append('<option value="">— Gagal memuat data —</option>');
        });
    });

    // Trigger province change if old value exists
    const oldProvince = "{{ old('province_id') }}";
    if (oldProvince) {
        $('#province_id').val(oldProvince).trigger('change');
    }

});

// Vanilla JS for form interactions
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('registerForm');
    const submitBtn = document.getElementById('submitBtn');

    // Toggle password visibility
    document.querySelectorAll('.toggle-password').forEach(btn => {
        btn.addEventListener('click', function() {
            const targetId = this.dataset.target;
            const input = document.getElementById(targetId);
            if (!input) return;

            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);

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
    const passwordInput = document.getElementById('passwordInput');
    const confirmInput = document.getElementById('confirmInput');
    const strengthBars = document.querySelectorAll('#strengthBars .password-strength-bar');
    const strengthLabel = document.getElementById('strengthLabel');
    const confirmMessage = document.getElementById('confirmMessage');

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

    if (passwordInput) {
        passwordInput.addEventListener('input', function() {
            updateStrengthIndicator(this.value);
            if (confirmInput.value.length > 0) {
                checkPasswordMatch();
            }
            this.classList.remove('error');
        });
    }

    function checkPasswordMatch() {
        const password = passwordInput ? passwordInput.value : '';
        const confirm = confirmInput ? confirmInput.value : '';

        if (confirm.length === 0) {
            confirmMessage.textContent = '';
            if (confirmInput) confirmInput.classList.remove('success', 'error');
            return;
        }

        if (password === confirm) {
            confirmMessage.textContent = '✓ Password cocok';
            confirmMessage.className = 'text-xs text-[#22C55E] mt-1';
            if (confirmInput) {
                confirmInput.classList.remove('error');
                confirmInput.classList.add('success');
            }
        } else {
            confirmMessage.textContent = '✗ Password tidak cocok';
            confirmMessage.className = 'text-xs text-[#EF4444] mt-1';
            if (confirmInput) {
                confirmInput.classList.remove('success');
                confirmInput.classList.add('error');
            }
        }
    }

    if (confirmInput) {
        confirmInput.addEventListener('input', function() {
            checkPasswordMatch();
            this.classList.remove('error');
        });
    }

    // File upload handler
    const avatarInput = document.getElementById('avatarInput');
    const fileName = document.getElementById('fileName');

    if (avatarInput) {
        avatarInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const file = this.files[0];
                const maxSize = 2 * 1024 * 1024;
                if (file.size > maxSize) {
                    alert('Ukuran file terlalu besar. Maksimal 2MB.');
                    this.value = '';
                    fileName.textContent = 'Pilih file gambar...';
                    return;
                }
                const validTypes = ['image/jpeg', 'image/png', 'image/webp'];
                if (!validTypes.includes(file.type)) {
                    alert('Format file tidak didukung. Gunakan JPG, PNG, atau WEBP.');
                    this.value = '';
                    fileName.textContent = 'Pilih file gambar...';
                    return;
                }
                fileName.textContent = file.name;
            } else {
                fileName.textContent = 'Pilih file gambar...';
            }
        });
    }

    // Form validation
    if (form) {
        form.addEventListener('submit', function(e) {
            // Validate name
            const nameInput = document.getElementById('nameInput');
            if (nameInput && !nameInput.value.trim()) {
                e.preventDefault();
                nameInput.classList.add('error');
                nameInput.focus();
                return;
            }

            // Validate email
            const emailInput = document.getElementById('emailInput');
            if (emailInput) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailInput.value.trim() || !emailRegex.test(emailInput.value.trim())) {
                    e.preventDefault();
                    emailInput.classList.add('error');
                    emailInput.focus();
                    return;
                }
            }

            // Validate password
            if (passwordInput) {
                if (passwordInput.value.length < 8) {
                    e.preventDefault();
                    passwordInput.classList.add('error');
                    passwordInput.focus();
                    return;
                }
            }

            // Validate password match
            if (passwordInput && confirmInput) {
                if (passwordInput.value !== confirmInput.value) {
                    e.preventDefault();
                    confirmInput.classList.add('error');
                    confirmInput.focus();
                    return;
                }
            }

            // Validate province
            const provinceSelect = document.getElementById('province_id');
            if (provinceSelect && !provinceSelect.value) {
                e.preventDefault();
                provinceSelect.classList.add('error');
                provinceSelect.focus();
                return;
            }

            // Validate regency
            const regencySelect = document.getElementById('regency_id');
            if (regencySelect && !regencySelect.value) {
                e.preventDefault();
                regencySelect.classList.add('error');
                regencySelect.focus();
                return;
            }

            // Show loading state
            submitBtn.disabled = true;
            submitBtn.querySelector('span').innerHTML = `
                <span class="spinner"></span>
                Mendaftar...
            `;
        });
    }

    // Remove error state on input
    document.querySelectorAll('.form-input, .form-select').forEach(el => {
        el.addEventListener('input', function() {
            this.classList.remove('error');
        });
        el.addEventListener('change', function() {
            this.classList.remove('error');
        });
    });
});
</script>
@endpush
