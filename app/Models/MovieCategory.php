<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class MovieCategory extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'movie_category';

    //通过id来读取分类名称
    public function GetNameForId($id = 0){
        $cacheKey = 'movie_category_lists';
        $lists = [];

        $MC = json_decode(Redis::get($cacheKey),true);
        if($MC){
            return isset($MC[$id])?$MC[$id]:'';
        }

        //从数据库读取数据
        $categorys = self::select('id','name')->where('status',1)->get();
        foreach($categorys as $v){
            $lists[$v['id']] = $v['name'];
        }

        //写入redis
        Redis::set($cacheKey,json_encode($lists));
        Redis::expire($cacheKey,3600*24);

        return isset($lists[$id])?$lists[$id]:'';
    }
}
