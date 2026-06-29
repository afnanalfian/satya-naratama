<?php
// app/Models/Invoice.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invoice extends Model
{
    protected $fillable = [
        'registration_id',
        'invoice_number',
        'amount',
        'description',
        'status',
        'payment_method',
        'payment_proof',
        'paid_at',
        'verified_at',
        'verified_by',
        'verification_notes',
        'metadata',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'paid_at' => 'datetime',
        'verified_at' => 'datetime',
        'metadata' => 'array',
    ];

    public function registration(): BelongsTo
    {
        return $this->belongsTo(StudentRegistration::class, 'registration_id');
    }

    public function verifiedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopePaid($query)
    {
        return $query->where('status', 'paid');
    }

    public function scopeVerified($query)
    {
        return $query->where('status', 'verified');
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'pending' => 'Belum Dibayar',
            'paid' => 'Sudah Dibayar',
            'verified' => 'Diverifikasi',
            'cancelled' => 'Dibatalkan',
            default => $this->status,
        };
    }

    public function getFormattedAmountAttribute(): string
    {
        return 'Rp ' . number_format($this->amount, 0, ',', '.');
    }

    public function markAsPaid(?string $proofPath = null): void
    {
        $this->update([
            'status' => 'paid',
            'payment_proof' => $proofPath,
            'paid_at' => now(),
        ]);
    }

    public function markAsVerified(int $adminId, ?string $notes = null): void
    {
        $this->update([
            'status' => 'verified',
            'verified_by' => $adminId,
            'verification_notes' => $notes,
            'verified_at' => now(),
        ]);
    }

    public function markAsCancelled(): void
    {
        $this->update([
            'status' => 'cancelled',
        ]);
    }

    public static function generateNumber(): string
    {
        $prefix = 'INV';
        $date = now()->format('Ymd');
        $random = str_pad(random_int(1, 99999), 5, '0', STR_PAD_LEFT);
        
        return "{$prefix}/{$date}/{$random}";
    }
}