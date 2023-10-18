<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Earning extends Model
{
    use HasFactory;

    protected $fillable = [
        'earnings',
        'user_id',
    ];

    public function users()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
