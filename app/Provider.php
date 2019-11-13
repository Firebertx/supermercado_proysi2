<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    public $table="providers";
    protected $fillable=['user_id','nit'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
