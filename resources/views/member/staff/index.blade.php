@extends('member.main')
@section('content')
    @include('member.common.crumb')
    <div class="mem_tab">
        {{--@include('member.common.lists')--}}
        <ul>
            <a href="{{DOMAIN}}member/entertain"><li>返回娱乐</li></a>
            <li>|</li>
            <a href="{{DOMAIN}}member/staff" style="color:orangered;"><li>人员列表</li></a>
            <li>|</li>
        </ul>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <select name="genre" style="margin:0 10px;padding:0 10px;">
            <option value="0" {{$genre==0?'selected':''}}>所有类型</option>
            @foreach($model['genres'] as $kgenre=>$vgenre)
            <option value="{{$kgenre}}" {{$genre==$kgenre?'selected':''}}>{{$vgenre}}</option>
            @endforeach
        </select>
        <div class="mem_create"><a href="{{DOMAIN}}member/staff/create">添加人员</a></div>
    </div>
    <div class="hr_tab"></div>
    <!-- 空白 -->
    <div class="list_kongbai">&nbsp;</div>
    <div class="list">
        <table class="list_tab">
            <tr>
                <td>编号</td>
                <td>人员</td>
                <td>职务</td>
                <td>性别</td>
                <td>创建时间</td>
                <td>操作</td>
            </tr>
        @if(count($datas))
            @foreach($datas as $data)
            <tr>
                <td>{{$data->id}}</td>
                <td><a href="{{DOMAIN}}member/staff/{{$data['id']}}">{{$data['name']}}</a></td>
                <td>{{$data['genreName']}}</td>
                <td>{{$data['sexName']}}</td>
                <td>{{$data['createTime']}}</td>
                <td>
                    <a href="{{DOMAIN}}member/staff/{{$data['id']}}" class="list_btn">查看</a>
                    <a href="{{DOMAIN}}member/staff/{{$data['id']}}/edit" class="list_btn">编辑</a>
                </td>
            </tr>
            @endforeach
        @else <tr><td colspan="10" style="text-align:center;">没有记录</td></tr>
        @endif
        </table>
        @include('member.common.page2')
    </div>
@stop