<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'batch', 'user_id', 'work_id',
    ];

    public function materials()
    {
        return $this->belongsToMany('App\Material', 'product_material', 'material_id', 'product_id');
    }

    public function work()
    {
        return $this->belongsTo('App\Work');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
