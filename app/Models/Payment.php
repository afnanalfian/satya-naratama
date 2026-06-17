<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'order_id',
        'method',
        'qris_image',
        'proof_image',
        // 'proof_image_2',
        // 'proof_image_3',
        'paid_at',
        'verified_at',
        'verified_by',
        'status',
    ];

    protected $casts = [
        'paid_at' => 'datetime',
        'verified_at' => 'datetime',
    ];

    /* ================= RELATIONS ================= */

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function verifier()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }
}
