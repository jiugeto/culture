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
                    <td>{{ $data->id }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">用户名 / User Name：</td>
                    <td>{{ $data->username }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">邮箱验证  / Email Check：</td>
                    <td>{{ $data->emailck==1 ? '通过' : '拒绝' }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">email  / Email：</td>
                    <td>{{ $data->email }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">qq / QQ：</td>
                    <td>{{ $data->qq }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">tel / Telphone：</td>
                    <td>{{ $data->tel }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">手机 / Mobile：</td>
                    <td>{{ $data->mobile }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">审核情况 / Is Auth：</td>
                    <td>{{ $data->isauth() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">会员类型  / User Type：</td>
                    <td>{{ $data->isuser() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">是否vip  / Is VIP：</td>
                    <td>{{ $data->isvip() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">列表每页显示记录数  / Limit：</td>
                    <td>{{ $data->limit }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">创建时间 / Create Time：</td>
                    <td>{{ $data->created_at }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">修改时间 / Update Time：</td>
                    <td>{{ $data->updated_at!='0000-00-00' ? $data->updated_at : '未修改' }}</td>
                </tr>
                </tbody>
            </table>

            <p><b>详情信息</b></p><hr>
            <table class="am-table am-table-striped am-table-hover table-main">
                <tbody id="tbody-alert">
            @if($personModel)
                <tr>
                    <td class="am-hide-sm-only">真实名字：</td>
                    <td>{{ $personModel->realname }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">性别：</td>
                    <td>{{ $personModel->sex==1 ? '男' : '女' }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">身份证：</td>
                    <td>{{ $personModel->idcard }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">身份证正面照：</td>
                    <td><img src="{{ $personModel->idfont }}"></td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">用户名称：</td>
                    <td>{{ $personModel->uid }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">认证时间：</td>
                    <td><{{ $personModel->created_at }}</td>
                </tr>
            @elseif($companyModel)
                <tr>
                    <td class="am-hide-sm-only">公司名称：</td>
                    <td>{{ $companyModel->name }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">地区：</td>
                    <td>{{ $companyModel->area }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">具体地址：</td>
                    <td>{{ $companyModel->address }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">营业执照：</td>
                    <td>{{ $companyModel->yyzzid }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">用户名称：</td>
                    <td>{{ $companyModel->uid }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">认证时间：</td>
                    <td><{{ $companyModel->created_at }}</td>
                </tr>
            @else @include('admin.common.norecord')
            @endif
                </tbody>
            </table>
        </div>
    </div>
@stop