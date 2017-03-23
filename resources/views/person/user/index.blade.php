@extends('person.main')
@section('content')
    <div class="per_body" style="border:0;height:700px;background:0;">
        @include('person.common.top')
        <div class="per_list">
            <p class="title">个人资料</p>
            <div class="list" style="width:748px;">
                <p class="user_info">
                    <b>{{$user['username']}}</b>
                    {{'( ID:'}}@if(strlen($user['id'])==1) 000{{$user['id']}}
                    @elseif(strlen($user['id'])==2) 00{{$user['id']}}
                    @elseif(strlen($user['id'])==3) 0{{$user['id']}}
                    @elseif(strlen($user['id'])>=4) {{$user['id']}}
                    @endif
                    {{')'}}
                </p>
                <table width="80%">
                    <tr>
                        <td>邮箱：{{$user['emailck']?$user['email']:'无'}}</td>
                        <td>邮箱认证：？</td>
                    </tr>
                    <tr>
                        <td>手机：{{$user['mobile']?$user['mobile']:'无'}}</td>
                        <td>手机认证：？</td>
                    </tr>
                    <tr>
                        <td>QQ：{{$user['qq']?$user['qq']:'无'}}</td>
                    </tr>
                </table>
                <br>

                <table class="uname">
                    <tr>
                        <td>真实姓名：{{$user['realname']}}</td>
                        <td>性别：{{$user['sexName']}}</td>
                        <td>地址：{{$user['address']}}</td>
                    </tr>
                </table>

                <p class="user_info"><b>该会员签到详情</b></p>
                <p class="user_info">
                    累计签到总天数：<b>{{$signs['signs']?count($signs['signs']):0}}</b> 天 <br>
                    本月签到天数：<b>{{count($signs['signsMonth'])}}</b> 天 <br>
                    上次签到时间：
                    <span class="red">
                        {{count($signs['signs'])>1 ? $signs['signs'][count($signs['signs'])-2]['createTime']:''}}
                    </span> <br>
                    该会员目前获取总金币数：<b class="red">{{ $signs['rewardCount'] }}</b> 枚，
                    上次获得金币：
                    <b class="red">
                        {{count($signs['signs'])>1 ? $signs['signs'][count($signs['signs'])-2]['reward']:0}}
                    </b> <br>
                    该会员目前签到等级：
                    <b class="blue">
                        [几等级]XX，离下一级 <span class="red">[XX]</span> 还差 <span class="red">0</span> 天
                    </b> <br>
                    <b style="color:rgb(14,144,210);">[今天是否签到 <span class="red">{{($signs&&$signs['signsDay'])?'√':'×'}}</span>]</b>
                </p>

                <div class="line">
                    <b class="blue">活跃情况</b><br>
                    用户组： {{$user['userType']}}<br>
                    注册时间： {{$user['createTime']}}<br>
                    上次访问： {{$user['lastLogin']}}<br>
                    注册 IP： @if($userRegistLog){{$userRegistLog['ip']}} - - {{$userRegistLog['ipaddress']}}@endif<br>
                    上次访问 IP：@if($userLastLog){{$userLastLog['ip']}} - - {{$userLastLog['ipaddress']}}@endif <br>
                </div>

                <p class="user_info">
                    <b class="blue">统计信息</b><br>
                    好友数 {{count($frields)}} |
                    留言数 {{count($messageNum)}}
                </p>
            </div>
        </div>
        @include('person.common.head')
    </div>
@stop