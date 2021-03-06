<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2019/6/10
 * Time: 9:33
 */

namespace App\Modules\Base\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Base\Model\Order;
use Illuminate\Http\Request;

class Order_manageController
{
   public function lists(Request $request)
   {
       $search =$request->input();
       $where = [];

       if(isset($search['start']) && !empty($search['start'])){
           $where[] = ['created_at', '>=', $search['start']];
       }

       if(isset($search['end']) && !empty($search['end'])){
           $where[] = ['created_at', '<=', $search['end']];
       }

       if(isset($search['pay_status']) && strlen($search['pay_status'])){
            $where[] = ['pay_status',$search['pay_status']];
       }
       if(isset($search['pay_name']) && strlen($search['pay_name'])){
           $where[] = ['pay_name',$search['pay_name']];
       }

       if(isset($search['order_num']) && !empty($search['order_num'])){
            $where[] = ['order_num',$search['order_num']];
       }
       $orders = Order::where($where)->orderBy('created_at','desc')->paginate(10)->appends($request->all());

       $count = Order::where($where)->count();
       return view('base::order.list')->with('orders',$orders)->with('search',$search)->with('count',$count);
   }

   public function del(Request $request){
       if($request->ajax()){
           $id = $request->input('id');
           $res = Order::destroy($id);
           if($res){
               return Controller::Message();
           }else{
               return Controller::Message('1001','请求失败');
           }
       }
   }
   public function edit(Request $request){
       if($request->isMethod('post')){
           $data = $request->all();
           unset($data['_token']);
           $id = $data['id'];
           unset($data['id']);
           $res = Order::where('id', $id)->update($data);
           if($res){
                echo "<script>parent.location.reload();</script>";
           }else{
                return "修改失败";
           }
       }
       $id = $request->input('id');
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