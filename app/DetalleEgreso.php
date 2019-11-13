<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleEgreso extends Model
{
    public $table="detalle_egresos";
    protected $fillable=["egreso_id", "product_id", "inventory_id" , "quantity", "price", "discount" ,"date"];
    public $timestamps=false;

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }

    public function inventory()
    {
        return $this->belongsTo(Inventory::class,'inventory_id');
    }
}
