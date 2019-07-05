<?php


namespace App\Http\Controllers;



use Illuminate\Http\Request;

class OrdersController
{
    public function show(){
        return view('order.user_order');

    }

    public function order_detail(Request $request){



        return view('order.detail');
    }
}