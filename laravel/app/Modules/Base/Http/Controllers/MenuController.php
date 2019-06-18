<?php

namespace App\Modules\Base\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Modules\Base\Models\menu\Menu;
class MenuController extends Controller
{
    public function index()
    {
        $menu = Menu::showType();

        return view('base::menu.menu_list',['data'=>$menu]);
    }
    public function delOne(Request $request)
    {
        $id = $request->input('id');
        if (empty($id))
        {
            return json_encode(array("code" => "3","message" => "没有菜单id"),JSON_UNESCAPED_UNICODE);
        }
        else
        {
            $res = DB::table('menu')->select('parent_id')->where('parent_id','=',$id)->get();
            $res = json_encode($res,TRUE);
            $res = json_decode($res);
            if (!empty($res))
            {
                echo json_encode(array("code" => "2","message"=>"有子菜单不能删除"),JSON_UNESCAPED_UNICODE);
            }
            else
            {
                $res2 = DB::table('menu')->where('id','=',$id)->delete();
                if ($res2)
                {
                    return json_encode(array("code" => "1","message"=>"删除成功"),JSON_UNESCAPED_UNICODE);
                }
                else
                {
                    return json_encode(array("code" => "0","message"=>"删除失败"),JSON_UNESCAPED_UNICODE);
                }
            }
        }
    }
    public function menu_edit(Request $request)
    {
        $id = $request->input('id');
        $menu = DB::table('menu')->where('id','=',$id)->get();
        return view('base::menu.menu_edit',['menu'=>$menu]);
    }
    public function menu_editdo(Request $request)
    {
        $data = $request->input();
        $id = $data['id'];
        $name = $data['name'];
        $url = $data['url'];
        $save_time = time();
        $status = $data['status'];
        $res = DB::table('menu')->where('id','=',$id)->update(['name'=>$name,'url'=>$url,'save_time'=>$save_time,'status'=>$status]);
        if ($res)
        {
            return json_encode(array("code"=> 1,"msg"=>"编辑成功"),JSON_UNESCAPED_UNICODE);
        }
        else
        {
            return json_encode(array("code"=> 0,"msg"=>"编辑失败"),JSON_UNESCAPED_UNICODE);
        }
    }
    public function add_pmenu(Request $request)
    {
        $name = $request->input('name');
        $create_time = date('Y-m-d H:i:s',time());
        $res = DB::table('menu')->insert(['name'=>$name,'create_time'=>$create_time,'parent_id'=>'0']);
        if ($res)
        {
            return json_encode(array("code"=>1,"msg"=>"添加成功"),JSON_UNESCAPED_UNICODE);
        }
        else
        {
            return json_encode(array("code"=>0,"msg"=>"添加失败"),JSON_UNESCAPED_UNICODE);
        }
    }
    public function menu_add(Request $request)
    {
        $id = $request->input('id');
        return view('base::menu.menu_add',['id'=>$id]);
    }
    public function menu_adddo(Request $request)
    {
        $data = $request->input();
        $name = $data['name'];
        $url = $data['url'];
        $create_time = date('Y-m-d H:i:s',time());
        $status = $data['status'];
        $parent_id = $data['parent_id'];
        $res = DB::table('menu')->insert(['name'=>$name,'url'=>$url,'create_time'=>$create_time,'status'=>$status,'parent_id'=>$parent_id]);
        if ($res)
        {
            return json_encode(array("code"=>1,"msg"=>"添加成功"),JSON_UNESCAPED_UNICODE);
        }
        else
        {
            return json_encode(array("code"=>0,"msg"=>"添加失败"),JSON_UNESCAPED_UNICODE);
        }
    }
}