@extends('layout') @section('content')

<div class="main"> 

@if(@ads)
<div class="pcd_ad" style="margin-bottom: 10px;">
  @if (app()->getLocale()=='en')
    @if(isset($ads['en']))
    <a href="{{$ads['en']['url']}}" target="_blank"><img src="{{$ads['en']['pic']}}" width="100%" /></a>
    @endif
  @else
    @if(isset($ads['cn']))
    <a href="{{$ads['cn']['url']}}" target="_blank"><img src="{{$ads['cn']['pic']}}" width="100%" /></a>
    @endif
  @endif
</div>

<div class="mbd_ad">
  @if (app()->getLocale()=='en')
    @if(isset($ads['en']))
    <a href="{{$ads['en']['url']}}"><img src="{{$ads['en']['m_pic']}}" width="100%" width="100%" /></a>
    @endif
  @else
    @if(isset($ads['cn']))
    <a href="{{$ads['cn']['url']}}"><img src="{{$ads['cn']['m_pic']}}" width="100%" width="100%" /></a>
    @endif
  @endif
</div>
@endif

</div>
<div class="main">
  <div class="sy-jg mb">
    <p class="jg"> <a href="/">{{ trans('menu.home')}}</a>
      &nbsp;>&nbsp;<a href="/novel">{{ trans('menu.novel')}}</a>
      @if($category)
      &nbsp;>&nbsp;<a href="/novel/category/{{$cid}}/">{{$category}}</a>
      @endif
    </p>
    <p class="px"> <a class="time on" href="/novel/category/{{$cid}}?sort=new"><em></em>{{ trans('novel.sort-new')}}</a> <a class="rq" href="/novel/category/{{$cid}}?sort=click"><em></em>{{ trans('novel.sort-view')}}</a></p>
  </div>
  <div class="index-area clearfix">
    <ul>
      @foreach ($ml as $v)
        <li class="p1 m1">
          <a class="link-hover" href="/novel/book/{{$v->id}}" title="{{$v->name}}">
              <img class="lazy" data-original="{{get_web_url($v->pic)}}" src="/skin/ecms106/images/load.gif" alt="{{$v->name}}">
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
          window.location.href="/novel/category/{{$cid}}/?sort={{$sort}}&page="+now; 
          //console.log('当前页:' + now);
       }
    });
</script>
@endsection