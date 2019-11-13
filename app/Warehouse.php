<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    public $table="warehouses";
    protected $fillable=["name","description","latitude","length"];
}
