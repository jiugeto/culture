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
                    删除否：
                    <select name="del">
                        <option value="0" {{ $del==0 ? 'selected' : '' }}>所有</option>
                        <option value="1" {{ $del==1 ? 'selected' : '' }}>未删除</option>
                        <option value="2" {{ $del==2 ? 'selected' : '' }}>已删除</option>
                    </select>
                    <script>
                        $(document).ready(function(){
                            var del = $("select[name='del']");
                            var isshow = $("select[name='isshow']");
                            del.change(function(){
                                if(del.val()==0 && isshow.val()==0){
                                    window.location.href = '{{DOMAIN}}admin/opinions';
                                } else {
                                    window.location.href = '{{DOMAIN}}admin/opinions/'+del.val()+isshow.val();
                                }
                            });
                            isshow.change(function(){
                                if(del.val()==0 && isshow.val()==0){
                                    window.location.href = '{{DOMAIN}}admin/opinions';
                                } else {
                                    window.location.href = '{{DOMAIN}}admin/opinions/'+del.val()+isshow.val();
                                }
                            });
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
                        <th class="table-type">申请方</th>
                        <th class="table-type">发布方</th>
                        <th class="table-type">状态</th>
                        <th class="table-type">是否删除</th>
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
                            <a href="{{DOMAIN}}admin/orderpro/{{$data->id}}">{{ $data->product() }}</a>
                        </td>
                        <td class="am-hide-sm-only">{{ $data->sellerName }}</td>
                        <td class="am-hide-sm-only">{{ $data->buyerName }}</td>
                        <td class="am-hide-sm-only">{{ $data->statusName() }}</td>
                        <td class="am-hide-sm-only">{{ $data->isshow ? '显示' : '不显示' }}</td>
                        <td class="am-hide-sm-only">{{ $data->createTime() }}</td>
                        <td class="am-hide-sm-only">
                            <div class="am-btn-toolbar">
                                <div class="am-btn-group am-btn-group-xs">
{{--                                @if($curr['url']=='')--}}
                                    <a href="{{DOMAIN}}admin/orderpro/{{$data->id}}"><button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><img src="{{PUB}}assets/images/show.png" class="icon"> 查看</button>
                                    </a>
                                    {{--<a href="{{DOMAIN}}admin/orderpro/{{$data->id}}/edit"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="{{PUB}}assets/images/edit.png" class="icon"> 编辑</button></a>--}}
                                    <a href="{{DOMAIN}}admin/orderpro/{{$data->id}}/destroy"><button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><img src="{{PUB}}assets/images/forceDelete_red.png" class="icon"> 删除</button></a>
                                {{--@else--}}
                                    {{--<a href="{{DOMAIN}}admin/orderpro/{{$data->id}}/restore"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="{{PUB}}assets/images/edit.png" class="icon"> 还原</button></a>--}}
                                    {{--<a href="{{DOMAIN}}admin/orderpro/{{$data->id}}/forceDelete"><button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><img src="{{PUB}}assets/images/forceDelete_red.png" class="icon"> 销毁</button></a>--}}
                                {{--@endif--}}
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