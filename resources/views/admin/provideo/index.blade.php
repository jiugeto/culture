@extends('admin.main')
@section('content')
    <div class="admin-content">
        @include('admin.common.crumb')
        <div class="am-g">
            <div class="am-u-sm-12 am-u-md-6">
                <div class="am-btn-toolbar">
                    <div class="am-btn-group am-btn-group-xs">
                        <a href="{{DOMAIN}}admin/provideo/create">
                            <button type="button" class="am-btn am-btn-default">
                                <img src="{{PUB}}assets/images/add.png" class="icon"> 添加
                            </button>
                        </a>
                        {{--@if(env('APP_ENV')=='local' && env('APP_DEBUG')=='true' && Session::get('admin.username')=='jiuge')--}}
                        {{--<a href="{{DOMAIN}}admin/provideo/clear">--}}
                            {{--<button type="button" class="am-btn am-btn-default">--}}
                                {{--<b style="color:orangered;">清空表</b>--}}
                            {{--</button>--}}
                        {{--</a>--}}
                        {{--@endif--}}
                    </div>
                </div>
            </div>
            <div class="am-form-group">
                <select name="genre" style="margin-right:20px;padding:5px 10px;border:1px solid lightgrey;float:right;">
                    <option value="0" {{$genre==0?'selected':''}}>所有</option>
                    <option value="2" {{$genre==2?'selected':''}}>效果定制</option>
                    <option value="1" {{$genre==1?'selected':''}}>动画定制</option>
                </select>
                <script>
                    $("select[name='genre']").change(function(){
                        var genre = $(this).val();
                        if (genre==0) {
                            window.location.href = '{{DOMAIN}}admin/provideo';
                        } else {
                            window.location.href = '{{DOMAIN}}admin/provideo/s/'+genre;
                        }
                    });
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
                        <th class="table-title">名称</th>
                        <th class="table-type">类型</th>
                        <th class="table-type">类别</th>
                        <th class="table-type">缩略图</th>
                        <th class="table-type">用户名称</th>
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
                            <a href="{{DOMAIN}}admin/proVideo/{{$data['id']}}">
                                {{$data['name']}}</a></td>
                        <td class="am-hide-sm-only">{{$data['genreName']}}</td>
                        <td class="am-hide-sm-only">{{$data['cateName']}}</td>
                        <td class="am-hide-sm-only">
                            @if($data['thumb'])<img src="{{$data['thumb']}}" width="30">@else/@endif
                        </td>
                        <td class="am-hide-sm-only">{{UserNameById($data['uid'])}}</td>
                        <td class="am-hide-sm-only">{{$data['createTime']}}</td>
                        <td class="am-hide-sm-only">
                            <div class="am-btn-toolbar">
                                <div class="am-btn-group am-btn-group-xs">
                                    <a href="{{DOMAIN}}admin/provideo/{{$data['id']}}"><button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><img src="{{PUB}}assets/images/show.png" class="icon"> 查看</button></a>
                                    <a href="{{DOMAIN}}admin/provideo/{{$data['id']}}/edit"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="{{PUB}}assets/images/edit.png" class="icon"> 编辑</button></a>
                                    <a href="javascript:;" onclick="getThumb({{$data['id']}})"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="{{PUB}}assets/images/edit.png" class="icon"> 缩略图</button></a>
                                    <a href="javascript:;" onclick="getLink({{$data['id']}})"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="{{PUB}}assets/images/edit.png" class="icon"> 视频链接</button></a>
                                    <div style="height:2px;"></div>
                                    @if($data['isshow']==1)
                                    <a href="{{DOMAIN}}admin/provideo/show/{{$data['id']}}/2"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="{{PUB}}assets/images/edit.png" class="icon"> 去显示</button></a>
                                    @else
                                    <a href="{{DOMAIN}}admin/provideo/show/{{$data['id']}}/1"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="{{PUB}}assets/images/edit.png" class="icon"> 去隐藏</button></a>
                                    @endif
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

    @include('admin.common.popup')

    <script>
        function getThumb(id){
            var name = $("input[name='name_"+id+"']").val();
            $(".pname").html(name+' 缩略图更新');
            $("#formthumb").attr('action','{{DOMAIN}}admin/provideo/thumb/'+id);
            $("#thumb").show(200);
        }
        function getLink(id){
            var name = $("input[name='name_"+id+"']").val();
            $(".pname").html(name+' 视频链接更新');
            $("#formlink").attr('action','{{DOMAIN}}admin/provideo/link/'+id);
            $("#link").show(200);
        }
        function getClose(){ $('.popup').hide(200); }
    </script>
@stop