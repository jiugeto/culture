@extends('member.main')
@section('content')
    @include('member.common.crumb')
    <div class="list_kongbai">&nbsp;</div>
    <div class="list">
        <table class="list_tab">
            <tr>
                <td>活动名</td>
                <td>类型</td>
                <td>有效期</td>
                <td>是否使用</td>
                <td>创建时间</td>
                {{--<td>操作</td>--}}
            </tr>
        @if(count($datas))
            @foreach($datas as $data)
            <tr>
                <td>{{$data['actName']}}</td>
                <td>{{$data['genreName']}}</td>
                <td>{{$data['period']}}</td>
                <td>{{$data['isUseName']}}</td>
                <td>{{$data['createTime']}}</td>
            </tr>
            @endforeach
        @else <tr><td colspan="10" style="text-align:center;">没有记录</td></tr>
        @endif
        </table>
        @include('member.common.page2')
    </div>
@stop