<?php
// app/Models/StudentRegistration.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class StudentRegistration extends Model
{
    protected $fillable = [
        'full_name',
        'nickname',
        'birth_date',
        'gender',
        'school_origin',
        'class',
        'phone',
        'kecamatan_id',
        'kelurahan_id',
        'height_cm',
        'weight_kg',
        'priority_university_1',
        'priority_university_2',
        'parent_name',
        'parent_occupation',
        'parent_phone',
        'email',
        'password',
        'avatar',
        'registration_fee',
        'payment_status',
        'payment_proof',
        'payment_verified_at',
        'payment_expires_at',
        'verified_by',
        'verification_notes',
        'verified_at',
        'rejected_at',
        'rejection_reason',
        'ip_address',
        'user_agent',
        'user_id',
        'registration_status',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'payment_verified_at' => 'datetime',
        'payment_expires_at' => 'datetime',
        'verified_at' => 'datetime',
        'rejected_at' => 'datetime',
        'registration_fee' => 'decimal:2',
        'height_cm' => 'integer',
        'weight_kg' => 'integer',
    ];

    protected $hidden = [
        'password',
    ];

    // Relationships
    public function kecamatan(): BelongsTo
    {
        return $this->belongsTo(Kecamatan::class);
    }

    public function kelurahan(): BelongsTo
    {
        return $this->belongsTo(Kelurahan::class);
    }

    public function verifiedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function invoice(): HasOne
    {
        return $this->hasOne(Invoice::class, 'registration_id');
    }

    // Scopes
    public function scopePendingPayment($query)
    {
        return $query->where('registration_status', 'pending_payment')
            ->where('payment_status', 'pending');
    }

    public function scopeAwaitingVerification($query)
    {
        return $query->where('registration_status', 'awaiting_verification')
            ->where('payment_status', 'paid');
    }

    public function scopeVerified($query)
    {
        return $query->where('registration_status', 'verified')
            ->where('payment_status', 'verified');
    }

    public function scopeRejected($query)
    {
        return $query->where('registration_status', 'rejected');
    }

    // Accessors
    public function getFullAddressAttribute(): string
    {
        $kecamatan = $this->kecamatan?->name ?? '';
        $kelurahan = $this->kelurahan?->name ?? '';
        return trim("{$kelurahan}, {$kecamatan}, Pangkep");
    }

    public function getGenderLabelAttribute(): string
    {
        return $this->gender === 'L' ? 'Laki-laki' : 'Perempuan';
    }

    public function getPaymentStatusLabelAttribute(): string
    {
        return match($this->payment_status) {
            'pending' => 'Belum Dibayar',
            'paid' => 'Menunggu Verifikasi',
            'verified' => 'Diverifikasi',
            'rejected' => 'Ditolak',
            'expired' => 'Kadaluarsa',
            default => $this->payment_status,
        };
    }

    public function getRegistrationStatusLabelAttribute(): string
    {
        return match($this->registration_status) {
            'draft' => 'Draft',
            'pending_payment' => 'Menunggu Pembayaran',
            'awaiting_verification' => 'Menunggu Verifikasi',
            'verified' => 'Terverifikasi ✅',
            'rejected' => 'Ditolak ❌',
            default => $this->registration_status,
        };
    }

    // Helper Methods
    public function isExpired(): bool
    {
        if (!$this->payment_expires_at) {
            return false;
        }
        return now()->gt($this->payment_expires_at);
    }

    public function canMakePayment(): bool
    {
        return $this->registration_status === 'pending_payment' 
            && $this->payment_status === 'pending'
            && !$this->isExpired();
    }

    public function canUploadProof(): bool
    {
        return $this->registration_status === 'pending_payment' 
            && $this->payment_status === 'pending'
            && !$this->isExpired();
    }

    public function isAwaitingVerification(): bool
    {
        return $this->registration_status === 'awaiting_verification'
            && $this->payment_status === 'paid';
    }

    public function isVerified(): bool
    {
        return $this->registration_status === 'verified'
            && $this->payment_status === 'verified';
    }

    public function isRejected(): bool
    {
        return $this->registration_status === 'rejected';
    }
}