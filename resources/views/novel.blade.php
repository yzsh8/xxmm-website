@extends('layout') @section('content')


<div class="main"> 
  <!--首页推荐-->
  <div class="index-tj clearfix">
    <div class="index-tj-l">
      <h3 class="title index-color clearfix"> <span class="hitkey"></span>推荐小说:</h3>
      <ul>
        @foreach ($ups as $v)
          <li class="p2 m1 ">
            <a class="link-hover" href="/novel/book/{{$v->id}}" title="{{$v->name}}">
              <img class="lazy" data-original="{{get_web_url($v->pic)}}" src="/skin/ecms106/images/load.gif" alt="{{$v->name}}">
              <span class="book-bg"></span>
              <span class="lzbz">
                <p class="name">{{$v->name}}</p>
                <p class="actor">分类：{{$v->category}}</p>
                <p class="actor">状态：{{$v->speed}}</p>
                <p class="actor">作者：{{$v->author}}</p>
                <p class="actor">共{{$v->chapter_num}}章</p>
              </span>
              </a> 
          </li>
        @endforeach
      </ul>
    </div>
    <div class="index-tj-r">
      <h3 class="title index-color">热门排行榜</h3>
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

<div class="pcd_ad">
  <table width="100%" height="90" bgcolor="#33CCCC" style="background:#33CCCC">
    <tr align="center">
      <td style="text-align: center;color: #fff;line-height: 90px;background:#33CCCC">pc广告位一</td>
    </tr>
  </table>
</div>
<div class="mbd_ad">
  <table width="100%" height="90" bgcolor="#33CCCC" style="background:#33CCCC">
    <tr align="center">
      <td style="text-align: center;color: #fff;line-height: 90px;background:#33CCCC">手机广告位一</td>
    </tr>
  </table>
</div>

  <div class="index-area clearfix">
    <h1 class="title index-color"> <span class="hitkey kp"></span> <a href="/novel/category">小说列表</a> </h1>
    <ul>
      @foreach ($news as $k=>$v)
        <li class="p1 m1">
            <a class="link-hover" href="/novel/book/{{$v->id}}" title="{{$v->name}}">
                <img class="lazy" data-original="{{get_web_url($v->pic)}}" src="/skin/ecms106/images/load.gif" alt="{{$v->name}}">
                <span class="book-bg"></span>
                <span class="lzbz">
                    <p class="name">{{$v->name}}</p>
                    <p class="actor">分类：{{$v->category}}</p>
                    <p class="actor">状态：{{$v->speed}}</p>
                    <p class="actor">作者：{{$v->author}}</p>
                </span>
                <p class="other"><i>共{{$v->chapter_num}}章</i></p>
            </a> 
        </li>
      @endforeach
    </ul>
  </div>

  @endsection
