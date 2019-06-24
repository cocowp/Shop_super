<?php

namespace App\Http\Controllers;

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
//
    }

    public function list(){
        $token = request('token');
        $user = JWTAuth::authenticate($token);
        $id = $user['id'];

        $order_list = OrderModel::where('user_id', $id)->get();
        if($order_list){
            return Controller::Message('','',$order_list);
        }else{
            return Controller::Message('1002','请求失败');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $token = request('token');
        $user = JWTAuth::authenticate($token);
        $id = $user['id'];

        $data = request()->toArray();
        unset($data['token']);

        //拼接order数据
        $order = $data;
        $order['user_id'] = $id;
        $order['order_num'] = '1000'.date('YmdHis').$id.rand(10000000,99999999);
        unset($order['goodsItems']);
        //拼接order_goods数据
        $order_goods = $data['goodsItems'];

        //进行事务处理
        $dbres = 0;
        DB::transaction(function () use($order,$order_goods) {
            //订单表数据入库
            $orderres = OrderModel::create($order);

            //获取订单id并 把订单商品表入库
            $order_id = $orderres['id'];
            $order_goods = json_decode($order_goods, TRUE);
            foreach($order_goods as $key => $value){
                $order_goods[$key]['order_id'] = $order_id;
                Order_goods::create($order_goods[$key]);

                //减少商品库存
                $goods = GoodModel::find($order_goods[$key]['goods_id']);
                if($goods->num - $order_goods[$key]['num'] >= 0){
                    $goods -> num = $goods->num - $order_goods[$key]['num'];
                    $goods->save();
                }
            }
            $dbres = 1;
//            运行到此处数据库修改操作完成 返回请求送成功
        });

        if($dbres == 1){
            return Controller::Message(g);
        }else{
            return Controller::Message('1002','请求失败');

        }
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
        $order_num = request('order_num');
        $data = OrderModel::with(['goods'])->where("order_num",$order_num)->get();

        if($data){
            return Controller::Message($data);
        }else{
            return Controller::Message('1002','请求失败');
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
        $order_num = request('order_num');
        $data = OrderModel::with(['goods'])->where("order_num",$order_num)->get();
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
    public function destroy($id)
    {
        //
    }
}
