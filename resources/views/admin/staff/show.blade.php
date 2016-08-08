@extends('admin.main')
@section('content')
<div class="admin-content">
    @include('admin.common.crumb')
    <div class="am-g">
        @include('admin.common.menu')
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
                    <td class="am-hide-sm-only">艺名 / Name：</td>
                    <td>{{ $data->name }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">真实姓名 / Name2：</td>
                    <td>{{ $data->realname }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">性别 / Sex：</td>
                    <td>{{ $data->sex==1 ? '男' : '女' }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">地址 / Origin：</td>
                    <td>{{ $data->origin }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">身高 / Height：</td>
                    <td>{{ $data->height }} cm</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">地区 / Area：</td>
                    <td>{{ $data->area ? $data->area() : '无' }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">毕业学校 / School：</td>
                    <td>{{ $data->school }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">兴趣爱好 / Hobby：</td>
                    <td>{{ $data->getHobbyName() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">前台显示否 / Is Show：</td>
                    <td>{{ $data->isshow ? '显示' : '不显示' }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">创建时间 / Create Time：</td>
                    <td>{{ $data->created_at }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">修改时间 / Update Time：</td>
                    <td>{{ $data->updated_at!='0000-00-00 00:00:00' ? $data->updated_at : '未修改' }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@stop