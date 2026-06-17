<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'order_code',
        'total_amount',
        'status',
        'expires_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];
    public function getRouteKeyName()
    {
        return 'order_code';
    }
    /* ================= RELATIONS ================= */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function discounts()
    {
        return $this->hasMany(OrderDiscount::class);
    }
    protected static function booted()
    {
        static::creating(function (Order $order) {
            if (empty($order->order_code)) {
                $order->order_code = self::generateOrderCode();
            }
        });
    }

    public static function generateOrderCode(): string
    {
        return 'AZW-' . now()->format('Ymd') . '-' . strtoupper(Str::random(5));
    }

}
