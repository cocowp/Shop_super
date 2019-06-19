<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2019/6/10
 * Time: 9:39
 */

namespace App\Modules\Base\Http\Controllers;

use DB;
use App\Http\Controllers\Controller;

class Store_manageController
{
    public function warehouse_add()//仓库添加
    {
    	return view('base::store_manage.warehouse_add');
        
    }
    public function warehouse_add_do()//仓库添加
    {
    	$name     = $_POST['name'];
    	$encoding = $_POST['encoding'];
    	$is_start = $_POST['is_start'];
    	$in_area  = $_POST['in_area'];
    	$is_area  = $_POST['is_area'];
    	$res = Db::table('warehouse')->insert([
    		'name' => $name,
    		'encoding' => $encoding,
    		'is_start' => $is_start,
    		'in_area' => $in_area,
    		'is_area' => $is_area,
    	]);
    	if ($res) {
    		echo "增加成功";
    	}
    	  
    } 
    public function warehouse_list()//仓库列表
    {
    	$data = Db::table('warehouse')->get();
        return view('base::store_manage.warehouse_list',['data'=>$data]);
    }
    public function delete()
    {
    	$id = $_GET['id'];
    	// var_dump($id);die;
    	$res = Db::table('warehouse')->delete($id);
    	if ($res) {
    		echo "删除成功";
    	}

    } 















}