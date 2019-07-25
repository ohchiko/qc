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

    public function products()
    {
        return $this->hasManyThrough('App\Product', 'App\Work');
    }

    public function work()
    {
        return $this->hasOne('App\Work');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
