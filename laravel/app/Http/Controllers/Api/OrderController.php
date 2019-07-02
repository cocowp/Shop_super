<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Good as GoodModel;
use App\Model\Order as OrderModel;
use App\Model\Order_goods;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;

class OrderController extends Controller
{
    public function index()
    {

    }

    public function list(){
        $token = request('token');
        $user = JWTAuth::authenticate($token);
        $id = $user['id'];
        $order = OrderModel::where([['user_id', $id],['parent_id',0]])->get();

        foreach ($order as $k => $v){
            $order_child = OrderModel::where([['user_id', $id],['parent_id',$v['id']]])->get();
            if(count($order_child)>0){
                $order[$k]['child_child'] = $order_child;
            }
        }
        if($order){
            return Controller::Message('1000','请求成功',$order);
        }else{
            return Controller::Message('1001','请求失败');
        }
    }

    public function create()
    {
        $token = request('token');
        $user = JWTAuth::authenticate($token);
        $id = $user['id'];

        $order = request()->only('consihnee','province','city','district','','address','mobile','goodsItems');

        $order = $this->order_goods($order);

        $order['user_id'] = $id;
        $order['order_num'] = 'EA1000'.date('YmdHis').$id.rand(10000000,99999999);

        $total_amount = $this->order_total_amount(json_decode($order['goodsItems'],true));
        $order['total_amount'] = $total_amount;

        $res = $this->order_create($order);
        if($res == 1){
           return Controller::Message();
        }else{
           return Controller::Message('1001','请求失败');
        }
    }

    public function order_goods($order){
        $goods = json_decode($order['goodsItems'], TRUE);

        foreach ( $goods as $key => $v){
            $goods_info = GoodModel::find($v['goods_id']);
            $goods[$key]['price'] = $goods_info['prices'];
            $goods[$key]['name'] = $goods_info['name'];
            $goods[$key]['img'] = $goods_info['imgs'];
        }
        $order['goodsItems'] = json_encode($goods);
        return $order;
    }

    public function order_total_amount($goods){
        $sum = 0;
        foreach ($goods as $k => $v){
            $sum += $v['num'] * $v['price'];
        }
        return $sum;
    }

    public function order_create($order){

        $res = DB::transaction(function () use($order) {
            $order_create_res = OrderModel::create($order);

            $order['goodsItems'] = json_decode($order['goodsItems'],true);
            $order_arr = [];
            foreach($order['goodsItems'] as $k => $v){
                $order_arr[$v['shop_id']][] = $v;
            }

            unset($order['goodsItems']);
            if(count($order_arr) >= 2){
//
                foreach($order_arr as $key => $value){

                    $order['order_num'] = 'EB1000'.date('YmdHis').$order['user_id'].rand(10000000,99999999);
                    $order['parent_id'] = $order_create_res['id'];

                    $order['total_amount'] = $this->order_total_amount($value);

                    $child_order_create_res = OrderModel::create($order);

                    foreach ($value as $k => $v){
                        $v['order_id'] = $child_order_create_res['id'];
                        Order_goods::create($v);

                        $goods = GoodModel::find($v['goods_id']);

                        if($goods->num - $v['num'] >= 0){
                            $goods -> num = $goods->num - $v['num'];
                            $goods->save();
                        }else{
                            Controller::Message('1001','请求失败');
                        }
                    }
                }
            }
            else{
                foreach($order['goodsItems'] as $key => $value){
                    $order['goodsItems'][$key]['order_id'] = $order_create_res['id'];

                    Order_goods::create($order['goodsItems'][$key]);

                    $goods = GoodModel::find($order['goodsItems'][$key]['goods_id']);
                    if($goods->num - $order['goodsItems'][$key]['num'] >= 0){
                        $goods -> num = $goods->num - $order['goodsItems'][$key]['num'];
                        $goods->save();
                    }
                }
            }
           return 1;
        });
        return $res;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // 通过订单编号来获取订单的详细信息
    public function show()
    {
//        $token = request('token');
//        $user = JWTAuth::authenticate($token);
//        $id = $user['id'];

        $order_num = request('order_num');

        $where = [];
        $where[] = ['order_num', $order_num];

        $data = OrderModel::with(['goods'])->where($where)->get();

        if(count($data)>0){
            return Controller::Message('1000','请求成功',$data);
        }else{
            return Controller::Message('1001','请求失败,（请获取当前登录用户的订单）');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_order_status()
    {
        $token = request('token');
        $order_num = request('order_num');

        $user = JWTAuth::authenticate($token);
        $id = $user['id'];

        $where = [];
        $where[] = ['user_id', '=', $id];
        $where[] = ['order_num', $order_num];

        $arr = ['-3','-2','-1','0','1','2'];
        $order_status = request('status');
        if(!in_array($order_status,$arr)){
            return Controller::Message('1001','请求失败（不存在此订单状态）');
        }
        $data = [
            'order_status' => $order_status
        ];

        $res = OrderModel::where($where)->update($data);
        if($res){
            return Controller::Message();
        }else{
            return Controller::Message('1001','请求失败');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $id = request('id');
        $res = OrderModel::destroy($id);
        if($res){
            return Controller::Message();
        }else{
            return Controller::Message('1001','请求失败');
        }
    }
}
