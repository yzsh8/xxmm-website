<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use App\Models\Page;

class PageController extends Controller
{
	public function index(Request $request,$id = 0)
	{

		//最新12条
		$info	=	Page::select('name','content')->where('status',1)->where('id',$id)->first();

		return view('page',[
			'info'		=> 	$info,
		]);
	}
	
}