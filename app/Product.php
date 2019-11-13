<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $table="products";
    protected $fillable=["code","name","price","description","image","unity_id","category_id","brand_id"];
    //public $timestamps=false;

    public function unity()
    {
        return $this->belongsTo(Unity::class,'unity_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class,'brand_id');
    }

    public function package()
    {
        return $this->belongsToMany(Package::class);
    }

    public function paypalItem()
    {
        return \Paypalpayment::item()->setName($this->name)
                                    ->setDescription($this->description)
                                    ->setCurrency('USD')
                                    ->setQuantity(1)
                                    ->setPrice($this->price/7);
    }


}
