@extends('layout') @section('content')

<div class="channel-focus">
  <div class="channel-silder layout">
    <ul class="channel-silder-cnt">
      @foreach ($banner as $v)
        <li class="channel-silder-panel">
            <a class="channel-silder-img" target="_blank" href="/movie/show/{{$v->number}}"><img src="{{get_web_url($v->avatar)}}"  title="{{$v->name}}" width="400"/></a>
            <div class="channel-silder-intro">
              <div class="channel-silder-title">
                <h2><a target="_blank" href="/movie/show/{{$v->number}}" title="{{$v->name}}">{{$v->name}}</a></h2>
                <span>番号：{{$v->number}}</span>
              </div>
              <ul class="channel-silder-info">
                  <li class="long"><label>主演：</label>
                    <span>
                      @isset($v->actor)
                      @foreach ($v->actor as $ac)
                      <a href="/movie/actor/{{$ac->id}}">{{$ac->name}}</a>
                      @endforeach
                      @endisset
                    </span>
                  </li>
                  <li>分类：<span>{{$v->category}}</span></li>
                  <li>导演：<span>{{$v->director}}</span></li>
                  <li>系列：<span>{{$v->series}}</span></li>
                  <li>片长：<span>{{ intval((int)$v->publish_time/60) }}分钟</span></li>
                  <li>片商：<span>{{$v->film}}</span></li>
                  <li>发行商：<span>{{$v->issued}}</span></li>
                  <li>年份：<span>{{$v->publish_time}}</span></li>
                  <li>时间：<span>{{ date("Y-m-d H:i",strtotime($v->updated_at)) }}</span></li>
              </ul>
              <p class="channel-silder-desc"> 标签：
                <span>
                    @isset($v->label)
                    @foreach ($v->label as $ac)
                    <a href="/movie/label/{{$ac->id}}">{{$ac->name}}</a>
                    @endforeach
                    @endisset
                </span>
              </p>
            </div>
        </li>
        @endforeach
    </ul>
    <ul class="channel-silder-nav">
      @foreach ($banner as $v)
          <li><a target="_blank" href="/dy/aqp/1100.html" ><img class="lazy" data-original="{{get_web_url($v->thumb)}}" src="/skin/ecms106/images/load.gif" alt="{{$v->name}}"></a></li>
      @endforeach
    </ul>
  </div>
</div>
<script type="text/javascript">
  jQuery(".channel-silder").slide({ 
    titCell:".channel-silder-nav li",
    mainCell:".channel-silder-cnt",
    delayTime:800,
    triggerTime:0,
    interTime:5000,
    pnLoop:false,
    autoPage:false,
    autoPlay:true
  });
</script>

<div class="main"> 
  <!--首页推荐-->
  <div class="index-tj clearfix">
    <div class="index-tj-l">
      <h3 class="title index-color clearfix"> <span class="hitkey"></span>最新片源:</h3>
      <ul>
        @foreach ($links as $v)
          <li class="p2 m1 ">
              <a class="link-hover" href="/movie/show/{{$v->number}}" title="{{$v->name}}">
                <img class="lazy" data-original="{{get_web_url($v->thumb)}}" src="/skin/ecms106/images/load.gif" alt="{{$v->name}}">
                <span class="video-bg"></span>
                <span class="lzbz">
                    <p class="name">{{$v->name}}</p>
                    <p class="actor">{{$v->number}}</p>
                    <p class="actor">{{$v->category}}</p>
                    <p class="actor">{{ intval((int)$v->publish_time/60) }}分钟</p>
                </span>
              </a> 
          </li>
        @endforeach
      </ul>
    </div>
    <div class="index-tj-r">
      <h3 class="title index-color">点击排行榜</h3>
      <ul>
        @foreach ($maxview as $k=>$v)
          <li><a href="/movie/show/{{$v->number}}" title="{{$v->name}}">
              <gm class="gs">{{$k+1}}</gm>
              <span class="az">{{$v->name}}</span></a>
          </li>
        @endforeach
      </ul>
    </div>
  </div>
<div class="pcd_ad"><table width="100%" height="90" bgcolor="#33CCCC" style="background:#33CCCC">
    <tr align="center">
      <td style="text-align: center;color: #fff;line-height: 90px;background:#33CCCC">pc-广告位招租</td>
    </tr>
  </table></div>

<div class="mbd_ad"><table width="100%" height="90" bgcolor="#33CCCC" style="background:#33CCCC">
    <tr align="center">
      <td style="text-align: center;color: #fff;line-height: 90px;background:#33CCCC">手机广告位招租</td>
    </tr>
  </table>
</div> 


<div class="index-area clearfix">
    <h1 class="title index-color">
          <span class="hitkey kp">
          @foreach ($mc as $v)
            <li><a href="/movie/category/{{$v['id']}}" alt="{{$v['name']}}">{{$v['name']}}</a></li>
          @endforeach
            <a href="/movie">更多»</a> 
          </span>
          <a href="/movie">影片</a>
    </h1>
    <ul>
      @foreach ($ml as $v)
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


<div class="pcd_ad"><table width="100%" height="90" bgcolor="#33CCCC" style="background:#33CCCC">
    <tr align="center">
      <td style="text-align: center;color: #fff;line-height: 90px;background:#33CCCC">pc-广告位招租</td>
    </tr>
  </table></div>

<div class="mbd_ad"><table width="100%" height="90" bgcolor="#33CCCC" style="background:#33CCCC">
    <tr align="center">
      <td style="text-align: center;color: #fff;line-height: 90px;background:#33CCCC">手机广告位招租</td>
    </tr>
  </table>
</div>     

<div class="index-area clearfix">
    <h1 class="title index-color"><span class="hitkey kp"><a href="/novel">更多»</a></span> <a href="/novel">成人小说</a></h1>
    <ul>
      @foreach ($novelbook as $v)
        <li class="p1 m1">
            <a class="link-hover" href="/novel/book/{{$v->id}}" title="{{$v->name}}">
                <img class="lazy" data-original="{{get_web_url($v->pic)}}" src="/skin/ecms106/images/logo.jpeg" alt="{{$v->name}}">
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