<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'method',
        'status',
        'tran_id',
        'user_id',
    ];

    public function users()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
