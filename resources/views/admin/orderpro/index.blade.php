@extends('admin.main')
@section('content')
    <div class="admin-content">
        @include('admin.common.crumb')
        <div class="am-g" style="margin:0px 30px;">
            {{--@include('admin.common.menu')--}}
            {{--<div class="am-u-sm-12 am-u-md-3">--}}
                {{--<div class="am-form-group">--}}
                    前台显示否：
                    <select name="isshow">
                        <option value="0" {{ $isshow==0 ? 'selected' : '' }}>所有</option>
                        <option value="1" {{ $isshow==1 ? 'selected' : '' }}>前台不显示</option>
                        <option value="2" {{ $isshow==2 ? 'selected' : '' }}>前台显示</option>
                    </select>
                    <script>
                        $("select[name='isshow']").change(function(){
                            if($(this).val()==0){
                                window.location.href = '{{DOMAIN}}admin/opinions';
                            } else {
                                window.location.href = '{{DOMAIN}}admin/opinions/'+del.val()+isshow.val();
                            }
                        });
                    </script>
                {{--</div>--}}
            {{--</div>--}}
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
                        <th class="table-type">价格</th>
                        <th class="table-type">状态</th>
                        <th class="table-type">是否显示</th>
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
                        <td class="am-hide-sm-only">
                            <a href="{{DOMAIN}}admin/orderpro/{{$data->id}}">{{ $data->getProductName() }}</a>
                        </td>
                        <td class="am-hide-sm-only">{{ $data->uname }}</td>
                        <td class="am-hide-sm-only">{{ $data->getMoney() }}</td>
                        <td class="am-hide-sm-only">{{ $data->getStatusName() }}</td>
                        <td class="am-hide-sm-only">{{ $data->isshow() }}</td>
                        <td class="am-hide-sm-only">{{ $data->createTime() }}</td>
                        <td class="am-hide-sm-only">
                            <div class="am-btn-toolbar">
                                <div class="am-btn-group am-btn-group-xs">
                                    <a href="{{DOMAIN}}admin/orderpro/{{$data->id}}"><button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><img src="{{PUB}}assets/images/show.png" class="icon"> 查看</button>
                                    </a>
                                    @if($data->isshow==2)
                                        <a href="{{DOMAIN}}admin/orderpro/isshow/{{$data->id}}/1"><button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><img src="{{PUB}}assets/images/del_red.png" class="icon"> 隐藏</button></a>
                                    @elseif($data->isshow==1)
                                        <a href="{{DOMAIN}}admin/orderpro/isshow/{{$data->id}}/2"><button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><img src="{{PUB}}assets/images/show.png" class="icon"> 显示</button></a>
                                    @endif

                                    @if($data->status==1)
                                        <a href="{{DOMAIN}}admin/orderpro/pay/{{$data->id}}/1"><button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><img src="{{PUB}}assets/images/tool.png" class="icon"> 确定已支付</button></a>
                                        <a href="{{DOMAIN}}admin/orderpro/pay/{{$data->id}}/1"><button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><img src="{{PUB}}assets/images/tool.png" class="icon"> 支付不全</button></a>
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