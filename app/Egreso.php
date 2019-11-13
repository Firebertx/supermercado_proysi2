<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Egreso extends Model
{
    public $table="egresos";
    protected $fillable=["user_id","customer_id","purchase_number","date","tax","total","state"];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id');
    }
}
