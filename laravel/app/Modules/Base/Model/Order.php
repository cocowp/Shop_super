<?php

namespace App\Modules\Base\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    protected $table = 'order';
    Use SoftDeletes;

    protected function getOrderStatusAttribute($value){
        $arr = [
            '-3' => '用户拒收',
            '-2' => '未付款',
            '-1' => '用户取消',
            '0' => '待发货',
            '1' => '配送中',
            '2' => '用户确认收货',
        ];
        return $arr[$value];
    }

    protected function getShippingStatusAttribute($value){
        $arr = [
            '0' => '待发货',
            '1' => '已发货',
        ];
        return $arr[$value];
    }
    protected function getPayStatusAttribute($value){
        $arr = [
            '0' => '未支付',
            '1' => '已支付',
        ];
        return $arr[$value];
    }
    protected function getPayNameAttribute($value){
        $arr = [
            '1' => '支付宝',
            '2' => '微信',
            '3' => '货到付款',
        ];
        return $arr[$value];
    }
//    protected function getCreatedAtAttribute($value){
//        return date('Y-m-d H:i:s',$value);
//    }
}
