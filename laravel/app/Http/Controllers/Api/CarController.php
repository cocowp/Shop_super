<?php


namespace App\Http\Controllers\Api;


use App\Model\Car;
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
}