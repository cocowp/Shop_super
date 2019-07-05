<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Model\Car;
use App\Model\Sku;
use Tymon\JWTAuth\Facades\JWTAuth;

class CarController
{
     public function list(){
         $token = request('token');
         $user = JWTAuth::authenticate($token);
         $id = $user['id'];

         $car = Car::with('sku')->where('user_id',$id)->get();
         foreach ($car as $key => $value){
             $value['sku_name'] = $value['sku']['sku'];
         }
        return $car;
     }

     public function create(){
         $token = request('token');
         $user = JWTAuth::authenticate($token);
         $id = $user['id'];

         $request = request()->only('goods_id','sku','goods_num');

         $sku_id = Sku::where('sku',$request['sku'])->where('goods_id',$request['goods_id'])->first();
        if(!$sku_id){
            Controller::Message('1001','请求失败');
        }

         $car['user_id'] = $id;
         $car['goods_id'] = $request['goods_id'];
         $car['sku_id'] = $sku_id['id'];
         $car['goods_num'] = $request['goods_num'];

         $res = Car::create($car);
         if($res){
            return Controller::Message();
         }else{
            return  Controller::Message('1001','请求失败');
         }
     }
}