<?php

/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2019/6/9
 * Time: 10:49
 */
namespace App\Modules\Base\Http\Controllers;

use App\Http\Controllers\Controller;
class IndexController extends Controller
{
   public function index()
   {
       return view('base::index.index');
   }

}