<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2019/6/20
 * Time: 9:49
 */

namespace App\Http\Controllers;


use App\Model\User as UserModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class LoginController
{
    public function login()
    {
        if(Request::isMethod('post')){
            $data = Request::input();
            unset($data['_token']);
            $data['password'] = md5($data['password']);
            $whereOr = [
                ['mobile', $data['name']],
                ['password', $data['password']]
            ];
            $user_info = UserModel::where($data)->orWhere($whereOr)->first();
            if($user_info){
                session('user_info', $user_info);
                return redirect()->intended();
            }else{
                session()->flash('status', '用户名或密码错误');
                return redirect()->back()->withInput();
            }
        }
        return view('login.login');
    }
}