<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Attr extends Model
{
    protected $table = 'attr';
    protected $hidden = [
        'id','parent_id','is_parent','classifyid'
    ];


}
