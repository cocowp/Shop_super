<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Good as GoodModel;
use App\Model\Good;
use App\Model\Order_goods;

class GoodsController extends Controller
{
    public function hot(){
        $data = GoodModel::orderBy('brower','desc')->limit(5)->get();
        if($data){
            return Controller::Message('1000','请求成功',$data);
        }else{
            return Controller::Message('1001','请求失败');
        }
    }

    public function fruit(){
        $data = GoodModel::where('classify','378')->limit(5)->get();
        if($data){
            return Controller::Message('1000','请求成功',$data);
        }else{
            return Controller::Message('1001','请求失败');
        }
    }

    public function product($id){
        $data = GoodModel::find($id);
        if($data){
            return Controller::Message('1000','请求成功',$data);
        }else{
            return Controller::Message('1001','请求失败');
        }
    }

    public function fruit()
    {
        $data = GoodModel::where('alassify','378')->limit(5)->get();
        if ($data) {
            return Controller::Message('1000','请求成功'，$data);
        }else{
            return Controller::Message('1001','请求失败');
        }
    }

}
