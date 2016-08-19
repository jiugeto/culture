@extends('admin.main')
@section('content')
    <div class="admin-content">
        @include('admin.common.crumb')
        <div class="am-g">
            @include('admin.common.menu')
        </div>

        <div class="am-g" id="list">
            <div class="am-u-sm-12">
                <table class="am-table am-table-striped am-table-hover table-main">
                    <thead>
                    <tr>
                        <th class="table-check"><input type="checkbox"/></th>
                        <th class="table-id">ID</th>
                        <th class="table-title">操作名称</th>
                        <th class="table-type">控制器名称</th>
                        <th class="table-type">操作方法</th>
                        <th class="table-author am-hide-sm-only">父ID</th>
                        <th class="table-author am-hide-sm-only">排序</th>
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
                        <td class="am-hide-sm-only"><a href="{{DOMAIN}}admin/action/{{$data->id}}">{{ $data->name }}</a></td>
                        <td class="am-hide-sm-only">{{ $data->controller_prefix.'Controller' }}</td>
                        <td class="am-hide-sm-only">{{ $data->action }}</td>
                        <td class="am-hide-sm-only">{{ $data->pid }}</td>
                        <td class="am-hide-sm-only">{{ $data->sort }}
                            <a href="{{DOMAIN}}admin/action/increase/{{ $data->id }}" class="increase" title="增加1">▲</a>
                            <a href="{{DOMAIN}}admin/action/reduce/{{ $data->id }}" class="reduce" title="减少1">▼</a>
                        </td>
                        <td class="am-hide-sm-only">{{ $data->created_at }}</td>
                        <td class="am-hide-sm-only">
                            <div class="am-btn-toolbar">
                                <div class="am-btn-group am-btn-group-xs">
                                    @if($data->pid==0)
                                    <a href="{{DOMAIN}}admin/action/create/{{$data->id}}"><button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><img src="{{PUB}}assets/images/add.png" class="icon"> 新增子操作</button></a>
                                    @endif
                                    <a href="{{DOMAIN}}admin/action/{{$data->id}}"><button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><img src="{{PUB}}assets/images/show.png" class="icon"> 查看</button></a>
                                    <a href="{{DOMAIN}}admin/action/{{$data->id}}/edit"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="{{PUB}}assets/images/edit.png" class="icon"> 编辑</button></a>
                                    <a href="{{DOMAIN}}admin/action/{{$data->id}}/destroy"><button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><img src="{{PUB}}assets/images/del_red.png" class="icon"> 删除</button></a>
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