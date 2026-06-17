<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDiscount extends Model
{
    protected $fillable = [
        'user_id',
        'discount_id',
        'used_at',
    ];

    protected $casts = [
        'used_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }
}
