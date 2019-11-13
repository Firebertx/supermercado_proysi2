<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PromotionProduct extends Model
{
    public $table="promotion_products";
    protected $fillable=["promotion_id","product_id","quantity","total","date"];

    public function promotion()
    {
        return $this->belongsTo(Promotion::class,'promotion_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
}
