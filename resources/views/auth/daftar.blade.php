@extends('layouts.guest')

@section('title', 'Pendaftaran – Satya Naratama')
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
        max-width: 820px;
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

    .section-title {
        font-size: 1rem;
        font-weight: 700;
        color: #0F172A;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .section-title .badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 0.625rem;
        font-weight: 700;
        color: white;
        background: #2563EB;
        padding: 0.125rem 0.5rem;
        border-radius: 9999px;
        min-width: 1.25rem;
        height: 1.25rem;
    }

    .section-divider {
        border: none;
        border-top: 1px solid #E2E8F0;
        margin: 0 0 1rem 0;
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

    .form-label .optional {
        color: #94A3B8;
        font-weight: 400;
        font-size: 0.75rem;
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

    .radio-group {
        display: flex;
        gap: 1.5rem;
        margin-top: 0.375rem;
    }

    .radio-group label {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.875rem;
        color: #1E293B;
        cursor: pointer;
        transition: color 0.2s ease;
    }

    .radio-group label:hover {
        color: #2563EB;
    }

    .radio-group input[type="radio"] {
        width: 1.125rem;
        height: 1.125rem;
        accent-color: #2563EB;
        cursor: pointer;
        flex-shrink: 0;
    }

    .input-wrapper {
        position: relative;
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

    .form-hint {
        font-size: 0.75rem;
        color: #94A3B8;
        margin-top: 0.25rem;
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

    .alert-error {
        background: #FEF2F2;
        color: #991B1B;
        padding: 0.75rem 1rem;
        border-radius: 0.75rem;
        font-size: 0.875rem;
        border: 1px solid #FECACA;
        margin-bottom: 1.5rem;
    }

    .alert-error ul {
        margin: 0;
        padding-left: 1.25rem;
        list-style: disc;
    }

    .alert-error li {
        margin: 0.125rem 0;
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

    .link-status {
        color: #2563EB;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
    }

    .link-status:hover {
        color: #1D4ED8;
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

        .section-title {
            color: #F8FAFC;
        }

        .section-divider {
            border-color: #334155;
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

        .radio-group label {
            color: #E2E8F0;
        }

        .radio-group label:hover {
            color: #60A5FA;
        }

        .radio-group input[type="radio"] {
            accent-color: #60A5FA;
        }

        .alert-error {
            background: #7F1D1D;
            color: #FCA5A5;
            border-color: #991B1B;
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

        .form-hint {
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

        .link-status {
            color: #60A5FA;
        }

        .link-status:hover {
            color: #93BBFC;
        }

        .divider::before,
        .divider::after {
            background: #334155;
        }

        .divider-text {
            color: #64748B;
        }
    }
</style>

<div class="register-container">

    <div class="register-card">

        {{-- Title --}}
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-[#2563EB]/10 mb-4">
                <svg class="w-7 h-7 text-[#2563EB]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                </svg>
            </div>
            <h2 class="register-title">
                Daftar Sekarang 🎉
            </h2>
            <p class="register-subtitle">
                Isi formulir pendaftaran dengan lengkap dan benar
            </p>
        </div>

        {{-- Errors --}}
        @if ($errors->any())
            <div class="alert-error">
                <ul>
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form --}}
        <form action="{{ route('daftar.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6" id="registerForm" novalidate>
            @csrf

            {{-- Data Pribadi --}}
            <div>
                <div class="section-title">
                    <span>Data Pribadi</span>
                    <span class="badge">1</span>
                </div>
                <hr class="section-divider">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    {{-- Nama Lengkap --}}
                    <div>
                        <label class="form-label">
                            Nama Lengkap <span class="required">*</span>
                        </label>
                        <input
                            type="text"
                            name="full_name"
                            required
                            value="{{ old('full_name') }}"
                            placeholder="Nama lengkap"
                            class="form-input @error('full_name') error @enderror"
                            id="fullNameInput"
                        >
                    </div>

                    {{-- Nama Panggilan --}}
                    <div>
                        <label class="form-label">
                            Nama Panggilan
                        </label>
                        <input
                            type="text"
                            name="nickname"
                            value="{{ old('nickname') }}"
                            placeholder="Nama panggilan"
                            class="form-input"
                        >
                    </div>

                    {{-- Tanggal Lahir --}}
                    <div>
                        <label class="form-label">
                            Tanggal Lahir <span class="required">*</span>
                        </label>
                        <input
                            type="date"
                            name="birth_date"
                            required
                            value="{{ old('birth_date') }}"
                            class="form-input @error('birth_date') error @enderror"
                        >
                    </div>

                    {{-- Jenis Kelamin --}}
                    <div>
                        <label class="form-label">
                            Jenis Kelamin <span class="required">*</span>
                        </label>
                        <div class="radio-group">
                            <label>
                                <input type="radio" name="gender" value="L" {{ old('gender') == 'L' ? 'checked' : '' }}>
                                Laki-laki
                            </label>
                            <label>
                                <input type="radio" name="gender" value="P" {{ old('gender') == 'P' ? 'checked' : '' }}>
                                Perempuan
                            </label>
                        </div>
                    </div>

                    {{-- Asal Sekolah --}}
                    <div>
                        <label class="form-label">
                            Asal Sekolah <span class="required">*</span>
                        </label>
                        <input
                            type="text"
                            name="school_origin"
                            required
                            value="{{ old('school_origin') }}"
                            placeholder="Nama sekolah"
                            class="form-input @error('school_origin') error @enderror"
                        >
                    </div>

                    {{-- Kelas --}}
                    <div>
                        <label class="form-label">
                            Kelas <span class="required">*</span>
                        </label>
                        <select
                            name="class"
                            required
                            class="form-select @error('class') error @enderror"
                        >
                            <option value="">— Pilih Kelas —</option>
                            @foreach($classes as $class)
                                <option value="{{ $class }}" {{ old('class') == $class ? 'selected' : '' }}>
                                    {{ $class }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Nomor WhatsApp --}}
                    <div>
                        <label class="form-label">
                            Nomor WhatsApp <span class="required">*</span>
                        </label>
                        <input
                            type="text"
                            name="phone"
                            required
                            value="{{ old('phone') }}"
                            placeholder="08xxxxxxxxxx"
                            class="form-input @error('phone') error @enderror"
                        >
                    </div>

                    {{-- Kecamatan --}}
                    <div>
                        <label class="form-label">
                            Kecamatan <span class="required">*</span>
                        </label>
                        <select
                            id="kecamatan_id"
                            name="kecamatan_id"
                            required
                            class="form-select @error('kecamatan_id') error @enderror"
                        >
                            <option value="">— Pilih Kecamatan —</option>
                            @foreach($kecamatans as $kec)
                                <option value="{{ $kec->id }}" {{ old('kecamatan_id') == $kec->id ? 'selected' : '' }}>
                                    {{ $kec->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Kelurahan --}}
                    <div>
                        <label class="form-label">
                            Kelurahan/Desa <span class="required">*</span>
                        </label>
                        <select
                            id="kelurahan_id"
                            name="kelurahan_id"
                            required
                            class="form-select @error('kelurahan_id') error @enderror"
                        >
                            <option value="">— Pilih Kelurahan —</option>
                        </select>
                    </div>

                    {{-- Tinggi Badan --}}
                    <div>
                        <label class="form-label">
                            Tinggi Badan <span class="optional">(cm)</span>
                        </label>
                        <input
                            type="number"
                            name="height_cm"
                            value="{{ old('height_cm') }}"
                            placeholder="170"
                            min="50"
                            max="300"
                            class="form-input"
                        >
                    </div>

                    {{-- Berat Badan --}}
                    <div>
                        <label class="form-label">
                            Berat Badan <span class="optional">(kg)</span>
                        </label>
                        <input
                            type="number"
                            name="weight_kg"
                            value="{{ old('weight_kg') }}"
                            placeholder="60"
                            min="10"
                            max="500"
                            class="form-input"
                        >
                    </div>

                    {{-- Ukuran Baju --}}
                    <div>
                        <label class="form-label">
                            Ukuran Baju
                        </label>
                        <select name="shirt_size" class="form-select">
                            <option value="">— Pilih Ukuran —</option>
                            <option value="S" {{ old('shirt_size') == 'S' ? 'selected' : '' }}>S (Small)</option>
                            <option value="M" {{ old('shirt_size') == 'M' ? 'selected' : '' }}>M (Medium)</option>
                            <option value="L" {{ old('shirt_size') == 'L' ? 'selected' : '' }}>L (Large)</option>
                            <option value="XL" {{ old('shirt_size') == 'XL' ? 'selected' : '' }}>XL (Extra Large)</option>
                            <option value="XXL" {{ old('shirt_size') == 'XXL' ? 'selected' : '' }}>XXL (Double Extra Large)</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- Kampus Impian --}}
            <div>
                <div class="section-title">
                    <span>Kampus Impian</span>
                    <span class="badge">2</span>
                </div>
                <hr class="section-divider">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Prioritas 1 --}}
                    <div>
                        <label class="form-label">
                            Prioritas 1 <span class="required">*</span>
                        </label>
                        <select
                            name="priority_university_1"
                            required
                            class="form-select @error('priority_university_1') error @enderror"
                        >
                            <option value="">— Pilih Kampus —</option>
                            @foreach($universities as $uni)
                                <option value="{{ $uni }}" {{ old('priority_university_1') == $uni ? 'selected' : '' }}>
                                    {{ $uni }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Prioritas 2 --}}
                    <div>
                        <label class="form-label">
                            Prioritas 2
                        </label>
                        <select name="priority_university_2" class="form-select">
                            <option value="">— Pilih Kampus —</option>
                            @foreach($universities as $uni)
                                <option value="{{ $uni }}" {{ old('priority_university_2') == $uni ? 'selected' : '' }}>
                                    {{ $uni }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            {{-- Data Orangtua --}}
            <div>
                <div class="section-title">
                    <span>Data Orangtua</span>
                    <span class="badge">3</span>
                </div>
                <hr class="section-divider">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Nama Orangtua --}}
                    <div>
                        <label class="form-label">
                            Nama Orangtua <span class="required">*</span>
                        </label>
                        <input
                            type="text"
                            name="parent_name"
                            required
                            value="{{ old('parent_name') }}"
                            placeholder="Nama ayah/ibu"
                            class="form-input @error('parent_name') error @enderror"
                        >
                    </div>

                    {{-- Pekerjaan Orangtua --}}
                    <div>
                        <label class="form-label">
                            Pekerjaan Orangtua
                        </label>
                        <input
                            type="text"
                            name="parent_occupation"
                            value="{{ old('parent_occupation') }}"
                            placeholder="Pekerjaan"
                            class="form-input"
                        >
                    </div>

                    {{-- Nomor Telepon Orangtua --}}
                    <div>
                        <label class="form-label">
                            Nomor Telepon Orangtua <span class="required">*</span>
                        </label>
                        <input
                            type="text"
                            name="parent_phone"
                            required
                            value="{{ old('parent_phone') }}"
                            placeholder="08xxxxxxxxxx"
                            class="form-input @error('parent_phone') error @enderror"
                        >
                    </div>
                </div>
            </div>

            {{-- Data Akun --}}
            <div>
                <div class="section-title">
                    <span>Data Akun</span>
                    <span class="badge">4</span>
                </div>
                <hr class="section-divider">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Email --}}
                    <div>
                        <label class="form-label">
                            Email <span class="required">*</span>
                        </label>
                        <input
                            type="email"
                            name="email"
                            required
                            value="{{ old('email') }}"
                            placeholder="email@example.com"
                            class="form-input @error('email') error @enderror"
                        >
                        <p class="form-hint">Email akan digunakan untuk login</p>
                    </div>

                    {{-- Password --}}
                    <div>
                        <label class="form-label">
                            Password <span class="required">*</span>
                        </label>
                        <div class="input-wrapper">
                            <input
                                type="password"
                                name="password"
                                required
                                placeholder="Minimal 8 karakter"
                                class="form-input @error('password') error @enderror"
                                id="passwordInput"
                                minlength="8"
                            >
                        </div>
                    </div>

                    {{-- Konfirmasi Password --}}
                    <div>
                        <label class="form-label">
                            Konfirmasi Password <span class="required">*</span>
                        </label>
                        <input
                            type="password"
                            name="password_confirmation"
                            required
                            placeholder="Ulangi password"
                            class="form-input"
                            id="confirmInput"
                        >
                        <div class="text-xs text-[#94A3B8] mt-1" id="confirmMessage"></div>
                    </div>

                    {{-- Upload Foto --}}
                    <div>
                        <label class="form-label">
                            Foto Profil <span class="optional">(Opsional)</span>
                        </label>
                        <div class="file-upload-wrapper">
                            <input
                                type="file"
                                name="avatar"
                                accept="image/*"
                                id="avatarInput"
                            >
                            <div class="file-upload-label" id="fileLabel">
                                <svg class="file-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span class="file-name" id="fileName">Pilih file gambar...</span>
                                <span class="file-hint">JPG, PNG • Max 2MB</span>
                            </div>
                        </div>
                        <p class="form-hint">Format: JPG, PNG. Maks 2MB</p>
                    </div>
                </div>
            </div>

            {{-- Submit --}}
            <div class="space-y-4 pt-2">
                <button type="submit" class="btn-submit" id="submitBtn">
                    <span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                        Daftar Sekarang
                    </span>
                </button>

                <div class="divider">
                    <span class="divider-text">Sudah punya akun?</span>
                </div>

                <div class="flex flex-col sm:flex-row items-center justify-center gap-3 text-sm">
                    <a href="{{ route('login') }}" class="link-login">
                        Login di sini
                    </a>
                    <span class="text-[#94A3B8]">atau</span>
                    <a href="{{ route('daftar.status.form') }}" class="link-status">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        Cek Status Pendaftaran
                    </a>
                </div>
            </div>

        </form>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    // Load kelurahan when kecamatan changes
    $('#kecamatan_id').on('change', function () {
        let kecamatanId = $(this).val();
        let kelurahanSelect = $('#kelurahan_id');

        kelurahanSelect.empty().append('<option value="">Loading...</option>');

        if (!kecamatanId) {
            kelurahanSelect.empty().append('<option value="">— Pilih Kelurahan —</option>');
            return;
        }

        $.get('/daftar/kelurahan', { kecamatan_id: kecamatanId }, function (data) {
            kelurahanSelect.empty().append('<option value="">— Pilih Kelurahan —</option>');

            data.forEach(function (item) {
                kelurahanSelect.append(new Option(item.name, item.id));
            });
        });
    });

    // Jika ada old value, trigger change untuk load kelurahan
    @if(old('kecamatan_id'))
        $('#kecamatan_id').val('{{ old('kecamatan_id') }}').trigger('change');

        setTimeout(function() {
            $('#kelurahan_id').val('{{ old('kelurahan_id') }}');
        }, 500);
    @endif
});

// Vanilla JS for form interactions
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('registerForm');
    const submitBtn = document.getElementById('submitBtn');
    const passwordInput = document.getElementById('passwordInput');
    const confirmInput = document.getElementById('confirmInput');
    const confirmMessage = document.getElementById('confirmMessage');

    // Password confirmation check
    if (passwordInput && confirmInput) {
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

        passwordInput.addEventListener('input', function() {
            this.classList.remove('error');
            if (confirmInput.value.length > 0) {
                checkPasswordMatch();
            }
        });

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
                    alert('Format file tidak didukung. Gunakan JPG atau PNG.');
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
            // Validate password match
            if (passwordInput && confirmInput) {
                if (passwordInput.value !== confirmInput.value) {
                    e.preventDefault();
                    confirmInput.classList.add('error');
                    confirmInput.focus();
                    return;
                }
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
