<?php


namespace App\Providers;


use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class MyRuleProvider extends ServiceProvider
{
    public function boot(){
        Validator::extend('IDMustIsInt',function ($attribute, $value, $params){
            if(is_numeric($value) && is_int($value + 0) && ($value + 0) > 0){
                return true;
            }else{
                return false;
            }
        });
    }
}