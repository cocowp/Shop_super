<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2019/6/20
 * Time: 9:58
 */

namespace App\Http\Controllers;


class IndexController
{
    //首页
    public function index()
    {
        return view('index.index');
    }
}