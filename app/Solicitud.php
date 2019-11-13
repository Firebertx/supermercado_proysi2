<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    public $table="solicituds";

    protected $fillable=["shopping_cart_id","customer_id","state","email","date","hour","status","guide_number","total"];

    public function shopping_cart()
    {
        return $this->belongsTo(InShoppingCart::class,'shopping_cart_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public static function createFromPayPalResponse($response, $shopping_cart)
    {
        $payer=$response->payer;
        $orderData=(array)$payer->payer_info->shipping_address;
        $orderData["email"]=$payer->payer_info->email;
        $orderData["total"]=$shopping_cart->total();
        $orderData["shopping_cart_id"]=$shopping_cart->id;
        //$data["customer_id"]=$customers->id;

        return Solicitud::create($orderData);
    }
}
