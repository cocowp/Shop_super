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
            return Controller::Message('1000','请求成功',$order_list);
        }else{
            return Controller::Message('1001','请求失败');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $status = 0;
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
            $this->status = 1;

//            运行到此处数据库修改操作完成 返回请求送成功
        });

        if($this->status == 1){
            return Controller::Message();
        }else{
            return Controller::Message('1001','请求失败');
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
        $token = request('token');
        $user = JWTAuth::authenticate($token);
        $id = $user['id'];

        $order_num = request('order_num');

        $where = [];
        $where[] = ['user_id', '=', $id];
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
