<div class="pull-right">
    @if ($paginator->hasPages())
    <div class="layui-box layui-laypage layui-laypage-page">
        <span class="layui-laypage-count">共 {{ $paginator->total() }} 条</span>
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <a href="javascript:;" class="layui-laypage-prev layui-disabled">上一页</a>
        @else
            <a href="javascript:;" class="layui-laypage-prev" lay-page="{{ $paginator->currentPage()-1 }}">上一页</a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
            <span >{{ $element }}</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                    <span class="layui-laypage-curr"><em>{{ $page }}</em></span>
                    @else
                       <a href="javascript:;" lay-page="{{ $page }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="javascript:;" class="layui-laypage-next" rel="next" lay-page="{{ $paginator->currentPage()+1 }}">下一页</a>
        @else
            <a href="javascript:;" class="layui-laypage-next layui-disabled">下一页</a>
        @endif
        <span class="layui-laypage-limits">
            @php $limit=$paginator->perPage(); @endphp
            <select lay-ignore="">
                <option value="10" @if($limit==10)selected="selected"@endif>10 条/页</option>
                <option value="15" @if($limit==15)selected="selected"@endif>15 条/页</option>
                <option value="20" @if($limit==20)selected="selected"@endif>20 条/页</option>
                <option value="50" @if($limit==50)selected="selected"@endif>50 条/页</option>
                <option value="100" @if($limit==50)selected="selected"@endif>100 条/页</option>
            </select>
        </span>
        <span class="layui-laypage-skip">到第 <input type="number" min="1" max="{{  $paginator->lastPage() }}" value="1" class="layui-input">页 <button type="button" class="layui-laypage-btn" style="color:#333;">确定</button> </span>
    </div>
    @endif
</div>
<script type="text/javascript">
$(document).ready(function(){
    //表格初始化
    $.fn.getList = function(callback, resetPage) {
        var that = this;
        var url = that.data('url') || window.location.href;
        var param = that.find('form').serialize();
        var page = that.data('page') || 1;
        var limit = 20;
        if (resetPage) {
            page = 1;
        }
        param = 'limit=' + limit + '&page=' + page + '&' + param;
        $.ajax({
                url: url,
                type: 'POST',
                dataType: 'html',
                data: param,
            })
            .done(function(html) {
                that.find('.data').empty().html(html);
                form.render();
                that.data('page', page);
            })
            .fail(function(xhr) {
                console.log(xhr.responseText);
                that.find('.data').empty().html('<p><i class="fa fa-warning"></i> 服务器异常，请稍后再试~</p>');
            })
            .always(function() {
                if (typeof callback === 'function') {
                    callback();
                }
            });
    };

    if ($('.data-list').length) {
        $('.data-list').getList(null, true);
    }
    //分页
    $('.layui-laypage-page>a').click(function() {
        var page = $(this).attr('lay-page');
        $(this).closest('.data-list').data('page', page).getList();
        return false;
    });
    //分页跳转
    $('.layui-laypage-page .layui-laypage-btn').click(function() {
        var input = $(this).prev('input');
        var page = input.val();
        if (!page) {
            layer.msg('请输入页码');
            return false;
        }
        if (parseInt(page) > parseInt(input.attr('max')) || parseInt(page) < parseInt(input.attr('min'))) {
            layer.msg('页码范围为' + input.attr('min') + '~' + input.attr('max'));
            return false;
        }
        $(this).closest('.data-list').data('page', page).getList();
        return false;
    });
    //分页数量
    $('.layui-laypage-page>.layui-laypage-limits select').change(function() {
        var limit = $(this).val() || 20;
        layui.data('leacmf', {
            key: 'limit',
            value: limit
        });
        $(this).closest('.data-list').data('limit', limit).getList();
        return;
    });
});
</script>
