<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    protected $fillable = [
        'sizename',
        'product_id',
    ];

    public function products()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
}
