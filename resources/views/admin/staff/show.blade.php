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
                    <td>{{$data['id']}}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">艺名 / Name：</td>
                    <td>{{$data['name']}}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">供求 / Genre：</td>
                    <td>{{$data['genreName']}}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">职员类型 / Type：</td>
                    <td>{{$data['typeName']}}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">发布方 / User Name：</td>
                    <td>{{UserNameById($data['uid'])}}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">真实姓名 / Name2：</td>
                    <td>{{$data['realname']}}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">性别 / Sex：</td>
                    <td>{{$data['sexName']}}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">地址 / Origin：</td>
                    <td>{{$data['origin']}}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">身高(cm) / Height：</td>
                    <td>{{$data['height']}}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">地区 / Area：</td>
                    <td>{{AreaNameByid($data['area'])}}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">毕业学校 / School：</td>
                    <td>{{$data['school']}}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">兴趣爱好 / Hobby：</td>
                    <td>{{$data['hobbyName']}}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">前台显示否 / Is Show：</td>
                    <td>{{$data['isshowName']}}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">创建时间 / Create Time：</td>
                    <td>{{$data['createTime']}}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">修改时间 / Update Time：</td>
                    <td>{{$data['updateTime']}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@stop