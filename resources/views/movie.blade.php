@extends('layout') @section('content')

<div class="main">
  <h1 class="title"><a href="/">{{ trans('menu.home')}}</a>
      &nbsp;>&nbsp;<a href="/movie/0/">{{ trans('menu.movie')}}</a>
      @if($category)
      &nbsp;>&nbsp;<a href="/movie/{{$cid}}/">{{$category}}</a>
      @endif
  </h1>
</div>

<div class="main">
  <div class="sy-jg mb">
    <p class="jg"> 
      {{$search}}
    </p>
    <p class="px"> <a class="time on" href="/movie/{{$cid}}?sort=new"><em></em>{{ trans('movie.sort-new')}}</a> <a class="rq" href="/movie/{{$cid}}?sort=click"><em></em>{{ trans('movie.sort-view')}}</a></p>
  </div>
  <div class="index-area clearfix">
    <ul>
      @foreach ($ml as $v)
        <li class="p1 m1">
          <a class="link-hover" href="/movie/show/{{$v->number}}" title="{{$v->name}}">
              <img class="lazy" data-original="{{get_web_url($v->thumb)}}" src="/skin/ecms106/images/load.gif" alt="{{$v->name}}">
              <span class="video-bg"></span>
              <span class="lzbz">
                  <p class="name">{{$v->name}}</p>
                  <p class="actor">{{$v->number}}</p>
                  <p class="actor">{{$v->category}}</p>
                  <p class="actor">{{ intval((int)$v->publish_time/60) }}{{ trans('movie.minute')}}</p>
              </span>
              <p class="other"><i></i></p>
            </a> 
        </li>
      @endforeach
    </ul>
  </div>
  <div class="page mb clearfix" id="page">
      
  </div>

<script type="text/javascript" src="/skin/ecms106/js/jquery.page.js"></script>
<script type="text/javascript">
    new page({
      "id_dom":"page",
      "total":{{$total}},     //总记录
      "per_page":{{$limit}},  //每页显示
      "nowpage":{{$page}},    //当前页面
      "callback":function(now){
          window.location.href="/movie/{{$cid}}/?sort={{$sort}}&page="+now; 
          //console.log('当前页:' + now);
       }
    });
</script>
@endsection