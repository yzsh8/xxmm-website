<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use App\Library\ArrayHelp;

class Ads extends Model
{
    
    protected $table = 'ads_location';

    //通过id来读取分类名称
    public function Gets($code = ''){
        $cacheKey = 'ads_lists:'.$code;

        $MC = json_decode(Redis::get($cacheKey),true);
        if($MC){
            return $MC;
        }

        //从数据库读取数据
        $location = self::select('id','width','height','m_width','m_height')->where('status',1)->where('code',$code)->first();
        if(!$location){
            return [];
        }

        //通过adl读取
        $adsCN = DB::select("select pic,m_pic,url from ads_list where adl=".$location['id']." and lang='cn' and status=1 order by id desc limit 1; ");
        $adsEN = DB::select("select pic,m_pic,url from ads_list where adl=".$location['id']." and lang='en' and status=1 order by id desc limit 1; ");

        if(isset($adsCN[0])){
            $location['cn'] = ArrayHelp::object2array($adsCN[0]);
        }
        if(isset($adsEN[0])){
            $location['en'] = ArrayHelp::object2array($adsEN[0]);
        }

        //写入redis
        Redis::set($cacheKey,json_encode($location));
        Redis::expire($cacheKey,3600*24);

        return $location;
    }
}
