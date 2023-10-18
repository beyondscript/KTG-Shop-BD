<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'trx_id',
        'total',
        'type',
        'status',
        'note',
        'currency',
        'user_id',
    ];

    public function orderdetails()
    {
        return $this->hasMany('App\Models\Orderdetail');
    }

    public function users()
    {
        return $this->belongsTo('App\Models\Order', 'user_id');
    }
}
