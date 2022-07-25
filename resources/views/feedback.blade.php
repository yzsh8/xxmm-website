@extends('layout') @section('content')

<link href="/skin/ecms106/css/pl.css" rel="stylesheet">

<div class="main">
  <h1 class="title"><a href="/">{{ trans('menu.home')}}</a>&nbsp;>&nbsp;{{ trans('menu.feedback')}}&nbsp;>&nbsp; </h1>
</div>

<div class="main">
	<div class="ct mb clearfix">
		<div style="text-align:center;"><h1>{{ trans('menu.feedback')}}</h1></div>

		<div class="comment">
				<div class="showpage" align="center">
				<form action="/feedback/save" method="post" onsubmit="return checkinput();">
				<table width="60%" border="0" cellpadding="0" cellspacing="0" style="width:60%;">
				<tbody>
					<tr>
						<td style="text-align:right;">{{ trans('feedback.title')}}：</td>
						<td><input name="name" type="text" id="name" value="" placeholder="{{ trans('feedback.title_placeholder')}}">*</td>
					</tr>
					<tr>
						<td style="text-align:right;">{{ trans('feedback.number')}}：</td>
						<td><input name="number" type="text" id="number" value="" placeholder="{{ trans('feedback.number_placeholder')}}"></td>
					</tr>
					<tr>
						<td style="text-align:right;">{{ trans('feedback.contact')}}：</td>
						<td><input name="contact" type="text" id="contact" value="" placeholder="{{ trans('feedback.contact_placeholder')}}">*</td>
					</tr>
					<tr>
						<td style="text-align:right;">{{ trans('feedback.content')}}：</td>
						<td><textarea name="desc" rows="6" id="desc" placeholder="{{ trans('feedback.content_placeholder')}}"></textarea></td>
					</tr>
					<tr>
						<td>{{ csrf_field() }}</td>
						<td>
							<input name="sumbit" type="submit" value="{{ trans('feedback.submit')}}" tabindex="6" style="border-radius: 5px;font-size: 16px;background: #e94c3d none repeat scroll 0% 0%;border: 0px none;margin: 0px 16px;padding: 1px 16px;height: 33px;line-height: 30px;color: rgb(255, 255, 255);opacity: 0.95;"></td>
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
					alert('{{ trans('feedback.title_placeholder')}}');
					return false;
			}
			if(document.getElementById('contact').value==''){
					alert('{{ trans('feedback.contact_placeholder')}}');
					return false;
			}
			return true;
	}
</script>

@endsection