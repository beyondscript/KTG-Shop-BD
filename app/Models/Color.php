<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    protected $fillable = [
        'colorname',
        'product_id',
    ];

    public function products()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
}
