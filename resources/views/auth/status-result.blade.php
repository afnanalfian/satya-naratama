<!-- resources/views/auth/status-result.blade.php -->
@extends('layouts.guest')

@section('title', 'Hasil Cek Status – Satya Naratama')
@section('content')

<style>
    .result-container {
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

    .result-container::before {
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

    .result-container::after {
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

    .result-card {
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
        .result-card {
            padding: 2.5rem 2.5rem;
        }
    }

    .result-card:hover {
        box-shadow: 0 8px 48px rgba(37, 99, 235, 0.12), 0 2px 8px rgba(0, 0, 0, 0.04);
    }

    .result-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #2563EB, #8B5CF6, #2563EB);
        border-radius: 1.5rem 1.5rem 0 0;
    }

    .result-title {
        font-size: 1.75rem;
        font-weight: 800;
        color: #0F172A;
        letter-spacing: -0.02em;
        margin-bottom: 0.25rem;
    }

    .result-subtitle {
        font-size: 0.875rem;
        color: #64748B;
        margin-top: 0.25rem;
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        color: #64748B;
        font-size: 0.875rem;
        text-decoration: none;
        transition: all 0.2s ease;
        margin-bottom: 1rem;
    }

    .back-link:hover {
        color: #2563EB;
    }

    .back-link svg {
        transition: transform 0.2s ease;
    }

    .back-link:hover svg {
        transform: translateX(-3px);
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1.25rem;
        border-radius: 9999px;
        font-weight: 700;
        font-size: 0.875rem;
        margin-bottom: 0.5rem;
    }

    .status-badge .dot {
        width: 0.5rem;
        height: 0.5rem;
        border-radius: 9999px;
    }

    .status-badge.verified {
        background: #F0FDF4;
        color: #166534;
        border: 1px solid #BBF7D0;
    }

    .status-badge.verified .dot {
        background: #22C55E;
    }

    .status-badge.pending {
        background: #FEFCE8;
        color: #854D0E;
        border: 1px solid #FDE68A;
    }

    .status-badge.pending .dot {
        background: #F59E0B;
        animation: pulse-dot 1.5s ease-in-out infinite;
    }

    .status-badge.rejected {
        background: #FEF2F2;
        color: #991B1B;
        border: 1px solid #FECACA;
    }

    .status-badge.rejected .dot {
        background: #EF4444;
    }

    .status-badge.payment {
        background: #EFF6FF;
        color: #1E40AF;
        border: 1px solid #BFDBFE;
    }

    .status-badge.payment .dot {
        background: #2563EB;
        animation: pulse-dot 1.5s ease-in-out infinite;
    }

    .status-badge.default {
        background: #F1F5F9;
        color: #475569;
        border: 1px solid #E2E8F0;
    }

    .status-badge.default .dot {
        background: #94A3B8;
    }

    @keyframes pulse-dot {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.5; transform: scale(0.8); }
    }

    .status-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 4.5rem;
        height: 4.5rem;
        border-radius: 9999px;
        margin-bottom: 0.75rem;
    }

    .status-icon svg {
        width: 2.25rem;
        height: 2.25rem;
    }

    .status-icon.verified {
        background: #F0FDF4;
        border: 3px solid #BBF7D0;
    }

    .status-icon.verified svg { color: #22C55E; }

    .status-icon.pending {
        background: #FEFCE8;
        border: 3px solid #FDE68A;
    }

    .status-icon.pending svg { color: #F59E0B; }

    .status-icon.rejected {
        background: #FEF2F2;
        border: 3px solid #FECACA;
    }

    .status-icon.rejected svg { color: #EF4444; }

    .status-icon.payment {
        background: #EFF6FF;
        border: 3px solid #BFDBFE;
    }

    .status-icon.payment svg { color: #2563EB; }

    .status-icon.default {
        background: #F1F5F9;
        border: 3px solid #E2E8F0;
    }

    .status-icon.default svg { color: #94A3B8; }

    .status-message {
        font-size: 1.125rem;
        font-weight: 700;
        margin-bottom: 0.25rem;
    }

    .status-description {
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }

    .info-box {
        border-radius: 0.75rem;
        padding: 1rem 1.25rem;
        margin-top: 1.5rem;
        border: 1px solid #E2E8F0;
        background: #F8FAFC;
    }

    .info-box .info-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.375rem 0;
    }

    .info-box .info-row:not(:last-child) {
        border-bottom: 1px solid #E2E8F0;
        padding-bottom: 0.375rem;
        margin-bottom: 0.375rem;
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

    .info-box .info-value.payment-verified {
        color: #22C55E;
    }

    .info-box .info-value.payment-pending {
        color: #F59E0B;
    }

    .info-box .info-value.payment-rejected {
        color: #EF4444;
    }

    .info-box .info-value.payment-default {
        color: #2563EB;
    }

    .btn-primary {
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
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .btn-primary::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, #1D4ED8, #1E40AF);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 32px rgba(37, 99, 235, 0.35);
    }

    .btn-primary:hover::after {
        opacity: 1;
    }

    .btn-primary span {
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .btn-primary:active {
        transform: scale(0.98);
    }

    .btn-outline {
        flex: 1;
        padding: 0.875rem 1.5rem;
        border-radius: 0.75rem;
        font-weight: 600;
        font-size: 1rem;
        color: #2563EB;
        background: transparent;
        border: 2px solid rgba(37, 99, 235, 0.2);
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        text-align: center;
    }

    .btn-outline:hover {
        border-color: #2563EB;
        background: rgba(37, 99, 235, 0.04);
        transform: translateY(-2px);
    }

    .btn-outline svg {
        width: 1.25rem;
        height: 1.25rem;
    }

    .action-group {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        margin-top: 1.5rem;
    }

    @media (min-width: 640px) {
        .action-group {
            flex-direction: row;
        }
    }

    .link-home {
        color: #64748B;
        font-size: 0.875rem;
        text-decoration: none;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        margin-top: 0.5rem;
    }

    .link-home:hover {
        color: #2563EB;
    }

    .link-home svg {
        transition: transform 0.2s ease;
    }

    .link-home:hover svg {
        transform: translateX(-3px);
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
        .result-container {
            background: linear-gradient(135deg, #0F172A 0%, #1E293B 50%, #0F172A 100%);
        }

        .result-container::before {
            background: radial-gradient(circle, rgba(37, 99, 235, 0.12) 0%, transparent 70%);
        }

        .result-container::after {
            background: radial-gradient(circle, rgba(139, 92, 246, 0.08) 0%, transparent 70%);
        }

        .result-card {
            background: rgba(30, 41, 59, 0.95);
            backdrop-filter: blur(20px);
            border-color: rgba(37, 99, 235, 0.15);
        }

        .result-title {
            color: #F8FAFC;
        }

        .result-subtitle {
            color: #94A3B8;
        }

        .back-link {
            color: #94A3B8;
        }

        .back-link:hover {
            color: #60A5FA;
        }

        .status-badge.verified {
            background: rgba(34, 197, 94, 0.15);
            color: #86EFAC;
            border-color: rgba(34, 197, 94, 0.2);
        }

        .status-badge.pending {
            background: rgba(245, 158, 11, 0.15);
            color: #FDE68A;
            border-color: rgba(245, 158, 11, 0.2);
        }

        .status-badge.rejected {
            background: rgba(239, 68, 68, 0.15);
            color: #FCA5A5;
            border-color: rgba(239, 68, 68, 0.2);
        }

        .status-badge.payment {
            background: rgba(37, 99, 235, 0.15);
            color: #93BBFC;
            border-color: rgba(37, 99, 235, 0.2);
        }

        .status-badge.default {
            background: rgba(71, 85, 105, 0.2);
            color: #94A3B8;
            border-color: rgba(71, 85, 105, 0.2);
        }

        .status-icon.verified {
            background: rgba(34, 197, 94, 0.15);
            border-color: rgba(34, 197, 94, 0.2);
        }

        .status-icon.pending {
            background: rgba(245, 158, 11, 0.15);
            border-color: rgba(245, 158, 11, 0.2);
        }

        .status-icon.rejected {
            background: rgba(239, 68, 68, 0.15);
            border-color: rgba(239, 68, 68, 0.2);
        }

        .status-icon.payment {
            background: rgba(37, 99, 235, 0.15);
            border-color: rgba(37, 99, 235, 0.2);
        }

        .status-icon.default {
            background: rgba(71, 85, 105, 0.2);
            border-color: rgba(71, 85, 105, 0.2);
        }

        .status-message {
            color: #F8FAFC;
        }

        .status-description {
            color: #94A3B8;
        }

        .info-box {
            background: #1E293B;
            border-color: #334155;
        }

        .info-box .info-row:not(:last-child) {
            border-color: #334155;
        }

        .info-box .info-label {
            color: #94A3B8;
        }

        .info-box .info-value {
            color: #F8FAFC;
        }

        .btn-outline {
            color: #60A5FA;
            border-color: rgba(37, 99, 235, 0.2);
        }

        .btn-outline:hover {
            border-color: #60A5FA;
            background: rgba(37, 99, 235, 0.08);
        }

        .link-home {
            color: #94A3B8;
        }

        .link-home:hover {
            color: #60A5FA;
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

<div class="result-container">

    <div class="result-card">

        {{-- Back Button --}}
        <a href="{{ route('daftar.status.form') }}" class="back-link">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali
        </a>

        {{-- Title --}}
        <div class="text-center mb-6">
            <h2 class="result-title">
                {{ $registration->full_name }}
            </h2>
            <p class="result-subtitle">
                {{ $registration->email }}
            </p>
        </div>

        {{-- Status --}}
        <div class="text-center">
            @if($registration->isVerified())
                <div class="status-icon verified">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="status-badge verified">
                    <span class="dot"></span>
                    Pendaftaran Diterima
                </div>
                <p class="status-message text-[#166534] dark:text-[#86EFAC]">✅ Pendaftaran Diterima!</p>
                <p class="status-description text-[#166534] dark:text-[#86EFAC]">Akun Anda sudah aktif. Silakan login.</p>

            @elseif($registration->isRejected())
                <div class="status-icon rejected">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </div>
                <div class="status-badge rejected">
                    <span class="dot"></span>
                    Pendaftaran Ditolak
                </div>
                <p class="status-message text-[#991B1B] dark:text-[#FCA5A5]">❌ Pendaftaran Ditolak</p>
                @if($registration->rejection_reason)
                    <p class="status-description text-[#991B1B] dark:text-[#FCA5A5]">
                        Alasan: {{ $registration->rejection_reason }}
                    </p>
                @endif

            @elseif($registration->isAwaitingVerification())
                <div class="status-icon pending">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="status-badge pending">
                    <span class="dot"></span>
                    Menunggu Verifikasi
                </div>
                <p class="status-message text-[#854D0E] dark:text-[#FDE68A]">⏳ Menunggu Verifikasi</p>
                <p class="status-description text-[#854D0E] dark:text-[#FDE68A]">
                    Pembayaran Anda sedang diverifikasi oleh admin.
                </p>

            @elseif($registration->canMakePayment())
                <div class="status-icon payment">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                    </svg>
                </div>
                <div class="status-badge payment">
                    <span class="dot"></span>
                    Menunggu Pembayaran
                </div>
                <p class="status-message text-[#1E40AF] dark:text-[#93BBFC]">💳 Menunggu Pembayaran</p>
                <p class="status-description text-[#1E40AF] dark:text-[#93BBFC]">
                    Silakan lakukan pembayaran untuk menyelesaikan pendaftaran.
                </p>

            @else
                <div class="status-icon default">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="status-badge default">
                    <span class="dot"></span>
                    Status Tidak Diketahui
                </div>
                <p class="status-message text-[#475569] dark:text-[#94A3B8]">Status Tidak Diketahui</p>
            @endif
        </div>

        {{-- Detail Info --}}
        <div class="info-box">
            <div class="info-row">
                <span class="info-label">Tanggal Daftar</span>
                <span class="info-value">{{ $registration->created_at->format('d M Y H:i') }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Status Pembayaran</span>
                <span class="info-value
                    @if($registration->payment_status == 'verified') payment-verified
                    @elseif($registration->payment_status == 'rejected') payment-rejected
                    @elseif($registration->payment_status == 'paid') payment-pending
                    @else payment-default @endif">
                    {{ $registration->payment_status_label }}
                </span>
            </div>
        </div>

        {{-- Actions --}}
        <div class="action-group">
            @if($registration->canMakePayment())
                <a href="{{ route('daftar.payment', $registration->id) }}" class="btn-primary">
                    <span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                        </svg>
                        Bayar Sekarang
                    </span>
                </a>
            @endif

            @if($registration->isVerified())
                <a href="{{ route('login') }}" class="btn-primary">
                    <span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                        </svg>
                        Login Sekarang
                    </span>
                </a>
            @endif

            <a href="https://wa.me/6282154734819?text=Halo%20Admin%2C%20saya%20{{ urlencode($registration->full_name) }}%20ingin%20bertanya%20tentang%20pendaftaran%20saya"
               target="_blank"
               class="btn-outline
                    @if(!$registration->canMakePayment() && !$registration->isVerified()) w-full @endif">
                <svg fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                </svg>
                Chat Admin
            </a>
        </div>

        {{-- Divider --}}
        <div class="divider">
            <span class="divider-text">Navigasi</span>
        </div>

        {{-- Back to Home --}}
        <a href="{{ route('home') }}" class="link-home">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            Kembali ke Beranda
        </a>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add entrance animation
    const card = document.querySelector('.result-card');
    if (card) {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';

        setTimeout(() => {
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, 100);
    }
});
</script>

@endsection
