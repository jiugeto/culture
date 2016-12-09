{{--这里放的是分页信息模板
    这里需要2个参数：
        $datas数据，
        $prefix_url分页url字符串
--}}

<div class="am-cf">
    每页 {{ $datas['pagelist']['limit'] }} 条记录，共 {{ $datas['pagelist']['lastPage'] }} 页，共 {{ $datas['pagelist']['total'] }} 条记录，当前是第 {{ $datas['pagelist']['currentPage'] }} 页
    <div class="am-fr">
        <ul class="am-pagination">
            @if ($datas['pagelist']['currentPage'] > 1 && $datas['pagelist']['currentPage'] != 1)
                <li class="am-active"><a href="{{ $prefix_url.'?page=1' }}">首页</a></li>
            @elseif ($datas['pagelist']['currentPage'] == 1 && $datas['pagelist']['currentPage'] == 1)
                <li class="am-disabled"><a href="{{ $prefix_url.'?page=1' }}">首页</a></li>
            @endif
            @if ($datas['pagelist']['lastPage'] > 1 && $datas['pagelist']['currentPage'] != 1)
                <li class="am-active"><a href="{{ $datas['pagelist']['previousPageUrl'] }}">«上一页</a></li>
            @elseif ($datas['pagelist']['currentPage'] == 1)
                <li class="am-disabled"><a href="{{ $datas['pagelist']['previousPageUrl'] }}">«上一页</a></li>
            @endif
            @if ($datas['pagelist']['lastPage'] > 1 && $datas['pagelist']['currentPage'] != $datas['pagelist']['lastPage'])
                <li class="am-active"><a href="{{ $datas['pagelist']['nextPageUrl'] }}">下一页»</a></li>
                <li class="am-active"><a href="{{ $prefix_url.'?page='.$datas['pagelist']['lastPage'] }}">尾页</a></li>
            @elseif ($datas['pagelist']['currentPage'] == $datas['pagelist']['lastPage'])
                <li class="am-disabled"><a href="{{ $datas['pagelist']['nextPageUrl'] }}">下一页»</a></li>
                <li class="am-disabled"><a href="{{ $prefix_url.'?page='.$datas['pagelist']['lastPage'] }}">尾页</a></li>
            @endif
        </ul>
    </div>
</div>
<hr />