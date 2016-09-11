@extends('company.admin.main')
@section('content')
    @include('company.admin.common.crumb')

    <div class="com_admin_list">
        <table cellspacing="0">
            <tr>
                <td>序号</td>
                <td>功能名称</td>
                <td>排序</td>
                <td>前台是否显示</td>
                <td>创建时间</td>
                {{--<td>操作</td>--}}
            </tr>
            <tr><td colspan="10"></td></tr>
            @if($datas->items)
                @foreach($datas->items as $data)
            <tr>
                <td>{{ $data['id'] }}</td>
                <td>{{ $data['name'] ? $data['name'] : '企业默认信息' }}</td>
                <td>{{ $data['sort'] }}</td>
                <td>{{ $data['isshow'] ? '显示' : '不显示' }}</td>
                <td>{{ date('Y年m月d日 H:i',$data['created_at']) }}</td>
                <td>
                    {{--<a href="/company/admin/content/{{ $data['id'] }}" class="list_btn">查看</a>--}}
                    {{--<a href="/company/admin/content/{{ $data['id'] }}/edit" class="list_btn">编辑</a>--}}
                </td>
            </tr>
                @endforeach
            @endif
        </table>
        {{--<div style="margin:10px;">@include('member.common.page')</div><--}}
        <div style="margin:10px;">
            每页 {{ $datas->count }} 条记录，共 {{ $datas->lastPage }} 页，共 {{ $datas->total }} 条记录，
            当前是第 {{ $datas->currentPage }} 页 (每页记录数20条以内)
            <div style="margin:5px auto;">
                <ul class="ul_css">
                    @if ($datas->currentPage > 1 && $datas->currentPage != 1)
                        <li class="li_css"><a href="{{ url($prefix_url.'/?page=1') }}">首页</a></li>
                    @elseif ($datas->currentPage == 1 && $datas->currentPage == 1)
                    @endif
                    @if ($datas->lastPage > 1 && $datas->currentPage != 1)
                        <li class="li_css"><a href="{{ $datas->previousPageUrl }}">«上一页</a></li>
                    @elseif ($datas->currentPage == 1)
                    @endif
                    @if ($datas->lastPage > 1 && $datas->currentPage != $datas->lastPage)
                        <li class="li_css"><a href="{{ $datas->nextPageUrl }}">下一页»</a></li>
                        <li class="li_css"><a href="{{ url($prefix_url.'/?page='.$datas->lastPage) }}">尾页</a></li>
                    @elseif ($datas->currentPage == $datas->lastPage)
                    @endif
                </ul>
            </div>
        </div>
    </div>
@stop