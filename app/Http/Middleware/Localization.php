<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use App\Models\NovelCategory;
use App\Models\Links;
use App\Models\Trans;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Session::has('locale')){
            App::setLocale(Session::get('locale'));
        }

        $ll = app()->getLocale();
        //小说分类
        $novelCategory = NovelCategory::select('id','name')->where('status',1)->get();

        foreach($novelCategory as $k=>$v){
            $v['name'] = Trans::do($v['name'],'novel_category','name',$ll);
            $novelCategory[$k] = $v;
        }

        //友情链接
        $linkLists = Links::GetLists();

        View::share('SYSNC', $novelCategory);
        View::share('SYSLINK', $linkLists);
    
        return $next($request);
    }
}
