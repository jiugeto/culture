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
                        <th class="table-title">分镜名称</th>
                        <th class="table-type">供求类别</th>
                        <th class="table-type">类型</th>
                        <th class="table-type">价格</th>
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
                        <td class="am-hide-sm-only">
                            <a href="{{DOMAIN}}admin/storyboard/{{$data->id}}">{{ $data->name }}</a>
                        </td>
                        <td class="am-hide-sm-only">{{ $data->genreName() }}</td>
                        <td class="am-hide-sm-only">{{ $data->getCateName() }}</td>
                        <td class="am-hide-sm-only">{{ $data->money() }}</td>
                        <td class="am-hide-sm-only">{{ $data->createTime() }}</td>
                        <td class="am-hide-sm-only">
                            <div class="am-btn-toolbar">
                                <div class="am-btn-group am-btn-group-xs">
                                    <a href="{{DOMAIN}}admin/storyboard/{{$data->id}}"><button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><img src="{{PUB}}assets/images/show.png" class="icon"> 查看</button></a>
                                    @if($curr['url']=='')
                                    <a href="{{DOMAIN}}admin/storyboard/{{$data->id}}/edit"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="{{PUB}}assets/images/edit.png" class="icon"> 编辑</button></a>
                                    <a href="{{DOMAIN}}admin/storyboard/{{$data->id}}/destroy"><button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><img src="{{PUB}}assets/images/del_red.png" class="icon"> 删除</button></a>
                                    @else
                                    <a href="{{DOMAIN}}admin/storyboard/{{$data->id}}/restore"><button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><img src="{{PUB}}assets/images/redo.png" class="icon"> 还原</button></a>
                                        <a href="{{DOMAIN}}admin/actor/{{$data->id}}/forceDelete"><button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><img src="{{PUB}}assets/images/forceDelete_red.png" class="icon"> 销毁记录</button></a>
                                    @endif
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