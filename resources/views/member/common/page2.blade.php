{{--这里放的是分页信息模板
    这里需要2个参数：
        $datas数据，
        $prefix_url分页url字符串
--}}


<div>
    每页 {{ $pagelist['limit'] }} 条记录，共 {{ $pagelist['lastPage'] }} 页，共 {{ $pagelist['total'] }} 条记录，当前是第 {{ $pagelist['currentPage'] }} 页
    <div style="margin:5px auto;">
        <ul class="ul_css">
            @if ($pagelist['currentPage'] > 1 && $pagelist['currentPage'] != 1)
                <li class="li_css"><a href="{{ $prefix_url }}">首页</a></li>
            @elseif ($pagelist['currentPage'] == 1 && $pagelist['currentPage'] == 1)
            @endif
            @if ($pagelist['lastPage'] > 1 && $pagelist['currentPage'] != 1)
                <li class="li_css"><a href="{{ $pagelist['previousPageUrl'] }}">«上一页</a></li>
            @elseif ($pagelist['currentPage'] == 1)
            @endif
            @if ($pagelist['lastPage'] > 1 && $pagelist['currentPage'] != $pagelist['lastPage'])
                <li class="li_css"><a href="{{ $pagelist['nextPageUrl'] }}">下一页»</a></li>
                <li class="li_css"><a href="{{ $prefix_url.'/?page='.$pagelist['lastPage'] }}">尾页</a></li>
            @elseif ($pagelist['currentPage'] == $pagelist['lastPage'])
            @endif
        </ul>
    </div>
</div>