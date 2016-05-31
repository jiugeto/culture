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
                <tr>
                    <td class="am-hide-sm-only">样式名称 / Style Name：</td>
                    <td>{{ $data->style_name }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">产品名称 / Name：</td>
                    <td>{{ $data->product() }}</td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">介绍 / Introduce：</td>
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
                <tr>
                    <td class="am-hide-sm-only">一级样式：</td>
                    <td>
                        @if($attrs && isset($attrs['switch']))
                            @if($attrs['switch'])
                                启用 &nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="/admin/productattr/{{$data->id}}/1" class="list_btn">查看</a>
                            @else 未启用
                            @endif
                        @else 无
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">二级样式：</td>
                    <td>
                        @if($attrs2 && isset($attrs2['switch2']))
                            @if($attrs2['switch2'])
                                启用 &nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="/admin/productattr/{{$data->id}}/2" class="list_btn">查看</a>
                            @else 未启用
                            @endif
                        @else 无
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">三级样式：</td>
                    <td>
                        @if($attrs3 && isset($attrs3['switch3']))
                            @if($attrs3['switch3'])
                                启用 &nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="/admin/productattr/{{$data->id}}/3" class="list_btn">查看</a>
                            @else 未启用
                            @endif
                        @else 无
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">图片样式：</td>
                    <td>
                        @if($pics && isset($pics['switch4']))
                            @if($pics['switch4'])
                                启用 &nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="/admin/productattr/{{$data->id}}/4" class="list_btn">查看</a>
                            @else 未启用
                            @endif
                        @else 无
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="am-hide-sm-only">文字样式：</td>
                    <td>
                        @if($texts && isset($texts['switch5']))
                            @if($texts['switch5'])
                                启用 &nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="/admin/productattr/{{$data->id}}/5" class="list_btn">查看</a>
                            @else 未启用
                            @endif
                        @else 无
                        @endif
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@stop