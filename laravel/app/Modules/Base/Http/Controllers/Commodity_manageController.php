<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2019/6/10
 * Time: 9:34
 */

namespace App\Modules\Base\Http\Controllers;
use App\Modules\Base\Model\Brands;
use App\Modules\Base\Model\Goodcat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class Commodity_manageController
{
   public function commodity_add(Request $request)
   {
      if($request->isMethod('post'))
      {
         $data = $request->input();
         unset($data['_token']);
         $img = $_FILES['imgs'];
         $end = substr($img['type'],6);
         $filename = getcwd().'\upload\image\\'.md5($data['name'].time()).".$end";
         move_uploaded_file($img['tmp_name'],$filename);
         $data['imgs'] =  '\upload\image\\'.md5($data['name'].time()).".$end";

         $res = DB::table('goods')->insert($data);

         if($res)
         {
             return json_encode(['status'=>200]);
         }
         return json_encode(['status'=>201]);

      }
      $brand = Brands::all();
      $classify = Goodcat::where('parent_id',0)->get();
      return view('base::commodity_manage.add_goods')->with(['brand'=>$brand,'classify'=>$classify]);
   }
   public function commodity_list()
   {
       $data = DB::table('goods')->get();

       foreach ($data as $key => $val){

           $brand = DB::table('brand')->where('id',$val->brand)->pluck('name');

           $data[$key]->brand_name = $brand[0];

           $classify = DB::table('cat')->where('id',$val->classify)->pluck('name');

           $data[$key]->classify_name = $classify[0];
       }

       return view('base::commodity_manage.commodity_list')->with('data',$data);
   }
   public function commodity_delete(Request $request)
   {
       $id = $request->input('id');

       $res = DB::table('goods')->where('id',$id)->delete();
       if($res)
       {
           return json_encode(['statue'=>200]);
       }
       return json_encode(['statue'=>201]);
   }


   public function add_sku(Request $request)
   {
       $id = $request->input('id');

       $c_id = DB::table('goods')->where('id',$id)->pluck('classify')[0];

       $data = DB::table('attr')->where('classifyid',$c_id)->get()->toArray();
       foreach ($data as $key => $val){
           $data[$key]->fen = DB::table('attr')->where('parent_id',$val->parent_id)->get();
       }

       return view('base::commodity_manage.add_sku')->with('data',$data)->with('id',$id);

   }

   public function commodity_add_classify()
   {

   }
   public function commodity_add_brand()
   {

   }
   public function commodity_add_message()
   {

   }
   public function commodity_add_picture()
   {

   }
   public function commodity_add_sku()
   {

   }
   public function commodity_add_warehouse()
   {

   }
}