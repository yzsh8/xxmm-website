<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class Movie extends Model
{
    //
    protected $table = 'movie';

    //读取热门影片
    public function GetHots($limit=9)
    {
        $cacheKey = 'movie:hot-'.$limit;

        $ids = [];
        $movie = [];

        //优先读取redis
        $lists = Redis::Smembers($cacheKey);
        if(!$lists){

            $hot = self::select('id','name','cid','director_id','series_id','film_id','issued','number','publish_time','duration','thumb','avatar','updated_at')->where('status',1)->where('is_up',1)->where('is_hot',1)->orderby('updated_at','desc')->limit($limit)->get();

            //遍历得到影片id列表
            foreach ($hot as $val) {
                $ids[] = $val['id'];
                $movie[$val['id']] = json_decode(json_encode($val));
            }

            $mids = join(',',$ids);

            //得到演员列表
            $actor = DB::select("select A.id,A.name,MA.mid from movie_actor A join movie_actor_associate MA on A.id = MA.aid where MA.mid in ($mids) ");

            //遍历处理数据
            foreach($actor as $v){
                $movie[$v->mid]->actor[] = $v;
            }

            //得到标签列表
            $label = DB::select("select A.id,A.name,ML.mid from movie_label A join movie_label_associate ML on A.id = ML.lid where ML.mid in ($mids) ");

            //遍历处理数据
            foreach($label as $v){
                $movie[$v->mid]->label[] = $v;
            }

            //数据重组
            $movie = array_values($movie);

            //数据写入redis
            foreach($movie as $k=>$v)
            {
                Redis::Sadd($cacheKey,json_encode($v));
                Redis::expire($cacheKey,3600*24);
            }
            
        }else{
            foreach($lists as $k=>$v){
                $lists[$k] = json_decode($v);
            }
            return $lists;
        }

        return $movie;
    }


    //读取最新种子的影片列表
    public function GetLinks($limit=12)
    {
        $cacheKey = 'movie:links-'.$limit;
        $movie = [];

        //优先读取redis
        $lists = Redis::Smembers($cacheKey);
        if(!$lists){

            $movie = self::select('id','name','cid','issued','number','publish_time','duration','thumb','updated_at')->where('status',1)->where('is_up',1)->orderby('link_time','desc')->limit($limit)->get();

            //数据写入redis
            foreach($movie as $k=>$v)
            {
                Redis::Sadd($cacheKey,json_encode($v));
                Redis::expire($cacheKey,3600*24);
            }
            
        }else{
            foreach($lists as $k=>$v){
                $lists[$k] = json_decode($v);
            }
            return $lists;
        }

        return $movie;
    }

    //读取点击排行榜
    public function GetViews($limit=10)
    {
        $cacheKey = 'movie:links-'.$limit;
        $movie = [];

        //优先读取redis
        $lists = Redis::Smembers($cacheKey);
        if(!$lists){

            $movie = self::select('id','name','cid','issued','number','publish_time','duration','view_num','thumb','updated_at')->where('status',1)->where('is_hot',1)->orderby('view_num','desc')->limit($limit)->get();

            //数据写入redis
            foreach($movie as $k=>$v)
            {
                Redis::Sadd($cacheKey,json_encode($v));
                Redis::expire($cacheKey,3600*24);
            }
            
        }else{
            foreach($lists as $k=>$v){
                $lists[$k] = json_decode($v);
            }
            return $lists;
        }

        return $movie;
    }

    //读取影片列表
    public function GetLists($cid=0,$page=1,$limit=12,$sort='id')
    {
        $ids = [];
        $movie = [];

        //查询条件
        $where = '';
        if($cid){
            $where = ' cid='.$cid.' and ';
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

        //得到标签列表
        $label = DB::select("select A.id,A.name,ML.mid from movie_label A join movie_label_associate ML on A.id = ML.lid where ML.mid in ($mids) ");

        //遍历处理数据
        foreach($label as $v){
            $movie[$v->mid]->label[] = $v;
        }

        //数据重组
        $movie = array_values($movie);  

        return $movie;
    }

    //计算影片总数
    public function GetTotal($cid=0)
    {
        //查询条件
        $where = '';
        if($cid){
            $where = ' cid='.$cid.' and ';
        }

        //优先读取redis
        $lists = DB::select("select count(0) as total from movie where $where status=1 and is_up=1");

        return $lists[0]->total;
    }

    /**
     * 猜你喜欢，相关影片
     * 相同演员
     * 相同分类
     * 相同导演
     * 相同标签
     * */
    public function GetRelated($mid,$cid=0)
    {
        $cacheKey = 'movie:related-'.$mid;
        $movie = [];

        //优先读取redis
        $lists = Redis::Smembers($cacheKey);
        if(!$lists){

            $midArr = ['0'];
            //相同演员
            $aid = [];
            $actor = MovieActorAss::select('aid')->where('mid',$mid)->get();
            foreach($actor as $v){
                $aid[] = $v['aid'];
            }
            $actorRelated = MovieActorAss::select('mid')->wherein('aid',$aid)->get();
            foreach($actorRelated as $v){
                if($v['mid']!=$mid){
                    $midArr[] = $v['mid'];
                }
            }

            $movie = self::select('id','name','cid','issued','number','publish_time','duration','thumb','updated_at')
                    ->Where(function($query) use ($midArr){
                        $query->wherein('id',$midArr)
                              ->where('status',1)
                              ->where('is_up',1);
                    })
                    ->orWhere(function($query) use ($cid){
                        $query->where('cid', $cid)
                              ->where('status',1)
                              ->where('is_up',1);
                    })
                    ->limit(12)
                    ->get();

            //数据写入redis
            foreach($movie as $k=>$v)
            {
                Redis::Sadd($cacheKey,json_encode($v));
                Redis::expire($cacheKey,3600*24);
            }
            
        }else{
            foreach($lists as $k=>$v){
                $lists[$k] = json_decode($v);
            }
            return $lists;
        }

        return $movie;
    }

}
