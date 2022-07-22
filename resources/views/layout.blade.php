<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="renderer" content="webkit">
<meta name="applicable-device" content="pc,mobile">
<meta name="keywords" content="XXMM成人网站" />
<meta name="description" content="XXMM成人网站 " />
<title>XXMM成人网站</title>
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
      <a href="/"><img src="/skin/ecms106/images/logo.png" title="XXMM成人网站"></a>
    </ul>
    <ul class="top-nav">
        <li><a class="now" rel="nofollow" href="/">首页</a></li>
        <li class="" _t_nav="topnav-1"><a href="/movie">成人电影<i class="sjbgs"></i><i class="sjbgx"></i></a></li>
        <li class="" _t_nav="topnav-2"><a href="/novel">小说<i class="sjbgs"></i><i class="sjbgx"></i></a></li>
        <li class=""><a href="/fankui">反馈</a></li>
    </ul>
    </ul>
    <ul class="search so">
      <form action="/search" method="post">
        <input type="text" id="wd" name="keyboard" class="input" onblur="if(this.value==''){ this.value='请输入影片或演员名';this.style.color='#cfcdcd';}" onfocus="if(this.value=='请输入影片或演员名'){this.value='';this.style.color='';}" value="请输入影片或演员名" />
        <input type="submit" name="submit" class="imgbt" value="" />
      </form>
    </ul>
    <ul class="nav-qt aa">
      <li class="bb">
	  <a href="#" onclick="window.external.AddFavorite(&quot;/&quot;,&quot;xxmm成人网站&quot;)"><i class="jl"></i>加入收藏</a>
      </li>
      <li class="bb member"><strong class="ma"><i class="mbbg"></i></strong><div class="cc mbp"></div> </li>
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
  </div>
  <!--分类子目录-->
  <div class="nav-down clearfix">
    <div id="topnav-1" class="nav-down-1" style="display:none;" _t_nav="topnav-1">
      <div class="nav-down-2 clearfix">
        <ul>
          <li><a href="/movie/category/1">无码</a></li>
          <li><a href="/movie/category/2">有码</a></li>
          <li><a href="/movie/category/3">国产</a></li>
          <li><a href="/movie/category/4">欧美</a></li>
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
          <li><a href="/movie/category/1">无码</a></li>
          <li><a href="/movie/category/2">有码</a></li>
          <li><a href="/movie/category/3">国产</a></li>
          <li><a href="/movie/category/4">欧美</a></li>
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
        <input type="text" id="wd" name="keyboard" class="input" onblur="if(this.value==''){ this.value='请输入影片或演员名';this.style.color='#cfcdcd';}" onfocus="if(this.value=='请输入影片或演员名'){this.value='';this.style.color='';}" value="请输入影片或演员名" />
        <input type="submit" name="submit" class="imgbt" value="搜 索" />
      </form>
      </div>
    </div>
  </div>
</div>
<div class="topone clearfix"></div>

     @yield('content')

<!--结束-->
</div>
<div class="ylink clearfix"> 友情连接：@foreach ($SYSLINK as $nc)
                                        <span><a href="{{$nc['url']}}" target="_blank">{{$nc['name']}}</a></span>
                                      @endforeach   
</div>
<!--/底部--> 
﻿
<div class="footer clearfix">
  <p>免责声明:本站所有视频均来自互联网收集而来，版权归原创者所有，如果侵犯了你的权益，请在上方导航栏相关区域通知我们，我们会及时删除侵权内容，谢谢合作。</p>
  Copyright &copy; 2002-{{ date('Y') }} [XXMM] ICP备12345678号  在线统计  <!-----------本站统计结束---> 
</div>

<div class="gotop"><a class="gotopbg" href="javascript:;" title="返回顶部"></a></div>
</body>
</html>