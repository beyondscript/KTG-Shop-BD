<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orderdetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'shippingaddress',
        'phonenumber',
        'color',
        'size',
        'quantity',
        'shippingcost',
        'total',
        'status',
        'order_id',
        'product_id',
    ];

    public function orders()
    {
        return $this->belongsTo('App\Models\Order', 'order_id');
    }

    public function products()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }

    public function reviews()
    {
        return $this->hasOne('App\Models\Review');
    }
}
