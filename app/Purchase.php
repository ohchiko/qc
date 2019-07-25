<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = [
        'batch', 'cust_name', 'description', 'est_delivery', 'status', 'user_id',
    ];

    protected $casts = [
        'est_delivery' => 'datetime',
    ];

    protected function products()
    {
        return $this->hasManyThrough('App\Product', 'App\Work');
    }

    protected function work()
    {
        return $this->hasOne('App\Work');
    }
}
