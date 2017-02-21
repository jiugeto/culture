@extends('admin.main')
@section('content')
    <div class="admin-content">
        @include('admin.common.crumb')
        <div class="am-g list_select">
            前台显示否
            <select name="isshow">
                @foreach($model['isshows'] as $kisshow=>$visshow)
                    <option value="{{ $kisshow }}" {{ $kisshow==$isshow ? 'selected' : '' }}>{{ $visshow }}</option>
                @endforeach
            </select>
            &nbsp;&nbsp;
            状态
            <select name="status">
                @foreach($model['statuss'] as $kstatus=>$vstatus)
                    <option value="{{ $kstatus }}" {{ $kstatus==$status ? 'selected' : '' }}>{{ $vstatus }}</option>
                @endforeach
            </select>
            <script>
                $("select[name='isshow']").change(function(){
                    var isshow = $("select[name='isshow']").val();
                    var status = $("select[name='status']").val();
                    if(isshow==0 && status==0){
                        window.location.href = '{{DOMAIN}}admin/orderpro';
                    } else {
                        //s代表检索
                        window.location.href = '{{DOMAIN}}admin/orderpro/s/'+isshow+'/'+status;
                    }
                });
                $("select[name='status']").change(function(){
                    var isshow = $("select[name='isshow']").val();
                    var status = $("select[name='status']").val();
                    if(isshow==0 && status==0){
                        window.location.href = '{{DOMAIN}}admin/orderpro';
                    } else {
                        //s代表检索
                        window.location.href = '{{DOMAIN}}admin/orderpro/s/'+isshow+'/'+status;
                    }
                });
            </script>
            <div class="am-u-sm-12 am-u-md-6">
                <div class="am-btn-toolbar">
                    <div class="am-btn-group am-btn-group-xs">
                        <a href="{{DOMAIN}}admin/wallet/clear">
                            <button type="button" class="am-btn am-btn-default">
                                <span style="color:orangered;">清空表</span>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <hr>

        <div class="am-g">
            <div class="am-u-sm-12">
                <table class="am-table am-table-striped am-table-hover table-main">
                    <thead>
                    <tr>
                        <th class="table-check"><input type="checkbox"/></th>
                        <th class="table-id">序号</th>
                        <th class="table-title">订单名称</th>
                        <th class="table-type">用户</th>
                        <th class="table-type">总价格</th>
                        <th class="table-type">所用福利</th>
                        <th class="table-type">需支付</th>
                        <th class="table-type">状态</th>
                        <th class="table-type">是否显示</th>
                        <th class="table-date am-hide-sm-only" width="100">添加时间</th>
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
                        <td class="am-hide-sm-only">
                            <a href="{{DOMAIN}}admin/orderpro/{{$data['id']}}">{{ $data['pname'] }}</a>
                        </td>
                        <td class="am-hide-sm-only">{{ $data['uname'] }}</td>
                        <td class="am-hide-sm-only">{{ $data['money1'].'元' }}
                            {{--@if($data['status']==1) <span style="color:orangered;">? 待定价</span>--}}
                            {{--@elseif($data['status']==2) {{ $data->getMoney() }}--}}
                            {{--@else /--}}
                            {{--@endif--}}
                        </td>
                        <td class="am-hide-sm-only">{{ $data['weal'].'元' }}</td>
                        <td class="am-hide-sm-only">{{ $data['money2'].'元' }} <br>
                            {{--@if($data->status==2) <span style="color:orangered;">? 未付款</span>--}}
                            {{--@elseif($data->status==3) <span class="star">× 付错款</span>--}}
                            {{--@elseif($data->status>3) <span style="color:green;">√ 已付款</span>--}}
                            {{--@endif--}}
                        </td>
                        <td class="am-hide-sm-only">{{ $data['statusName'] }} <br>
                            {{--@if($data['status']==7)<span style="color:green;">√ 返5金币</span>@endif--}}
                        </td>
                        <td class="am-hide-sm-only">{{ $data['isShowName'] }}</td>
                        <td class="am-hide-sm-only">{{ $data['createTime'] }}</td>
                        <td class="am-hide-sm-only">
                            <div class="am-btn-toolbar">
                                <div class="am-btn-group am-btn-group-xs">
                                    <a href="{{DOMAIN}}admin/ordercre/{{$data['id']}}"><button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><img src="{{PUB}}assets/images/show.png" class="icon"> 查看</button></a>
                                    @if($data['isshow']==2)
                                        <a href="{{DOMAIN}}admin/ordercre/isshow/{{$data['id']}}/1"><button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><img src="{{PUB}}assets/images/tool.png" class="icon"> 隐藏</button></a>
                                    @else
                                        <a href="{{DOMAIN}}admin/ordercre/isshow/{{$data['id']}}/2"><button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><img src="{{PUB}}assets/images/tool.png" class="icon"> 显示</button></a>
                                    @endif

                                    <div style="height:4px"></div>
                                    @if(in_array($data['status'],[1,2]))
                                        <a href="{{DOMAIN}}admin/ordercre/status/{{$data['id']}}/3"><button class="am-btn am-btn-default am-btn-xs am-hide-sm-only">确认付款</button></a>
                                    @elseif($data['status']==1)
                                        <a href="{{DOMAIN}}admin/ordercre/status/{{$data['id']}}/2"><button class="am-btn am-btn-default am-btn-xs am-hide-sm-only">未付款或款不对</button></a>
                                    @elseif($data['status']==3 && !$data['link'])
                                        <a href="{{DOMAIN}}admin/ordercre/{{$data['id']}}/edit"><button class="am-btn am-btn-default am-btn-xs am-hide-sm-only">处理视频</button></a>
                                    @elseif($data['status']==4 && $data['link'])
                                        <a href="{{DOMAIN}}admin/ordercre/status/{{$data['id']}}/4"><button class="am-btn am-btn-default am-btn-xs am-hide-sm-only">视频已处理</button></a>
                                    @endif
                                </div>
                            </div>
                        </td>
                    </tr>
                        @endif
                    @endforeach
                @else @include('admin.common.#norecord')
                @endif
                    </tbody>
                </table>
                @include('admin.common.page2')
            </div>
        </div>
    </div>

    <input type="hidden" name="id">
    <script>
        function showPopup(id){
            $("input[name='id']")[0].value = id;
            $('.sureMoney').show();
        }
    </script>
    @include('admin.ordercre.money')
@stop