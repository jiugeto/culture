@extends('admin.main')
@section('content')
    <div class="admin-content">
        @include('admin.common.crumb')
        <div class="am-g">
            @include('admin.wallet.menu')
        </div>

        <div class="am-g">
            <div class="am-u-sm-12">
                <table class="am-table am-table-striped am-table-hover table-main">
                    <thead>
                    <tr>
                        <th class="table-check"><input type="checkbox"/></th>
                        <th class="table-id">ID</th>
                        <th class="table-title">会员名称</th>
                        <th class="table-type">奖励数量</th>
                        <th class="table-date am-hide-sm-only">添加时间</th>
                        {{--<th class="table-set">操作</th>--}}
                    </tr>
                    </thead>
                    <tbody>
                @if(count($datas)>1)
                    @foreach($datas as $kdata=>$data)
                        @if(is_numeric($kdata))
                    <tr>
                        <td class="am-hide-sm-only"><input type="checkbox" /></td>
                        <td class="am-hide-sm-only">{{ $data['id'] }}</td>
                        <td class="am-hide-sm-only">{{ $data['username'] }}</td>
                        <td class="am-hide-sm-only">{{ $data['reward'] }}</td>
                        <td class="am-hide-sm-only">{{ $data['createTime'] }}</td>
                        {{--<td class="am-hide-sm-only">--}}
                            {{--<div class="am-btn-toolbar">--}}
                                {{--<div class="am-btn-group am-btn-group-xs">--}}
                                    {{--<a href="{{DOMAIN}}admin/signToWeal/{{$data->id}}"><button class="am-btn am-btn-default am-btn-xs am-text-secondary">签到换福利</button></a>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</td>--}}
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