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
        @if($datas->total())
            @foreach($datas as $data)
            <tr>
                <td>{{ $data->id }}</td>
                <td><a href="{{DOMAIN}}member/staff/{{$data->id}}">{{ $data->name }}</a></td>
                <td>{{ $data->genreName() }}</td>
                <td>{{ $data->sex }}</td>
                <td>{{ $data->createTime() }}</td>
                <td>
                @if($curr=='')
                    <a href="{{DOMAIN}}member/staff/{{ $data->id }}" class="list_btn">查看</a>
                    <a href="{{DOMIAN}}member/staff/{{ $data->id }}/edit" class="list_btn">编辑</a>
                    <a href="{{DOMAIN}}member/staff/{{ $data->id }}/destroy" class="list_btn">删除</a>
                @else
                    <a href="{{DOMIAN}}member/staff/{{ $data->id }}/restore" class="list_btn">还原</a>
                    <a href="{{DOMAIN}}member/staff/{{ $data->id }}/forceDelete" class="list_btn">销毁</a>
                @endif
                </td>
            </tr>
            @endforeach
        @else @include('member.common.#norecord')
        @endif
        </table>
        @include('member.common.#page')
    </div>
@stop