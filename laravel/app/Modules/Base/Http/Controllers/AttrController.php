<?php
namespace App\Modules\Base\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Base\Model\Active as ActiveModel;
use App\Modules\Base\Model\Active;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Modules\Base\Models\attr\Attr;

class AttrController extends Controller
{
    //属性管理首页，属性列表展示
    public function index()
    {
        $n_id = DB::table('cat_attr')->pluck('cat_id');
        $n_id = json_encode($n_id);
        $n_id = json_decode($n_id);
        $i=0;
        foreach ($n_id as $key => $value)
        {
            $cat_id = $value;
            $cat = DB::table('cat')->where('id',$cat_id)->pluck('name');
            $cat = json_encode($cat,JSON_UNESCAPED_UNICODE);
            $cat = json_decode($cat,true);
            $attr = DB::table('cat_attr')->where('cat_id',$cat_id)->get();
            $attr = json_encode($attr,JSON_UNESCAPED_UNICODE);
            $attr = json_decode($attr,true);
            $res[] = explode(',', $attr[0]['attr_id']);
            foreach ($res[0] as $k => $v){
                $attrs[$i][] = DB::table('attr')->where('id',$v)->select('name')->get();
                $attrs = json_encode($attrs,JSON_UNESCAPED_UNICODE);
                $attrs = json_decode($attrs,true);
            }
            $data[$i] = array_merge($cat,$attrs[$i]);
            $data[$i]['id'] = $i+1;
            $i++;
            unset($res);
        }
        return view('base::attr.attr_list',['data'=>$data]);
    }
    //属性添加
//    public function attr_add()
//    {
//        $classify = DB::table('cat')->where('parent_id','0')->get();
//        $attr = DB::table('attr')->where('parent_id','0')->get();
//        return view('base::attr.attr_add',['classify'=>$classify,'attr'=>$attr]);
//    }
    public function attrvalue_list()
    {
        $attr = Attr::showType();
        return view('base::attr.attrvalue_list',['attr'=>$attr]);
    }
    public function attrvalue_del(Request $request)
    {
        $id = $request->input('id');
        if (empty($id))
        {
            return json_encode(array("code" => "3","message" => "没有属性id"),JSON_UNESCAPED_UNICODE);
        }
        else
        {
            $res = DB::table('attr')->select('parent_id')->where('parent_id','=',$id)->get();
            $res = json_encode($res,TRUE);
            $res = json_decode($res);
            if (!empty($res))
            {
                echo json_encode(array("code" => "2","message"=>"有子菜单不能删除"),JSON_UNESCAPED_UNICODE);
            }
            else
            {
                $res2 = DB::table('attr')->where('id','=',$id)->delete();
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
    public function add_attr(Request $request)
    {
        $name = $request->input('name');
        $res = DB::table('attr')->insert(['name'=>$name,'parent_id'=>'0']);
        if ($res)
        {
            return json_encode(array("code"=>1,"msg"=>"添加成功"),JSON_UNESCAPED_UNICODE);
        }
        else
        {
            return json_encode(array("code"=>0,"msg"=>"添加失败"),JSON_UNESCAPED_UNICODE);
        }
    }
    public function attrvalue_add(Request $request)
    {
        $id = $request->input('id');
        return view('base::attr.attrvalue_add',['id'=>$id]);
    }
    public function attrvalue_add_do(Request $request)
    {
        $data = $request->input();
        $name = $data['name'];
        $parent_id = $data['parent_id'];
        $res = DB::table('attr')->insert(['name'=>$name,'parent_id'=>$parent_id]);
        if ($res)
        {
            return json_encode(array("code"=>1,"msg"=>"添加成功"),JSON_UNESCAPED_UNICODE);
        }
        else
        {
            return json_encode(array("code"=>0,"msg"=>"添加失败"),JSON_UNESCAPED_UNICODE);
        }
    }
    public function attrvalue_edit(Request $request)
    {
        $id = $request->input('id');
        $attr = DB::table('attr')->where('id','=',$id)->get();
        return view('base::attr.attrvalue_edit',['attr'=>$attr]);
    }
    public function attrvalue_edit_do(Request $request)
    {
        $data = $request->input();
        $id = $data['id'];
        $name = $data['name'];
        $res = DB::table('attr')->where('id','=',$id)->update(['name'=>$name]);
        if ($res)
        {
            return json_encode(array("code"=> 1,"msg"=>"编辑成功"),JSON_UNESCAPED_UNICODE);
        }
        else
        {
            return json_encode(array("code"=> 0,"msg"=>"编辑失败"),JSON_UNESCAPED_UNICODE);
        }
    }
    public function attr_add_do(Request $request)
    {
        $i = 0;
        $attr_id = $request->input('attr_id');
        $cat_id = $request->input('cat_id');
        $res = DB::table('cat_attr')->where('cat_id',$cat_id)->get();
        $res = json_decode(json_encode($res),true);
        if (empty($res))
        {
            if(DB::table('cat_attr')->insert(['attr_id'=>$attr_id,'cat_id'=>$cat_id]))
            {
                $i = 1;
            }
        }
        else
        {
            $attrid = DB::table('cat_attr')->where('cat_id',$cat_id)->select('attr_id')->get();
            $attrid = json_decode(json_encode($attrid),true);
            $attrid = $attr_id[0]['id'].','.$attrid[0]['attr_id'];
            if(DB::table('cat_attr')->where('cat_id',$cat_id)->update(['attr_id'=>$attrid]))
            {
                $i = 1;
            }
        }
        if ($i == 1)
        {
            return json_encode(array('code'=>1,'msg'=>'添加成功'));
        }
//        $i = $j = 0;
//        $data = $request->input();
//        $parent_id = $request->input('parent_id');
//        $name = $request->input('name');
//        $cat_id = $request->input('cat_id');
//        $res = DB::table('attr')->where('name',$name)->get();
//        $res = json_decode(json_encode($res),true);
//        if (empty($res))
//        {
//            $attradd = DB::table('attr')->insert(['name'=>$name,'parent_id'=>$parent_id]);
//            $attr_id = DB::table('attr')->where('name',$name)->select('id')->get();
//            $attr_id = json_decode(json_encode($attr_id),true);
//            if ($attradd)
//            {
//                $i = 1;
//            }
//        }
//        else
//        {
//            $attr_id = DB::table('attr')->where('name',$name)->select('id')->get();
//            $attr_id = json_decode(json_encode($attr_id),TRUE);
//            if (!empty($attr_id))
//            {
//                $i = 1;
//            }
//        }
//        $cat = DB::table('cat_attr')->where('cat_id',$cat_id)->get();
//        $cat = json_decode(json_encode($cat),true);
//        if (empty($cat))
//        {
//
//            if ($r = DB::table('cat_attr')->insert(['cat_id'=>$cat_id,'attr_id'=>$attr_id[0]['id']]))
//            {
//                $j = 1;
//            }
//        }
//        else
//        {
//            $attrid = DB::table('cat_attr')->where('cat_id',$cat_id)->select('attr_id')->get();
//            $attrid = json_decode(json_encode($attrid),true);
//            $attrid = $attr_id[0]['id'].','.$attrid[0]['attr_id'];
//            if (DB::table('cat_attr')->where('cat_id',$cat_id)->update(['attr_id'=>$attrid]))
//            {
//                $j = 1;
//            }
//        }
//        if ($i == 1 && $j == 1)
//        {
//            return json_encode(array('code'=>1,'msg'=>'添加成功','data'=>$data));
//        }
//        else if($i == 1 && $j == 0)
//        {
//            return json_encode(array('code'=>0,'msg'=>'添加失败'));
//        }
//        else if($i == 0 && $j == 1)
//        {
//            return json_encode(array('code'=>0,'msg'=>'添加失败'));
//        }
//        else if($i == 0 && $j == 0)
//        {
//            return json_encode(array('code'=>0,'msg'=>'添加失败'));
//        }

    }
//    public function attr_add_do(Request $request)
//    {
//        $data = $request->input();
//        return json_encode(['statue'=>201]);
//    }
    public function attr_edit()
    {
        $id = $request->input('id');
        $data = DB::table('attr')->where('id','=',$id)->get();
        return view('base::attr.attr_edit',['data'=>$data]);
    }
    public function attr_editdo()
    {

    }
}