@extends('admin.main')
@section('content')
    <div class="admin-content">
        @include('admin.common.crumb')
        <div class="am-g">
            @include('admin.common.menu')
            {{--@include('admin.type.search')--}}
        </div>
        <hr>

        <div class="am-g">
            <div class="am-u-sm-12">
                <table class="am-table am-table-striped am-table-hover table-main">
                    <thead>
                    <tr>
                        <th class="table-check"><input type="checkbox"/></th>
                        <th class="table-id">ID</th>
                        <th class="table-title">名称</th>
                        <th class="table-title">动画名称</th>
                        <th class="table-type">产品名称</th>
                        <th class="table-type">属性名称</th>
                        <th class="table-date am-hide-sm-only">添加时间</th>
                        <th class="table-set">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                @if($datas->total())
                    @foreach($datas as $data)
                    <tr>
                        <td class="am-hide-sm-only"><input type="checkbox" /></td>
                        <td class="am-hide-sm-only">{{ $data->id }}</td>
                        <td class="am-hide-sm-only"><a href="/admin/productlayer/{{$data->id}}">{{ $data->name }}</a></td>
                        <td class="am-hide-sm-only">{{ $data->animation_name }}</td>
                        <td class="am-hide-sm-only">{{ $data->attrname() }}</td>
                        <td class="am-hide-sm-only">{{ $data->product() }}</td>
                        <td class="am-hide-sm-only">{{ $data->created_at }}</td>
                        <td class="am-hide-sm-only">
                            <div class="am-btn-toolbar">
                                <div class="am-btn-group am-btn-group-xs">
                                    <a href="/admin/{{$data->id}}/prolayerattr"><button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><img src="/assets/images/show.png" class="icon"> 动画属性</button></a>
                                    <a href="/admin/productlayer/{{$data->id}}"><button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><img src="/assets/images/show.png" class="icon"> 查看</button></a>
                                    <a href="/admin/productlayer/{{$data->id}}/edit"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="/assets/images/edit.png" class="icon"> 编辑</button></a>
                                    <a href="/admin/productlayer/{{$data->id}}/forceDelete"><button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><img src="/assets/images/forceDelete_red.png" class="icon"> 销毁记录</button></a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                @else @include('admin.common.norecord')
                @endif
                    </tbody>
                </table>
                @include('admin.common.page')
            </div>
        </div>
    </div>
@stop