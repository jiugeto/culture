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
                        {{--<th class="table-id">权限</th>--}}
                        <th class="table-date am-hide-sm-only">权限key</th>
                        <th class="table-title">会员类型</th>
                        <th class="table-type">拥有功能</th>
                        <th class="table-set">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($menuModel['auths'] as $k=>$vauth)
                        <tr>
                            <td class="am-hide-sm-only">{{ $k }}</td>
                            <td class="am-hide-sm-only">{{ $vauth }}</td>
                            <td class="am-hide-sm-only">
                                @if($k==0) {{count($auths0)}}
                                @elseif($k==1) {{count($auths1)}}
                                @elseif($k==2) {{count($auths2)}}
                                @elseif($k==3) {{count($auths3)}}
                                @elseif($k==4) {{count($auths4)}}
                                @elseif($k==5) {{count($auths5)}}
                                @elseif($k==6) {{count($auths6)}}
                                @elseif($k==7) {{count($auths7)}}
                                @elseif($k==50) {{count($auths8)}}
                                @endif
                            </td>
                            <td class="am-hide-sm-only">
                                <div class="am-btn-toolbar">
                                    <div class="am-btn-group am-btn-group-xs">
                                        {{--<a href="{{DOMAIN}}admin/auth/{{$data->id}}"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="{{PUB}}assets/images/show.png" class="icon"> 查看</button></a>--}}
                                        <a href="{{DOMAIN}}admin/auth/edit/{{$k}}"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="{{PUB}}assets/images/edit.png" class="icon"> 编辑</button></a>
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

