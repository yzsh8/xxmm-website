@extends('layout') @section('content')

<div class="main">
  <h1 class="title"><a href="/">首页</a>&nbsp;>&nbsp;{{$info->name}}&nbsp;>&nbsp; </h1>
  <div style="text-align:center;"><h1>{{$info->name}}</h1></div>
  <div class="ct mb clearfix">

    <div class="m-cont" style="margin-top:20px;">
      {!!$info->content!!}
    </div>

  </div>
</div>
  
@endsection