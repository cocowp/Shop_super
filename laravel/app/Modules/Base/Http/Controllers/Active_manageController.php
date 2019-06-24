<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2019/6/10
 * Time: 9:39
 */

namespace App\Modules\Base\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Modules\Base\Model\Active as ActiveModel;
use App\Modules\Base\Model\Active;
use Illuminate\Http\Request;

class Active_manageController
{
   public function lists(Request $request)
   {
       $search =$request->input();
       $where = [];

       if(isset($search['start']) && !empty($search['start'])){
           $where[] = ['start_time', '>=', $search['start']];
       }

       if(isset($search['end']) && !empty($search['end'])){
           $where[] = ['end_time', '<=', $search['end']];
       }
       if(isset($search['name']) && !empty($search['name'])){
            $where[] = ['name', 'like', "%".$search['name']."%"];
        }

       $active = ActiveModel::where($where)->orderBy('created_at','desc')->paginate(10)->appends($request->all());
       $count = ActiveModel::where($where)->count();
      return view('base::active.list')->with('active',$active)->with('search',$search)->with('count',$count);
   }
   public function create(Request $request)
   {
       if($request->isMethod('post')){
           $data = $request->input();
           unset($data['_token']);
            $res = ActiveModel::create($data);
            if($res){
                echo "<script>parent.location.reload();</script>";
            }else{
               echo "请求失败";
            }
       }
       return view('base::active.create');
   }
    public function del(Request $request){
        if($request->ajax()){
            $id = $request->input('id');
            $res = ActiveModel::destroy($id);
            if($res){
                return Controller::Message();
            }else{
                return Controller::Message('1001','请求失败');
            }
        }
    }

    public function edit_status(Request $request){
        if($request->ajax()){
            $data = $request->all();
            $id = $data['id'];
            unset($data['id']);

            $res = ActiveModel::where('id',$id)->update($data);
            if($res){
                return Controller::Message();
            }else{
                return Controller::Message('1001','请求失败');
            }
        }
    }

    public function edit(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            unset($data['_token']);

            $id = $data['id'];

            $res = ActiveModel::where('id', $id)->update($data);
            if($res){
                echo "<script>parent.location.reload();</script>";
            }else{
                return "修改失败";
            }
        }
        $id = $request->input('id');
        $active = ActiveModel::find($id);

        return view('base::active.edit')->with('active',$active);
    }

}