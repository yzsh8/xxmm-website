@extends('layout') @section('content')

<div class="main">
  <h1 class="title"><a href="/">首页</a>&nbsp;>&nbsp;<a href="/novel">小说</a>&nbsp;>&nbsp;<a href="/novel/category/{{$cid}}">{{$category}}<</a> </h1>
  <div class="ct mb clearfix">
    <div class="bt-l"> <img class="lazy" data-original="{{get_web_url($info->pic)}}" src="/skin/ecms106/images/load.gif" alt="{{$info['name']}}"> </div>
    <div class="bt-c">
      <dl>
        <dt class="name">{{$info['name']}}<span class="bz">共{{$info['chapter_num']}}章</span></dt>
        <dt><span>分类：</span>{{$category}}</dt>
        <dt><span>作者：</span>{{$info->author}} </dt>
        <dt><span>状态：</span>{{$speed}}</dt>
        <dt><span>更新：</span>{{ date("Y-m-d H:i",strtotime($info->updated_at)) }}</dt>
      </dl>
      <div name="ee" class="ee"><span class="js">介绍：</span>{{$info->desc}}&hellip;&hellip;</div>
    </div>
    <div class="bt-r">
      <p>
      <div style="text-align:center;">
            <table width="100%" height="90" bgcolor="#33CCCC" style="background:#33CCCC">
                <tr align="center">
                  <td style="text-align: center;color: #fff;line-height: 90px;background:#33CCCC">小说右侧广告位</td>
                </tr>
            </table>
      </div>
      </p>
    </div>
  </div>

<div class="pcd_ad" style="margin-bottom: 10px;">
    <table width="100%" height="90" bgcolor="#33CCCC" style="background:#33CCCC">
        <tr align="center">
          <td style="text-align: center;color: #fff;line-height: 90px;background:#33CCCC">pc广告位一</td>
        </tr>
    </table>
</div>
<div class="mbd_ad"  style="margin-bottom: 10px;">
    <table width="100%" height="90" bgcolor="#33CCCC" style="background:#33CCCC">
        <tr align="center">
          <td style="text-align: center;color: #fff;line-height: 90px;background:#33CCCC">手机广告位一</td>
        </tr>
    </table>
</div>

<div class="tab-down mb clearfix">
    <div class="playfrom tab8 clearfix">
      <ul>
        <li class="on" >章节列表
            <p class="jj">
                <span id="vlink_1_s1"><a href="/novel/book/{{$info->id}}/?sort=desc"><em @if ($sort=='desc') 
                    class="over" 
                    @endif>倒序↓</em></a></span>
                <span id="vlink_1_s2"><a href="/novel/book/{{$info->id}}/?sort=asc"><em @if ($sort=='asc') 
                    class="over" 
                    @endif>顺序↑</em></a></span>
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
          console.log('当前页:' + now);
       }
    });
</script>

@endsection