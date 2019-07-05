<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2019/6/10
 * Time: 9:35
 */

namespace App\Modules\Base\Http\Controllers;

use DB;
use App\Http\Controllers\Controller;

class Service_manageController
{
   public function comment_audit()//商品评论审核
   {
       $data = DB::table('coupleback_list')->get();
      return view('base::service_manage.comment_audit',['data'=>$data]);

   }
   public function comment_reply()//评论回复
   {
      $data = DB::table('coupleback_list')->get();
      return view('base::service_manage.comment_reply',['data'=>$data]);
   }
   public function reply()//回复
   {
      $id = $_GET['id'];
      $data = DB::table('coupleback_list')->where('id',$id)->get();
      return view('base::service_manage.reply',['data'=>$data[0]]);
   }
   public function reply_do()
   {
      $content = $_GET['content'];
      var_dump($content);die;
   }

   public function opinion_list()//用户意见反馈列表
   {
      $data = DB::table('audit')->get();
      return view('base::service_manage.opinion_list',['data'=>$data]);
   }
   public function opinion_reply()//用户意见回复
   {
      $data = DB::table('audit')->get();
      return view('base::service_manage.opinion_reply',['data'=>$data]);
   }
   public function replyy()//回复
   {
      $id = $_GET['id'];
      $data = DB::table('audit')->where('id',$id)->get();
      // var_dump($data);die;
      return view('base::service_manage.reply',['data'=>$data[0]]);
   }


}