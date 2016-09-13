@extends('admin.main')
@section('content')
    <div class="admin-content">
        @include('admin.common.crumb')

        <div class="am-g">
            <div class="am-u-sm-12">
                <table class="am-table am-table-striped am-table-hover table-main">
                    <thead>
                    <tr>
                        <th class="table-check"><input type="checkbox"/></th>
                        <th class="table-id">ID</th>
                        <th class="table-title">用户名</th>
                        <th class="table-type">企业名称</th>
                        <th class="table-type">当天访问次数</th>
                        <th class="table-type">当天访问时长</th>
                        <th class="table-date am-hide-sm-only">首次访问时间</th>
                        <th class="table-date am-hide-sm-only">最后访问时间</th>
                        <th class="table-set">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                @if($datas->total())
                    @foreach($datas as $data)
                    <tr>
                        <td class="am-hide-sm-only"><input type="checkbox" /></td>
                        <td class="am-hide-sm-only">{{ $data->id }}</td>
                        <td class="am-hide-sm-only">{{ $data->getVisitName() }}</td>
                        <td class="am-hide-sm-only">{{ $data->getCName() }}</td>
                        <td class="am-hide-sm-only">{{ $data->dayCount }}</td>
                        <td class="am-hide-sm-only">{{ $data->getTimeCount($visitRate) }}</td>
                        <td class="am-hide-sm-only">{{ $data->loginTime() }}</td>
                        <td class="am-hide-sm-only">{{ $data->logoutTime() }}</td>
                        <td class="am-hide-sm-only">
                            <div class="am-btn-toolbar">
                                <div class="am-btn-group am-btn-group-xs">
                                    <a href="{{DOMAIN}}admin/visitlog/{{$data->id}}"><button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><img src="{{PUB}}assets/images/show.png" class="icon"> 查看</button></a>
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