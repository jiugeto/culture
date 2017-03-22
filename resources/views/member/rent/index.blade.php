@extends('member.main')
@section('content')
    @include('member.common.crumb')
    <div class="mem_tab">
        <ul>
            <a href=""><li style="border:0;">&nbsp;</li></a>
        </ul>
        &nbsp;&nbsp;
        设备：
        <select name="type" required onchange="getType(this.value)">
            <option value="0" {{ $type==0 ? 'selected' : '' }}>所有</option>
            @foreach($model['types'] as $ktype=>$vtype)
                <option value="{{$ktype}}" {{ $type==$ktype ? 'selected' : '' }}>{{$vtype}}</option>
            @endforeach
        </select>
        <script>
            function getType(val){
                if(val==0){
                    window.location.href = '{{DOMAIN}}member/rent';
                } else {
                    window.location.href = '{{DOMAIN}}member/rent/s/'+val;
                }
            }
        </script>
        <div class="mem_create">
            <a href="{{DOMAIN}}member/{{$lists['func']['url']}}/create">{{$lists['create']['name']}}</a>
        </div>
    </div>
    <div class="hr_tab"></div>
    <!-- 空白 -->
    <div class="list_kongbai">&nbsp;</div>
    <div class="list">
        <table class="list_tab">
            <tr>
                <td>编号</td>
                <td>设备名称</td>
                <td>供求关系</td>
                <td>缩略图</td>
                <td>发布人</td>
                <td>创建时间</td>
                <td>操作</td>
            </tr>
        @if(count($datas))
            @foreach($datas as $data)
            <tr>
                <td>{{$data['id']}}</td>
                <td>{{$data['name']}}</td>
                <td>{{$data['genreName']}}</td>
                <td>@if($data['thumb'])<img src="{{$data['thumb']}}" width="100">@else/@endif</td>
                <td>{{UserNameById($data['uid'])}}</td>
                <td>{{$data['createTime']}}</td>
                <td>
                    <a href="{{DOMAIN}}member/rent/{{ $data['id'] }}" class="list_btn">查看</a>
                    <a href="{{DOMAIN}}member/rent/{{ $data['id'] }}/edit" class="list_btn">编辑</a>
                </td>
            </tr>
            @endforeach
        @else <tr><td colspan="10" style="text-align:center;">没有记录</td></tr>
        @endif
        </table>
        @include('member.common.page2')
    </div>
@stop