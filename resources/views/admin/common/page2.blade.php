{{--这里放的是分页信息模板
    这里需要2个参数：
        $datas数据，
        $prefix_url分页url字符串
--}}

<div class="am-cf">
    每页 {{ $pagelist['limit'] }} 条记录，共 {{ $pagelist['lastPage'] }} 页，共 {{ $pagelist['total'] }} 条记录，当前是第 {{ $pagelist['currentPage'] }} 页
    <div class="am-fr">
        <ul class="am-pagination">
            @if ($pagelist['currentPage'] > 1 && $pagelist['currentPage'] != 1)
                <li class="am-active"><a href="{{ $prefix_url.'?page=1' }}">首页</a></li>
            @elseif ($pagelist['currentPage'] == 1 && $pagelist['currentPage'] == 1)
                <li class="am-disabled"><a href="{{ $prefix_url.'?page=1' }}">首页</a></li>
            @endif
            @if ($pagelist['lastPage'] > 1 && $pagelist['currentPage'] != 1)
                <li class="am-active"><a href="{{ $pagelist['previousPageUrl'] }}">«上一页</a></li>
            @elseif ($pagelist['currentPage'] == 1)
                <li class="am-disabled"><a href="{{ $pagelist['previousPageUrl'] }}">«上一页</a></li>
            @endif
            @if ($pagelist['lastPage'] > 1 && $pagelist['currentPage'] != $pagelist['lastPage'])
                <li class="am-active"><a href="{{ $pagelist['nextPageUrl'] }}">下一页»</a></li>
                <li class="am-active"><a href="{{ $prefix_url.'?page='.$pagelist['lastPage'] }}">尾页</a></li>
            @elseif ($pagelist['currentPage'] == $pagelist['lastPage'])
                <li class="am-disabled"><a href="{{ $pagelist['nextPageUrl'] }}">下一页»</a></li>
                <li class="am-disabled"><a href="{{ $prefix_url.'?page='.$pagelist['lastPage'] }}">尾页</a></li>
            @endif
        </ul>
    </div>
</div>
<hr />