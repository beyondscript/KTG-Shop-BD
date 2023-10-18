<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'rating',
        'comment',
        'user_id',
        'product_id',
        'orderdetail_id',
    ];

    public function users()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function products()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }

    public function orderdetails()
    {
        return $this->belongsTo('App\Models\Orderdetail', 'orderdetail_id');
    }
}
