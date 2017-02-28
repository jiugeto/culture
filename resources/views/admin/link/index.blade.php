@extends('admin.main')
@section('content')
    <div class="admin-content">
        @include('admin.common.crumb')
        <div class="am-g">
            @include('admin.common.menu')
            <div class="am-btn-group am-btn-group-xs list_select" style="float:right;">
                发布单位
                <select name="type" onchange="getSel()">
                    <option value="0" {{$type==0?'selected':''}}>所有</option>
                    @foreach($model['types'] as $k=>$vtype)
                        <option value="{{$k}}" {{$type==$k?'selected':''}}>{{$vtype}}</option>
                    @endforeach
                </select>
                <script>
                    function getSel() {
                        var type = $("select[name='type']").val();
                        if(type==0){
                            window.location.href = '{{DOMAIN}}admin/link';
                        } else {
                            window.location.href = '{{DOMAIN}}admin/link/s/'+type;
                        }
                    }
                </script>
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
                        <th class="table-title">链接名称</th>
                        <th class="table-type">图片</th>
                        <th class="table-type">显示方式</th>
                        <th class="table-type">是否显示</th>
                        <th class="table-date am-hide-sm-only">添加时间</th>
                        <th class="table-set">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                @if(count($datas))
                    @foreach($datas as $data)
                    <tr>
                        <td class="am-hide-sm-only"><input type="checkbox" /></td>
                        <td class="am-hide-sm-only">{{$data['id']}}</td>
                        <td class="am-hide-sm-only">
                            <a href="{{DOMAIN}}admin/link/{{$data['id']}}">
                                {{$data['name']}}</a></td>
                        <td class="am-hide-sm-only">
                            @if($data['thumb'])<img src="{{$data['thumb']}}" width="30">@else/@endif
                        </td>
                        <td class="am-hide-sm-only">{{$data['wayName']}}</td>
                        <td class="am-hide-sm-only">{{$data['isshowName']}}</td>
                        <td class="am-hide-sm-only">{{$data['createTime']}}</td>
                        <td class="am-hide-sm-only">
                            <div class="am-btn-toolbar">
                                <div class="am-btn-group am-btn-group-xs">
                                    <a href="{{DOMAIN}}admin/link/{{$data['id']}}"><button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><img src="{{PUB}}assets/images/show.png" class="icon"> 查看</button></a>
                                    <a href="{{DOMAIN}}admin/link/{{$data['id']}}/edit"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="{{PUB}}assets/images/edit.png" class="icon"> 编辑</button></a>
                                    {{--@if($data['display_way']==2)--}}
                                    <a href="javascript:;" onclick="getThumb({{$data['id']}})"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="{{PUB}}assets/images/edit.png" class="icon"> 图片</button></a>
                                    {{--@endif--}}
                                    @if($data['isshow']==2)
                                    <a href="{{DOMAIN}}admin/link/show/{{$data['id']}}/1"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="{{PUB}}assets/images/edit.png" class="icon"> 去隐藏</button></a>
                                    @else
                                    <a href="{{DOMAIN}}admin/link/show/{{$data['id']}}/2"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="{{PUB}}assets/images/edit.png" class="icon"> 去显示</button></a>
                                    @endif
                                    {{--<a href="{{DOMAIN}}admin/link/{{$data->id}}/forceDelete"><button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><img src="{{PUB}}assets/images/forceDelete_red.png" class="icon"> 销毁记录</button></a>--}}
                                    <input type="hidden" name="name_{{$data['id']}}" value="{{$data['name']}}">
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

    @include('admin.common.popupImg')

    <script>
        function getThumb(id){
            var name = $("input[name='name_"+id+"']").val();
            $(".pname").html(name+' 图片更新');
            $("#formthumb").attr('action','{{DOMAIN}}admin/link/thumb/'+id);
            $("#thumb").show(200);
        }
        function getClose(){ $('.popup').hide(200); }
    </script>
@stop