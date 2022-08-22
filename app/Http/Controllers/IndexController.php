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
use App\Models\Movie;
use App\Models\NovelBook;
use App\Models\NovelCategory;
use App\Models\Ads;

class IndexController extends Controller
{
	//首页
	public function index(Request $request){

		//读取首页热门
		$banner = Movie::GetHots(9);

		//处理数据
		foreach($banner as $k=>$v){
			$v->category = MovieCategory::GetNameForId($v->cid);
			$v->director = MovieDirector::GetNameForId($v->director_id);
			$v->series 	= MovieSeries::GetNameForId($v->series_id);
			$v->film 	= MovieFilm::GetNameForId($v->film_id);

			$banner[$k] = $v;
		}

		//读取首页新种12条
		$links = Movie::GetLinks(12);

		//处理数据
		foreach($links as $k=>$v){
			$v->category = MovieCategory::GetNameForId($v->cid);
			$links[$k] = $v;
		}

		//读取首页排行榜10条
		$maxViews = Movie::GetViews(10);

		//影片分类
		$movieCategory = MovieCategory::select('id','name')->where('status',1)->get();

		//读取12条影片
		$movieLists	= Movie::GetLists(0,1,12);
		foreach($movieLists as $k=>$v){
			$v->category = MovieCategory::GetNameForId($v->cid);
			$movieLists[$k] = $v;
		}

		//读取首页小说更新前10
		$novelBook = NovelBook::GetNews(12);
		foreach($novelBook as $k=>$v){
			$v->category 	= NovelCategory::GetNameForId($v->cid);
			$v->speed 		= ($v->speed==2)?'完本':'连载中';
			$novelBook[$k] = $v;
		}

		//读取广告
		$adsBanner  = Ads::Gets('home-banner');
		$adsActive  = Ads::Gets('home-active');

		return view('index',[
			'banner'	=>	$banner,
			'links'		=> 	$links,
			'maxview'	=> 	$maxViews,
			'novelbook'	=> 	$novelBook,
			'mc' 		=> 	$movieCategory,
			'ml'		=> 	$movieLists,
			'adsbanner'	=>	$adsBanner,
			'adsactive'	=>	$adsActive,
		]);
	}
	
}