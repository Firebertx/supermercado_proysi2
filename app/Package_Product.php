<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package_Product extends Model
{
    public $table="package_product";
    protected $fillable=["package_id","product_id","quantity","sub_total","date"];

    public function package()
    {
        return $this->belongsTo(Package::class,'package_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
}
