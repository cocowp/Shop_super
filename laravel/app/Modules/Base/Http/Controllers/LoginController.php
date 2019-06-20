<?php

namespace App\Modules\Base\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
   public function login()
   {
       return view('base::login.login');
   }

   public function login_do()
   {
       $data = Request::all();
//       print_r($data);die;
       $info = DB::table('admin')->where('name',$data['name'])->where('pwd',$data['pwd'])->get();
//       print_r($info);die;
       $info = json_decode("$info",1);
       if($info) {
           session(['info'=>$info]);
           return json_encode(['status'=>200,'msg'=>"登录成功"]);
       }
       return json_encode(['status'=>201,'msg'=>"登录失败"]);
   }
}