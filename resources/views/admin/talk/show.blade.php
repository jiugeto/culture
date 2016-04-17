@extends('admin.main')
@section('content')
<div class="admin-content">
    @include('admin.common.crumb')
    <div class="am-g">
        {{--@include('admin.common.menu')--}}
        {{--@include('admin.type.search')--}}
    </div>
    <hr/>

    <div class="am-g">
        @include('admin.common.info')
        <div class="am-u-sm-12 am-u-md-8 am-u-md-pull-4">
            <table class="am-table am-table-striped am-table-hover table-main">
                <tbody id="tbody-alert">
                <tr>
                    <td class="am-hide-sm-only">编号 / Id：</td>
                    <td>{{ $data->id }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">话题名称 / Name：</td>
                    <td>{{ $data->name }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">内容  / Introduce：</td>
                    <td>{!! $data->content !!}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">发布人 / User：</td>
                    <td>{{ $data->uid }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">阅读量 / Read：</td>
                    <td>{{ $data->read }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">点赞次数 / Click：</td>
                    <td>{{ $data->click }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">关注着 / Follow：</td>
                    <td>{{ $data->follow }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">感谢人 / Thank：</td>
                    <td>{{ $data->thank }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">分享此话题的用户 / Share：</td>
                    <td>{{ $data->share }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">此话题的举报者 / report：</td>
                    <td>{{ $data->report }}</td>
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
        </div>
    </div>
@stop