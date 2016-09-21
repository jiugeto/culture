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
            <label>总的样式属性</label>
            <table class="am-table am-table-striped am-table-hover table-main">
                <tbody id="tbody-alert">
                <tr>
                    <td class="am-hide-sm-only">编号 / Id：</td>
                    <td>{{ $data->id }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">名称 / Name：</td>
                    <td>{{ $data->name }}</td>
                </tr>
                {{--<tr>--}}
                    {{--<td class="am-hide-sm-only">样式名称 / Style Name：</td>--}}
                    {{--<td>{{ $data->style_name }}</td>--}}
                {{--</tr>--}}
                <tr>
                    <td class="am-hide-sm-only">产品名称 / Name：</td>
                    <td>{{ $data->getProductName() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">动画层 / Genre：</td>
                    <td>{{ $data->getGenreName() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">内边距 / Padding：(单位px)</td>
                    <td>{{ $data->getPadVal() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">宽高 / Size：(单位px)</td>
                    <td>{{ $data->getWidth() }}，{{ $data->getHeight() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">定位方式 / Postion：</td>
                    <td>{{ $data->getPos()['pos'] }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">左边距离 / Left：(单位px)</td>
                    <td>{{ $data->getPos()['left'] }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">顶部距离 / Top：(单位px)</td>
                    <td>{{ $data->getPos()['top'] }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">浮动方式 / Float：</td>
                    <td>{{ $data->getFloat() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">透明度 / Opacity：</td>
                    <td>{{ $data->getOpacity() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">创建时间 / Create Time：</td>
                    <td>{{ $data->createTime() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">修改时间 / Update Time：</td>
                    <td>{{ $data->updateTime() }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@stop