<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class Links extends Model
{
    //
    protected $table = 'links';

    //通过id来读取分类名称
    public function GetLists($id = 0){
        $cacheKey = 'links_lists';

        $MC = json_decode(Redis::get($cacheKey),true);
        if($MC){
            return $MC;
        }

        //从数据库读取数据
        $categorys = self::select('id','name','url')->where('status',1)->get();

        //写入redis
        Redis::set($cacheKey,json_encode($categorys));
        Redis::expire($cacheKey,3600*24);

        return $categorys;
    }
}
