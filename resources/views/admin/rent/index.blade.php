@extends('admin.main')
@section('content')
    <div class="admin-content">
        @include('admin.common.crumb')
        <div class="am-g">
            <div class="am-u-sm-12">
                <div class="am-form-group">
                    {{--<div class="am-btn-toolbar">--}}
                    <div class="am-btn-group am-btn-group-xs">
                        <a href="{{DOMAIN}}admin/rent/create">
                            <button type="button" class="am-btn am-btn-default">
                                <img src="{{PUB}}assets/images/add.png" class="icon"> 添加
                            </button>
                        </a>
                    </div>
                    <div class="am-btn-group am-btn-group-xs list_select" style="float:right;">
                        供求
                        <select name="genre" onchange="getSel()">
                            <option value="0" {{ $genre==0 ? 'selected' : '' }}>所有</option>
                            @foreach($model['genres'] as $k=>$vgenre)
                                <option value="{{ $k }}" {{ $genre==$k ? 'selected' : '' }}>{{ $vgenre }}</option>
                            @endforeach
                        </select>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        设备类型
                        <select name="type" onchange="getSel()">
                            <option value="0" {{ $type==0 ? 'selected' : '' }}>所有</option>
                            @foreach($model['types'] as $k=>$vtype)
                                <option value="{{ $k }}" {{ $type==$k ? 'selected' : '' }}>{{ $vtype }}</option>
                            @endforeach
                        </select>
                        <script>
                            function getSel() {
                                var genre = $("select[name='genre']").val();
                                var type = $("select[name='type']").val();
                                if(genre==0 && type==0){
                                    window.location.href = '{{DOMAIN}}admin/rent';
                                } else {
                                    window.location.href = '{{DOMAIN}}admin/rent/s/'+genre+'/'+type;
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
                        <th class="table-title">设备名称</th>
                        <th class="table-type">供求类型</th>
                        <th class="table-type">设备类型</th>
                        <th class="table-type">租金(元)</th>
                        <th class="table-type">有效期</th>
                        <th class="table-type">地区</th>
                        <th class="table-author am-hide-sm-only">发布者</th>
                        <th class="table-date am-hide-sm-only">添加时间</th>
                        <th class="table-set">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                @if(count($datas))
                    @foreach($datas as $data)
                    <tr>
                        <td class="am-hide-sm-only"><input type="checkbox" /></td>
                        <td class="am-hide-sm-only">{{$data['id'] }}</td>
                        <td class="am-hide-sm-only">
                            <a href="{{DOMAIN}}admin/rent/{{$data['id']}}">{{$data['name']}}</a>
                        </td>
                        <td class="am-hide-sm-only">{{$data['genreName'] }}</td>
                        <td class="am-hide-sm-only">{{$data['typeName'] }}</td>
                        <td class="am-hide-sm-only">{{$data['money']}}</td>
                        <td class="am-hide-sm-only">
                            @if($data['fromtime']&&$data['totime'])
                                {{date('Y年m月d日',$data['fromtime'])}}<br>
                                <p style="margin:0;text-align:center;">至</p>
                                {{date('Y年m月d日',$data['fromtime'])}}
                            @else 长期
                            @endif
                        </td>
                        <td class="am-hide-sm-only">{{$data['area']?AreaNameByid($data['area']):'/'}}</td>
                        <td class="am-hide-sm-only">{{UserNameById($data['uid'])}}</td>
                        <td class="am-hide-sm-only">{{$data['createTime']}}</td>
                        <td class="am-hide-sm-only">
                            <div class="am-btn-toolbar">
                                <div class="am-btn-group am-btn-group-xs">
                                    <a href="{{DOMAIN}}admin/rent/{{$data['id']}}"><button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><img src="{{PUB}}assets/images/show.png" class="icon"> 查看</button></a>
                                    <a href="{{DOMAIN}}admin/rent/{{$data['id']}}/edit"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="{{PUB}}assets/images/edit.png" class="icon"> 编辑</button></a>
                                    <a href="javascript:;" onclick="getThumb({{$data['id']}})"><button class="am-btn am-btn-default am-btn-xs am-text-secondary"><img src="{{PUB}}assets/images/edit.png" class="icon"> 缩略图</button></a>
                                    {{--<a href="{{DOMAIN}}admin/rent/{{$data->id}}/forceDelete"><button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><img src="{{PUB}}assets/images/forceDelete_red.png" class="icon"> 销毁记录</button></a>--}}
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
            $("#formthumb").attr('action','{{DOMAIN}}admin/rent/thumb/'+id);
            $("#thumb").show(200);
        }
        function getClose(){ $('.popup').hide(200); }
    </script>
@stop