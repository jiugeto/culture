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
                        <a href="{{DOMAIN}}admin/{{$productid}}/proAttr/create">
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
                        {{--<th class="table-check"><input type="checkbox"/></th>--}}
                        <th class="table-id">ID</th>
                        <th class="table-title">属性名称</th>
                        {{--<th class="table-type">父级属性</th>--}}
                        <th class="table-type">产品名称</th>
                        <th class="table-type">属性层类型</th>
                        <th class="table-date am-hide-sm-only" width="150">添加时间</th>
                        <th class="table-set">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                @if($datas->total())
                    @foreach($datas as $data)
                    <tr>
                        {{--<td class="am-hide-sm-only"><input type="checkbox" /></td>--}}
                        <td class="am-hide-sm-only">{{ $data->id }}</td>
                        <td class="am-hide-sm-only"><a href="{{DOMAIN}}admin/proAttr/{{$data->id}}">{{ $data->name }}</a></td>
                        {{--<td class="am-hide-sm-only">{{ $data->getParentName() }}</td>--}}
                        <td class="am-hide-sm-only">{{ $data->getProductName() }}</td>
                        <td class="am-hide-sm-only">{{ $data->getGenreName() }}</td>
                        <td class="am-hide-sm-only">{{ $data->createTime() }}</td>
                        <td class="am-hide-sm-only">
                            <div class="am-btn-toolbar">
                                <div class="am-btn-group am-btn-group-xs">
                                    <a href="{{DOMAIN}}admin/{{$productid}}/proAttr/{{$data->id}}"><button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><img src="{{PUB}}assets/images/show.png" class="icon"> 查看</button></a>
                                    <a href="{{DOMAIN}}admin/{{$productid}}/proAttr/{{$data->id}}/edit"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="{{PUB}}assets/images/edit.png" class="icon"> 编辑</button></a>
                                    @if(!$data->getLayer())
                                        <a href="{{DOMAIN}}admin/{{$productid}}/{{$data->getSub(2)->id}}/proLayer"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="{{PUB}}assets/images/edit.png" class="icon"> 添加动画设置</button></a>
                                    @else
                                        <a href="{{DOMAIN}}admin/{{$productid}}/{{$data->getSub(2)->id}}/proLayer"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="{{PUB}}assets/images/edit.png" class="icon"> 修改动画设置</button></a>
                                    @endif
                                    @if($data->genre==1)
                                        <div style="height:5px;"></div>
                                        @if(!$data->getSub(2))
                                        <a href="{{DOMAIN}}admin/{{$productid}}/{{$data->id}}/proAttr2"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="{{PUB}}assets/images/add.png" class="icon"> 添加定位层</button></a>
                                        @elseif($data->getSub(2) && $data->getSub(2)->genre==2)
                                        <a href="{{DOMAIN}}admin/{{$productid}}/{{$data->id}}/{{$data->getSub(2)->id}}/proAttr2/edit"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="{{PUB}}assets/images/edit.png" class="icon"> 修改定位层</button></a>
                                        @endif
                                        @if(!$data->getSub(3))
                                        <a href="{{DOMAIN}}admin/{{$productid}}/{{$data->id}}/proAttr3"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="{{PUB}}assets/images/add.png" class="icon"> 添加动画层</button></a>
                                        @elseif($data->getSub(3) && $data->getSub(3)->genre==3)
                                        <a href="{{DOMAIN}}admin/{{$productid}}/{{$data->id}}/{{$data->getSub(3)->id}}/proAttr3/edit"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="{{PUB}}assets/images/edit.png" class="icon"> 修改动画层</button></a>
                                        @endif
                                    @endif
                                    <a href="{{DOMAIN}}admin/{{$productid}}/{{$data->id}}/proCon"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="{{PUB}}assets/images/edit.png" class="icon"> 图文列表</button></a>
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