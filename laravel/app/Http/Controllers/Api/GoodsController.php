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
        return Controller::Message($data);
    }

    public function fruit(){
        $data = GoodModel::where('classify','378')->limit(5)->get();
        return Controller::Message($data);
    }

    public function product($id){
        $data = GoodModel::find($id);
        return Controller::Message($data);
    }


}
