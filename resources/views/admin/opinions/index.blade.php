@extends('admin.main')
@section('content')
    <div class="admin-content">
        @include('admin.common.crumb')
        <div class="am-g">
            {{--@include('admin.common.menu')--}}
            <div class="am-u-sm-12 am-u-md-3">
                <div class="am-form-group">
                    <div class="am-btn-group am-btn-group-xs">
                        <a href="{{DOMAIN}}admin/opinions/create">
                            <button type="button" class="am-btn am-btn-default">
                                <img src="{{PUB}}assets/images/add.png" class="icon"> 添加
                            </button>
                        </a>
                    </div>
                    @if(env('APP_ENV')=='local' && env('APP_DEBUG')=='true')
                        <a href="{{DOMAIN}}admin/opinions/clear">
                            <button type="button" class="am-btn am-btn-default">
                                {{--<img src="{{PUB}}assets/images/del_red.png" class="icon">--}}
                                <b style="color:orangered;">清空表</b>
                            </button>
                        </a>
                    @endif
                </div>
            </div>
            <div class="am-u-sm-12 am-u-md-3">
                <div class="am-form-group" style="float:right;">
                    <select name="isshow" style="padding:5px 10px;border:1px solid lightgrey;outline:none;">
                        <option value="0" {{ $isshow==0 ? 'selected' : '' }}>所有意见</option>
                        <option value="1" {{ $isshow==1 ? 'selected' : '' }}>前台不显示</option>
                        <option value="2" {{ $isshow==2 ? 'selected' : '' }}>前台显示</option>
                    </select>
                    <script>
                        $("select[name='isshow']").change(function(){
                            var isshow = $(this).val();
                            if(isshow==0){
                                window.location.href = '{{DOMAIN}}admin/opinions';
                            } else {
                                window.location.href = '{{DOMAIN}}admin/opinions/s/'+isshow;
                            }
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
                @if(count($datas))
                    @foreach($datas as $kdata=>$data)
                    <tr>
                        <td class="am-hide-sm-only"><input type="checkbox" /></td>
                        <td class="am-hide-sm-only">{{ $data['id'] }}</td>
                        <td class="am-hide-sm-only">
                        @if($curr['url']=='')
                            <a href="{{DOMAIN}}admin/opinions/{{$data['id']}}">{{ $data['name'] }}</a>
                        @else {{ $data['name'] }}
                        @endif
                        </td>
                        <td class="am-hide-sm-only">{{ $data['username'] }}</td>
                        <td class="am-hide-sm-only">{{ $data['statusName'] }}</td>
                        <td class="am-hide-sm-only">{{ $data['isShowName'] }}</td>
                        <td class="am-hide-sm-only">{{ $data['createTime'] }}</td>
                        <td class="am-hide-sm-only">
                            <div class="am-btn-toolbar">
                                <div class="am-btn-group am-btn-group-xs">
                                    <a href="{{DOMAIN}}admin/opinions/{{$data['id']}}"><button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><img src="{{PUB}}assets/images/show.png" class="icon"> 查看</button>
                                    </a>
                                    <a href="{{DOMAIN}}admin/opinions/{{$data['id']}}/edit"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="{{PUB}}assets/images/edit.png" class="icon"> 编辑</button></a>
                                    @if($data['isshow']==1)
                                    <a href="{{DOMAIN}}admin/opinions/show/{{$data['id']}}/2"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="{{PUB}}assets/images/edit.png" class="icon"> 去显示</button></a>
                                    @else
                                    <a href="{{DOMAIN}}admin/opinions/show/{{$data['id']}}/1"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="{{PUB}}assets/images/edit.png" class="icon"> 去隐藏</button></a>
                                    @endif
                                    {{--@if($curr['url']=='')--}}
                                    {{--<a href="{{DOMAIN}}admin/opinions/{{$data['id']}}/destroy"><button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><img src="{{PUB}}assets/images/forceDelete_red.png" class="icon"> 去隐藏</button></a>--}}
                                {{--@else--}}
                                    {{--<a href="{{DOMAIN}}admin/opinions/{{$data['id']}}/restore"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="{{PUB}}assets/images/edit.png" class="icon"> 还原</button></a>--}}
                                    {{--<a href="{{DOMAIN}}admin/opinions/{{$data['id']}}/forceDelete"><button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><img src="{{PUB}}assets/images/forceDelete_red.png" class="icon"> 销毁</button></a>--}}
                                {{--@endif--}}
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                @else <tr><td colspan="10" style="text-align:center;">没有记录</td></tr>
                @endif
                    </tbody>
                </table>
                @include('admin.common.page2')
            </div>
        </div>
    </div>
@stop