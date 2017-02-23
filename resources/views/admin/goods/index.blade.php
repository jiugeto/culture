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
                            <select name="genre" onchange="getSel()">
                                <option value="0" {{ $genre==0 ? 'selected' : '' }}>所有</option>
                                @foreach($model['genres'] as $k=>$vgenre)
                                    <option value="{{ $k }}" {{ $genre==$k ? 'selected' : '' }}>{{ $vgenre }}</option>
                                @endforeach
                            </select>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            样片类型
                            <select name="cate" onchange="getSel()">
                                <option value="0" {{ $cate==0 ? 'selected' : '' }}>所有</option>
                                @foreach($model['cates'] as $k=>$vcate)
                                    <option value="{{ $k }}" {{ $cate==$k ? 'selected' : '' }}>{{ $vcate }}</option>
                                @endforeach
                            </select>
                            <script>
                                function getSel() {
                                    var genre = $("select[name='genre']").val();
                                    var cate = $("select[name='cate']").val();
                                    if(genre==0 && cate==0){
                                        window.location.href = '{{DOMAIN}}admin/goods';
                                    } else {
                                        window.location.href = '{{DOMAIN}}admin/goods/s/'+genre+'/'+cate;
                                    }
                                }
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
                        <th class="table-type">供应方</th>
                        <th class="table-type">类型</th>
                        <th class="table-type">缩略图</th>
                        <th class="table-type">视频链接</th>
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
                        <td class="am-hide-sm-only"><a href="{{DOMAIN}}admin/goods/{{$data['id']}}">
                                {{str_limit($data['name'],10)}}</a></td>
                        <td class="am-hide-sm-only">{{$data['genreName']}}</td>
                        <td class="am-hide-sm-only">{{$data['cateName']}}</td>
                        <td class="am-hide-sm-only">
                            @if($data['thumb'])<img src="{{$data['thumb']}}" width="30">@else/@endif
                        </td>
                        <td class="am-hide-sm-only">{{($data['linkType']&&$data['link'])?'有':'无'}}</td>
                        <td class="am-hide-sm-only">{{$data['createTime']}}</td>
                        <td class="am-hide-sm-only">
                            <div class="am-btn-toolbar">
                                <div class="am-btn-group am-btn-group-xs">
                                    <a href="{{DOMAIN}}admin/goods/{{$data['id']}}"><button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><img src="{{PUB}}assets/images/show.png" class="icon"> 查看</button></a>
                                {{--@if($crumb['']['url']=='')--}}
                                    <a href="{{DOMAIN}}admin/goods/{{$data['id']}}/edit"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="{{PUB}}assets/images/edit.png" class="icon"> 编辑</button></a>
                                    <a href="javascript:;" onclick="getThumb({{$data['id']}})"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="{{PUB}}assets/images/edit.png" class="icon"> 缩略图</button></a>
                                    <a href="javascript:;" onclick="getLink({{$data['id']}})"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="{{PUB}}assets/images/edit.png" class="icon"> 视频链接</button></a>
                                    <div style="height:2px;"></div>
                                    @if($data['isshow']==1)
                                    <a href="{{DOMAIN}}admin/goods/setshow/{{$data['id']}}/2"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="{{PUB}}assets/images/edit.png" class="icon"> 去显示</button></a>
                                    @else
                                    <a href="{{DOMAIN}}admin/goods/setshow/{{$data['id']}}/1"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="{{PUB}}assets/images/edit.png" class="icon"> 去隐藏</button></a>
                                    @endif
                                    {{--<a href="{{DOMAIN}}admin/function/{{$data->id}}/forceDelete"><button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><img src="{{PUB}}assets/images/del_red.png" class="icon"> 放入回收站</button></a>--}}
                                {{--@endif--}}
                                {{--@if($crumb['trash']['url']=='trash')--}}
                                    {{--<a href="{{DOMAIN}}admin/function/{{$data->id}}/restore"><button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><img src="{{PUB}}assets/images/forceDelete_red.png" class="icon"> 还原</button></a>--}}
                                    {{--<a href="{{DOMAIN}}admin/function/{{$data->id}}/forceDelete"><button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><img src="{{PUB}}assets/images/forceDelete_red.png" class="icon"> 销毁记录</button></a>--}}
                                {{--@endif--}}
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
            $("#formthumb").attr('action','{{DOMAIN}}admin/goods/thumb/'+id);
            $("#thumb").show(200);
        }
        function getLink(id){
            var name = $("input[name='name_"+id+"']").val();
            $(".pname").html(name+' 视频链接更新');
            $("#formlink").attr('action','{{DOMAIN}}admin/goods/link/'+id);
            $("#link").show(200);
        }
        function getClose(){ $('.popup').hide(200); }
    </script>
@stop