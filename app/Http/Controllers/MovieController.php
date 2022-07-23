<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use App\Models\MovieCategory;
use App\Models\MovieDirector;
use App\Models\MovieSeries;
use App\Models\MovieFilm;
use App\Models\MovieActor;
use App\Models\MovieLabel;
use App\Models\Movie;
use App\Models\VideoNotice;
use Illuminate\Support\Facades\Redis;

class MovieController extends Controller
{

	public function index(Request $request,$cid = 0)
	{
		$limit  = 30;
		$page 	= $request->input('page')?$request->input('page'):1;
		$sort 	= $request->input('sort')?$request->input('sort'):'new';

		$orderby = [
			'new' 	=>	'id',
			'click'	=>	'view_num',
		];

		//读取30条影片
		$movieLists	= Movie::GetLists($cid,$page,$limit,$orderby[$sort]);
		foreach($movieLists as $k=>$v){
			$v->category = MovieCategory::GetNameForId($v->cid);
			$movieLists[$k] = $v;
		}

		//计算总数
		$total = Movie::GetTotal($cid);

		return view('movie',[
			'ml'		=> 	$movieLists,		//数据列表
			'search'	=>	'',					//搜索条件
			'total'   	=>  $total,				//总记录数
			'limit'		=> 	$limit,				//每页多少条
			'cid'		=>	$cid,				//分类
			'category'	=>	MovieCategory::GetNameForId($cid),
			'page'		=>	$page,				//当前页
			'sort'		=> 	$sort,				//排序
		]);
	}

	//显示电影详细页
	public function show(Request $request,$number='')
	{
		if(!$number){
			return view('error',[
				'error'	=>	'参数错误'
			]);
		}

		//根据番号读取数据
		$info = Movie::select('id','name','cid','director_id','series_id','film_id','score','view_num','issued','number','publish_time','duration','thumb','avatar','video','magneticlink','pic','updated_at')->where('status',1)->where('number',$number)->first();

		if(!$info){
			return view('error',[
				'error'	=>	'番号不存在'
			]);
		}

		$ip = request()->ip();
		$cacheKey = 'movie:show:'.$info['id'].':'.$ip;
		$isView = Redis::get($cacheKey);
		if(!$isView){
			//点击数+1
			Movie::where('id',$info['id'])->increment('view_num', 1);

			//加入缓存
			Redis::set($cacheKey,1);
		}

		//处理数据
		$info['series'] = MovieSeries::GetNameForId($info['series_id']);
		$info['film'] = MovieFilm::GetNameForId($info['film_id']);
		$info['director'] = MovieFilm::GetNameForId($info['director_id']);

		//读取演员
		$actor = MovieActor::GetActorList($info['id']);

		//得到标签列表
        $label = MovieLabel::GetList($info['id']);

        //处理磁链
        $magneticlink = json_decode($info['magneticlink'],true);

        //截图列表
        $pic = $info['pic']?json_decode($info['pic'],true):[];

        //获取相关影片，猜你喜欢
        $related = Movie::GetRelated($info['id']);
        foreach($related as $k=>$v){
			$v->category = MovieCategory::GetNameForId($v->cid);
			$related[$k] = $v;
		}

		//读取视频播放器定义的滚动字幕
		$videoNotice = VideoNotice::GetLists();

		$cid 	=	$info['cid'];
		return view('movie_show',[
			'info'		=> 	$info,		//数据
			'search'	=>	'',			//搜索条件
			'cid'		=>	$cid,		
			'category'	=>	MovieCategory::GetNameForId($cid),
			'actor'		=>	$actor,
			'label'		=> 	$label,
			'mlink' 	=>	$magneticlink,
			'pic'		=>	$pic,
			'related'	=> 	$related,
			'notice'	=>	$videoNotice,
		]);

	}
	
}