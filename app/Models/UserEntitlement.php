<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserEntitlement extends Model
{
    protected $fillable = [
        'user_id',
        'entitlement_type',
        'entitlement_id',
        'source',
        'expires_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];

    /* ================= RELATIONS ================= */

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
