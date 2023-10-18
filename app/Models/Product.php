<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'productname',
        'productmodel',
        'coverimage',
        'regularprice',
        'discountedprice',
        'productquantity',
        'productdetail',
        'productdescription',
        'sales',
        'user_id',
        'brand_id',
        'category_id',
        'shop_id',
    ];

    public function users()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function brands()
    {
        return $this->belongsTo('App\Models\Brand', 'brand_id');
    }

    public function categories()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function shops()
    {
        return $this->belongsTo('App\Models\Shop', 'shop_id');
    }

    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
    }

    public function wishlists()
    {
        return $this->belongsTo('App\Models\Wishlist');
    }

    public function otherimages()
    {
        return $this->hasMany('App\Models\Otherimage');
    }

    public function colors()
    {
        return $this->hasMany('App\Models\Color');
    }

    public function sizes()
    {
        return $this->hasMany('App\Models\Size');
    }

    public function carts()
    {
        return $this->hasMany('App\Models\Cart');
    }

    public function orderdetails()
    {
        return $this->hasOne('App\Models\Orderdetail');
    }
}
