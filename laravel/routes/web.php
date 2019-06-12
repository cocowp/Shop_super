<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome',['website'=>'Laravel']);
});

Route::view('view','welcome',['website'=>'LaravelWP']);

Route::get('hello',function (){
   return 'Hello ,welcome to LaravelAcademy.org';
<<<<<<< HEAD
});
=======
});
>>>>>>> 6bf5e661db9137291a603e9f2476f302add8b42c
