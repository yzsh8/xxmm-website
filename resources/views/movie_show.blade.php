@extends('layout') @section('content')

<div class="main">
  <h1 class="title"><a href="/">首页</a>&nbsp;>&nbsp;<a href="/movie/">电影</a>&nbsp;>&nbsp;<a href="/movie/{{$cid}}/">{{$category}}</a>&nbsp;&nbsp;&raquo;&nbsp;&nbsp;<a href="/movie/show/{{$info['number']}}">{{$info['name']}}</a> </h1>
  <div class="ct mb clearfix">
    <div class="ct-l"> <img class="lazy" data-original="{{get_web_url($info->avatar)}}" src="/skin/ecms106/images/load.gif" alt="{{$info['name']}}"> </div>
    <div class="ct-c">
      <dl>
        <dt class="name">{{$info['name']}}</dt>
        <dt><span>番号：</span>{{$info['number']}}</dt>
        <dt><span>系列：</span>{{$info['series']}} </dt>
        <dt><span>片商：</span>{{$info['film']}} </dt>
        <dt><span>发行商：</span>{{$info['issued']}} </dt>
        <dt><span>导演：</span>{{$info['director']}}</dt>
        <dt><span>日期：</span>{{$info['publish_time']}}</dt>
        <dt><span>时长：</span>{{intval($info['duration']/60)}}分钟</dt>
        <dt><span>评分：</span>{{$info['score']}}</dt>
        <dt><span>查看：</span>{{$info['view_num']}}</dt>
      </dl>
      <div><span class="js">主演：</span>
            @foreach ($actor as $ac)
            <p style="padding-left: 46px;"><a href="/movie/actor/{{$ac->id}}">{{$ac->name}}</a> {{$ac->sex}} </p>
            @endforeach
      </div>
      <div><span class="js">标签：</span>
            @foreach ($label as $ac)
            <a href="/movie/label/{{$ac->id}}">{{$ac->name}}</a>
            @endforeach
      </div>
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

  <div class="tab-title tab mb clearfix">
    <ul>
      <li id="tab1" class="on" onClick="setTab('tab','stab',1,3)">在线播放</li>
      <li id="tab2" onClick="setTab('tab','stab',2,3)">磁链列表</li>
      <li id="tab3" onClick="setTab('tab','stab',3,3)">视频截图</li>
    </ul>
  </div>
  
  <!--/播放地址-->
  <div id="stab1" class="tab-down mb clearfix">
    <script type="text/javascript" src="/dist/DPlayer.min.js"></script>
    <div class="playfrom tab8 clearfix">
      <ul>
        <li id="tab81" onClick="setTab('tab8','stab8',1,1)"  class="on" ><i class="playerico ico-Azhan"></i> 视频播放</li>
      </ul>
    </div>
    <div id="stab81" class="playlist clearfix"  >
        <div id="dplayer"></div>
    </div>
  </div>
  <!--/播放地址结束--> 
  
  
  <!--/手机内容页-->
  <div id="stab2" class="tab-down mb clearfix" style="display:none;">
<script type="text/javascript">
  function copyUrl(url){
        var input = document.createElement('input');
        document.body.appendChild(input);
        input.setAttribute('value', url);
        input.select();
        document.execCommand("copy"); // 执行浏览器复制命令
        if (document.execCommand('copy')) {
            document.execCommand('copy');
            alert("磁链地址已复制好。");
        }
        document.body.removeChild(input);
    }
</script>
      <div class="playlist clearfix">
        @foreach ($mlink as $v)
          <div class="h1 clearfix">
            <p class="intro">{{$v['name']}} ({{$v['desc']}}) 
              @if ($v['hd']==1) 
              <font color="#f06000">[高清]</font>
              @endif
              @if ($v['subtitles']==1) 
              <font color="#f06000">[字幕]</font>
              @endif
              @if ($v['down']==1) 
              <font color="#f06000">[离线]</font>
              @endif
            </p>
            <p class="jj"><span id="vlink_1_s1"><em onClick="javascript:copyUrl('{{$v['url']}}');">复制链接</em></span></p>
          </div>
        @endforeach
      </div>
  </div>

  <div id="stab3" class="tab-down mb clearfix" style="display:none;">
    <div class="index-area clearfix">
      <ul>
        @foreach ($pic as $v)
          <li class="p1 m1"><img src="{{get_web_url($v)}}" class="mydrawing"></li>
        @endforeach
      </ul>
    </div>
  </div>


<div class="pcd_ad">
  <table width="100%" height="90" bgcolor="#33CCCC" style="background:#33CCCC">
    <tr align="center">
      <td style="text-align: center;color: #fff;line-height: 90px;background:#33CCCC">pc广告招租</td>
    </tr>
  </table>
</div>
<div class="mbd_ad">
  <table width="100%" height="90" bgcolor="#33CCCC" style="background:#33CCCC">
    <tr align="center">
      <td style="text-align: center;color: #fff;line-height: 90px;background:#33CCCC">手机广告招租</td>
    </tr>
  </table>
</div> 
  


  <div class="index-area clearfix" >
    <h4 class="title index-color">猜你喜欢</h4>
    <ul>
        @foreach ($related as $v)
        <li class="p1 m1">
            <a class="link-hover" href="/movie/show/{{$v->number}}" title="{{$v->name}}">
                <img class="lazy" data-original="{{get_web_url($v->thumb)}}" src="/skin/ecms106/images/load.gif" alt="{{$v->name}}" style="display: inline;">
                  <span class="video-bg"></span>
                  <span class="lzbz">
                      <p class="name">{{$v->name}}</p>
                      <p class="actor">{{$v->number}}</p>
                      <p class="actor">{{$v->category}}</p>
                      <p class="actor">{{ intval((int)$v->publish_time/60) }}分钟</p>
                  </span>
                <p class="other"></p>
            </a> 
        </li>
      @endforeach
    </ul>
  </div>
<script type="text/javascript">
  $(function(){
    $('.mydrawing').click(function(){
      //查看大图
      $(this).after("<div class='wrapper'></div>");
      var imgSrc = $(this).attr('src');
      $(".wrapper").css("background-image", "url(" + imgSrc + ")");
      $('.wrapper').fadeIn(1000);
      //关闭并移除图层
      $('.wrapper').click(function(){
        $('.wrapper').fadeOut(1000).remove();
      });
    });
  });

  const dp = new DPlayer({
      container: document.getElementById('dplayer'),
      video: {
          url: '{{$info['video']}}',
      },
  });
</script>
@endsection