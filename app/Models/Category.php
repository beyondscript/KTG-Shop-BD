<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'categoryname',
        'categoryimage',
    ];

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }

    public function hotdeals()
    {
        return $this->hasMany('App\Models\Hotdeal');
    }
}
