@extends('admin.main')
@section('content')
    <div class="admin-content">
        @include('admin.common.crumb')
        <div class="am-g">
            @include('admin.talk.menu')
        </div>

        <div class="am-g">
            <div class="am-u-sm-12">
                <table class="am-table am-table-striped am-table-hover table-main">
                    <thead>
                    <tr>
                        <th class="table-check"><input type="checkbox"/></th>
                        <th class="table-id">ID</th>
                        <th class="table-title">专栏名称</th>
                        <th class="table-type">发布人</th>
                        <th class="table-date am-hide-sm-only">添加时间</th>
                        <th class="table-set">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                @if(count($datas)>1)
                    @foreach($datas as $kdata=>$data)
                        @if(is_numeric($kdata))
                    <tr>
                        <td class="am-hide-sm-only"><input type="checkbox" /></td>
                        <td class="am-hide-sm-only">{{ $data['id'] }}</td>
                        <td class="am-hide-sm-only"><a href="{{DOMAIN}}admin/theme/{{$data['id']}}">{{ $data['name'] }}</a></td>
                        <td class="am-hide-sm-only">{{ $data['uname'] }}</td>
                        <td class="am-hide-sm-only">{{ $data['createTime'] }}</td>
                        <td class="am-hide-sm-only">
                            <div class="am-btn-toolbar">
                                <div class="am-btn-group am-btn-group-xs">
                                    <a href="{{DOMAIN}}admin/theme/{{$data['id']}}"><button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><img src="{{PUB}}assets/images/show.png" class="icon"> 查看</button></a>
                                    <a href="{{DOMAIN}}admin/theme/{{$data['id']}}/edit"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="{{PUB}}assets/images/edit.png" class="icon"> 编辑</button></a>
                                    @if($data['del']==0)
                                    <a href="{{DOMAIN}}admin/theme/isdel/{{$data['id']}}/1"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="{{PUB}}assets/images/edit.png" class="icon"> 去删除</button></a>
                                    @else
                                    <a href="{{DOMAIN}}admin/theme/isdel/{{$data['id']}}/0"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="{{PUB}}assets/images/edit.png" class="icon"> 去还原</button></a>
                                    @endif
                                    {{--<a href="{{DOMAIN}}admin/theme/{{$data->id}}/forceDelete"><button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><img src="{{PUB}}assets/images/forceDelete_red.png" class="icon"> 销毁记录</button></a>--}}
                                </div>
                            </div>
                        </td>
                    </tr>
                        @endif
                    @endforeach
                @else @include('admin.common.norecord')
                @endif
                    </tbody>
                </table>
                @include('admin.common.page2')
            </div>
        </div>
    </div>
@stop