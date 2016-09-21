@extends('admin.main')
@section('content')
    <div class="admin-content">
        @include('admin.common.crumb')
        <div class="am-g">
            @include('admin.common.menu')
        </div>
        <hr>

        <div class="am-g">
            <div class="am-u-sm-12">
                <table class="am-table am-table-striped am-table-hover table-main">
                    <thead>
                    <tr>
                        <th class="table-check"><input type="checkbox"/></th>
                        <th class="table-id">ID</th>
                        <th class="table-title">产品名称</th>
                        <th class="table-type">用户名称</th>
                        <th class="table-type">排序</th>
                        <th class="table-type">前台是否显示</th>
                        <th class="table-type">是否置顶</th>
                        <th class="table-date am-hide-sm-only" width="150">添加时间</th>
                        <th class="table-set">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                @if(count($datas))
                    @foreach($datas as $data)
                    <tr>
                        <td class="am-hide-sm-only"><input type="checkbox" /></td>
                        <td class="am-hide-sm-only">{{ $data->id }}</td>
                        <td class="am-hide-sm-only"><a href="{{DOMAIN}}admin/product/{{$data->id}}">{{ $data->name }}</a></td>
                        <td class="am-hide-sm-only">{{ $data->uname }}</td>
                        <td class="am-hide-sm-only">{{ $data->sort }}</td>
                        <td class="am-hide-sm-only">{{ $data->isshow() }}</td>
                        <td class="am-hide-sm-only">{{ $data->istop() }}</td>
                        <td class="am-hide-sm-only">{{ $data->createTime() }}</td>
                        <td class="am-hide-sm-only">
                            <div class="am-btn-toolbar">
                                <div class="am-btn-group am-btn-group-xs">
                                    <a href="{{DOMAIN}}admin/product/{{$data->id}}"><button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><img src="{{PUB}}assets/images/show.png" class="icon"> 查看</button></a>
                                    <a href="{{DOMAIN}}admin/product/{{$data->id}}/edit"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="{{PUB}}assets/images/edit.png" class="icon"> 编辑</button></a>
                                    <a href="{{DOMAIN}}admin/{{$data->id}}/proAttr"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"> 图层列表</button></a>
                                    {{--<a href="{{DOMAIN}}admin/product/{{$data->id}}/forceDelete"><button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><img src="{{PUB}}assets/images/forceDelete_red.png" class="icon"> 销毁记录</button></a>--}}
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
                <p>默认高宽：720*405</p>
            </div>
        </div>
    </div>
@stop