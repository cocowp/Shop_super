<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
    protected $hidden = [
        'num','created_at','updated_at','deleted_at','pivot'
    ];

    public function attr(){
        return $this->hasMany('App\Model\Attr','classifyid','classify');
    }
}
