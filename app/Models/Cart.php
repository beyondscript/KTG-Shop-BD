<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity',
        'color',
        'size',
        'user_id',
        'product_id',
    ];

    public function users()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function products()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
}
