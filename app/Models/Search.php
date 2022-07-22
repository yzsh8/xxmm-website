<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class Search extends Model
{
    //
    protected $table = 'movie';

    //读取影片列表
    public function GetLists($keyword='',$page=1,$limit=12,$sort='id')
    {
        $ids = [];
        $movie = [];

        //查询条件
        $where = '';
        if($keyword){
            $where = " name like '$keyword%' and ";
        }

        //分页
        $offset = ($page-1)*$limit;

        //优先读取redis
        $lists = DB::select("select id,name,cid,director_id,series_id,film_id,issued,number,publish_time,duration,thumb,avatar,updated_at from movie where $where status=1 and is_up=1 order by $sort desc limit $offset,$limit");
        if(!$lists){
            return [];
        }

        //遍历得到影片id列表
        foreach ($lists as $val) {
            $ids[] = $val->id;
            $movie[$val->id] = json_decode(json_encode($val));
        }

        $mids = join(',',$ids);

        //得到演员列表
        $actor = DB::select("select A.id,A.name,MA.mid from movie_actor A join movie_actor_associate MA on A.id = MA.aid where MA.mid in ($mids) ");

        //遍历处理数据
        foreach($actor as $v){
            $movie[$v->mid]->actor[] = $v;
        }

        //数据重组
        $movie = array_values($movie);  

        return $movie;
    }

    //计算影片总数
    public function GetTotal($keyword='')
    {
        //查询条件
        $where = '';
        if($keyword){
            $where = " name like '$keyword%' and ";
        }

        //优先读取redis
        $lists = DB::select("select count(0) as total from movie where $where status=1 and is_up=1");

        return $lists[0]->total;
    }
}
