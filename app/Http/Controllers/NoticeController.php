<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use App\Library\Y;
use App\Models\VideoNotice;

class NoticeController extends Controller
{
	public function api(Request $request)
	{
		//读取视频播放器定义的滚动字幕
		$videoNotice = VideoNotice::GetLists();

		$da	=	[];
		foreach($videoNotice as $v)
		{
			$size = '';
			$color = '';
			if($v['size']){
				$size = 'size='.$v['size'];
			}
			if($v['color']){
				$color = 'color='.$v['color'];
			}
			$da[]	= [$v['stime'],0,$v['color'],'dplayer','<font '.$color.' '.$size.'>'.$v['name'].'</font>'];
		}
		return Y::success('success',$da);
	}
	
}