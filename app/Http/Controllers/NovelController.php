<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use App\Models\NovelBook;
use App\Models\NovelCategory;
use App\Models\NovelChapter;
use App\Models\Ads;
use App\Models\Trans;

class NovelController extends Controller
{
	public function index(Request $request)
	{

		//最新12条
		$ups	= NovelBook::GetNews(12,'is_up');
		foreach($ups as $k=>$v){
			$v->category = NovelCategory::GetNameForId($v->cid);
			$ups[$k] = $v;
		}

		//点击排行10条
		$tops	= NovelBook::GetNews(10,'view_num');

		//12条
		$news	= NovelBook::GetNews(12,'updated_at');
		foreach($news as $k=>$v){
			$v->category = NovelCategory::GetNameForId($v->cid);
			$news[$k] = $v;
		}

		return view('novel',[
			'news'		=> 	$news,		//最新
			'tops'   	=>  $tops,		//点击排行
			'ups'   	=>  $ups,		//推荐
		]);
	}

	public function lists(Request $request,$cid = 0)
	{
		$ll = app()->getLocale();
		$limit  = 30;
		$page 	= $request->input('page')?$request->input('page'):1;
		$sort 	= $request->input('sort')?$request->input('sort'):'new';

		$orderby = [
			'new' 	=>	'id',
			'click'	=>	'view_num',
		];

		//读取30条小说
		$lists	= NovelBook::GetLists($cid,$page,$limit,$orderby[$sort]);
		foreach($lists as $k=>$v){
			$v->category = NovelCategory::GetNameForId($v->cid);
			$lists[$k] = $v;
		}

		//计算总数
		$total = NovelBook::GetTotal($cid);

		//读取广告
		$ads  = Ads::Gets('novel-list');

		return view('novel_list',[
			'ml'		=> 	$lists,				//数据列表
			'total'   	=>  $total,				//总记录数
			'limit'		=> 	$limit,				//每页多少条
			'cid'		=>	$cid,				//分类
			'category'	=>	Trans::do(NovelCategory::GetNameForId($cid),'novel_category','name',$ll),
			'page'		=>	$page,				//当前页
			'sort'		=> 	$sort,				//排序
			'ads'		=>	$ads,
		]);
	}

	//显示详细页
	public function book(Request $request,$id=0)
	{
		$ll = app()->getLocale();
		if(!$id){
			return view('error',[
				'error'	=>	'参数错误'
			]);
		}

		$info = NovelBook::select('id','name','cid','author','chapter_num','view_num','speed','pic','desc','updated_at')->where('status',1)->where('id',$id)->first();

		if(!$info){
			return view('error',[
				'error'	=>	'数据不存在'
			]);
		}

		$ip = request()->ip();
		$cacheKey = 'novel:book:'.$info['id'].':'.$ip;
		$isView = Redis::get($cacheKey);
		if(!$isView){
			//点击数+1
			NovelBook::where('id',$info['id'])->increment('view_num', 1);

			//加入缓存
			Redis::set($cacheKey,1);
		}

		//处理状态
		$speed 		= ($info->speed==2)?'完本':'连载中';

		//获取参数
		$limit   =  $request->input('limit')?intval($request->input('limit')):100;
		$page 	 =	$request->input('page')?intval($request->input('page')):1;
		$sort 	= $request->input('sort')?$request->input('sort'):'desc';

		$orderby = [
			'asc' 	=>	'asc',
			'desc'	=>	'desc',
		];

		//读取章节
		$lists = NovelChapter::select('id','name','created_at')->where('status',1)->where('bid',$id)->orderby('id',$orderby[$sort])->paginate($limit);

		$cid 	=	$info['cid'];

		//读取广告
		$ads  = Ads::Gets('novel-book');

		return view('novel_book',[
			'info'		=> 	$info,		//数据
			'cid'		=>	$cid,		//分类
			'category'	=>	Trans::do(NovelCategory::GetNameForId($cid),'novel_category','name',$ll),
			'speed'		=> 	$speed,
			'lists'		=>	$lists,
			'total'		=> 	$lists->total(),
			'limit'		=>	$limit,
			'page'		=>	$page,
			'sort'		=>	$sort,
			'ads'		=>	$ads,
		]);
	}

	public function chapter(Request $request,$id=0)
	{
		$ll = app()->getLocale();
		if(!$id){
			return view('error',[
				'error'	=>	'参数错误'
			]);
		}

		$info = NovelChapter::select('id','name','bid','cid','content','created_at')->where('status',1)->where('id',$id)->first();

		if(!$info){
			return view('error',[
				'error'	=>	'数据不存在'
			]);
		}

		$cid 	=	$info['cid'];
		$bid	= 	$info['bid'];

		//获取上一页id
		$left = NovelChapter::select('id','name','bid','cid')->where('status',1)->where('bid',$bid)->where('id','<',$id)->orderby('id','desc')->first();
		//获取下一页id
		$right = NovelChapter::select('id','name','bid','cid')->where('status',1)->where('bid',$bid)->where('id','>',$id)->orderby('id','asc')->first();

		return view('novel_chapter',[
			'cid'		=>	$cid,		//分类
			'category'	=>	Trans::do(NovelCategory::GetNameForId($cid),'novel_category','name',$ll),
			'info'		=>	$info,
			'bid'		=> 	$bid,
			'bookname' 	=> 	NovelBook::GetNameForId($bid),
			'left'		=>  isset($left['id'])?$left['id']:0,
			'right'		=>  isset($right['id'])?$right['id']:0,
		]);
	}
	
}