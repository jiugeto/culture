@extends('company.admin.main')
@section('content')
    <div class="com_admin_crumb">
        <p>首页 / 内容设置</p>
    </div>

    <div class="com_admin_list" style="height:960px;">
        <table cellspacing="0">
            <tr>
                <td>页面</td>
                <td>数量</td>
                <td>子页面</td>
                <td>操作</td>
            </tr>
            <tr><td colspan="10"></td></tr>
            <tr>
                <td>关于公司</td>
                <td>{{ count($data->abouts) }}</td>
                <td width="300">简介，历程，新闻，资讯</td>
                <td>
                    <a href="{{DOMAIN}}company/admin/about" class="list_btn">查看</a>
                </td>
            </tr>
            <tr>
                <td>产品编辑</td>
                <td>{{ count($data->products) }}</td>
                <td>样片</td>
                <td>
                    <a href="{{DOMAIN}}company/admin/product" class="list_btn">查看</a>
                </td>
            </tr>
            <tr>
                <td>团队编辑</td>
                <td>{{ count($data->teams) }}</td>
                <td>人员</td>
                <td>
                    <a href="{{DOMAIN}}company/admin/team" class="list_btn">查看</a>
                </td>
            </tr>
            <tr>
                <td>招聘编辑</td>
                <td>{{ count($data->jobs) }}</td>
                <td>人才</td>
                <td>
                    <a href="{{DOMAIN}}company/admin/job" class="list_btn">查看</a>
                </td>
            </tr>
            <tr>
                <td>联系编辑</td>
                <td>{{ $data->contact }} / {{ count($data->contactFields) }}</td>
                <td>@foreach($data->contactFieldNames as $contactFieldName){{ $contactFieldName.'，' }}@endforeach</td>
                <td>
                    <a href="{{DOMAIN}}company/admin/contact" class="list_btn">查看</a>
                </td>
            </tr>
            <tr>
                <td>花絮编辑</td>
                <td>{{ count($data->parts) }}</td>
                <td>样片花絮</td>
                <td>
                    <a href="{{DOMAIN}}company/admin/part" class="list_btn">查看</a>
                </td>
            </tr>
            <tr>
                <td>服务编辑</td>
                <td>{{ count($data->firms) }}</td>
                <td>服务项目</td>
                <td>
                    <a href="{{DOMAIN}}company/admin/firm" class="list_btn">查看</a>
                </td>
            </tr>
        </table>
    </div>

    {{--<div class="com_admin_home">--}}
        {{--<br>--}}
        {{--<div class="com_space">关于公司 ---}}
            {{--<span onclick="window.location.href='{{DOMAIN}}company/admin/about';" class="com_info">详情</span>--}}
            {{--<div class="bottom"><div class="top1"></div></div>--}}
        {{--</div>--}}
        {{--<br>--}}
        {{--<div class="com_space">产品编辑 ---}}
            {{--<span onclick="window.location.href='{{DOMAIN}}company/admin/product';" class="com_info">详情</span>--}}
            {{--<div class="bottom"><div class="top2"></div></div>--}}
        {{--</div>--}}
        {{--<br>--}}
        {{--<div class="com_space">团队编辑 ---}}
            {{--<span onclick="window.location.href='{{DOMAIN}}company/admin/team';" class="com_info">详情</span>--}}
            {{--<div class="bottom"><div class="top3"></div></div>--}}
        {{--</div>--}}
        {{--<br>--}}
        {{--<div class="com_space">招聘编辑 ---}}
            {{--<span onclick="window.location.href='{{DOMAIN}}company/admin/job';" class="com_info">详情</span>--}}
            {{--<div class="bottom"><div class="top4"></div></div>--}}
        {{--</div>--}}
        {{--<br>--}}
        {{--<div class="com_space">联系编辑 ---}}
            {{--<span onclick="window.location.href='{{DOMAIN}}company/admin/contact';" class="com_info">详情</span>--}}
            {{--<div class="bottom"><div class="top1"></div></div>--}}
        {{--</div>--}}
        {{--<br>--}}
        {{--<div class="com_space">花絮编辑 ---}}
            {{--<span onclick="window.location.href='{{DOMAIN}}company/admin/part';" class="com_info">详情</span>--}}
            {{--<div class="bottom"><div class="top2"></div></div>--}}
        {{--</div>--}}
        {{--<br>--}}
        {{--<div class="com_space">服务编辑 ---}}
            {{--<span onclick="window.location.href='{{DOMAIN}}company/admin/firms';" class="com_info">详情</span>--}}
            {{--<div class="bottom"><div class="top3"></div></div>--}}
        {{--</div>--}}
        {{--<br>--}}
        {{--<div class="com_space">招聘编辑 ---}}
            {{--<span onclick="window.location.href='{{DOMAIN}}company/admin/job';" class="com_info">详情</span>--}}
            {{--<div class="bottom"><div class="top4"></div></div>--}}
        {{--</div>--}}
    {{--</div>--}}
@stop