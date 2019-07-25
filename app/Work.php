<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    protected $fillable = [
        'batch', 'purchase_id', 'description', 'status', 'user_id',
    ];

    public function purchase()
    {
        return $this->hasOne('App\Purchase');
    }

    public function products()
    {
        return $this->hasMany('App\Product');
    }

    public function materials()
    {
        return $this->hasManyThrough('App\Material', 'App\Product');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
