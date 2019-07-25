<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    protected $fillable = [
        'batch', 'purchase_id', 'description', 'status', 'user_id',
    ];

    protected function purchase()
    {
        return $this->hasOne('App\Purchase');
    }

    protected function products()
    {
        return $this->hasMany('App\Product');
    }

    protected function materials()
    {
        return $this->hasManyThrough('App\Material', 'App\Product');
    }
}
