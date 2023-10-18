<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotdeal extends Model
{
    use HasFactory;

    protected $fillable = [
        'discount',
        'image',
        'date',
        'expired',
        'category_id',
    ];

    public function categories()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }
}
