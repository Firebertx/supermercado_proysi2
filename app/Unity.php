<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unity extends Model
{
    public $table="unities";
    protected $fillable=["name", "description"];
    //public $timestamps=false;
}
