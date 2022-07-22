<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\NovelCategory;
use App\Models\Links;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //------分享公共数据

        //小说分类
        $novelCategory = NovelCategory::select('id','name')->where('status',1)->get();

        //友情链接
        $linkLists = Links::GetLists();

        View::share('SYSNC', $novelCategory);
        View::share('SYSLINK', $linkLists);
    }
}
