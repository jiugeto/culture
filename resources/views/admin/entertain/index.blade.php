@extends('admin.main')
@section('content')
    <div class="admin-content">
        @include('admin.common.crumb')
        <div class="am-g">
            @include('admin.common.menu')
            {{--演员链接、作品链接--}}
            <div class="am-u-sm-12 am-u-md-6">
                <div class="am-btn-toolbar">
                    <div class="am-btn-group am-btn-group-xs" style="float:right;">
                        <a href="{{DOMAIN}}admin/staff">
                            <button type="button" class="am-btn am-btn-default">
                                <img src="{{PUB}}assets/images/files.png" class="icon"> 人员列表
                            </button>
                        </a>
                        <a href="{{DOMAIN}}admin/goods">
                            <button type="button" class="am-btn am-btn-default">
                                <img src="{{PUB}}assets/images/files.png" class="icon"> 作品列表
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
                        <th class="table-title">娱乐标题</th>
                        <th class="table-type">缩略图</th>
                        <th class="table-type">艺人</th>
                        <th class="table-type">作品</th>
                        <th class="table-type">发布者</th>
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
                        <td class="am-hide-sm-only"><a href="{{DOMAIN}}admin/entertain/{{$data['id']}}">
                            {{str_limit($data['title'],10)}}</a></td>
                        <td class="am-hide-sm-only">
                            @if($data['thumb'])<img src="{{$data['thumb']}}" width="30">
                            @else /
                            @endif
                        </td>
                        <td class="am-hide-sm-only">{{$data['staffs']?count($data['staffs']):0}}</td>
                        <td class="am-hide-sm-only">{{$data['works']?count($data['works']):0}}</td>
                        <td class="am-hide-sm-only">{{$data['uname']}}</td>
                        <td class="am-hide-sm-only">{{$data['createTime']}}</td>
                        <td class="am-hide-sm-only">
                            <div class="am-btn-toolbar">
                                <div class="am-btn-group am-btn-group-xs">
                                {{--@if($prefix_url=='/admin/entertain')--}}
                                    <a href="{{DOMAIN}}admin/entertain/{{$data['id']}}"><button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><img src="{{PUB}}assets/images/show.png" class="icon"> 查看</button></a>
                                    <a href="{{DOMAIN}}admin/entertain/{{$data['id']}}/edit"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="{{PUB}}assets/images/edit.png" class="icon"> 编辑</button></a>
                                    <a href="javascript:;" onclick="getThumb({{$data['id']}})"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="{{PUB}}assets/images/edit.png" class="icon"> 缩略图</button></a>
                                    <div style="height:2px;"></div>
                                    @if($data['isshow']==1)
                                    <a href="{{DOMAIN}}admin/entertain/show/{{$data['id']}}/2"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="{{PUB}}assets/images/edit.png" class="icon"> 显示</button></a>
                                    @else
                                    <a href="{{DOMAIN}}admin/entertain/show/{{$data['id']}}/1"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="{{PUB}}assets/images/edit.png" class="icon"> 隐藏</button></a>
                                    @endif
                                    {{--<a href="{{DOMAIN}}admin/design/{{$data->id}}/forceDelete"><button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><img src="{{PUB}}assets/images/del_red.png" class="icon"> 放入回收站</button></a>--}}
                                {{--@else--}}
                                    {{--<a href="{{DOMAIN}}admin/entertain/{{$data->id}}/restore"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="{{PUB}}assets/images/edit.png" class="icon"> 还原</button></a>--}}
                                    {{--<a href="{{DOMAIN}}admin/entertain/{{$data->id}}/forceDelete"><button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><img src="{{PUB}}assets/images/forceDelete_red.png" class="icon"> 销毁记录</button></a>--}}
                                {{--@endif--}}
                                    <input type="hidden" name="name_{{$data['id']}}" value="{{$data['title']}}">
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
            $("#formthumb").attr('action','{{DOMAIN}}admin/entertain/thumb/'+id);
            $("#thumb").show(200);
        }
        function getClose(){ $('.popup').hide(200); }
    </script>
@stop