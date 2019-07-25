<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = [
        'name', 'batch', 'user_id',
    ];

    public function product()
    {
        return $this->belongsToMany('App\Product', 'product_material', 'product_id', 'material_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
