<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2019/6/10
 * Time: 8:40
 */

namespace App\Modules\Base\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function alist()
    {
       $users = DB::select('select * from admin');

       print_r($users);
    }
}