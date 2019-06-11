<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2019/6/10
 * Time: 9:30
 */

namespace App\Modules\Base\Http\Controllers;

use DB;
use App\Http\Controllers\Controller;


class Member_manageController extends Controller
{
		public function index()
   {
       echo 123;
   }

   public function admin_list()//管理员列表
   {
   		
   		return view('base::index.admin_list');
   }

   public function admin_role()//角色管理
   {
   		return view();
   }

   public function admin_cate()//分配角色
   {
   		return view();
   }

   public function admin_rule()//分配权限
   {
   		return view();
   }










}