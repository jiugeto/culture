@extends('admin.main')
@section('content')
    <div class="admin-content">
        @include('admin.common.crumb')
        <div class="am-g">
            @include('admin.common.menu')
            {{--@include('admin.type.search')--}}
        </div>

        {{--<hr>
        <div class="am-u-sm-12 am-u-md-3">
            <span class="action_span" id="span_list" onclick="tolist()">列表模式</span>
            <span class="action_span" id="span_accordion" onclick="toaccordion()">层叠模式</span>
        </div>--}}
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
                        <td class="am-hide-sm-only"><a href="/admin/action/{{$data->id}}">{{ $data->name }}</a></td>
                        <td class="am-hide-sm-only">{{ $data->controller_prefix.'Controller' }}</td>
                        <td class="am-hide-sm-only">{{ $data->action }}</td>
                        <td class="am-hide-sm-only">{{ $data->pid }}</td>
                        <td class="am-hide-sm-only">{{ $data->created_at }}</td>
                        <td class="am-hide-sm-only">
                            <div class="am-btn-toolbar">
                                <div class="am-btn-group am-btn-group-xs">
                                    @if($data->pid==0)
                                    <a href="/admin/action/create/{{$data->id}}"><button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><img src="/assets/images/add.png" class="icon"> 新增子操作</button></a>
                                    @endif
                                    <a href="/admin/action/{{$data->id}}"><button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><img src="/assets/images/show.png" class="icon"> 查看</button></a>
                                    <a href="/admin/action/{{$data->id}}/edit"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="/assets/images/edit.png" class="icon"> 编辑</button></a>
                                    <a href="/admin/action/{{$data->id}}/forceDelete"><button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><img src="/assets/images/forceDelete_red.png" class="icon"> 销毁记录</button></a>
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
        {{--<div class="am-panel-group" id="accordion" style="display:none;">
            <div class="action_border am-panel am-panel-default">
            @if($actions)
                @foreach($actions as $action)
                <div class="clear am-panel-hd">
                    <h4 class="am-panel-title" data-am-collapse="{parent: '#accordion', target: '#do-not-say-1'}">
                        {{ $action->name }}
                        <div class="action_pos">
                            @if($action->pid==0)
                                <a href="/admin/action/create/{{$action->id}}"><button class="action_sub_btn"><img src="/assets/images/add.png" class="icon"> 新增子操作</button></a>
                            @endif
                            <a href="/admin/action/{{$action->id}}"><button class="action_sub_btn"><img src="/assets/images/show.png" class="icon"> 查看</button></a>
                            <a href="/admin/action/{{$action->id}}/edit"><button class="action_sub_btn action_blue"><img src="/assets/images/edit.png" class="icon"> 编辑</button></a>
                            <a href="/admin/action/{{$action->id}}/forceDelete"><button class="action_sub_btn action_red"><img src="/assets/images/forceDelete_red.png" class="icon"> 销毁记录</button></a>
                        </div>
                    </h4>
                </div>
                <div id="do-not-say-1" class="am-panel-collapse am-collapse am-in">
                    <div class="am-panel-bd">
                    @if($action->child)
                        @foreach($action->child as $subaction)
                            <div class="action_sub">
                                {{ $subaction->name }} &nbsp;&nbsp;&nbsp;&nbsp;
                                <div class="action_pos">
                                    @if($subaction->pid==0)
                                        <a href="/admin/action/create/{{$subaction->id}}"><button class="action_sub_btn"><img src="/assets/images/add.png" class="icon"> 新增子操作</button></a>
                                    @endif
                                    <a href="/admin/action/{{$subaction->id}}"><button class="action_sub_btn"><img src="/assets/images/show.png" class="icon"> 查看</button></a>
                                    <a href="/admin/action/{{$subaction->id}}/edit"><button class="action_sub_btn action_blue"><img src="/assets/images/edit.png" class="icon"> 编辑</button></a>
                                    <a href="/admin/action/{{$subaction->id}}/forceDelete"><button class="action_sub_btn action_red"><img src="/assets/images/forceDelete_red.png" class="icon"> 销毁记录</button></a>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    </div>
                </div>
                @endforeach
            @endif
            </div>
        </div>--}}
    </div>

    {{--<script>
        var span_list = document.getElementById('span_list');
        var span_accordion = document.getElementById('span_accordion');
        var list = document.getElementById('list');
        var accordion = document.getElementById('accordion');
        function tolist(){
            span_list.style.color = rgb(14,144,210);
            span_accordion.style.color = 'black';
            list.style.display = 'block';
            accordion.style.display = 'none';
        }
        function toaccordion(){
            span_accordion.style.color = rgb(14,144,210);
            span_list.style.color = 'black';
            accordion.style.display = 'block';
            list.style.display = 'none';
        }
    </script>--}}
@stop