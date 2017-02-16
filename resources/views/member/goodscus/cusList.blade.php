@extends('member.main')
@section('content')
    @include('member.common.crumb')
    <div class="mem_tab">
        {{--@include('member.common.lists')--}}
        <ul>
            <a href="{{DOMAIN}}member/goodscus"><li>片源列表</li></a>
            <li>|</li>
            <a href="{{DOMAIN}}member/goodscus" style="color:orangered;"><li><b>返回</b></li></a>
        </ul>
    </div>
    <div class="hr_tab"></div>
    <!-- 空白 -->
    <div class="list_kongbai">&nbsp;</div>
    <div class="list">
        <p>片源名称：{{$goodsCus['name']}}</p>
        <table class="list_tab">
            <tr>
                <td>编号</td>
                <td>竞价方</td>
                <td>报价</td>
                <td>期限</td>
                <td>创建时间</td>
                <td>操作</td>
            </tr>
        @if(count($userList))
            @foreach($userList as $data)
            <tr>
                <td>{{ $data['id'] }}</td>
                <td>{{ UserNameById($data['uid']) }}</td>
                <td>{{ $data['money'] }}</td>
                <td>{{ $data['period'] }}</td>
                <td>{{ $data['createTime'] }}</td>
                <td>
                    {{--<a href="{{DOMAIN}}member/goodscus/{{ $data->id }}" class="list_btn">查看</a>--}}
                    {{--<a @if(!$data->getIsSupply()) href="{{DOMAIN}}member/proCus/{{ $data->id }}/setCus" @else style="background:grey;" onclick="alert('已经选择供应方！');" @endif class="list_btn">确定供应方</a>--}}
                    {{--<a onclick="$('input[name=chat_uid]')[0].value={{$data->uid}};alert('已经选择{{$data->getUName()}}，请点击右侧的对话！');" class="list_btn">对话选择</a>--}}
                    {{--<input type="hidden" name="chat_uname_{{$data->uid}}" value="{{$data->getUName()}}">--}}
                </td>
            </tr>
            @endforeach
        @else <tr><td colspan="10" style="text-align:center;">没有记录</td></tr>
        @endif
        </table>
        @include('member.common.page2')
    </div>
@stop