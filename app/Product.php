<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'batch', 'user_id', 'work_id',
    ];

    protected function materials()
    {
        return $this->hasMany('App\Material');
    }

    protected function work()
    {
        return $this->belongsTo('App\Work');
    }
}
