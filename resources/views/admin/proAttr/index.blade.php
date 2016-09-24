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
                                <img src="{{PUB}}assets/images/files.png" class="icon"> 返回产品列表
                            </button>
                        </a>
                        <a href="{{DOMAIN}}admin/{{$productid}}/proLayer">
                            <button type="button" class="am-btn am-btn-default">
                                <img src="{{PUB}}assets/images/files.png" class="icon"> 返回动画设置
                            </button>
                        </a>
                        <a href="{{DOMAIN}}admin/{{$productid}}/{{$layerid}}/proAttr/create">
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
            <td class="am-u-sm-12">
                <table class="am-table am-table-striped am-table-hover table-main">
                    <thead>
                    <tr>
                        <th class="table-check"><input type="checkbox"/></th>
                        {{--<th class="table-id">ID</th>--}}
                        <th class="table-title">属性名称</th>
                        <th class="table-type">动画设置名称</th>
                        <th class="table-type">类型</th>
                        <th class="table-date am-hide-sm-only" width="150">添加时间</th>
                        <th class="table-set">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                @if(count($datas))
                    @foreach($datas as $data)
                    <tr>
                        <td class="am-hide-sm-only"><input type="checkbox" /></td>
                        {{--<td class="am-hide-sm-only">{{ $data->id }}</td>--}}
                        <td class="am-hide-sm-only">
                            <a href="{{DOMAIN}}admin{{$productid}}/{{$layerid}}/proAttr/{{$data->id}}">{{ $data->name }}</a>
                        </td>
                        <td class="am-hide-sm-only">{{ $data->getLayerName() }}</td>
                        <td class="am-hide-sm-only">{{ $data->getGenreName() }}</td>
                        <td class="am-hide-sm-only">{{ $data->createTime() }}</td>
                        <td class="am-hide-sm-only">
                            <div class="am-btn-toolbar">
                                <div class="am-btn-group am-btn-group-xs">
                                    <a href="{{DOMAIN}}admin/{{$productid}}/{{$layerid}}/proAttr/{{$data->id}}"><button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><img src="{{PUB}}assets/images/show.png" class="icon"> 查看</button></a>
                                    <a href="{{DOMAIN}}admin/{{$productid}}/{{$layerid}}/proAttr/{{$data->id}}/edit"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="{{PUB}}assets/images/edit.png" class="icon"> 编辑</button></a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                @else @include('admin.common.norecord')
                @endif
                    </tbody>
                </table>
                {{--@include('admin.common.page')--}}
            </div>
        </div>
    </div>
@stop