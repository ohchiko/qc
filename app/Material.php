<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = [
        'name', 'batch', 'user_id',
    ];

    protected function product()
    {
        return $this->belongsTo('App\Product');
    }
}
