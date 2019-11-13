<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    public $table="inventories";
    protected $fillable=["name","description","warehouse_id"];

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class,'warehouse_id');
    }
    public function branchOffice()
    {
        return $this->belongsTo(BranchOffice::class,'branchOffice_id');
    }
}
