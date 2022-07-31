<!DOCTYPE html>
<html lang="{{app()->getLocale()}}">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="renderer" content="webkit">
<meta name="applicable-device" content="pc,mobile">
<meta name="keywords" content="{{ trans('website.keyword')}}" />
<meta name="description" content="{{ trans('website.desc')}} " />
<title>{{ trans('website.title')}}</title>
<link href="/skin/ecms106/css/style.css" rel="stylesheet">
<script src="/skin/ecms106/js/jquery-1.4.4.min.js"></script>
<script src="/skin/ecms106/js/common.js"></script>
<script src="/skin/ecms106/js/jquery.lazyload.js"></script>
<!--[if lt IE 9]>
<script src="/skin/ecms106/js/html5shiv.min.js"></script>
<script src="/skin/ecms106/js/respond.min.js"></script>
<![endif]-->
<script src="/skin/ecms106/js/jquery.superslide.js" type="text/javascript"></script>
</head>
<body>
<!--/头部--> 
<div class="header-all">
  <div class="top clearfix">
    <ul class="logo">
      <a href="/"><img src="/skin/ecms106/images/logo.png" title="{{ trans('website.title')}}"></a>
    </ul>
    <ul class="top-nav">
        <li><a class="now" rel="nofollow" href="/">{{ trans('menu.home')}}</a></li>
        <li class="" _t_nav="topnav-1"><a href="/movie">{{ trans('menu.movie')}}</a></li>
        <li class="" ><a href="/movie/category/1">{{ trans('menu.nocode')}}</a></li>
        <li class="" ><a href="/movie/category/2">{{ trans('menu.code')}}</a></li>
        <li class="" ><a href="/movie/category/3">{{ trans('menu.chinese')}}</a></li>
        <li class="" ><a href="/movie/category/4">{{ trans('menu.eng')}}</a></li>
        <li class="" _t_nav="topnav-2"><a href="/novel">{{ trans('menu.novel')}}<i class="sjbgs"></i><i class="sjbgx"></i></a></li>
        <li class=""><a href="/feedback">{{ trans('menu.feedback')}}</a></li>
    </ul>
    </ul>
    <ul class="search so">
      <form action="/search" method="post">
        <input type="text" id="wd" name="keyword" class="input" onblur="if(this.value==''){ this.value='{{ trans('website.search')}}';this.style.color='#cfcdcd';}" onfocus="if(this.value=='{{ trans('website.search')}}'){this.value='';this.style.color='';}" value="{{ trans('website.search')}}" />
        {{ csrf_field() }}
        <input type="submit" name="submit" class="imgbt" value="" />
      </form>
    </ul>
    <ul class="nav-qt aa">
      <li class="bb">
	  <a href="#" onclick="window.external.AddFavorite(&quot;/&quot;,&quot;{{ trans('website.title')}}&quot;)"><i class="jl"></i>{{ trans('website.favorite')}}</a>
      </li>
      <li class="bb member"><strong class="ma"><i class="mbbg"></i>@if (app()->getLocale()=='en')
       {{ trans('language.en')}}
     @else
       {{ trans('language.zh-CN')}}
     @endif</strong>
        <div class="cc mbp">
            <p><a href="/language/en">{{ trans('language.en')}}</a></p>
            <p><a href="/language/zh-CN">{{ trans('language.zh-CN')}}</a></p>
        </div>
      </li>
    </ul>
    <ul class="sj-search">
      <li class="sbtn2"><i class="sjbg-search"></i></li>
    </ul>
    <ul class="sj-nav">
      <li class="sbtn1"><i class="sjbg-nav"></i></li>
    </ul>
    <ul class="sj-navhome">
      <li><a href="/"><i class="sjbg-home"></i></a></li>
    </ul>
    <ul class="sj-language">
      <li class="sbtn3"><i class="sjbg-language"></i>@if (app()->getLocale()=='en')
       {{ trans('language.en')}}
     @else
       {{ trans('language.zh-CN')}}
     @endif</li>
    </ul>
  </div>
  <!--分类子目录-->
  <div class="nav-down clearfix">
    <div id="topnav-1" class="nav-down-1" style="display:none;" _t_nav="topnav-1">
      <div class="nav-down-2 clearfix">
        <ul>
          <li><a href="/movie/category/1">{{ trans('menu.nocode')}}</a></li>
          <li><a href="/movie/category/2">{{ trans('menu.code')}}</a></li>
          <li><a href="/movie/category/3">{{ trans('menu.chinese')}}</a></li>
          <li><a href="/movie/category/4">{{ trans('menu.eng')}}</a></li>
          <li><a href="/movie/category/5">FC2</a></li>
        </ul>
      </div>
    </div>
    <div id="topnav-2" class="nav-down-1" style="display:none;" _t_nav="topnav-2">
      <div class="nav-down-2 clearfix">
        <ul>
          @foreach ($SYSNC as $nc)
          <li><a href="/novel/category/{{$nc['id']}}">{{$nc['name']}}</a></li>
          @endforeach
        </ul>
      </div>
    </div> 

    <!--手机版导航-->
    <div id="sj-nav-1" class="nav-down-1 sy1 sj-noover" style="display:none;" _s_nav="sj-nav-1">
      <div class="nav-down-2 sj-nav-down-2 clearfix">
        <ul>
          <li><a href="/movie/category/1">{{ trans('menu.nocode')}}</a></li>
          <li><a href="/movie/category/2">{{ trans('menu.code')}}</a></li>
          <li><a href="/movie/category/3">{{ trans('menu.chinese')}}</a></li>
          <li><a href="/movie/category/4">{{ trans('menu.eng')}}</a></li>
          <li><a href="/movie/category/5">FC2</a></li>      
        </ul>
      </div>
      <div class="nav-down-2 sj-nav-down-2 clearfix">
        <ul>
          @foreach ($SYSNC as $nc)
          <li><a href="/novel/category/{{$nc['id']}}">{{$nc['name']}}</a></li>
          @endforeach     
        </ul>
      </div>
    </div>
    <div id="sj-nav-search" class="nav-down-1 sy2 sj-noover" style="display:none;" _t_nav1="sj-nav-search">
      <div class="nav-down-2 sj-nav-down-search clearfix">
        <form action="/search" method="post">
        <input type="text" id="wd" name="keyword" class="input" onblur="if(this.value==''){ this.value='{{ trans('website.search')}}';this.style.color='#cfcdcd';}" onfocus="if(this.value=='{{ trans('website.search')}}'){this.value='';this.style.color='';}" value="{{ trans('website.search')}}" />
        {{ csrf_field() }}
        <input type="submit" name="submit" class="imgbt" value="{{ trans('website.search_button')}}" />
      </form>
      </div>
    </div>

    <div id="sj-nav-language" class="nav-down-1 sy3 sj-noover" style="display:none;" _t_nav1="sj-nav-language">
      <div class="nav-down-2 sj-nav-down-2 clearfix">
        <ul>
          <li><a href="/language/en">{{ trans('language.en')}}</a></li>
          <li><a href="/language/zh-CN">{{ trans('language.zh-CN')}}</a></li>
        </ul>
      </div>
      </div>

    <!--结束-->

  </div>
</div>
<div class="topone clearfix"></div>

     @yield('content')

</div>
<div class="ylink clearfix"> {{ trans('website.link')}}：@foreach ($SYSLINK as $nc)
                                        <span><a href="{{$nc['url']}}" target="_blank">{{$nc['name']}}</a></span>
                                      @endforeach   
</div>
<!--/底部--> 
﻿
<div class="footer clearfix">
  <p><a href="/page/1">{{ trans('menu.aboutus')}}</a> <a href="/page/2">{{ trans('menu.privacy')}}</a> <a href="/page/3">{{ trans('menu.magnet')}}</a> <a href="/page/4">{{ trans('menu.contact')}}</a> <a href="/feedback">{{ trans('menu.feedback')}}</a></p>
  <p>{{ trans('website.foot')}}</p>
  Copyright &copy; 2002-{{ date('Y') }} [XXMM] ICP备12345678号  <!-----------本站统计结束---> 
</div>

<div class="gotop"><a class="gotopbg" href="javascript:;" title="{{ trans('website.top')}}"></a></div>
</body>
</html>