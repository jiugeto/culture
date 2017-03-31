@extends('company.admin.main')
@section('content')
    @include('company.admin.common.crumb')

    <div class="com_admin_list">
        <div class="search_type">
            分类：
            <select name="cate">
                <option value="0" {{$cate==0?'selected':''}}>所有</option>
                @foreach($model['cates'] as $k=>$vcate)
                    <option value="{{$k}}" {{$cate==$k?'selected':''}}>{{$vcate}}</option>
                @endforeach
            </select>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <span class="create_right">
                <a href="{{DOMAIN_C_BACK}}product/create" class="list_btn">发布产品</a>
            </span>
            <input type="hidden" name="func_url" value="{{$lists['func']['url']}}">
        </div>
        <table cellspacing="0">
            <tr>
                <td>序号</td>
                <td>产品名称</td>
                <td>预览图</td>
                <td>产品类型</td>
                <td>前台是否显示</td>
                <td width="150">创建时间</td>
                <td>操作</td>
            </tr>
            <tr><td colspan="10"></td></tr>
            @if(count($datas))
                @foreach($datas as $data)
            <tr>
                <td>{{$data['id']}}</td>
                <td><a href="{{DOMAIN_C_BACK}}product/{{$data['id']}}" class="list_a">
                        {{$data['name']?$data['name']:'默认'}}</a></td>
                <td><img src="{{$data['thumb']}}" width="30"></td>
                <td>{{$data['cateName']}}</td>
                <td>{{$data['isshowName']}}</td>
                <td>{{$data['createTime']}}</td>
                <td>
                    <a href="{{DOMAIN_C_BACK}}product/{{$data['id']}}" class="list_btn">查看</a>
                    <a href="{{DOMAIN_C_BACK}}product/{{$data['id']}}/edit" class="list_btn">编辑</a>
                    <div style="height:10px;"></div>
                    <a href="javascript:;" class="list_btn" onclick="getThumb({{$data['id']}})">缩略图</a>
                    <a href="javascript:;" class="list_btn" onclick="getLink({{$data['id']}})">视频链接</a>
                    <input type="hidden" name="pname_{{$data['id']}}" value="{{$data['name']}}">
                    {{--<a href="{{DOMAIN}}product/video/{{ $data['id'] }}/{{ $data['video_id'] }}" target="_blank" class="list_btn">预览</a>--}}
                </td>
            </tr>
                @endforeach
            @else <tr><td colspan="10" style="text-align:center">没有记录</td></tr>
            @endif
        </table>
        @include('company.admin.common.page2')
    </div>

    @include('company.admin.common.popup')

    <script>
        $("select[name='cate']").change(function(){
            var func_url = $("input[name='func_url']").val();
            if ($(this).val()==0) {
                window.location.href = '{{DOMAIN_C_BACK}}'+func_url;
            } else {
                window.location.href = '{{DOMAIN_C_BACK}}'+func_url+'/s/'+$(this).val();
            }
        });
        function getThumb(id){
            var name = $("input[name='pname_"+id+"']").val();
            $(".pname").html(name+" 缩略图更新");
            $("#formthumb").attr('action','{{DOMAIN_C_BACK}}product/thumb/'+id);
            $("#thumb").show();
        }
        function getLink(id){
            var name = $("input[name='pname_"+id+"']").val();
            $(".pname").html(name+" 视频链接更新");
            $("#formlink").attr('action','{{DOMAIN_C_BACK}}product/link/'+id);
            $("#link").show();
        }
    </script>
@stop