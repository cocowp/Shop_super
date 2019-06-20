<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2019/6/20
 * Time: 9:49
 */

namespace App\Http\Controllers;


class LoginController
{
    public function login()
    {
        return view('login.login');
    }
}