<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    public $table="packages";
    protected $fillable=["image","name","amount_of_people","description","price","event_id"];

    public function event()
    {
        return $this->belongsTo(Event::class,'event_id');
    }

    public function product()
    {
        return $this->belongsToMany(Product::class);
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
