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
                <tr>
                    <td class="am-hide-sm-only">产品名称 / Product：</td>
                    <td>{{ $data->product() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">属性名称 / Attr：</td>
                    <td>{{ $data->attrname() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">动画名称 / Animation：</td>
                    <td>{{ $data->animation_name }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">动画时长 / Duration：(单位s)</td>
                    <td>{{ $data->duration }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">动画曲线 / Function：</td>
                    <td>{{ $data->functionName() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">延时秒数 / Delay：(单位s)</td>
                    <td>{{ $data->delay }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">播放次数 / Count：</td>
                    <td>{{ $data->count }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">播放方向 / Direction：</td>
                    <td>{{ $data->directionName() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">播放状态 / State：</td>
                    <td>{{ $data->stateName() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">播放模式 / Mode：</td>
                    <td>{{ $data->modeName() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">字段名称 / Field：</td>
                    <td>{{ $data->field }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">动画百分比 / Per：</td>
                    <td>{{ $data->per }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">动画值 / Value：</td>
                    <td>
                        @if($data->vals)
                            @foreach($data->vals as $val) {{ $val }}<br> @endforeach
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">动画简介 / Introduce：</td>
                    <td>{{ $data->intro ? $data->intro : '无' }}</td>
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