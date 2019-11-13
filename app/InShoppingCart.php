<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InShoppingCart extends Model
{
    public $table="in_shopping_carts";
    protected $fillable=['product_id','shopping_cart_id','package_id'];


    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
    public function package()
    {
        return $this->belongsTo(Package::class,'package_id');
    }
}
