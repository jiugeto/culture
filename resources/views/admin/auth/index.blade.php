@extends('admin.main')
@section('content')
    <div class="admin-content">
        @include('admin.common.crumb')
        <div class="am-g">
            {{--@include('admin.common.menu')--}}
        </div>

        <div class="am-g">
            <div class="am-u-sm-12">
                <table class="am-table am-table-striped am-table-hover table-main">
                    <thead>
                    <tr>
                        <th class="table-id">权限</th>
                        <th class="table-title">会员类型</th>
                        <th class="table-type">拥有功能</th>
                        {{--<th class="table-date am-hide-sm-only">创建时间</th>--}}
                        <th class="table-set">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($model['auths'] as $kauth=>$vauth)
                        <tr>
                            <td class="am-hide-sm-only">{{ $kauth }}</td>
                            <td class="am-hide-sm-only">{{ $vauth }}</td>
                            <td class="am-hide-sm-only">{{ count($model->getAuths($kauth)) }}</td>
                            <td class="am-hide-sm-only">
                                <div class="am-btn-toolbar">
                                    <div class="am-btn-group am-btn-group-xs">
                                        {{--<a href="{{DOMAIN}}admin/auth/{{$data->id}}"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="{{PUB}}assets/images/show.png" class="icon"> 查看</button></a>--}}
                                        <a href="{{DOMAIN}}admin/auth/edit/{{$kauth}}"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="{{PUB}}assets/images/edit.png" class="icon"> 编辑</button></a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

