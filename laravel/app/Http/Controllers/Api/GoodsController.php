<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Attr as AttrModel;
use App\Model\Cat_attr as Cat_attrModel;
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
            $cat_attr = Cat_attrModel::where('cat_id',$data['classify'])->first();
            $attr_arr = explode(',',$cat_attr['attr_id']);

            $attr = AttrModel::whereIn('id', $attr_arr)->get();

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
