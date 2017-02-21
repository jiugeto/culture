@extends('admin.main')
@section('content')
    <div class="admin-content">
        @include('admin.common.crumb')
        <div class="am-g">
            @include('admin.common.menu')
        </div>

        <div class="am-g">
            <div class="am-u-sm-12">
                <table class="am-table am-table-striped am-table-hover table-main">
                    <thead>
                    <tr>
                        <th class="table-check"><input type="checkbox"/></th>
                        <th class="table-id">ID</th>
                        <th class="table-title">企业名称</th>
                        <th class="table-type">logo</th>
                        <th class="table-type">前台是否显示</th>
                        <th class="table-type">是否置顶</th>
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
                        <td class="am-hide-sm-only"><a href="{{DOMAIN}}admin/commain/{{$data->id}}">
                                {{ str_limit($data->name,20) }}</a></td>
                        <td class="am-hide-sm-only">
                            @if($data->logo)<img src="{{ $data->logo }}" style="width:50px;">@else 无logo @endif
                        </td>
                        <td class="am-hide-sm-only">{{ $data->isshow() }}</td>
                        <td class="am-hide-sm-only">{{ $data->istop() }}</td>
                        <td class="am-hide-sm-only">{{ $data->createTime() }}</td>
                        <td class="am-hide-sm-only">
                            <div class="am-btn-toolbar">
                                <div class="am-btn-group am-btn-group-xs">
                                    <a href="{{DOMAIN}}admin/commain/{{$data->id}}"><button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><img src="{{PUB}}assets/images/show.png" class="icon"> 查看</button></a>
                                    <a href="{{DOMAIN}}admin/commain/{{$data->id}}/edit"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="{{PUB}}assets/images/edit.png" class="icon"> 编辑</button></a>
                                    @if($data->isshow==2)
                                    <a href="{{DOMAIN}}admin/commain/isshow/{{$data->id}}/1"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="{{PUB}}assets/images/edit.png" class="icon"> 去隐藏</button></a>
                                    @else
                                    <a href="{{DOMAIN}}admin/commain/isshow/{{$data->id}}/2"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="{{PUB}}assets/images/edit.png" class="icon"> 去显示</button></a>
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