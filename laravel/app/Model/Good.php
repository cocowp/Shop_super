<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
    protected $hidden = [
        'id','num','created_at','updated_at','deleted_at','pivot'
    ];
}
