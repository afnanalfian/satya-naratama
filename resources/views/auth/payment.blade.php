@extends('layouts.guest')

@section('title', 'Pembayaran – Satya Naratama')
@section('content')

<style>
    .payment-container {
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

    .payment-container::before {
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

    .payment-container::after {
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

    .payment-card {
        position: relative;
        z-index: 1;
        width: 100%;
        max-width: 640px;
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
        .payment-card {
            padding: 2.5rem 2.5rem;
        }
    }

    .payment-card:hover {
        box-shadow: 0 8px 48px rgba(37, 99, 235, 0.12), 0 2px 8px rgba(0, 0, 0, 0.04);
    }

    /* Decorative top accent */
    .payment-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #2563EB, #8B5CF6, #2563EB);
        border-radius: 1.5rem 1.5rem 0 0;
    }

    .payment-title {
        font-size: 1.75rem;
        font-weight: 800;
        color: #0F172A;
        letter-spacing: -0.02em;
        margin-bottom: 0.25rem;
    }

    .payment-subtitle {
        font-size: 0.875rem;
        color: #64748B;
        margin-top: 0.25rem;
    }

    .info-box {
        background: rgba(37, 99, 235, 0.05);
        border: 1px solid rgba(37, 99, 235, 0.15);
        border-radius: 0.75rem;
        padding: 1rem 1.25rem;
    }

    .info-box .info-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.25rem 0;
    }

    .info-box .info-row:not(:last-child) {
        border-bottom: 1px solid rgba(37, 99, 235, 0.06);
        padding-bottom: 0.5rem;
        margin-bottom: 0.5rem;
    }

    .info-box .info-label {
        font-size: 0.875rem;
        color: #64748B;
    }

    .info-box .info-value {
        font-size: 0.875rem;
        font-weight: 600;
        color: #0F172A;
    }

    .info-box .info-value.amount {
        font-size: 1.25rem;
        font-weight: 800;
        color: #2563EB;
    }

    .info-box .info-value.code {
        font-family: 'Courier New', monospace;
        font-weight: 600;
        color: #0F172A;
        background: rgba(37, 99, 235, 0.06);
        padding: 0.125rem 0.5rem;
        border-radius: 0.25rem;
    }

    .section-title {
        font-size: 0.875rem;
        font-weight: 600;
        color: #1E293B;
        margin-bottom: 0.75rem;
    }

    .bank-card {
        background: #F8FAFC;
        border: 2px solid #E2E8F0;
        border-radius: 0.75rem;
        padding: 1rem 1.25rem;
        transition: all 0.3s ease;
    }

    .bank-card:hover {
        border-color: #2563EB;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.06);
    }

    .bank-card .bank-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 0.5rem;
    }

    .bank-card .bank-name {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .bank-card .bank-name .bank-icon {
        width: 2rem;
        height: 2rem;
        border-radius: 0.5rem;
        background: linear-gradient(135deg, #2563EB, #1D4ED8);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 0.75rem;
    }

    .bank-card .bank-name .bank-title {
        font-weight: 700;
        color: #0F172A;
    }

    .bank-card .bank-name .bank-sub {
        font-size: 0.75rem;
        color: #94A3B8;
    }

    .bank-card .bank-number {
        font-family: 'Courier New', monospace;
        font-size: 1.125rem;
        font-weight: 700;
        color: #0F172A;
        letter-spacing: 0.05em;
        margin: 0.25rem 0;
    }

    .bank-card .bank-owner {
        font-size: 0.875rem;
        color: #64748B;
    }

    .btn-copy {
        padding: 0.375rem 0.75rem;
        font-size: 0.75rem;
        font-weight: 600;
        border-radius: 0.5rem;
        background: rgba(37, 99, 235, 0.08);
        color: #2563EB;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        flex-shrink: 0;
    }

    .btn-copy:hover {
        background: rgba(37, 99, 235, 0.16);
        transform: translateY(-1px);
    }

    .btn-copy.copied {
        background: #22C55E;
        color: white;
    }

    .alert-info {
        background: #FEFCE8;
        border: 1px solid #FDE68A;
        border-radius: 0.75rem;
        padding: 0.75rem 1rem;
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
    }

    .alert-info svg {
        flex-shrink: 0;
        width: 1.25rem;
        height: 1.25rem;
        color: #D97706;
        margin-top: 0.0625rem;
    }

    .alert-info p {
        font-size: 0.8rem;
        color: #92400E;
        line-height: 1.5;
        margin: 0;
    }

    .alert-info p strong {
        font-weight: 700;
    }

    .alert-whatsapp {
        background: #F0FDF4;
        border: 1px solid #BBF7D0;
        border-radius: 0.75rem;
        padding: 0.75rem 1rem;
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
    }

    .alert-whatsapp svg {
        flex-shrink: 0;
        width: 1.25rem;
        height: 1.25rem;
        color: #22C55E;
        margin-top: 0.0625rem;
    }

    .alert-whatsapp .content {
        flex: 1;
    }

    .alert-whatsapp .content p {
        font-size: 0.8rem;
        color: #14532D;
        line-height: 1.5;
        margin: 0 0 0.25rem 0;
    }

    .alert-whatsapp .content a {
        color: #2563EB;
        font-weight: 600;
        text-decoration: none;
        font-size: 0.875rem;
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
    }

    .alert-whatsapp .content a:hover {
        color: #1D4ED8;
        text-decoration: underline;
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

    .btn-submit {
        flex: 1;
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
        text-align: center;
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

    .btn-secondary {
        flex: 1;
        padding: 0.875rem 1.5rem;
        border-radius: 0.75rem;
        font-weight: 600;
        font-size: 1rem;
        color: #475569;
        background: transparent;
        border: 2px solid #E2E8F0;
        cursor: pointer;
        transition: all 0.3s ease;
        text-align: center;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .btn-secondary:hover {
        border-color: #94A3B8;
        background: #F1F5F9;
        transform: translateY(-2px);
    }

    .btn-secondary:active {
        transform: scale(0.98);
    }

    .link-status {
        color: #2563EB;
        font-weight: 600;
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
        .payment-container {
            background: linear-gradient(135deg, #0F172A 0%, #1E293B 50%, #0F172A 100%);
        }

        .payment-container::before {
            background: radial-gradient(circle, rgba(37, 99, 235, 0.12) 0%, transparent 70%);
        }

        .payment-container::after {
            background: radial-gradient(circle, rgba(139, 92, 246, 0.08) 0%, transparent 70%);
        }

        .payment-card {
            background: rgba(30, 41, 59, 0.95);
            backdrop-filter: blur(20px);
            border-color: rgba(37, 99, 235, 0.15);
        }

        .payment-title {
            color: #F8FAFC;
        }

        .payment-subtitle {
            color: #94A3B8;
        }

        .info-box {
            background: rgba(37, 99, 235, 0.08);
            border-color: rgba(37, 99, 235, 0.15);
        }

        .info-box .info-row:not(:last-child) {
            border-color: rgba(37, 99, 235, 0.08);
        }

        .info-box .info-label {
            color: #94A3B8;
        }

        .info-box .info-value {
            color: #F8FAFC;
        }

        .info-box .info-value.amount {
            color: #60A5FA;
        }

        .info-box .info-value.code {
            color: #F8FAFC;
            background: rgba(37, 99, 235, 0.12);
        }

        .section-title {
            color: #E2E8F0;
        }

        .bank-card {
            background: #1E293B;
            border-color: #334155;
        }

        .bank-card:hover {
            border-color: #3B82F6;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.12);
        }

        .bank-card .bank-name .bank-title {
            color: #F8FAFC;
        }

        .bank-card .bank-name .bank-sub {
            color: #64748B;
        }

        .bank-card .bank-number {
            color: #F8FAFC;
        }

        .bank-card .bank-owner {
            color: #94A3B8;
        }

        .btn-copy {
            background: rgba(37, 99, 235, 0.15);
            color: #60A5FA;
        }

        .btn-copy:hover {
            background: rgba(37, 99, 235, 0.25);
        }

        .alert-info {
            background: rgba(251, 191, 36, 0.1);
            border-color: rgba(251, 191, 36, 0.2);
        }

        .alert-info svg {
            color: #FBBF24;
        }

        .alert-info p {
            color: #FDE68A;
        }

        .alert-whatsapp {
            background: rgba(34, 197, 94, 0.08);
            border-color: rgba(34, 197, 94, 0.15);
        }

        .alert-whatsapp svg {
            color: #4ADE80;
        }

        .alert-whatsapp .content p {
            color: #86EFAC;
        }

        .alert-whatsapp .content a {
            color: #60A5FA;
        }

        .alert-whatsapp .content a:hover {
            color: #93BBFC;
        }

        .form-label {
            color: #E2E8F0;
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

        .btn-secondary {
            color: #94A3B8;
            border-color: #334155;
        }

        .btn-secondary:hover {
            border-color: #64748B;
            background: #1E293B;
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

<div class="payment-container">

    <div class="payment-card">

        {{-- Title --}}
        <div class="text-center mb-7">
            <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-[#2563EB]/10 mb-4">
                <svg class="w-7 h-7 text-[#2563EB]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                </svg>
            </div>
            <h2 class="payment-title">
                Selesaikan Pembayaran 💳
            </h2>
            <p class="payment-subtitle">
                {{ $registration->full_name }} • {{ $registration->email }}
            </p>
        </div>

        {{-- Info Pendaftaran --}}
        <div class="info-box mb-6">
            <div class="info-row">
                <span class="info-label">Biaya Pendaftaran</span>
                <span class="info-value amount">
                    Rp {{ number_format($registration->registration_fee, 0, ',', '.') }}
                </span>
            </div>
            <div class="info-row">
                <span class="info-label">Kode Pendaftaran</span>
                <span class="info-value code">
                    #{{ str_pad($registration->id, 6, '0', STR_PAD_LEFT) }}
                </span>
            </div>
        </div>

        {{-- Metode Pembayaran --}}
        <div class="mb-6">
            <p class="section-title">
                🏦 Transfer Bank
            </p>

            <div class="bank-card">
                <div class="bank-header">
                    <div class="bank-name">
                        <div class="bank-icon">BRI</div>
                        <div>
                            <span class="bank-title">Bank Rakyat Indonesia</span>
                            <span class="bank-sub block">BRI</span>
                        </div>
                    </div>
                    <button
                        onclick="copyRekening('022301059553505')"
                        class="btn-copy"
                        id="copyBtn"
                    >
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                        </svg>
                        Salin
                    </button>
                </div>
                <div class="bank-number">0223 0105 9553 505</div>
                <div class="bank-owner">a.n. Muhammad Afnan Alfian</div>
            </div>

            {{-- Info Penting --}}
            <div class="alert-info mt-3">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p>
                    <strong>📌 Penting:</strong>
                    Transfer sesuai nominal <strong>Rp {{ number_format($registration->registration_fee, 0, ',', '.') }}</strong>
                    dan gunakan kode pendaftaran sebagai referensi transfer.
                </p>
            </div>
        </div>

        {{-- Promo Info --}}
        <div class="alert-whatsapp mb-6">
            <svg fill="currentColor" viewBox="0 0 24 24">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.76.982.998-3.675-.236-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.9 6.994c-.004 5.45-4.438 9.88-9.888 9.88m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.333.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.333 11.893-11.893 0-3.18-1.24-6.162-3.495-8.411z"/>
            </svg>
            <div class="content">
                <p>Hubungi admin untuk info promo atau potongan harga.</p>
                <a href="https://wa.me/6282154734819?text=Halo%20Admin%2C%20saya%20ingin%20bertanya%20tentang%20promo%20pendaftaran" target="_blank">
                    Chat Admin Sekarang →
                </a>
            </div>
        </div>

        {{-- Upload Bukti --}}
        <form action="{{ route('daftar.payment.upload', $registration->id) }}"
              method="POST"
              enctype="multipart/form-data"
              class="space-y-4"
              id="paymentForm"
              novalidate>
            @csrf

            <div>
                <label class="form-label">
                    Upload Bukti Transfer <span class="required">*</span>
                </label>
                <div class="file-upload-wrapper">
                    <input
                        type="file"
                        name="payment_proof"
                        required
                        accept="image/*,.pdf"
                        id="proofInput"
                    >
                    <div class="file-upload-label" id="fileLabel">
                        <svg class="file-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span class="file-name" id="fileName">Pilih file bukti transfer...</span>
                        <span class="file-hint">JPG, PNG, PDF • Max 5MB</span>
                    </div>
                </div>
                <p class="text-xs text-[#94A3B8] mt-1" id="fileMessage"></p>
            </div>

            <div class="flex flex-col sm:flex-row gap-3">
                <button type="submit" class="btn-submit" id="submitBtn">
                    <span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Kirim Bukti Pembayaran
                    </span>
                </button>

                <a href="{{ route('daftar.payment.nanti', $registration->id) }}"
                   class="btn-secondary">
                    Bayar Nanti
                </a>
            </div>
        </form>

        {{-- Divider --}}
        <div class="divider">
            <span class="divider-text">Info Pendaftaran</span>
        </div>

        {{-- Link Cek Status --}}
        <p class="text-sm text-center text-[#475569] dark:text-[#94A3B8]">
            <a href="{{ route('daftar.status.form') }}" class="link-status">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                Cek Status Pendaftaran
            </a>
        </p>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('paymentForm');
    const submitBtn = document.getElementById('submitBtn');
    const proofInput = document.getElementById('proofInput');
    const fileName = document.getElementById('fileName');
    const fileMessage = document.getElementById('fileMessage');

    // File upload handler with validation
    if (proofInput) {
        proofInput.addEventListener('change', function() {
            const file = this.files[0];
            fileMessage.textContent = '';
            fileMessage.className = 'text-xs mt-1';

            if (file) {
                // Validate file size (max 5MB)
                const maxSize = 5 * 1024 * 1024;
                if (file.size > maxSize) {
                    fileMessage.textContent = '✗ Ukuran file terlalu besar. Maksimal 5MB.';
                    fileMessage.className = 'text-xs text-[#EF4444] mt-1';
                    this.value = '';
                    fileName.textContent = 'Pilih file bukti transfer...';
                    return;
                }

                // Validate file type
                const validTypes = ['image/jpeg', 'image/png', 'image/webp', 'application/pdf'];
                if (!validTypes.includes(file.type)) {
                    fileMessage.textContent = '✗ Format file tidak didukung. Gunakan JPG, PNG, atau PDF.';
                    fileMessage.className = 'text-xs text-[#EF4444] mt-1';
                    this.value = '';
                    fileName.textContent = 'Pilih file bukti transfer...';
                    return;
                }

                fileMessage.textContent = '✓ File siap diupload: ' + (file.size / 1024 / 1024).toFixed(2) + ' MB';
                fileMessage.className = 'text-xs text-[#22C55E] mt-1';
                fileName.textContent = file.name;
            } else {
                fileName.textContent = 'Pilih file bukti transfer...';
            }
        });
    }

    // Form submission
    if (form) {
        form.addEventListener('submit', function(e) {
            // Validate file
            if (!proofInput || !proofInput.files || !proofInput.files[0]) {
                e.preventDefault();
                fileMessage.textContent = '✗ Silakan pilih file bukti transfer terlebih dahulu.';
                fileMessage.className = 'text-xs text-[#EF4444] mt-1';
                proofInput.focus();
                return;
            }

            // Show loading state
            submitBtn.disabled = true;
            submitBtn.querySelector('span').innerHTML = `
                <span class="spinner"></span>
                Mengupload...
            `;
        });
    }
});

// Copy rekening to clipboard
function copyRekening(rekening) {
    const btn = document.getElementById('copyBtn');
    if (!btn) return;

    const originalText = btn.innerHTML;

    navigator.clipboard.writeText(rekening).then(() => {
        btn.innerHTML = `
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            Tersalin!
        `;
        btn.className = 'btn-copy copied';

        setTimeout(() => {
            btn.innerHTML = originalText;
            btn.className = 'btn-copy';
        }, 3000);
    }).catch(() => {
        // Fallback for older browsers
        const input = document.createElement('input');
        input.value = rekening;
        document.body.appendChild(input);
        input.select();
        document.execCommand('copy');
        document.body.removeChild(input);

        btn.innerHTML = `
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            Tersalin!
        `;
        btn.className = 'btn-copy copied';

        setTimeout(() => {
            btn.innerHTML = originalText;
            btn.className = 'btn-copy';
        }, 3000);
    });
}
</script>

@endsection
