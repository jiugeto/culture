@extends('admin.main')
@section('content')
    <div class="admin-content">
        @include('admin.common.crumb')
        <div class="am-g">
            @include('admin.common.menu')
        </div>

        <div class="am-g">
            <div class="am-u-sm-12">
                <table class="am-table am-table-striped am-table-hover table-main">
                    <thead>
                    <tr>
                        {{--<th class="table-check"><input type="checkbox"/></th>--}}
                        <th class="table-id">ID</th>
                        <th class="table-title">广告名称</th>
                        <th class="table-title">所在广告位</th>
                        <th class="table-type">图片</th>
                        <th class="table-type">投放企业</th>
                        <th class="table-type">投放状态</th>
                        <th class="table-type">审核状态</th>
                        <th class="table-date am-hide-sm-only">创建时间</th>
                        <th class="table-set">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                @if(count($datas))
                    @foreach($datas as $data)
                    <tr>
                        {{--<td class="am-hide-sm-only"><input type="checkbox" /></td>--}}
                        <td class="am-hide-sm-only">{{$data['id']}}</td>
                        <td class="am-hide-sm-only"><a href="{{DOMAIN}}admin/ad/{{$data['id']}}">
                                {{$data['name']}}</a></td>
                        <td class="am-hide-sm-only">{{$data['adplaceName']}}</td>
                        <td class="am-hide-sm-only">
                            @if($data['img'])<img src="{{$data['img']}}" width="30">@else/@endif
                        </td>
                        <td class="am-hide-sm-only">{{UserNameById($data['uid'])}}</td>
                        <td class="am-hide-sm-only">{{$data['period']}}</td>
                        <td class="am-hide-sm-only">{{$data['isauthName']}}</td>
                        <td class="am-hide-sm-only">{{$data['createTime']}}</td>
                        <td class="am-hide-sm-only">
                            <div class="am-btn-toolbar">
                                <div class="am-btn-group am-btn-group-xs">
                                    <a href="{{DOMAIN}}admin/ad/{{$data['id']}}"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="{{PUB}}assets/images/show.png" class="icon"> 查看</button></a>
                                    <a href="{{DOMAIN}}admin/ad/{{$data['id']}}/edit"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="{{PUB}}assets/images/edit.png" class="icon"> 编辑</button></a>
                                    <a href="javascript:;" onclick="getThumb({{$data['id']}})"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="{{PUB}}assets/images/edit.png" class="icon"> 图片</button></a>
                                    @if($data['isuse']==1)
                                    <a href="{{DOMAIN}}admin/ad/use/{{$data['id']}}/2">
                                        <button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only">
                                            <span class="am-icon-ban"></span> 开启
                                        </button>
                                    </a>
                                    @else
                                    <a href="{{DOMAIN}}admin/ad/use/{{$data['id']}}/1">
                                        <button class="am-btn am-btn-default am-btn-xs am-text-success am-hide-sm-only">
                                            <span class="am-icon-play"></span> 暂停
                                        </button>
                                    </a>
                                    @endif
                                    {{--<a href="{{DOMAIN}}admin/ad/{{$data->id}}/forceDelete"><button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><img src="{{PUB}}assets/images/forceDelete_red.png" class="icon"> 销毁记录</button></a>--}}
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
            $("#formthumb").attr('action','{{DOMAIN}}admin/ad/thumb/'+id);
            $("#thumb").show(200);
        }
        function getClose(){ $('.popup').hide(200); }
    </script>
@stop