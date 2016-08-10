@extends('member.main')
@section('content')
    @include('member.common.crumb')
    <div class="p_style">供求类型：
        @if(in_array($lists['func']['url'],['designPerS','designPerD']))
        <a href="{{DOMAIN}}member/designPerS" style="color:{{$lists['func']['url']=='designPerS'?'red':'grey'}};"><b>设计供应</b></a>&nbsp;
        <a href="{{DOMAIN}}member/designPerD" style="color:{{$lists['func']['url']=='designPerD'?'red':'grey'}};"><b>设计需求</b></a>
        @elseif(in_array($lists['func']['url'],['designComS','designComD']))
        <a href="{{DOMAIN}}member/designPerS" style="color:{{$lists['func']['url']=='designComS'?'red':'grey'}};"><b>设计供应</b></a>&nbsp;
        <a href="{{DOMAIN}}member/designPerD" style="color:{{$lists['func']['url']=='designComD'?'red':'grey'}};"><b>设计需求</b></a>
        @endif
    </div>
    <div class="hr_tab"></div>

    <div class="mem_tab">@include('member.common.lists')</div>
    <div class="hr_tab"></div>

    <!-- 空白 -->
    <div class="list_kongbai">&nbsp;</div>
    <div class="list">
        <table class="list_tab">
            <tr>
                <td>编号</td>
                <td>设计名称</td>
                {{--<td>供求类别</td>--}}
                <td>价格</td>
                <td>发布人</td>
                <td>创建时间</td>
                <td>操作</td>
            </tr>
        @if($datas->total())
            @foreach($datas as $data)
            <tr>
                <td>{{ $data->id }}</td>
                <td>{{ $data->name }}</td>
                {{--<td>{{ $data->genreName() }}</td>--}}
                <td>{{ $data->money() }}</td>
                <td>{{ $data->getUserName() }}</td>
                <td>{{ $data->createTime() }}</td>
                <td>
                    <a href="{{DOMAIN}}member/designPerS/{{ $data->id }}" class="list_btn">查看</a>
                    <a href="{{DOMAIN}}member/designPerS/{{ $data->id }}/edit" class="list_btn">编辑</a>
                    {{--<a href="{{DOMAIN}}member/designPerS/{{ $data->id }}/destroy" class="list_btn">删除</a>--}}
                </td>
            </tr>
            @endforeach
        @else @include('member.common.norecord')
        @endif
        </table>
        @include('member.common.page')
    </div>
@stop