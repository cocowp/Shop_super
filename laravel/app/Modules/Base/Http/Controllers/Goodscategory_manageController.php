<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2019/6/10
 * Time: 9:33
 */

namespace App\Modules\Base\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Goodscategory_manageController
{
   public function add()
   {

   }
   public function lists()
   {

       $data = DB::table('cat')->where('parent_id',0)->get();

       return view('base::goodscategory.lists')->with('data',$data);

   }

   public function digui($data , $p_id = 0)
   {
       $list = [];

       foreach ($data as $key => $val)
       {
           if($val->parent_id == $p_id )
           {
              $val->children = $this->digui($data , $val->id);
              $list[] = $val;
           }
       }
       return $list;
   }

   public function search_child(Request $request)
   {
      $id = $request->input('id');

      $data = DB::select('select * from shop_cat where parent_id = ?',[$id]);

      return json_encode(['data'=>$data]);
   }

   public function cat_delete(Request $request)
   {
       $id = $request->input('id');
       $res = DB::table('cat')->where('id',$id)->delete();
       if($res)
       {
           return json_encode(['statue'=>200]);
       }
       return json_encode(['statue'=>201]);
   }
}