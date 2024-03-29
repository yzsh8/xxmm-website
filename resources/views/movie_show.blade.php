@extends('layout') @section('content')
<link rel="stylesheet" href="https://g.alicdn.com/de/prismplayer/2.9.23/skins/default/aliplayer-min.css" />
<script charset="utf-8" type="text/javascript" src="https://g.alicdn.com/de/prismplayer/2.9.23/aliplayer-min.js"></script>
<!--[if lte IE 8]>
    <script charset="utf-8" type="text/javascript" src="https://g.alicdn.com/de/prismplayer/2.9.23/json/json.min.js"></script>
<![endif]-->
<script type="text/javascript" charset="utf-8" src="/aliyun/aliplayercomponents-1.0.8.min.js"></script>

<div class="main">
  <h1 class="title"><a href="/">{{ trans('menu.home')}}</a>&nbsp;>&nbsp;<a href="/movie/">{{ trans('menu.movie')}}</a>&nbsp;>&nbsp;<a href="/movie/{{$cid}}/">{{$category}}</a>&nbsp;&nbsp;&raquo;&nbsp;&nbsp;<a href="/movie/show/{{$info['number']}}">{{$info['name']}}</a> </h1>
  <div class="ct mb clearfix">
    <div class="ct-l"> <img class="lazy" data-original="{{get_web_url($info->avatar)}}" src="/skin/ecms106/images/load.gif" alt="{{$info['name']}}"> </div>
    <div class="ct-c">
      <dl>
        <dt class="name">{{$info['name']}}</dt>
        <dt><span>{{ trans('movie.number')}}：</span>{{$info['number']}}</dt>
        <dt><span>{{ trans('movie.series')}}：</span>{{$info['series']}} </dt>
        <dt><span>{{ trans('movie.film')}}：</span>{{$info['film']}} </dt>
        <dt><span>{{ trans('movie.issued')}}：</span>{{$info['issued']}} </dt>
        <dt><span>{{ trans('movie.director')}}：</span>{{$info['director']}}</dt>
        <dt><span>{{ trans('movie.release')}}：</span>{{$info['publish_time']}}</dt>
        <dt><span>{{ trans('movie.footage')}}：</span>{{intval($info['duration']/3600)}}{{ trans('movie.minute')}}</dt>
        <dt><span>{{ trans('movie.score')}}：</span>{{$info['score']}}</dt>
        <dt><span>{{ trans('movie.view')}}：</span>{{$info['view_num']}}</dt>
      </dl>
      <div><span class="js">{{ trans('movie.actor')}}：</span>
            @foreach ($actor as $ac)
            <p style="padding-left: 46px;"><a href="/movie/actor/{{$ac->id}}">{{$ac->name}}</a> {{$ac->sex}} </p>
            @endforeach
      </div>
      <div><span class="js">{{ trans('movie.label')}}：</span>
            @foreach ($label as $ac)
            <a href="/movie/label/{{$ac->id}}">{{$ac->name}}</a>
            @endforeach
      </div>
    </div>
  </div>

@if(@adstop)
<div class="pcd_ad" style="margin-bottom: 10px;">
  @if (app()->getLocale()=='en')
    @if(isset($adstop['en']))
    <a href="{{$adstop['en']['url']}}" target="_blank"><img src="{{$adstop['en']['pic']}}" width="100%" /></a>
    @endif
  @else
    @if(isset($adstop['cn']))
    <a href="{{$adstop['cn']['url']}}" target="_blank"><img src="{{$adstop['cn']['pic']}}" width="100%" /></a>
    @endif
  @endif
</div>

<div class="mbd_ad">
  @if (app()->getLocale()=='en')
    @if(isset($adstop['en']))
    <a href="{{$adstop['en']['url']}}"><img src="{{$adstop['en']['m_pic']}}" width="100%" width="100%" /></a>
    @endif
  @else
    @if(isset($adstop['cn']))
    <a href="{{$adstop['cn']['url']}}"><img src="{{$adstop['cn']['m_pic']}}" width="100%" width="100%" /></a>
    @endif
  @endif
</div>
@endif

  <div class="tab-title tab mb clearfix">
    <ul>
      <li id="tab1" class="on" onClick="setTab('tab','stab',1,3)">{{ trans('movie.online')}}</li>
      <li id="tab2" onClick="setTab('tab','stab',2,3)">{{ trans('movie.dlink')}}</li>
      <li id="tab3" onClick="setTab('tab','stab',3,3)">{{ trans('movie.pics')}}</li>
    </ul>
  </div>
  
  <!--/播放地址-->
  <div id="stab1" class="tab-down mb clearfix">
    <div class="playfrom tab8 clearfix">
      <ul>
        <li id="tab81" onClick="setTab('tab8','stab8',1,1)"  class="on" ><i class="playerico ico-Azhan"></i> {{ trans('movie.play')}}</li>
      </ul>
    </div>
    <div id="stab81" class="playlist clearfix"  >
        <div id="player-con"></div>
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
              <font color="#f06000">[{{ trans('movie.hd')}}]</font>
              @endif
              @if ($v['subtitles']==1) 
              <font color="#f06000">[{{ trans('movie.subtitle')}}]</font>
              @endif
              @if ($v['down']==1) 
              <font color="#f06000">[{{ trans('movie.down')}}]</font>
              @endif
            </p>
            <p class="jj"><span id="vlink_1_s1"><em onClick="javascript:copyUrl('{{$v['url']}}');">{{ trans('movie.copy')}}</em></span></p>
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

@if(@adsfoot)
<div class="pcd_ad" style="margin-bottom: 10px;">
  @if (app()->getLocale()=='en')
    @if(isset($adsfoot['en']))
    <a href="{{$adsfoot['en']['url']}}" target="_blank"><img src="{{$adsfoot['en']['pic']}}" width="100%" /></a>
    @endif
  @else
    @if(isset($adsfoot['cn']))
    <a href="{{$adsfoot['cn']['url']}}" target="_blank"><img src="{{$adsfoot['cn']['pic']}}" width="100%" /></a>
    @endif
  @endif
</div>

<div class="mbd_ad">
  @if (app()->getLocale()=='en')
    @if(isset($adsfoot['en']))
    <a href="{{$adsfoot['en']['url']}}"><img src="{{$adsfoot['en']['m_pic']}}" width="100%" width="100%" /></a>
    @endif
  @else
    @if(isset($adsfoot['cn']))
    <a href="{{$adsfoot['cn']['url']}}"><img src="{{$adsfoot['cn']['m_pic']}}" width="100%" width="100%" /></a>
    @endif
  @endif
</div>
@endif

  <div class="index-area clearfix" >
    <h4 class="title index-color">{{ trans('movie.youlike')}}</h4>
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
                      <p class="actor">{{ intval((int)$v->publish_time/3600) }}{{ trans('movie.minute')}}</p>
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

  var videoWidth = document.getElementById('player-con').clientWidth;
  var videoHeight = document.getElementById('player-con').scrollHeight  ;

  var danmukuList = [{
          "mode":17,
          "stime":2000,
          "text": "WWW.138.MG\n太阳城贵宾会",
          "size":30,
          "x":videoWidth - 250,
          "y":500 - 140,
          "align":1,
          "dur":4000*3600,
          "color":0xD8C302,
          "img":"/images/shuiyin.png"
      }];

  var player = new Aliplayer({
    id: "player-con",
    cover: '{{get_web_url($info->avatar)}}',
    source: "{{get_video_url($info['video'])}}",
    width: "100%",
    height: "500px",
    autoplay: false,
    isLive: false,
    components: [{
      name: 'StartADComponent',  //开播广告
      type: AliPlayerComponent.StartADComponent,
      args: ['/images/ads-player.png', 'https://www.138.mg/', 5]
    }, {
      name: 'PauseADComponent',  //暂停广告
      type: AliPlayerComponent.PauseADComponent,
      args: ['/images/ads-player.png', 'https://www.138.mg/']
    },{
      name: 'BulletScreenComponent',  //跑马灯
      type: AliPlayerComponent.BulletScreenComponent,
      args: ['{{$v_cn}}\n \n {{$v_en}}', {fontSize: '20px', color: '#F5C400'}, 'top']
    },{
      name: 'RateComponent',  //播放倍数
      type: AliPlayerComponent.RateComponent
    },{
      name: 'RotateMirrorComponent',  //  旋转镜像
      type: AliPlayerComponent.RotateMirrorComponent
    },{
      name: 'AliplayerDanmuComponent', // 弹幕组件
      type: AliPlayerComponent.AliplayerDanmuComponent,
      args: [danmukuList] //列表：注意需要外层的[ ]
    }

    ]
  }, function (player) {
      console.log("The player is created");

      var danmu = player.getComponent('AliplayerDanmuComponent');

      @foreach ($notice as $v)
danmu.insert({
          "mode":1,   //测试模式只有1，4好用
          "text":"{{$v['name']}}",
          "stime":{{$v['stime']}}*1000,
          "size":{{$v['size']}},
          "dur":{{$v['dur']}}*1000,
          "color":0x{{colorToCode($v['color'])}}
      });
      @endforeach      
  });
</script>
@endsection