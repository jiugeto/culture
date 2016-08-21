@extends('person.main')
@section('content')
    <div class="per_body" style="border:0;height:700px;background:0;">
        @include('person.partials.top')
        <div class="per_list">
            <p class="title">个人资料</p>
            <div class="list">
                <p class="user_info"><b>用户名</b> (ID:0000)</p>
                <table width="80%">
                    <tr>
                        <td>邮箱认证：</td><td>手机认证：</td><td>QQ：</td>
                    </tr>
                </table>
                <br>
                <p class="user_info">统计信息：好友数 | 记录数 0 | 回帖数 0 | 主题数 0 | 分享数 0</p>

                <table class="uname">
                    <tr>
                        <td>真实姓名：</td><td>性别：</td>
                    </tr>
                </table>

                <p class="user_info"><b>该会员签到详情</b></p>
                <p class="user_info">
                    累计签到总天数：<b>0</b> 天 <br>
                    本月签到天数：<b>0</b> 天 <br>
                    上次签到时间：<span class="red">XXX</span> <br>
                    该会员目前获取总金币数：<b class="red">0</b> 枚，上次获得金币：<b class="red">0</b> 枚 <br>
                    该会员目前签到等级：<b class="blue">[几等级]XX，离下一级 <span class="red">[XX]</span> 还差 <span class="red">0</span> 天</b> <br>
                    <b style="color:rgb(14,144,210);">[今天是否签到]</b>
                </p>

                <div class="line">
                    <b class="blue">活跃情况</b><br>
                    用户组： <br>
                    在线时间： <br>
                    注册时间： <br>
                    最后访问： <br>
                    注册 IP： <br>
                    上次访问 IP： <br>
                    上次活动时间： <br>
                    上次发表时间： <br>
                    所在时区： <br>
                </div>

                <p class="user_info">
                    <b class="blue">统计信息</b><br>
                </p>
            </div>
        </div>
        @include('person.common.head')
    </div>
@stop