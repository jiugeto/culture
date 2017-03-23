{{--这里放的是分页信息模板
    这里需要2个参数：
        $datas数据，
        $prefix_url分页url字符串
--}}


<style>
    .p_out { width:100%;text-align:center;color:grey; }
    .p_out a { padding:2px 10px;border:1px solid lightgrey;color:grey;text-decoration:none;cursor:pointer; }
    .p_out a:hover,.p_out a:hover.curr { border:1px solid red;color:red; }
    .p_out input { padding:2px 5px;width:15px;height:20px;border:1px solid lightgrey;text-align:center;color:grey;font-size:18px;position:relative;top:-1px; }
    .p_out p { margin-top:10px;border:0;background:0;position:relative;top:-10px; }
</style>
<div class="p_out">
    <a href="{{ $prefix_url }}">首页</a>
    <a href="{{ $pagelist['previousPageUrl'] }}">上一页</a>
    <a href="{{ $prefix_url }}?page={{ $pagelist['currentPage'] }}">{{ $pagelist['currentPage'] }}</a>
    @if($pagelist['lastPage']>$pagelist['currentPage'])
        @if(ceil($pagelist['total']/$pagelist['limit'])>$pagelist['currentPage'])
            <a href="{{ $prefix_url }}?page={{ $pagelist['currentPage']+1 }}">{{ $pagelist['currentPage']+1 }}</a>
        @endif
        @if(ceil($pagelist['total']/$pagelist['limit'])>$pagelist['currentPage']+1)
            <a href="{{ $prefix_url }}?page={{ $pagelist['currentPage']+2 }}">{{ $pagelist['currentPage']+2 }}</a>
        @endif
        @if(ceil($pagelist['total']/$pagelist['limit'])>$pagelist['currentPage']+3)
            <a href="{{ $prefix_url }}?page={{ $pagelist['currentPage']+3 }}">{{ $pagelist['currentPage']+3 }}</a>
        @endif
    @endif
    <a href="{{ $pagelist['nextPageUrl'] }}">下一页</a>
    <a href="{{ $prefix_url }}/?page={{$pagelist['lastPage']}}">尾页</a>

    &nbsp;&nbsp;&nbsp;&nbsp;
    跳到
    <input type="text" name="page" value="{{ $pagelist['currentPage'] }}">
    <input type="hidden" name="last_page" value="{{ $pagelist['lastPage'] }}">
    <input type="hidden" name="prefix_url" value="{{ $prefix_url }}">
    <a onclick="getPage()">确定</a>

    <p>每页 {{ $pagelist['limit'] }} 条记录，共 {{ $pagelist['lastPage'] }} 页，共 {{ $pagelist['total'] }} 条有效记录，当前是第 {{ $pagelist['currentPage'] }} 页</p>
</div>

<script>
    function getPage(){
        var page = $("input[name='page']").val();
        var last_page = $("input[name='last_page']").val();
        var prefix_url = $("input[name='prefix_url']").val();
        var prefix = prefix_url + '?page=';
        if (page < 1 || page > last_page) {
            alert('请输入正确数字！'); return;
        } else {
            window.location.href = prefix + page;
        }
    }
</script>