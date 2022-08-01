<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class Trans extends Model
{
    //
    protected $table = 'languages';

    //通过id来读取分类名称
    public function do($text,$table,$field,$lang){

        if($lang == 'zh-CN')
        {
            return $text;
        }

        $cacheKey = 'languages:'.md5($text.$table.$field.$lang);

        $MC = json_decode(Redis::get($cacheKey),true);
        if($MC){
            return $MC;
        }

        //从数据库读取数据
        $da = self::select('trans')->where('table',$table)->where('field',$field)->where('origin',$text)->where('lang',$lang)->first();

        echo $text.$table.$field.$lang;
        var_dump($da);
        exit();

        if($da && $da['trans'])
        {
            //写入redis
            Redis::set($cacheKey,json_encode($da['trans']));
            Redis::expire($cacheKey,3600*24*365);
            $text = $da['trans'];
        }
        
        return $text;
    }
}
