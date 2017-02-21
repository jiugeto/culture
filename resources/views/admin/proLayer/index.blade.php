@extends('admin.main')
@section('content')
    <div class="admin-content">
        @include('admin.common.crumb')
        <div class="am-g">
            {{--@include('admin.common.menu')--}}
            <div class="am-u-sm-12 am-u-md-6">
                <div class="am-btn-toolbar">
                    <div class="am-btn-group am-btn-group-xs">
                        <a href="{{DOMAIN}}admin/product">
                            <button type="button" class="am-btn am-btn-default">
                                <img src="{{PUB}}assets/images/redo.png" class="icon"> 返回产品列表
                            </button>
                        </a>
                        <a href="{{DOMAIN}}admin/{{$productid}}/proLayer/create">
                            <button type="button" class="am-btn am-btn-default">
                                <img src="{{PUB}}assets/images/add.png" class="icon"> 添加
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <hr>

        <div class="am-g">
            <div class="am-u-sm-12">
                <table class="am-table am-table-striped am-table-hover table-main">
                    <thead>
                    <tr>
                        <th class="table-check"><input type="checkbox"/></th>
                        <th class="table-id">ID</th>
                        <th class="table-title">动画名称</th>
                        <th class="table-type">产品名称</th>
                        <th class="table-type">延迟(单位s)</th>
                        <th class="table-type">时长（单位s）</th>
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
                        <td class="am-hide-sm-only"><a href="{{DOMAIN}}admin/productlayer/{{$data->id}}">{{ $data->name }}</a></td>
                        <td class="am-hide-sm-only">{{ $data->getProductName() }}</td>
                        <td class="am-hide-sm-only">{{ $data->delay }}</td>
                        <td class="am-hide-sm-only">{{ $data->timelong }}</td>
                        <td class="am-hide-sm-only">{{ $data->createTime() }}</td>
                        <td class="am-hide-sm-only">
                            <div class="am-btn-toolbar">
                                <div class="am-btn-group am-btn-group-xs">
                                    {{--<a href="{{DOMAIN}}admin/{{$productid}}/proLayer/{{$data->id}}"><button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><img src="{{PUB}}assets/images/show.png" class="icon"> 查看</button></a>--}}
                                    <a href="{{DOMAIN}}admin/{{$productid}}/proLayer/{{$data->id}}/edit"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="{{PUB}}assets/images/edit.png" class="icon"> 编辑</button></a>
                                    <a href="{{DOMAIN}}admin/{{$productid}}/{{$data->id}}/proCon"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="{{PUB}}assets/images/edit.png" class="icon"> 图文列表</button></a>
                                    <a href="{{DOMAIN}}admin/{{$productid}}/{{$data->id}}/proAttr"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="{{PUB}}assets/images/edit.png" class="icon"> 样式属性</button></a>
                                    <a href="{{DOMAIN}}admin/{{$productid}}/{{$data->id}}/proLayerAttr"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="{{PUB}}assets/images/edit.png" class="icon"> 动画列表</button></a>
                                    {{--<a href="{{DOMAIN}}admin/{{$layerModel->id}}/proLayer/{{$data->id}}/forceDelete"><button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><img src="{{PUB}}assets/images/forceDelete_red.png" class="icon"> 销毁记录</button></a>--}}
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                @else @include('admin.common.#norecord')
                @endif
                    </tbody>
                </table>
                @include('admin.common.#page')
            </div>
        </div>
    </div>
@stop