<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use App\Models\Feedback;

class FeedbackController extends Controller
{
	public function index(Request $request)
	{
		return view('feedback');
	}

	public function save(Request $request)
	{
		$name 		=	$request->input('name');
		$number		=	$request->input('number');
		$contact	=	$request->input('contact');
		$desc		=	$request->input('desc');

		$ip = request()->ip();
		$cacheKey  =  'feedback:ip:'.$ip;

		if(Redis::get($cacheKey)){
			return view('error',[
				'error'	=>	'不要频繁提交，请过一会儿再来'
			]);
		}

		//存入数据库
		$da = array();
		$da['name']		=	$name;
		$da['number']	=	$number;
		$da['contact']	=	$contact;
		$da['desc']		=	$desc;
		$da['ip']		=	$ip;

		Feedback::create($da);

		//写入redis
		Redis::set($cacheKey,1);
		Redis::expire($cacheKey,60*10);

		return view('error',[
			'error'	=>	'提交完成,感谢您的提交',
		]);
	}
	
}