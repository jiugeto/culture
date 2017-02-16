@extends('member.main')
@section('content')
    @include('member.common.crumb')
    {{--<div class="p_style">需求类型：--}}
        {{--<a href="{{DOMAIN}}member/{{$lists['func']['url']=='goodsD'?'goodsD':'goodsS'}}">视频</a>--}}
        {{--<a href="{{DOMAIN}}member/design">设计</a>--}}
    {{--</div>--}}
    <div class="hr_tab"></div>

    <div class="mem_tab">@include('member.common.lists')</div>
    <div class="hr_tab"></div>

    <!-- 空白 -->
    <div class="list_kongbai">&nbsp;</div>
    <div class="list">
        <table class="list_tab">
            <tr>
                <td>编号</td>
                <td>需求名称</td>
                <td>分类</td>
                <td>缩略图</td>
                <td>发布人</td>
                <td>创建时间</td>
                <td>操作</td>
            </tr>
        @if(count($datas))
            @foreach($datas as $data)
            <tr>
                <td>{{ $data['id'] }}</td>
                <td>{{ str_limit($data['name'],20) }}</td>
                <td>{{ $data['cateName'] }}</td>
                <td><img src="{{$data['thumb']}}" width="50"></td>
                <td>{{ $data['uname'] }}</td>
                <td>{{ $data['createTime'] }}</td>
                <td>
                    {{--<a href="{{DOMAIN}}product/video/{{ $data->id }}/{{ $data->video_id }}" target="_blank" class="list_btn">预览</a>--}}
                    <a href="{{DOMAIN}}member/goods/{{ $data['id'] }}" class="list_btn">查看</a>
                    <a href="{{DOMAIN}}member/goods/{{ $data['id'] }}/edit" class="list_btn">编辑</a>
                    <a href="javascript:;" class="list_btn" onclick="getThumb({{$data['id']}})">缩略图</a>
                    <a href="javascript:;" class="list_btn" onclick="getLink({{$data['id']}})">视频链接</a>
                    <input type="hidden" name="name_{{$data['id']}}" value="{{$data['name']}}">
                </td>
            </tr>
            @endforeach
        @else <tr><td colspan="10" style="text-align:center;">没有记录</td></tr>
        @endif
        </table>
        @include('member.common.page2')
    </div>

    <div class="tankuang" id="thumb">
        <div class="mask"></div>
        <div class="con">
            <form id="formthumb" action="" method="POST" enctype="multipart/form-data" data-am-validator>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="_method" value="POST">
                <p style="text-align:center;" class="pname">产品 缩略图更新</p>
                @include('member.common.uploadImg')
                <button type="submit" class="homebtn">立即申请</button>
            </form>
            <a title="关闭" onclick="getClose()">X</a>
        </div>
    </div>
    <div class="tankuang" id="link">
        <div class="mask"></div>
        <div class="con">
            <form id="formlink" action="" method="POST" enctype="multipart/form-data" data-am-validator>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="_method" value="POST">
                <p style="text-align:center;" class="pname">产品 视频链接更新</p>
                <p>链接类型：
                    <select name="linkType">
                        @foreach($model['linkTypes'] as $k=>$linkType)
                            <option value="{{$k}}">{{$linkType}}</option>
                        @endforeach
                    </select>
                </p>
                <p>视频链接：
                    <input type="text" name="link" placeholder="输入视频链接，可以去视频门户网复制过来">
                </p>
                <button type="submit" class="homebtn">立即更新</button>
            </form>
            <a title="关闭" onclick="getClose()">X</a>
        </div>
    </div>

    <script>
        function getThumb(id){
            var name = $("input[name='name_"+id+"']").val();
            $(".pname").html(name+' 缩略图更新');
            $("#formthumb").attr('action','{{DOMAIN}}member/goods/thumb/'+id);
            $("#thumb").show(200);
        }
        function getLink(id){
            var name = $("input[name='name_"+id+"']").val();
            $(".pname").html(name+' 视频链接更新');
            $("#formlink").attr('action','{{DOMAIN}}member/goods/link/'+id);
            $("#link").show(200);
        }
        function getClose(){ $('.tankuang').hide(200); }
    </script>
@stop