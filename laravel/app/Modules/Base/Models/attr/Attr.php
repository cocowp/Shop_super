<?php

namespace App\Modules\Base\Models\attr;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Attr extends Model
{
    protected $table = 'attr';
    public $timestamps = false;

    public static function showType()
    {
        $info = Attr::orderBy('parent_id', 'asc')->get();
        $result = self::list_level($info, $parent_id = 0, $level = 0);

        return $result;
    }

    public static function list_level($data, $parent_id, $level)
    {
        static $array = array();

        foreach ($data as $k => $v) {
            # code...
            if ($parent_id == $v->parent_id) {
                $v->level = $level;

                $array[] = $v;

                self::list_level($data, $v->id, $level + 1);
            }
        }
        return $array;
    }
}