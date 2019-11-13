<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{

    public $table="shopping_carts";
    protected $fillable=["status"];

    public function inShoppingCarts()
    {
        return $this->hasMany(InShoppingCart::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class,'in_shopping_carts');
    }
    public function packages()
    {
        return $this->belongsToMany(Package::class,'in_shopping_carts');
    }

    //Métodos integradores: integrar la funcionalidad de otros
    //Metodos que hacen las cosas: nombre describe su acción
    public function productsSize(){
        $products=$this->products()->count();
        $packages=$this->packages()->count();
        return ($products+$packages);
    }

    public function total(){
        $products=$this->products()->sum("price");
        $packages=$this->packages()->sum("price");
        return ($products+$packages);
    }

    public function totalUSD(){
        $products=$this->products()->sum("price")/7;
        $packages=$this->packages()->sum("price")/7;
        return ($products+$packages);
    }

    public static function findOrCreateBySessionID($shopping_cart_id){
        if($shopping_cart_id)
            //Buscar el carrito de compras con este ID
            return ShoppingCart::findBySession($shopping_cart_id);
            else
                //Crear un carrito de compras
                return ShoppingCart::createWithoutSession();
    }

    public static function findBySession($shopping_cart_id){
        return ShoppingCart::find($shopping_cart_id);
    }

    public static function createWithoutSession(){
        return ShoppingCart::create([
            "status"=>"incompleted"
        ]);
    }
}
