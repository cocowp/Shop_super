<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2019/6/10
 * Time: 9:33
 */

namespace App\Modules\Base\Http\Controllers;

use App\Modules\Base\Model\Order;
use Illuminate\Support\Facades\Request;

class Order_manageController
{
   public function lists()
   {
       $orders = Order::orderBy('created_at','desc')->paginate(10);
       return view('base::order.list')->with('orders',$orders);
   }

   public function del(){
       if(Request::ajax()){
           $id = Request::input('id');
           $res = Order::destroy($id);
           if($res){
               return json_encode(['code'=>'100']);
           }else{
               return json_encode(['code'=>'200']);
           }
       }
   }

   public function edit(){
       if(Request::isMethod('post')){
           $data = Request::all();
           unset($data['_token']);
           $id = $data['id'];
           unset($data['id']);
           $res = Order::where('id', $id)->update($data);
           if($res){
                echo "<script>parent.location.reload();</script>";
           }else{
                return "修改时便";
           }
       }
       $id = Request::input('id');
       $order = Order::find($id);
       return view('base::order.edit')->with('order',$order);
   }

   public function state()
   {
        echo "订单状态";
   }
   public function list_compile()
   {

   }
   public function list_compile_state_amend()
   {

   }
   public function list_compile_user_amend()
   {

   }
   public function list_compile_commodity_amend()
   {

   }
   public function state_add()
   {

   }
   public function state_list()
   {

   }
}