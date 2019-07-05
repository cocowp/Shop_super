<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $hidden = [
        'user_id','created_at','updated_at','deleted_at','pivot'
    ];
    protected $fillable = [
        'goods_id','user_id','goods_num','sku_id'
    ];

    public function sku(){
        return $this->belongsTo('App\Model\Sku','sku_id');
    }

    public function good(){
        return $this->hasMany('App\Model\Good','id','goods_id');
    }
}
