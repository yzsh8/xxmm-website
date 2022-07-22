<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class NovelBook extends Model
{
    //
    protected $table = 'novel_book';

    //通过id来读取分类名称
    public function GetNameForId($id = 0){
        $cacheKey = 'novel_book_names:'.$id;

        $name = Redis::get($cacheKey);
        if($name){
            return $name;
        }

        //从数据库读取数据
        $info = self::select('id','name')->where('status',1)->where('id',$id)->first();

        //写入redis
        Redis::set($cacheKey,$info['name']);
        Redis::expire($cacheKey,3600*24);

        return $info['name'];
    }

    //读取最新小说列表
    public function GetNews($limit=12,$sort='id')
    {
        $cacheKey = 'novel:news-'.$limit;
        $novel = [];

        //优先读取redis
        $lists = Redis::Smembers($cacheKey);
        if(!$lists){

            $novel = self::select('id','name','cid','author','chapter_num','speed','pic')->where('status',1)->orderby($sort,'desc')->limit($limit)->get();

            //数据写入redis
            foreach($novel as $k=>$v)
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

        return $novel;
    }

    //读取列表
    public function GetLists($cid=0,$page=1,$limit=12,$sort='id')
    {
        //查询条件
        $where = '';
        if($cid){
            $where = ' cid='.$cid.' and ';
        }

        //分页
        $offset = ($page-1)*$limit;

        //优先读取redis
        $novel = DB::select("select id,name,cid,author,chapter_num,speed,pic from novel_book where $where status=1 order by $sort desc limit $offset,$limit");

        return $novel;
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
        $lists = DB::select("select count(0) as total from novel_book where $where status=1;");

        return $lists[0]->total;
    }

}
