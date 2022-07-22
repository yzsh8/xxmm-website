@extends('layout') @section('content')

<div class="main"> 
<div class="pcd_ad"><table width="100%" height="90" bgcolor="#33CCCC" style="background:#33CCCC">
    <tr align="center">
      <td style="text-align: center;color: #fff;line-height: 90px;background:#33CCCC">pc广告位招租一</td>
    </tr>
  </table></div>
<div class="mbd_ad"><table width="100%" height="90" bgcolor="#33CCCC" style="background:#33CCCC">
    <tr align="center">
      <td style="text-align: center;color: #fff;line-height: 90px;background:#33CCCC">手机广告位招租一</td>
    </tr>
  </table></div> 
</div>
<div class="main">
  <div class="sy-jg mb">
    <p class="jg"> <a href="/">首页</a>
      &nbsp;>&nbsp;<a href="/novel">小说</a>
      @if($category)
      &nbsp;>&nbsp;<a href="/novel/category/{{$cid}}/">{{$category}}</a>
      @endif
    </p>
    <p class="px"> <a class="time on" href="/novel/category/{{$cid}}?sort=new"><em></em>最新</a> <a class="rq" href="/novel/category/{{$cid}}?sort=click"><em></em>人气</a></p>
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
          console.log('当前页:' + now);
       }
    });
</script>
@endsection