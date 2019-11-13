<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public $table="employees";
    protected $fillable = ['user_id','code','branchOffice_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function branchOffice()
    {
        return $this->belongsTo(BranchOffice::class, 'branchOffice_id');
    }
}
