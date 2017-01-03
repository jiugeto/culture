{{--这里放的是分页信息模板
    这里需要2个参数：
        $datas数据，
        $prefix_url分页url字符串
--}}


<div>
    每页 {{ $datas['pagelist']['limit'] }} 条记录，共 {{ $datas['pagelist']['lastPage'] }} 页，共 {{ $datas['pagelist']['total'] }} 条记录，当前是第 {{ $datas['pagelist']['currentPage'] }} 页
    <div style="margin:5px auto;">
        <ul class="ul_css">
            @if ($datas['pagelist']['currentPage'] > 1 && $datas['pagelist']['currentPage'] != 1)
                <li class="li_css"><a href="{{ $prefix_url }}">首页</a></li>
            @elseif ($datas['pagelist']['currentPage'] == 1 && $datas['pagelist']['currentPage'] == 1)
            @endif
            @if ($datas['pagelist']['lastPage'] > 1 && $datas['pagelist']['currentPage'] != 1)
                <li class="li_css"><a href="{{ $datas['pagelist']['previousPageUrl'] }}">«上一页</a></li>
            @elseif ($datas['pagelist']['currentPage'] == 1)
            @endif
            @if ($datas['pagelist']['lastPage'] > 1 && $datas['pagelist']['currentPage'] != $datas['pagelist']['lastPage'])
                <li class="li_css"><a href="{{ $datas['pagelist']['nextPageUrl'] }}">下一页»</a></li>
                <li class="li_css"><a href="{{ $prefix_url.'/?page='.$datas['pagelist']['lastPage'] }}">尾页</a></li>
            @elseif ($datas['pagelist']['currentPage'] == $datas['pagelist']['lastPage'])
            @endif
        </ul>
    </div>
</div>