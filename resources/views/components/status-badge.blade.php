@props(['status'])
@php
    $map = [
        'pending' => ['badge-gold', 'Menunggu Pembayaran'], 'paid' => ['badge-sky', 'Menunggu Verifikasi'], 'verified' => ['badge-lagoon', 'Terverifikasi'],
        'expired' => ['badge-ink', 'Kedaluwarsa'], 'rejected' => ['badge-garnet', 'Ditolak'], 'cancelled' => ['badge-ink', 'Dibatalkan'],
        'upcoming' => ['badge-sky', 'Akan Datang'], 'live' => ['badge-garnet', 'Sedang Live'], 'done' => ['badge-lagoon', 'Selesai'],
        'active' => ['badge-lagoon', 'Aktif'], 'inactive' => ['badge-ink', 'Draft'], 'closed' => ['badge-garnet', 'Ditutup'],
        'hadir' => ['badge-lagoon', 'Hadir'], 'izin' => ['badge-sky', 'Izin'], 'sakit' => ['badge-gold', 'Sakit'], 'alpa' => ['badge-garnet', 'Alpa'],
        'draft' => ['badge-ink', 'Draft'], 'pending_payment' => ['badge-gold', 'Menunggu Pembayaran'], 'awaiting_verification' => ['badge-sky', 'Menunggu Verifikasi'],
    ];
    [$cls, $label] = $map[$status] ?? ['badge-ink', ucfirst((string) $status)];
@endphp
<span {{ $attributes->merge(['class' => $cls]) }}>{{ $label }}</span>
