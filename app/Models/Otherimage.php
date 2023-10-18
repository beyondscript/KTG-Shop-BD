<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Otherimage extends Model
{
    use HasFactory;

    protected $fillable = [
        'otherimage',
        'product_id',
    ];

    public function products()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
}
