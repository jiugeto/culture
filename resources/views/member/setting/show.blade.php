@extends('member.main')
@section('content')
    {{--@include('member.common.crumb')--}}
    <div class="mem_crumb">
        <a href="{{DOMAIN}}member">会员后台</a> / 会员设置
    </div>

    <table class="table_create">
        {{--基本信息--}}
        <tr><td colspan="2">
                <p class="center"><b>基本信息</b></p>
            </td></tr>
        <tr>
            <td style="width:40%;"><label>用户名：</label></td>
            <td>{{ $data['username'] }}</td>
        </tr>
        {{--<tr><td>&nbsp;</td></tr>--}}
        <tr>
            <td><label>邮箱：</label></td>
            <td>{{ $data['email'] }}</td>
        </tr>
        {{--<tr><td>&nbsp;</td></tr>--}}
        <tr>
            <td><label>qq：</label></td>
            <td>{{ $data['qq'] }}</td>
        </tr>
        {{--<tr><td>&nbsp;</td></tr>--}}
        <tr>
            <td><label>电话：</label></td>
            <td>{{ $data['tel'] }}</td>
        </tr>
        {{--<tr><td>&nbsp;</td></tr>--}}
        <tr>
            <td><label>手机：</label></td>
            <td>{{ $data['mobile'] }}</td>
        </tr>
        {{--<tr><td>&nbsp;</td></tr>--}}
        <tr>
            <td><label>用户类型：</label></td>
            <td>{{ $data['userType'] }}</td>
        </tr>
        {{--<tr><td>&nbsp;</td></tr>--}}

        {{--个人信息--}}
        @if(in_array($data['isuser'],[1,2,4,50]))
            <tr><td colspan="2">
                    <p class="center"><b>个人信息</b></p>
                </td></tr>
            <tr>
                <td><label>真实名称：</label></td>
                <td>{{ $personArr['realname'] }}</td>
            </tr>
            <tr>
                <td><label>性别：</label></td>
                <td>{{ $personArr['sexName'] }}</td>
            </tr>
            <tr>
                <td><label>身份证：</label></td>
                <td>{{ $personArr['idcard'] }}</td>
            </tr>
            <tr>
                <td><label>身份证正面照：</label></td>
                <td>@if($personArr['idfront'])<img src="{{ $personArr['idfront'] }}">@endif</td>
            </tr>
        @endif

        {{--企业信息--}}
        @if(in_array($data['isuser'],[3,5,6,7,50]))
            <tr><td colspan="2">
                    <p class="center"><b>企业信息</b></p>
                </td></tr>
            <tr>
                <td><label>用户名：</label></td>
                <td>{{ $companyArr['name'] }}</td>
            </tr>
            <tr>
                <td><label>地区：</label></td>
                <td>{{ $companyArr['areaName'] }}</td>
            </tr>
            <tr>
                <td><label>详细地址：</label></td>
                <td>{{ $companyArr['address'] }}</td>
            </tr>
            <tr>
                <td><label>营业执照：</label></td>
                <td><img src="{{ $companyArr['yyzzid'] }}"></td>
            </tr>
        @endif

        {{--其他信息--}}
        <tr><td colspan="2">
                <p class="center"><b>其他信息</b></p>
            </td></tr>
        {{--<tr>--}}
            {{--<td><label>列表每页显示记录数：</label></td>--}}
            {{--<td>{{ $data->limit }}</td>--}}
        {{--</tr>--}}
        <tr><td>&nbsp;</td></tr>

        <tr><td colspan="2"><div class="div_hr"></div></td></tr>
        <tr><td colspan="2" class="center">
                <a href="/member/setting/{{ $data['id'] }}/auth">
                    <button class="companybtn">完善资料</button>
                </a>
                <a href="/member/setting/info/{{ $data['id'] }}">
                    <button class="companybtn">其他更新</button>
                </a>
                <a href="/member/setting/pwd/{{ $data['id'] }}">
                    <button class="companybtn">更新密码</button>
                </a>
            </td>
        </tr>

        <tr><td colspan="2"><div class="div_hr"></div></td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td colspan="2" class="center">
                <button class="companybtn" onclick="history.go(-1)">返 &nbsp;&nbsp;&nbsp;回</button>
            </td></tr>
    </table>
@stop