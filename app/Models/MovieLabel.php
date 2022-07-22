<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class MovieLabel extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'movie_label';

    //得到列表
    public function GetList($mid = 0)
    {
        $lists = DB::select("select A.id,A.name,ML.mid from movie_label A join movie_label_associate ML on A.id = ML.lid where ML.mid = $mid ");
        return $lists;
    }     

}
