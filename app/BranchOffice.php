<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BranchOffice extends Model
{
    public $table="branch_offices";
    protected $fillable=["name","address","image"];
    //public $timestamps=false;
}
