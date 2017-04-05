@extends('company.admin.main')
@section('content')
    @include('company.admin.common.crumb')

    <div class="com_admin_list">
        <div style="height:20px;"></div>
        <table class="companyinfo">
            <tr>
                <td colspan="2">公司类型：{{$company['genreName']}}</td>
            </tr>
            <tr>
                <td>公司电话：{{$company['tel']}}</td>
                <td>QQ：{{$company['qq']}}</td>
            </tr>
            <tr>
                <td>城市：{{AreaNameByid($company['area'])}}</td>
                <td>地址公司：{{$company['address']}}</td>
            </tr>
            <tr>
                <td>邮箱地址：{{$company['email']}}</td>
                <td width="500">logo：{{$company['logo']}}</td>
            </tr>
            <tr>
                <td colspan="2">坐标：
                    <span style="font-size:12px;">{{$company['point']}}</span>
                    <a href="{{DOMAIN_C_BACK}}contact/map/{{$company['id']}}">坐标设置</a>
                </td>
            </tr>
        </table>
        <hr>
        <div class="search_type" style="height:20px;border:0;">
            <span class="create_right">
                <a href="{{DOMAIN_C_BACK}}contact/create" class="list_btn">添加其他联系方式</a>
            </span>
        </div>
        <table cellspacing="0">
            <tr>
                <td>联系方式</td>
                <td>联系内容</td>
                <td width="150">创建时间</td>
                <td>操作</td>
            </tr>
            <tr><td colspan="10"></td></tr>
            @if(count($datas))
                @foreach($datas as $data)
            <tr>
                <td>{{$data['name']}}</td>
                <td>{{str_limit($data['intro'],20)}}</td>
                <td>{{$data['createTime']}}</td>
                <td>
                    <a href="{{DOMAIN_C_BACK}}contact/{{$data['id']}}" class="list_btn">查看</a>
                    <a href="{{DOMAIN_C_BACK}}contact/{{$data['id']}}/edit" class="list_btn">编辑</a>
                </td>
            </tr>
                @endforeach
            @else <tr><td colspan="10" style="text-align:center;">没有记录</td></tr>
            @endif
        </table>
        {{--@include('company.admin.common.page2')--}}
    </div>
@stop