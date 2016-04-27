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
                        <th class="table-title">名称</th>
                        <th class="table-type">企业名称</th>
                        <th class="table-type">前台是否显示</th>
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
                        <td class="am-hide-sm-only"><a href="/admin/comfirm/{{$data->id}}">
                                @if(mb_strlen($data->name)>6)
                                    {{ mb_substr($data->name,0,5,'utf-8').'...' }}
                                @else {{ $data->name }}
                                @endif
                            </a></td>
                        <td class="am-hide-sm-only">{{ $data->company()->name }}</td>
                        <td class="am-hide-sm-only">{{ $data->isshow==1 ? '显示' : '不显示' }}</td>
                        <td class="am-hide-sm-only">{{ $data->created_at }}</td>
                        <td class="am-hide-sm-only">
                            <div class="am-btn-toolbar">
                                <div class="am-btn-group am-btn-group-xs">
                                    <a href="/admin/comfrim/{{$data->id}}"><button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><img src="/assets/images/show.png" class="icon"> 查看</button></a>
                                {{--@if($crumb['']['url']=='')--}}
                                    <a href="/admin/comfirm/{{$data->id}}/edit"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="/assets/images/edit.png" class="icon"> 编辑</button></a>
                                    {{--<a href="/admin/comfirm/{{$data->id}}/forceDelete"><button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><img src="/assets/images/del_red.png" class="icon"> 放入回收站</button></a>--}}
                                {{--@endif--}}
                                {{--@if($crumb['trash']['url']=='trash')--}}
                                    {{--<a href="/admin/comfirm/{{$data->id}}/restore"><button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><img src="/assets/images/forceDelete_red.png" class="icon"> 还原</button></a>--}}
                                    {{--<a href="/admin/comfirm/{{$data->id}}/forceDelete"><button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><img src="/assets/images/forceDelete_red.png" class="icon"> 销毁记录</button></a>--}}
                                {{--@endif--}}
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