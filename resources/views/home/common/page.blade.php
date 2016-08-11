{{--这里放的是分页信息模板
    这里需要2个参数：
        $datas数据，
        $prefix_url分页url字符串
--}}


<div style="margin:20px auto;color:lightgrey;">
    每页 {{ $datas->limit }}{{--{{ $datas->count() }}--}} 条记录，共 {{ $datas->lastPage() }} 页，共 {{ $datas->total() }} 条记录，当前是第 {{ $datas->currentPage() }} 页
    <div style="margin:5px auto;">
        <ul class="ul_css">
            @if ($datas->currentPage() > 1 && $datas->currentPage() != 1)
                <li class="li_css"><a href="{{ url($prefix_url.'/?page=1') }}">首页</a></li>
            @elseif ($datas->currentPage() == 1 && $datas->currentPage() == 1)
            @endif

            @if ($datas->lastPage() > 1 && $datas->currentPage() != 1)
                <li class="li_css"><a href="{{ $datas->previousPageUrl() }}">«上一页</a></li>
            @elseif ($datas->currentPage() == 1)
            @endif

            @if ($datas->lastPage() > 1 && $datas->currentPage() != $datas->lastPage())
                <li class="li_css"><a href="{{ $datas->nextPageUrl() }}">下一页»</a></li>
                <li class="li_css"><a href="{{ url($prefix_url.'/?page='.$datas->lastPage()) }}">尾页</a></li>
            @elseif ($datas->currentPage() == $datas->lastPage())
            @endif
        </ul>
    </div>
</div>