@extends('admin.main')
@section('content')
    <div class="admin-content">
        @include('admin.common.crumb')
        <div class="am-g">
            @include('admin.common.menu')
            <div class="am-u-sm-12 am-u-md-6">
                <div class="am-btn-toolbar">
                    <div class="am-btn-group am-btn-group-xs" style="float:right;">
                        <a href="{{DOMAIN}}admin/entertain">
                            <button type="button" class="am-btn am-btn-default">
                                <img src="{{PUB}}assets/images/files.png" class="icon"> 返回娱乐列表
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="am-g">
            <div class="am-u-sm-12">
                <table class="am-table am-table-striped am-table-hover table-main">
                    <thead>
                    <tr>
                        <th class="table-check"><input type="checkbox"/></th>
                        <th class="table-id">ID</th>
                        <th class="table-title">作品名称</th>
                        <th class="table-type">类型</th>
                        <th class="table-type">前台显示否</th>
                        <th class="table-type">删除否</th>
                        <th class="table-type">排序</th>
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
                        <td class="am-hide-sm-only"><a href="{{DOMAIN}}admin/works/{{ $data->id }}">{{ $data->name }}</a></td>
                        <td class="am-hide-sm-only">{{ $data->cate() }}</td>
                        <td class="am-hide-sm-only">{{ $data->isshow ? '显示' : '不显示' }}</td>
                        <td class="am-hide-sm-only">@if($data->del)<span style="color:red;">已删除</span>@else未删除@endif</td>
                        <td class="am-hide-sm-only">
                            <span id="sort_show">{{ $data->sort }}</span>
                            <span id="sort_edit" style="display:none;"><input type="text" style="width:25px;border:1px solid lightgrey;border-radius:3px;" name="sort" value="{{ $data->sort }}"></span>
                            <a onclick="sort_show({{ $data->id }})" id="sort_show2">修改</a>
                            <a onclick="sort_edit({{ $data->id }})" id="sort_edit2" style="display:none;">完成</a>
                            <style>
                                a:hover#sort_show2,a:hover#sort_edit2 { cursor:pointer; }
                            </style>
                            <script>
                                function sort_show(id){
                                    $("#sort_show").hide(); $("#sort_edit").show();
                                    $("#sort_show2").hide(); $("#sort_edit2").show();
                                }
                                function sort_edit(id){
                                    $("#sort_show").show(); $("#sort_edit").hide();
                                    $("#sort_show2").show(); $("#sort_edit2").hide();
                                    var sort = $("input[name='sort']");
                                    window.location.href = '{{DOMAIN}}admin/works/'+id+'/sort/'+sort.val();
                                }
                            </script>
                        </td>
                        <td class="am-hide-sm-only">{{ $data->created_at }}</td>
                        <td class="am-hide-sm-only">
                            <div class="am-btn-toolbar">
                                <div class="am-btn-group am-btn-group-xs">
                                    <a href="{{DOMAIN}}admin/works/{{$data->id}}"><button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><img src="{{PUB}}assets/images/show.png" class="icon"> 查看</button></a>
                                    <a href="{{DOMAIN}}admin/works/{{$data->id}}/edit"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="{{PUB}}assets/images/edit.png" class="icon"> 编辑</button></a>
                                    @if(!$data->del)
                                    <a href="{{DOMAIN}}admin/works/{{$data->id}}/destroy"><button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><img src="{{PUB}}assets/images/del_red.png" class="icon"> 放入回收站</button></a>
                                    @else
                                    <a href="{{DOMAIN}}admin/works/{{$data->id}}/restore"><button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><img src="{{PUB}}assets/images/redo.png" class="icon"> 还原</button></a>
                                    <a href="{{DOMAIN}}admin/works/{{$data->id}}/forceDelete"><button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><img src="{{PUB}}assets/images/forceDelete_red.png" class="icon"> 销毁记录</button></a>
                                    @endif
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