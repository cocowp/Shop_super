<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2019/6/20
 * Time: 10:58
 */

namespace App\Http\Controllers;


class BuycarController
{
    public function index()
    {
//        echo 1;die;
        return view('index.buycar');
    }
}