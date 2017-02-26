@extends('admin.main')
@section('content')
    <div class="admin-content">
        @include('admin.common.crumb')
        <div class="am-g">
            @include('admin.common.menu')
        </div>
        <hr>

        <div class="am-g">
            <div class="am-u-sm-12">
                <table class="am-table am-table-striped am-table-hover table-main">
                    <thead>
                    <tr>
                        <th class="table-check"><input type="checkbox"/></th>
                        <th class="table-id">ID</th>
                        <th class="table-title">分镜名称</th>
                        <th class="table-type">供求类别</th>
                        <th class="table-type">类型</th>
                        <th class="table-type">缩略图</th>
                        <th class="table-type">发布方</th>
                        <th class="table-type">价格</th>
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
                            <a href="{{DOMAIN}}admin/storyboard/{{$data['id']}}">
                                {{$data['name']}}</a>
                        </td>
                        <td class="am-hide-sm-only">{{$data['genreName']}}</td>
                        <td class="am-hide-sm-only">{{$data['cateName']}}</td>
                        <td class="am-hide-sm-only">
                            @if($data['thumb'])<img src="{{$data['thumb']}}" width="30">
                            @else /
                            @endif
                        </td>
                        <td class="am-hide-sm-only">{{$data['uname']}}</td>
                        <td class="am-hide-sm-only">{{$data['money']}}</td>
                        <td class="am-hide-sm-only">{{$data['createTime']}}</td>
                        <td class="am-hide-sm-only">
                            <div class="am-btn-toolbar">
                                <div class="am-btn-group am-btn-group-xs">
                                    <a href="{{DOMAIN}}admin/storyboard/{{$data['id']}}"><button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><img src="{{PUB}}assets/images/show.png" class="icon"> 查看</button></a>
                                    <a href="{{DOMAIN}}admin/storyboard/{{$data['id']}}/edit"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="{{PUB}}assets/images/edit.png" class="icon"> 编辑</button></a>
                                    <a href="javascript:;" onclick="getThumb({{$data['id']}})"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="{{PUB}}assets/images/edit.png" class="icon"> 缩略图</button></a>
                                    <div style="height:2px;"></div>
                                    @if($data['isshow']==1)
                                    <a href="{{DOMAIN}}admin/storyboard/show/{{$data['id']}}/2"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="{{PUB}}assets/images/edit.png" class="icon"> 去显示</button></a>
                                    @else
                                    <a href="{{DOMAIN}}admin/storyboard/show/{{$data['id']}}/1"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="{{PUB}}assets/images/edit.png" class="icon"> 去隐藏</button></a>
                                    @endif
                                    {{--@if($curr['url']=='')--}}
                                    {{--<a href="{{DOMAIN}}admin/storyboard/{{$data->id}}/destroy"><button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><img src="{{PUB}}assets/images/del_red.png" class="icon"> 删除</button></a>--}}
                                    {{--@else--}}
                                    {{--<a href="{{DOMAIN}}admin/storyboard/{{$data->id}}/restore"><button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><img src="{{PUB}}assets/images/redo.png" class="icon"> 还原</button></a>--}}
                                        {{--<a href="{{DOMAIN}}admin/actor/{{$data->id}}/forceDelete"><button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><img src="{{PUB}}assets/images/forceDelete_red.png" class="icon"> 销毁记录</button></a>--}}
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

    @include('admin.common.popupImg')

    <script>
        function getThumb(id){
            var name = $("input[name='name_"+id+"']").val();
            $(".pname").html(name+' 缩略图更新');
            $("#formthumb").attr('action','{{DOMAIN}}admin/storyboard/thumb/'+id);
            $("#thumb").show(200);
        }
        function getClose(){ $('.popup').hide(200); }
    </script>
@stop