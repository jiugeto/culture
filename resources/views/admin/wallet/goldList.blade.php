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
                        <th class="table-type">发布奖励数量</th>
                        <th class="table-type">好评奖励数量</th>
                        <th class="table-date am-hide-sm-only">添加时间</th>
                    </tr>
                    </thead>
                    <tbody>
                @if($datas->total())
                    @foreach($datas as $data)
                    <tr>
                        <td class="am-hide-sm-only"><input type="checkbox" /></td>
                        <td class="am-hide-sm-only">{{ $data->id }}</td>
                        <td class="am-hide-sm-only">{{ $data->getUName() }}</td>
                        <td class="am-hide-sm-only">{{ $data->gold1 }}</td>
                        <td class="am-hide-sm-only">{{ $data->gold2 }}</td>
                        <td class="am-hide-sm-only">{{ $data->createTime() }}</td>
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