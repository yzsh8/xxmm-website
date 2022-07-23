<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class VideoNotice extends Model
{
    //
    protected $table = 'video_notice';

    //通过名称
    public function GetLists(){
        $cacheKey = 'video_notice';

        $MC = json_decode(Redis::get($cacheKey),true);
        if($MC){
            return $MC;
        }

        //从数据库读取数据
        $lists = self::select('id','name','size','stime','color')->where('status',1)->get();

        //写入redis
        Redis::set($cacheKey,json_encode($lists));
        Redis::expire($cacheKey,3600);

        return $lists;
    }
}
