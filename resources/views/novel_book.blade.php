@extends('layout') @section('content')

<div class="main">
  <h1 class="title"><a href="/">{{ trans('menu.homne')}}</a>&nbsp;>&nbsp;<a href="/novel">{{ trans('menu.novel')}}</a>&nbsp;>&nbsp;<a href="/novel/category/{{$cid}}">{{$category}}</a> </h1>
  <div class="ct mb clearfix">
    <div class="bt-l"> <img class="lazy" data-original="{{get_web_url($info->pic)}}" src="/skin/ecms106/images/load.gif" alt="{{$info['name']}}"> </div>
    <div class="bt-c">
      <dl>
        <dt class="name">{{$info['name']}}<span class="bz">共{{$info['chapter_num']}}{{ trans('novel.chapter')}}</span></dt>
        <dt><span>{{ trans('novel.category')}}：</span>{{$category}}</dt>
        <dt><span>{{ trans('novel.author')}}：</span>{{$info->author}} </dt>
        <dt><span>{{ trans('novel.status')}}：</span>{{$speed}}</dt>
        <dt><span>{{ trans('novel.updated')}}：</span>{{ date("Y-m-d H:i",strtotime($info->updated_at)) }}</dt>
      </dl>
      <div name="ee" class="ee"><span class="js">{{ trans('novel.desc')}}：</span>{{$info->desc}}&hellip;&hellip;</div>
    </div>
    <div class="bt-r">
      <p>
      <div style="text-align:center;">
            <img src="/images/novel-right.png">
      </div>
      </p>
    </div>
  </div>

<!--<div class="pcd_ad" style="margin-bottom: 10px;">
    <img src="/images/ads-home.png">
</div>
<div class="mbd_ad"  style="margin-bottom: 10px;">
    <img src="/images/ads-mobil.png" width="100%">
</div>-->

<div class="tab-down mb clearfix">
    <div class="playfrom tab8 clearfix">
      <ul>
        <li class="on" >{{ trans('novel.chapter')}}
            <p class="jj">
                <span id="vlink_1_s1"><a href="/novel/book/{{$info->id}}/?sort=desc"><em @if ($sort=='desc') 
                    class="over" 
                    @endif>{{ trans('novel.desc')}}↓</em></a></span>
                <span id="vlink_1_s2"><a href="/novel/book/{{$info->id}}/?sort=asc"><em @if ($sort=='asc') 
                    class="over" 
                    @endif>{{ trans('novel.asc')}}↑</em></a></span>
            </p>
        </li>
      </ul>
    </div>
    <div class="playlist clearfix">
        @foreach ($lists as $v)
          <div class="h1 clearfix">
            <p class="intro"><a href="/novel/book/chapter/{{$v->id}}">{{$v->name}}</a></p>
            <p class="jj"><span id="vlink_1_s1">{{ date("Y-m-d H:i",strtotime($v->created_at)) }}</span></p>
          </div>
        @endforeach
    </div>
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
          window.location.href="/novel/book/{{$info->id}}/?sort={{$sort}}&page="+now; 
          //console.log('当前页:' + now);
       }
    });
</script>

@endsection