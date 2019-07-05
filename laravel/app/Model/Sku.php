<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Sku extends Model
{
    protected $table = 'sku';
    protected $hidden = [
        'id','goods_id','created_at','updated_at','deleted_at','pivot','price','repertory'
    ];
}
