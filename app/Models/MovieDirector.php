<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class MovieDirector extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'movie_director';

    public function GetNameForId($id = 0){
        $cacheKey = 'movie_actor_info:'.$id;

        //读取缓存
        $info = json_decode(Redis::get($cacheKey),true);
        if($info){
            return $info['name'];
        }

        //从数据库读取
        $info = self::select('id','name','movie_num','cid')->where('id',$id)->where('status',1)->first();

        if($info){
            //写入缓存
            Redis::set($cacheKey,json_encode($info));
            Redis::expire($cacheKey,3600*24);
        }
        
        return isset($info)?$info['name']:'';
    }

}
