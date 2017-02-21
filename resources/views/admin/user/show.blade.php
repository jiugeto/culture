@extends('admin.main')
@section('content')
<div class="admin-content">
    @include('admin.common.crumb')
    <div class="am-g">
        @include('admin.common.menu')
        {{--@include('admin.type.search')--}}
    </div>
    <hr/>

    <div class="am-g">
        @include('admin.common.info')
        <div class="am-u-sm-12 am-u-md-8 am-u-md-pull-4">
            <p><b>基本信息</b></p><hr>
            <table class="am-table am-table-striped am-table-hover table-main">
                <tbody id="tbody-alert">
                <tr>
                    <td class="am-hide-sm-only">编号 / Id：</td>
                    <td>{{ $data['id'] }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">用户名 / User Name：</td>
                    <td>{{ $data['username'] }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">邮箱验证  / Email Check：</td>
                    <td>{{ $data['emailck']==1 ? '通过' : '拒绝' }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">email  / Email：</td>
                    <td>{{ $data['email'] }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">qq / QQ：</td>
                    <td>{{ $data['qq'] }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">tel / Telphone：</td>
                    <td>{{ $data['tel'] }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">手机 / Mobile：</td>
                    <td>{{ $data['mobile'] }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">审核情况 / Is Auth：</td>
                    <td>{{ $data['authType'] }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">会员类型  / User Type：</td>
                    <td>{{ $data['userType'] }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">是否vip  / Is VIP：</td>
                    <td>{{ $data['vip'] }}</td>
                </tr>
                {{--<tr>--}}
                    {{--<td class="am-hide-sm-only">列表每页显示记录数  / Limit：</td>--}}
                    {{--<td>{{ $data->limit }}</td>--}}
                {{--</tr>--}}
                <tr>
                    <td class="am-hide-sm-only">创建时间 / Create Time：</td>
                    <td>{{ $data['createTime'] }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">修改时间 / Update Time：</td>
                    <td>{{ $data['updateTime'] }}</td>
                </tr>
                </tbody>
            </table>

            <p><b>详情信息</b></p><hr>
            <table class="am-table am-table-striped am-table-hover table-main">
                <tbody id="tbody-alert">
            @if($personArr)
                <tr>
                    <td class="am-hide-sm-only">真实名字：</td>
                    <td>{{ $personArr['realname'] }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">性别：</td>
                    <td>{{ $personArr['sex']==1 ? '男' : '女' }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">身份证：</td>
                    <td>{{ $personArr['idcard'] }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">身份证正面照：</td>
                    <td><img src="{{ $personArr['idfront'] }}"></td>
                </tr>
                {{--<tr>--}}
                    {{--<td class="am-hide-sm-only">用户名称：</td>--}}
                    {{--<td>{{ $personArr['uid'] }}</td>--}}
                {{--</tr>--}}
                {{--<tr>--}}
                    {{--<td class="am-hide-sm-only">认证时间：</td>--}}
                    {{--<td><{{ $personArr['createTime'] }}</td>--}}
                {{--</tr>--}}
            @elseif($companyArr)
                <tr>
                    <td class="am-hide-sm-only">公司名称：</td>
                    <td>{{ $companyArr['name'] }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">地区：</td>
                    <td>{{ $companyArr['area'] }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">具体地址：</td>
                    <td>{{ $companyArr['address'] }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">营业执照：</td>
                    <td>{{ $companyArr['yyzzid'] }}</td>
                </tr>
                {{--<tr>--}}
                    {{--<td class="am-hide-sm-only">用户名称：</td>--}}
                    {{--<td>{{ $companyArr['uid'] }}</td>--}}
                {{--</tr>--}}
                <tr>
                    <td class="am-hide-sm-only">认证时间：</td>
                    <td><{{ $companyArr['createTime'] }}</td>
                </tr>
            @else @include('admin.common.#norecord')
            @endif
                </tbody>
            </table>
        </div>
    </div>
@stop