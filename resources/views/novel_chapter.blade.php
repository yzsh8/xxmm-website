@extends('layout') @section('content')

<link href="/skin/ecms106/css/novel.css" rel="stylesheet">
<div class="main">
  <h1 class="title"><a href="/">{{ trans('menu.home')}}</a>&nbsp;>&nbsp;<a href="/novel/">{{ trans('menu.novel')}}</a>&nbsp;>&nbsp; <a href="/novel/category/{{$cid}}">{{$category}}</a>&nbsp;>&nbsp;<a href="/novel/book/{{$bid}}">{{$bookname}}</a></h1>
  <div class="ct mb clearfix">
    
    <div style="text-align:center;" class="title"><h1>{{$info->name}}</h1></div>

    <div class="content_btn ptm-clearfix">
      @if ($left>0)
      <div class="ptm-col-xs-3">
      <a class="ptm-btn ptm-btn-primary ptm-btn-block ptm-btn-outlined" href="/novel/book/chapter/{{$left}}">{{ trans('menu.previous')}}</a>
      </div>
      @endif
      <div class="ptm-col-xs-6">
      <a class="ptm-btn ptm-btn-primary ptm-btn-block ptm-btn-outlined" href="/novel/book/{{$bid}}">{{ trans('novel.catalogue')}}</a>
      </div>
      @if ($right>0)
      <div class="ptm-col-xs-3">
      <a class="ptm-btn ptm-btn-primary ptm-btn-block ptm-btn-outlined" href="/novel/book/chapter/{{$right}}">{{ trans('menu.next')}}</a>
      </div>
      @endif
    </div>
  
  </div>

  <div class="chaptercontent" id="BookText" style="font-size: 16px;">
    {!!$info->content!!}
  </div>

<div class="content_btn ptm-clearfix">
  @if ($left>0)
  <div class="ptm-col-xs-3">
    <a class="ptm-btn ptm-btn-primary ptm-btn-block ptm-btn-outlined" href="/novel/book/chapter/{{$left}}">{{ trans('menu.previous')}}</a> 
  </div>
  @endif
  <div class="ptm-col-xs-6">
  <a class="ptm-btn ptm-btn-primary ptm-btn-block ptm-btn-outlined" href="/novel/book/{{$bid}}">{{ trans('novel.catalogue')}}</a>
  </div>
  @if ($right>0)
  <div class="ptm-col-xs-3">
    <a class="ptm-btn ptm-btn-primary ptm-btn-block ptm-btn-outlined" href="/novel/book/chapter/{{$right}}">{{ trans('menu.next')}}</a> 
  </div>
  @endif
</div>

@endsection
