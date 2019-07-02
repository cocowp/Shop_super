<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order_goods extends Model
{
    protected $fillable = [
        'order_id','goods_id','shop_id','config_id','num','price','name','img'
    ];
}
