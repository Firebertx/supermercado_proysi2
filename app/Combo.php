<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Combo extends Model
{
    public $table="packages";
    protected $fillable=["image","name","description","price"];

    public function paypalItem()
    {
        return \Paypalpayment::item()->setName($this->name)
            ->setDescription($this->description)
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($this->price/7);
    }
}
