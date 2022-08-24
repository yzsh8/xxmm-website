@extends('layout') @section('content')

<link href="/skin/ecms106/css/novel.css" rel="stylesheet">
<div class="main">
  <h1 class="title"><a href="/">{{ trans('menu.home')}}</a>&nbsp;>&nbsp;<a href="/novel/">{{ trans('menu.novel')}}</a>&nbsp;>&nbsp; <a href="/novel/category/{{$cid}}">{{$category}}</a>&nbsp;>&nbsp;<a href="/novel/book/{{$bid}}">{{$bookname}}</a></h1>
  <div class="ct mb clearfix">
    
    <div style="text-align:center;" class="title"><h1>{{$info->name}}</h1></div>

    <div class="content_btn ptm-clearfix">
      <div class="ptm-col-xs-3">
      <a class="ptm-btn ptm-btn-primary ptm-btn-block ptm-btn-outlined" href="/novel/book/chapter/{{$left}}">{{ trans('novel.previous')}}</a>
      </div>
      <div class="ptm-col-xs-6">
      <a class="ptm-btn ptm-btn-primary ptm-btn-block ptm-btn-outlined" href="/novel/book/{{$bid}}">{{ trans('novel.catalogue')}}</a>
      </div>
      @if ($right>0)
      <div class="ptm-col-xs-3">
      <a class="ptm-btn ptm-btn-primary ptm-btn-block ptm-btn-outlined" href="/novel/book/chapter/{{$right}}">{{ trans('novel.next')}}</a>
      </div>
      @endif
    </div>

    @if(@ads)
    <div class="pcd_ad" style="margin-top: 10px;">
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

    <div class="mbd_ad" style="margin-top: 10px;">
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

  <div class="chaptercontent" id="BookText" style="font-size: 16px;">
    {!!$info->content!!}
  </div>

  <div class="main">
    @if(@ads)
    <div class="pcd_ad" style="margin-top: 10px;">
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

    <div class="mbd_ad" style="margin-top: 10px;">
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

<div class="content_btn ptm-clearfix">
  <div class="ptm-col-xs-3">
    <a class="ptm-btn ptm-btn-primary ptm-btn-block ptm-btn-outlined" href="/novel/book/chapter/{{$left}}">{{ trans('novel.previous')}}</a>
  </div>
  <div class="ptm-col-xs-6">
  <a class="ptm-btn ptm-btn-primary ptm-btn-block ptm-btn-outlined" href="/novel/book/{{$bid}}">{{ trans('novel.catalogue')}}</a>
  </div>
  @if ($right>0)
  <div class="ptm-col-xs-3">
    <a class="ptm-btn ptm-btn-primary ptm-btn-block ptm-btn-outlined" href="/novel/book/chapter/{{$right}}">{{ trans('novel.next')}}</a> 
  </div>
  @endif
</div>

@endsection
