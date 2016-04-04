@extends('admin.main')
@section('content')
    <div class="admin-content">
        @include('admin.common.crumb')
        <div class="am-g">
            @include('admin.common.menu')
            {{--@include('admin.type.search')--}}
            <div class="am-u-sm-12 am-u-md-3">
                <div class="am-form-group">
                    前台显示否：
                    <select name="isshow">
                        <option value="0" {{ $isshow==0 ? 'selected' : '' }}>所有意见</option>
                        <option value="1" {{ $isshow==1 ? 'selected' : '' }}>前台不显示</option>
                        <option value="2" {{ $isshow==2 ? 'selected' : '' }}>前台显示</option>
                    </select>
                    {{--意见状态：--}}
                    {{--<select name="status">--}}
                        {{--<option value="0" {{ $status==0 ? 'selected' : '' }}>所有状态</option>--}}
                    {{--</select>--}}
                    <script>
                        $(document).ready(function(){
                            var isshow = $("select[name='isshow']");
//                            var status = $("select[name='status']");
                            isshow.change(function(){
                                if(isshow.val()==0){
                                    window.location.href = '/admin/opinions';
                                } else {
                                    window.location.href = '/admin/'+isshow.val()+'/opinions';
                                }
                            });
                        });
                    </script>
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
                        <th class="table-id">ID</th>
                        <th class="table-title">意见名称</th>
                        <th class="table-type">发布人</th>
                        <th class="table-type">状态</th>
                        <th class="table-author am-hide-sm-only">前台显示否</th>
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
                        @if($curr['url']=='')
                            <a href="/admin/opinions/{{$data->id}}">{{ $data->name }}</a>
                        @else {{ $data->name }}
                        @endif
                        </td>
                        <td class="am-hide-sm-only">{{ $data->uid }}</td>
                        <td class="am-hide-sm-only">{{ $data->status() }}</td>
                        <td class="am-hide-sm-only">{{ $data->isshow==0 ? '不显示' : '显示' }}</td>
                        <td class="am-hide-sm-only">{{ $data->created_at }}</td>
                        <td class="am-hide-sm-only">
                            <div class="am-btn-toolbar">
                                <div class="am-btn-group am-btn-group-xs">
                                @if($curr['url']=='')
                                    <a href="/admin/opinions/{{$data->id}}"><button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><img src="/assets/images/show.png" class="icon"> 查看</button>
                                    </a>
                                    <a href="/admin/opinions/{{$data->id}}/edit"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="/assets/images/edit.png" class="icon"> 编辑</button></a>
                                    <a href="/admin/opinions/{{$data->id}}/destroy"><button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><img src="/assets/images/forceDelete_red.png" class="icon"> 放入回收站</button></a>
                                @else
                                    <a href="/admin/opinions/{{$data->id}}/restore"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="/assets/images/edit.png" class="icon"> 还原</button></a>
                                    <a href="/admin/opinions/{{$data->id}}/forceDelete"><button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><img src="/assets/images/forceDelete_red.png" class="icon"> 销毁</button></a>
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