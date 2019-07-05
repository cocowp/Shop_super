<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $hidden = [
        'user_id','created_at','updated_at','deleted_at','pivot'
    ];

    public function sku(){
        return $this->belongsTo('App\Model\Sku','sku_id');
    }
}
