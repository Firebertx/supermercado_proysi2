<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleInventario extends Model
{
    public $table="detalle_inventarios";
    protected $fillable=["inventory_id","product_id","stock","total"];

    public function inventory()
    {
        return $this->belongsTo(Inventory::class,'inventory_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
}
