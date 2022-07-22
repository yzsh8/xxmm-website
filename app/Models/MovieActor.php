<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class MovieActor extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'movie_actor';

    //得到演员列表
    public function GetActorList($mid = 0)
    {
        $actor = DB::select("select A.id,A.name,A.sex,MA.mid from movie_actor A join movie_actor_associate MA on A.id = MA.aid where MA.mid = $mid ");
        return $actor;
    }     

}
