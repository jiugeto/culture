@extends('company.admin.main')
@section('content')
    <div class="com_admin_crumb">
        <p>首页 / 公司信息</p>
    </div>

    <div class="com_admin_home">
        <br>
        <div class="com_space">页面布局 -
            <span onclick="window.location.href='{{DOMAIN}}company/admin/layout';" class="com_info">详情</span>
            <div class="bottom"><div class="top1"></div></div>
        </div>
        <br>
        <div class="com_space">基本设置 -
            <span onclick="window.location.href='{{DOMAIN}}company/admin/basic';" class="com_info">详情</span>
            <div class="bottom"><div class="top2"></div></div>
        </div>
        <br>
        <div class="com_space">单页信息 -
            <span onclick="window.location.href='{{DOMAIN}}company/admin/single';" class="com_info">详情</span>
            <div class="bottom"><div class="top3"></div></div>
        </div>
        <br>
        <div class="com_space">链接信息 -
            <span onclick="window.location.href='{{DOMAIN}}company/admin/link';" class="com_info">详情</span>
            <div class="bottom"><div class="top4"></div></div>
        </div>
        {{--<br>--}}
        {{--<div class="com_space"><a href="">更多</a></div>--}}
    </div>
@stop