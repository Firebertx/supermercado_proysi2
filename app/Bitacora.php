<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model
{
    protected $table='bitacoras';
    protected $fillable=['user','last_name', 'action', 'date', 'hour'];
    public $timestamps=false;

    protected $guarded=[];
}
