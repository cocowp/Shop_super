<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use function MongoDB\BSON\toJSON;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public static function Message($data = array()){
        $arr = [
            'code' => '1000',
            'msg' => '请求成功',
        ];
        if($data){
            $arr['data'] = $data;
        }
        return json_encode($arr);
    }
}
