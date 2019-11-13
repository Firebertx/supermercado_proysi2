<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    public $table="promotions";
    protected $fillable=["image","name","description","price","percentage"];

    public function paypalItem()
    {
        return \Paypalpayment::item()->setName($this->name)
            ->setDescription($this->description)
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($this->price/7);
    }
}
