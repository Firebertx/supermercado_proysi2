<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public $table="customers";
    protected $fillable=['user_id','location','city','latitude','length'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
