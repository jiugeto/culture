@extends('admin.main')
@section('content')
    <div class="admin-content">
        @include('admin.common.crumb')
        <div class="am-g">
            {{--@include('admin.common.menu')--}}
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
                        <th class="table-title">地区名称</th>
                        <th class="table-title">父级id</th>
                        <th class="table-author am-hide-sm-only">城市编号</th>
                        <th class="table-author am-hide-sm-only">邮政编码</th>
                        <th class="table-author am-hide-sm-only">天气网城市id</th>
                        {{--<th class="table-date am-hide-sm-only">添加时间</th>--}}
                        {{--<th class="table-set">操作</th>--}}
                    </tr>
                    </thead>
                    <tbody>
                @if($datas->total())
                    @foreach($datas as $data)
                    <tr>
                        <td class="am-hide-sm-only"><input type="checkbox" /></td>
                        <td class="am-hide-sm-only">{{ $data->id }}</td>
                        <td class="am-hide-sm-only">{{ $data->cityname }}</td>
                        <td class="am-hide-sm-only">{{ $data->parentid }}</td>
                        <td class="am-hide-sm-only">{{ $data->nocode }}</td>
                        <td class="am-hide-sm-only">{{ $data->zipcode }}</td>
                        <td class="am-hide-sm-only">{{ $data->weathercode }}</td>
                        {{--<td class="am-hide-sm-only">{{ $data->created_at }}</td>--}}
                        {{--<td class="am-hide-sm-only">--}}
                            {{--<div class="am-btn-toolbar">--}}
                                {{--<div class="am-btn-group am-btn-group-xs">--}}
                                    {{--<a href="/admin/area/{{$data->id}}"><button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><img src="/assets/images/show.png" class="icon"> 查看</button></a>--}}
                                    {{--<a href="/admin/area/{{$data->id}}/edit"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="/assets/images/edit.png" class="icon"> 编辑</button></a>--}}
                                    {{--<a href="/admin/rent/{{$data->id}}/forceDelete"><button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><img src="/assets/images/forceDelete_red.png" class="icon"> 销毁记录</button></a>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</td>--}}
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