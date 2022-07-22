@extends('layout') @section('content')

<link href="/skin/ecms106/css/pl.css" rel="stylesheet">

<div class="main">
  <h1 class="title"><a href="/">首页</a>&nbsp;>&nbsp;意见反馈&nbsp;>&nbsp; </h1>
</div>

<div class="main">
	<div class="ct mb clearfix">
		<div style="text-align:center;"><h1>意见反馈</h1></div>

		<div class="comment">
				<div class="showpage" align="center">
				<form action="/feedback/save" method="post" onsubmit="return checkinput();">
				<table width="60%" border="0" cellpadding="0" cellspacing="0" style="width:60%;">
				<tbody>
					<tr>
						<td style="text-align:right;">主题：</td>
						<td><input name="name" type="text" id="name" value="" placeholder="请输入需要表达的主题!">*</td>
					</tr>
					<tr>
						<td style="text-align:right;">番号：</td>
						<td><input name="number" type="text" id="number" value="" placeholder="请输入影片番号!"></td>
					</tr>
					<tr>
						<td style="text-align:right;">联系方式：</td>
						<td><input name="contact" type="text" id="contact" value="" placeholder="请输入联系方式!">*</td>
					</tr>
					<tr>
						<td style="text-align:right;">内容：</td>
						<td><textarea name="desc" rows="6" id="desc" placeholder="请遵守互联网相关规定，不要发布广告和违法内容!"></textarea></td>
					</tr>
					<tr>
						<td>{{ csrf_field() }}</td>
						<td>
							<input name="sumbit" type="submit" value="提交" tabindex="6" style="border-radius: 5px;font-size: 16px;background: #e94c3d none repeat scroll 0% 0%;border: 0px none;margin: 0px 16px;padding: 1px 16px;height: 33px;line-height: 30px;color: rgb(255, 255, 255);opacity: 0.95;"></td>
					</tr>
				</tbody>
				</table>
				</form>
				</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	function checkinput(){
			if(document.getElementById('name').value==''){
					alert('请输入需要你表达的主题');
					return false;
			}
			if(document.getElementById('contact').value==''){
					alert('请输入联系方式');
					return false;
			}
			return true;
	}
</script>

@endsection