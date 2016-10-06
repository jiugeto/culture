@extends('admin.main')
@section('content')
    <div class="admin-content">
        @include('admin.common.crumb')
        <div class="am-g">
            <div class="am-u-sm-12">
                <div class="am-form-group">
                    {{--<div class="am-btn-toolbar">--}}
                        <div class="am-btn-group am-btn-group-xs">
                            <a href="{{DOMAIN}}admin/goods/create">
                                <button type="button" class="am-btn am-btn-default">
                                    <img src="{{PUB}}assets/images/add.png" class="icon"> 添加
                                </button>
                            </a>
                        </div>
                        <div class="am-btn-group am-btn-group-xs list_select" style="float:right;">
                            发布单位
                            <select name="type">
                                <option value="0" {{ $type==0 ? 'selected' : '' }}>所有</option>
                                @foreach($types as $ktype=>$vtype)
                                    <option value="{{ $ktype }}" {{ $type==$ktype ? 'selected' : '' }}>{{ $vtype }}</option>
                                @endforeach
                            </select>
                            <script>
                                $(document).ready(function(){
                                    $("select[name='type']").change(function(){
                                        if(this.value==0){
                                            window.location.href = '{{DOMAIN}}admin/goods';
                                        }
                                        if(this.value!=0){
                                            window.location.href = '{{DOMAIN}}admin/'+this.value+'/goods';
                                        }
                                    });
                                });
                            </script>
                        </div>
                    {{--</div>--}}
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
                        <th class="table-title">作品名称</th>
                        <th class="table-type">类型</th>
                        <th class="table-type">发布单位类型</th>
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
                        <td class="am-hide-sm-only"><a href="{{DOMAIN}}admin/goods/{{$data->id}}">
                                @if(mb_strlen($data->name)>6)
                                    {{ mb_substr($data->name,0,5,'utf-8').'...' }}
                                @else {{ $data->name }}
                                @endif
                            </a></td>
                        <td class="am-hide-sm-only">{{ $data->cate_id }}</td>
                        <td class="am-hide-sm-only">{{ $data->type() }}</td>
                        <td class="am-hide-sm-only">{{ $data->created_at }}</td>
                        <td class="am-hide-sm-only">
                            <div class="am-btn-toolbar">
                                <div class="am-btn-group am-btn-group-xs">
                                    <a href="{{DOMAIN}}admin/goods/{{$data->id}}"><button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><img src="{{PUB}}assets/images/show.png" class="icon"> 查看</button></a>
                                {{--@if($crumb['']['url']=='')--}}
                                    <a href="{{DOMAIN}}admin/goods/{{$data->id}}/edit"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="{{PUB}}assets/images/edit.png" class="icon"> 编辑</button></a>
                                    {{--<a href="{{DOMAIN}}admin/function/{{$data->id}}/forceDelete"><button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><img src="{{PUB}}assets/images/del_red.png" class="icon"> 放入回收站</button></a>--}}
                                {{--@endif--}}
                                {{--@if($crumb['trash']['url']=='trash')--}}
                                    {{--<a href="{{DOMAIN}}admin/function/{{$data->id}}/restore"><button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><img src="{{PUB}}assets/images/forceDelete_red.png" class="icon"> 还原</button></a>--}}
                                    {{--<a href="{{DOMAIN}}admin/function/{{$data->id}}/forceDelete"><button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><img src="{{PUB}}assets/images/forceDelete_red.png" class="icon"> 销毁记录</button></a>--}}
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