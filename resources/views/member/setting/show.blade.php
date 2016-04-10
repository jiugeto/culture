@extends('member.main')
@section('content')
    @include('member.common.crumb')

    <table class="table_create">
        {{--基本信息--}}
        <tr><td colspan="2">
                <p class="center"><b>基本信息</b></p>
            </td></tr>
        <tr>
            <td style="width:40%;"><label>用户名：</label></td>
            <td>{{ $data->username }}</td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td><label>邮箱：</label></td>
            <td>{{ $data->email }}</td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td><label>qq：</label></td>
            <td>{{ $data->qq }}</td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td><label>电话：</label></td>
            <td>{{ $data->tel }}</td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td><label>手机：</label></td>
            <td>{{ $data->mobile }}</td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td><label>用户类型：</label></td>
            <td>{{ $data->isuser() }}</td>
        </tr>
        <tr><td>&nbsp;</td></tr>

        {{--个人信息--}}
        @if(in_array($data->isuser,[1,3]) && $data->memberid)
            <tr><td colspan="2">
                    <p class="center"><b>个人信息</b></p>
                </td></tr>
            <tr>
                <td><label>真实名称：</label></td>
                <td>{{ $data->realname }}</td>
            </tr>
            <tr>
                <td><label>用户类型：</label></td>
                <td>{{ $data->genre($data->genre) }}</td>
            </tr>
            <tr>
                <td><label>性别：</label></td>
                <td>{{ $data->sex==1 ? '男' : '女' }}</td>
            </tr>
            <tr>
                <td><label>身份证：</label></td>
                <td><img src="{{ $data->idcard }}"></td>
            </tr>
            <tr>
                <td><label>身份证正面照：</label></td>
                <td><img src="{{ $data->idfront }}"></td>
            </tr>
        @endif

        {{--企业信息--}}
        @if(in_array($data->isuser,[2,4,5,6]) && $data->memberid)
            <tr><td colspan="2">
                    <p class="center"><b>企业信息</b></p>
                </td></tr>
            <tr>
                <td><label>用户名：</label></td>
                <td>{{ $data->name }}</td>
            </tr>
            <tr>
                <td><label>公司类型：</label></td>
                <td>{{ $data->genre($data->genre) }}</td>
            </tr>
            <tr>
                <td><label>地区：</label></td>
                <td>{{ $data->area }}</td>
            </tr>
            <tr>
                <td><label>详细地址：</label></td>
                <td>{{ $data->address }}</td>
            </tr>
            <tr>
                <td><label>营业执照：</label></td>
                <td><img src="{{ $data->yyzzid }}"></td>
            </tr>
        @endif

        <tr><td colspan="2"><div class="div_hr"></div></td></tr>
        <tr><td colspan="2" class="center">
                <a href="/member/setting/pwd/{{ $data->id }}">
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