<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductBonus extends Model
{
    protected $fillable = [
        'product_id',
        'bonus_type',
        'bonus_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function tryout()
    {
        return $this->belongsTo(Exam::class, 'bonus_id');
    }
    public function course()
    {
        return $this->belongsTo(Course::class, 'bonus_id');
    }
}
