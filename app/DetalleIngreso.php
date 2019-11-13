<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleIngreso extends Model
{
    public $table="detalle_ingresos";
    protected $fillable=["ingreso_id", "product_id", "inventory_id" ,"quantity", "price","date"];
    //public $timestamps=false;

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }

    public function inventory()
    {
        return $this->belongsTo(Inventory::class,'inventory_id');
    }
    public function ingreso()
    {
        return $this->belongsTo(Ingreso::class,'ingreso_id');
    }
}
