<?php

namespace App\Modules\Base\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Active extends Model
{
    protected $table = 'active';
    Use SoftDeletes;
    protected $fillable = [
        'name','desc','start_time','end_time'
    ];
}
