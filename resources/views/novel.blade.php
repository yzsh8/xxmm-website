@extends('layout') @section('content')

<link href="/skin/ecms106/css/novel.css" rel="stylesheet">

<div class="main"> 
  <!--首页推荐-->
  <div class="index-tj clearfix">
    <div class="index-tj-l ptm-card-content">
      <h3 class="title index-color clearfix"> <span class="hitkey"></span>{{ trans('novel.tops')}}:</h3>
      <ul class="pt-card pt-card-6">
        @foreach ($ups as $v)
          <li>
            <div class="pt-novel">
              <div class="pt-one">
                <span class="pt-author"><strong>[{{$v->category}}]</strong></span>
                <span class="pt-name"><a href="/novel/book/{{$v->id}}" title="{{$v->name}}">{{$v->name}}</a></span>
                <span class="pt-author"> / {{$v->author}}</span>
                <span class="pt-author"> / {{$v->chapter_num}}{{ trans('novel.chapter')}}</span>
                <span class="pt-author"> / {{($v->speed==2)?trans('novel.speed-done'):trans('novel.speed-process')}}</span>
              </div>
            </div>
            <div class="pt-cover">
                {{date('y-m-d H:i',strtotime($v->updated_at))}}
            </div>
          </li>
        @endforeach
      </ul>
    </div>
    <div class="index-tj-r">
      <h3 class="title index-color">{{ trans('novel.hots')}}</h3>
      <ul>
        @foreach ($tops as $k=>$v)
          <li>
              <a href="/novel/book/{{$v->id}}" title="{{$v->name}}">
                <span class="bz"></span>
                <gm  class="gs">{{$k+1}}</gm><span class="az">{{$v->name}}</span>
              </a>
          </li>
        @endforeach  
      </ul>
    </div>
  </div>

<!--<div class="pcd_ad">
  <table width="100%" height="90" bgcolor="#33CCCC" style="background:#33CCCC">
    <tr align="center">
      <td style="text-align: center;color: #fff;line-height: 90px;background:#33CCCC">{{ trans('website.pcads')}}</td>
    </tr>
  </table>
</div>
<div class="mbd_ad">
  <table width="100%" height="90" bgcolor="#33CCCC" style="background:#33CCCC">
    <tr align="center">
      <td style="text-align: center;color: #fff;line-height: 90px;background:#33CCCC">{{ trans('website.mobielads')}}</td>
    </tr>
  </table>
</div>-->

  <div class="index-area clearfix">
    <h1 class="title index-color"> <span class="hitkey kp"></span> <a href="/novel/category">{{ trans('novel.lists')}}</a> </h1>
    <ul class="pt-card pt-card-6">
      @foreach ($news as $k=>$v)
        <li>
            <div class="pt-novel">
              <div class="pt-one">
                <span class="pt-author"><strong>[{{$v->category}}]</strong></span>
                <span class="pt-name"><a href="/novel/book/{{$v->id}}" title="{{$v->name}}">{{$v->name}}</a></span>
                <span class="pt-author"> / {{$v->author}}</span>
                <span class="pt-author"> / {{$v->chapter_num}}{{ trans('novel.chapter')}}</span>
                <span class="pt-author"> / {{($v->speed==2)?trans('novel.speed-done'):trans('novel.speed-process')}}</span>
              </div>
            </div>
            <div class="pt-cover">
                {{date('y-m-d H:i',strtotime($v->updated_at))}}
            </div>
        </li>
      @endforeach
    </ul>
  </div>

  @endsection
