<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public $table="brands";
    protected $fillable=["name","logo","description"];
    //public $timestamps=false;
}
