<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use App\Models\MovieCategory;
use App\Models\Search;
use Illuminate\Support\Facades\Redis;

class SearchController extends Controller
{

	public function search(Request $request)
	{
		$limit  = 30;
		$page 	= $request->input('page')?$request->input('page'):1;
		$sort 	= $request->input('sort')?$request->input('sort'):'new';
		$keyword = $request->input('keyword');

		$orderby = [
			'new' 	=>	'id',
			'click'	=>	'view_num',
		];

		//读取30条影片
		$movieLists	= Search::GetLists($keyword,$page,$limit,$orderby[$sort]);
		foreach($movieLists as $k=>$v){
			$v->category = MovieCategory::GetNameForId($v->cid);
			$movieLists[$k] = $v;
		}

		//计算总数
		$total = Search::GetTotal($keyword);

		//搜索条件
		$search = '搜索【'.$keyword.'】的结果';

		$cid = 0;
		return view('movie',[
			'ml'		=> 	$movieLists,		//数据列表
			'search'	=>	$search,			//搜索条件
			'total'   	=>  $total,				//总记录数
			'limit'		=> 	$limit,				//每页多少条
			'cid'		=>	$cid,				//分类
			'category'	=>	MovieCategory::GetNameForId($cid),
			'page'		=>	$page,				//当前页
			'sort'		=> 	$sort,				//排序
		]);
	}
	
}