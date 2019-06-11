<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2019/6/10
 * Time: 9:30
 */

namespace App\Modules\Base\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Member_manageController
{
   public function lists()
   {
       $data = DB::table('admin')->paginate(5);
       foreach ($data as $val){
           $val->regin_time = date('Y-m-d H:i:s',$val->regin_time);
       }
       return view('base::memberage.lists')->with('data',$data);
   }

   public function editing(Request $request)
   {
       $id = $request->input('id');

       $data = DB::table('admin')->where('id',$id)->first();

       return view('base::memberage.editing')->with('data',$data);
   }

   public function updateinfo(Request $request)
   {
      $data = $request->input();

      $res = DB::update('update shop_admin set name = ? , pwd = ? , node = ? , regin_time = ?  where id = ? ',[$data['name'], $data['pwd'], $data['node'], time(), $data['id']]);

      if($res)
      {
          return json_encode(['statue'=>'200','msg'=>"修改成功"]);
      }else
      {
          return json_encode(['statue'=>'201','msg'=>"修改失败"]);
      }
   }

   public function deleteinfo(Request $request)
   {
       $id = $request->input('id');

       $res = DB::delete('delete from shop_admin where id = ?',[$id]);

       if($res)
       {
           return json_encode(['statue'=>'200','msg'=>"删除成功"]);
       }else
       {
           return json_encode(['statue'=>'201','msg'=>"删除失败"]);
       }
   }

   public function adddo(Request $request)
   {
       $data = $request->input();

       $res = DB::insert('insert into shop_admin (name , pwd , node , regin_time) values (?, ?, ?, ?)',[$data['name'] , $data['pwd'] , $data['node'], time()]);

       if($res)
       {
           return json_encode(['statue'=>'200','msg'=>"修改成功"]);
       }else
       {
           return json_encode(['statue'=>'201','msg'=>"修改失败"]);
       }
   }

}