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
use App\Http\Controllers\Controller;


class Member_manageController extends Controller
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
    public function index()
   {
       echo 123;
   }


    protected $beforeActionList = [
        'rbac' => ['only'=>'admin_list,admin_cate,admin_role,admin_rule'],
    ];

    public function rbac()
    {
        $request = Request::instance();
        $action = $request->module().'/'.$request->controller().'/'.$request->action();
        // var_dump($action);die;
        $user = session::get('id');
        //var_dump($user);die;
        if (empty($user)) {
            $this->error('无权限','index');
        }
        $data = DB::table('admin_role')->where('id',$user)->select();
        foreach ($data as $k => $v) {
            $data[$k]=DB::table('role_node')->where('role_id',$v['role_id'])->select();
        }
        foreach ($data[0] as $k => $v) {
            $data1[]=$v['node_id'];
        }
        $ids=implode(',',$data1);
        $data2 = DB::table('node')->field('url')->where('id','in',$ids)->select();
        foreach ($data2 as $k => $v) {
            $data3[]=$v['uri'];
        }
        if (!in_array($action,$data3)) {
            echo "无权限";die;
        }
    }

    public function admin_list()//管理员列表
    {
        // var_dump('123');die;
        $data = Db::table('admin')->get();
        // var_dump($data);die;
        return view('base::member_manage.admin_list',['data'=>$data]);
    }
    public function admin_role()//角色管理
    {
        $data = Db::table('role')->get();
        return view('base::member_manage.admin_role',['data'=>$data]);
    }
    public function admin_cate()//分配角色
    {
        $data = Db::table('role')->get();
        $data1 = Db::table('admin')->get();
        // var_dump($data1);die;
        return view('base::member_manage.admin_cate',['data'=>$data,'data1'=>$data1]);
    }
    public function admin_cate_do()
    {
        $data = input('get.');
        // var_dump($data);die;
    }
    public function admin_rule()//分配权限
    {
        $data = Db::table('node')->get();
        $data1 = Db::table('role')->get();
        return view('base::member_manage.admin_rule',['data'=>$data,'data1'=>$data1]);
    }
    public function admin_rule_do()
    {

    }
    public function delete()//管理员列表删除
    {
        $id = $_GET['id'];
        // var_dump($id);die;
        $res = Db::table('admin')->delete($id);
        if ($res) {
            echo "删除成功";
        }

    }

}