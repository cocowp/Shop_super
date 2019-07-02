<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Attr as AttrModel;
use App\Model\Good as GoodModel;
use App\Model\Good;

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
            $attr = AttrModel::where('classifyid',$data['classify'])->get();

            foreach($attr as $k => $v){
                if($v['is_parent'] == 1){
                    $v['child'] = AttrModel::where('parent_id',$v['id'])->get();
                }
            }

            $data['attr'] = $attr;
            return Controller::Message('1000','请求成功',$data);
        }else{
            return Controller::Message('1001','请求失败');
        }
    }


}
