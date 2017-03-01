@extends('admin.main')
@section('content')
    <div class="admin-content">
        @include('admin.common.crumb')
        <div class="am-g">
            {{--@include('admin.common.menu')--}}
            <div class="am-u-sm-12 am-u-md-6">
                <div class="am-btn-toolbar">
                    <div class="am-btn-group am-btn-group-xs">
                        <a href="{{DOMAIN}}admin/wallet/create">
                            <button type="button" class="am-btn am-btn-default">
                                <img src="{{PUB}}assets/images/add.png" class="icon"> 添加
                            </button>
                        </a>
                        <a href="{{DOMAIN}}admin/sign">
                            <button type="button" class="am-btn am-btn-default">
                                <img src="{{PUB}}assets/images/files.png" class="icon"> 签到列表
                            </button>
                        </a>
                        <a href="{{DOMAIN}}admin/gold">
                            <button type="button" class="am-btn am-btn-default">
                                <img src="{{PUB}}assets/images/files.png" class="icon"> 金币列表
                            </button>
                        </a>
                        <a href="{{DOMAIN}}admin/tip">
                            <button type="button" class="am-btn am-btn-default">
                                <img src="{{PUB}}assets/images/files.png" class="icon"> 红包列表
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
                        <th class="table-title">会员名称</th>
                        <th class="table-type">签到总数(个)</th>
                        <th class="table-type">金币总数(个)</th>
                        <th class="table-type">红包总额(元)</th>
                        <th class="table-type">福利(元)</th>
                        <th class="table-date am-hide-sm-only">添加时间</th>
                        <th class="table-set">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                @if(count($datas))
                    @foreach($datas as $data)
                        <td class="am-hide-sm-only"><input type="checkbox" /></td>
                        <td class="am-hide-sm-only">{{$data['id']}}</td>
                        <td class="am-hide-sm-only">{{$data['username']}}</td>
                        <td class="am-hide-sm-only">{{$data['sign']}}</td>
                        <td class="am-hide-sm-only">{{$data['gold']}}</td>
                        <td class="am-hide-sm-only">{{$data['tip']}}</td>
                        <td class="am-hide-sm-only">{{$data['weal']}}</td>
                        <td class="am-hide-sm-only">{{$data['createTime']}}</td>
                        <td class="am-hide-sm-only">
                            <div class="am-btn-toolbar">
                                <div class="am-btn-group am-btn-group-xs">
                                    <a href="{{DOMAIN}}admin/wallet/{{$data['id']}}/edit"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="{{PUB}}assets/images/edit.png" class="icon"> 编辑</button></a>
                                    <a href="{{DOMAIN}}admin/wallet/toweal/{{$data['id']}}/1"><button class="am-btn am-btn-default am-btn-xs am-text-secondary">签到换福利</button></a>
                                    <a href="{{DOMAIN}}admin/wallet/toweal/{{$data['id']}}/2"><button class="am-btn am-btn-default am-btn-xs am-text-secondary">金币换福利</button></a>
                                    <a href="{{DOMAIN}}admin/wallet/toweal/{{$data['id']}}/3"><button class="am-btn am-btn-default am-btn-xs am-text-secondary">红包换福利</button></a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                @else <re><td colspan="10" style="text-align:center;">没有记录</td></re>
                @endif
                    </tbody>
                </table>
                <p style="font-size:12px;">注意：福利可用于支付，{{$signByWeal}}签到=1福利，{{$goldByWeal}}金币=1福利，{{$tipByWeal}}红包=1福利</p>
                @include('admin.common.page2')
            </div>
        </div>
    </div>
@stop