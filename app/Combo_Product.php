<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Combo_Product extends Model
{
    public $table="package_product";
    protected $fillable=["package_id","product_id","quantity","sub_total","date"];

    public function combo()
    {
        return $this->belongsTo(Combo::class,'package_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
}
