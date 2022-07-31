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
                <span>{{ trans('movie.number') }}：{{$v->number}}</span>
              </div>
              <ul class="channel-silder-info">
                  <li class="long"><label>{{ trans('movie.actor')}}：</label>
                    <span>
                      @isset($v->actor)
                      @foreach ($v->actor as $ac)
                      <a href="/movie/actor/{{$ac->id}}">{{$ac->name}}</a>
                      @endforeach
                      @endisset
                    </span>
                  </li>
                  <li>{{ trans('movie.category') }}：<span>{{$v->category}}</span></li>
                  <li>{{ trans('movie.director') }}：<span>{{$v->director}}</span></li>
                  <li>{{ trans('movie.serie')}}：<span>{{$v->series}}</span></li>
                  <li>{{ trans('movie.footage')}}：<span>{{ intval((int)$v->publish_time/60) }}{{ trans('movie.minute')}}</span></li>
                  <li>{{ trans('movie.film')}}：<span>{{$v->film}}</span></li>
                  <li>{{ trans('movie.issued')}}：<span>{{$v->issued}}</span></li>
                  <li>{{ trans('movie.release')}}：<span>{{$v->publish_time}}</span></li>
                  <li>{{ trans('movie.updated')}}：<span>{{ date("Y-m-d H:i",strtotime($v->updated_at)) }}</span></li>
              </ul>
              <p class="channel-silder-desc">{{ trans('movie.label')}}：
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
          <li><a target="_blank" href="/movie/show/{{$v->number}}" ><img class="lazy" data-original="{{get_web_url($v->thumb)}}" src="/skin/ecms106/images/load.gif" alt="{{$v->name}}"></a></li>
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
      <h3 class="title index-color clearfix"> <span class="hitkey"></span>{{ trans('movie.news')}}:</h3>
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
                    <p class="actor">{{ intval((int)$v->publish_time/60) }}{{ trans('movie.minute')}}</p>
                </span>
              </a> 
          </li>
        @endforeach
      </ul>
    </div>
    <div class="index-tj-r">
      <h3 class="title index-color">{{ trans('movie.hots')}}</h3>
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

<div class="pcd_ad">
  @if (app()->getLocale()=='en')
    <img src="/images/ads-home-en.gif" width="100%" />
  @else
    <img src="/images/ads-home-cn.gif" width="100%" />
  @endif
</div>

<div class="mbd_ad">
  @if (app()->getLocale()=='en')
    <img src="/images/ads-mobil-en.gif" width="100%" width="100%" />
  @else
    <img src="/images/ads-mobil-cn.gif" width="100%" width="100%" />
  @endif
</div>


<div class="index-area clearfix">
    <h1 class="title index-color">
          <span class="hitkey kp">
          @foreach ($mc as $v)
            <li><a href="/movie/category/{{$v['id']}}" alt="{{$v['name']}}">{{$v['name']}}</a></li>
          @endforeach
            <a href="/movie">{{ trans('website.more')}}»</a> 
          </span>
          <a href="/movie">{{ trans('menu.movie')}}</a>
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
                      <p class="actor">{{ intval((int)$v->publish_time/60) }}{{ trans('movie.minute')}}</p>
                  </span>
                <p class="other"></p>
            </a> 
        </li>
      @endforeach
    </ul>
</div>


<div class="pcd_ad">
  @if (app()->getLocale()=='en')
    <img src="/images/ads-home-en.gif" width="100%" />
  @else
    <img src="/images/ads-home-cn.gif" width="100%" />
  @endif
</div>

<div class="mbd_ad">
  @if (app()->getLocale()=='en')
    <img src="/images/ads-mobil-en.gif" width="100%" />
  @else
    <img src="/images/ads-mobil-cn.gif" width="100%" />
  @endif
</div>    

<div class="index-area clearfix">
    <h1 class="title index-color"><span class="hitkey kp"><a href="/novel">{{ trans('website.more')}}»</a></span> <a href="/novel">{{ trans('menu.novel')}}</a></h1>
    <ul>
      @foreach ($novelbook as $v)
        <li class="p1 m1">
            <a class="link-hover" href="/novel/book/{{$v->id}}" title="{{$v->name}}">
                <img class="lazy" data-original="{{get_web_url($v->pic)}}" src="/skin/ecms106/images/logo.jpeg" alt="{{$v->name}}">
                <span class="book-bg"></span>
                <span class="lzbz">
                    <p class="name">{{$v->name}}</p>
                    <p class="actor">{{ trans('novel.category')}}：{{$v->category}}</p>
                    <p class="actor">{{ trans('novel.status')}}：{{$v->speed}}</p>
                    <p class="actor">{{ trans('novel.author')}}：{{$v->author}}</p>
                </span>
                <p class="other"><i>{{$v->chapter_num}}{{ trans('novel.chapter')}}</i></p>
            </a> 
        </li>
      @endforeach
    </ul>
  </div>

@endsection