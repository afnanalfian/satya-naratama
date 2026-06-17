<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountDeletionLog extends Model
{
    protected $fillable = [
        'user_id',
        'reason_option',
        'reason_custom',
        'deactivated_at',
        'deleted_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
