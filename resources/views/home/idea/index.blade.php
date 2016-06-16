@extends('home.main')
@section('content')
    @include('home.common.crumb')
    <style>
        .small a { cursor:pointer; }
    </style>

    <div class="opinion_con">
        <div class="opinion_list">
            {{--<p class="cate">大分类：</p>--}}
            <p class="cate">
                @if($cates)
                @foreach($cates as $cate)
                    {{ $cate->name }}：
                    @if($cate->child)
                        @foreach($cate->child as $subcate)
                            <a href="{{ $subcate->id }}">{{ $subcate->name }}</a>
                        @endforeach
                    @endif <br>
                @endforeach
                @endif
            </p>
            {{--<table class="idea">--}}
                {{--<tr>--}}
                    {{--<td rowspan="3" class="img"><div><img src="/uploads/images/2016/online1.png"></div></td>--}}
                    {{--<td><a href=""><b>创意标题：让他发给你哈</b></a><span class="right">浏览量</span></td>--}}
                {{--</tr>--}}
                {{--<tr><td class="con">创意内容：个人部分人共同发布不太好听任何人挺好呢个人部分人共同发布不太好听任何人挺好呢个人部分人共同发布不太好听任何人挺好呢个人部分人共同发布不太好听任何人挺好呢个人部分人共同发布不太好听任何人挺好呢个人部分人共同发布不太好听任何人挺好呢个人部分人共同发布不太好听任何人挺好呢</td></tr>--}}
                {{--<tr><td class="small">关注标签：<span class="right">时间</span></td></tr>--}}
            {{--</table>--}}
            @if($datas->total())
            @foreach($datas as $data)
            <table class="idea">
                <tr>
                    <td rowspan="3" class="img"><div><img src="/uploads/images/2016/online1.png"></div></td>
                    <td>
                        <a href="/idea/{{$data->id}}"><b>{{ $data->name }}</b></a>
                        <span class="right">{{ count($data->read($userid)) }}</span>
                        <span class="right"><a href="/idea/{{$data->id}}">查看</a></span>
                    </td>
                </tr>
                <tr><td class="con">{{ $data->intro }}</td></tr>
                <tr>
                    <td class="small">
                        <input type="hidden" name="userid" value="{{ $userid }}">
                        <input type="hidden" name="uid" value="{{ $data->uid }}">
                        <input type="hidden" name="id" value="{{ $data->id }}">
                        <a id="click" style="display:{{ !$data->click($userid) ? 'block' : 'none' }};">关注：{{ $data->click($userid) }}</a>
                        <a id="noclick" style="display:{{ $data->click($userid) ? 'block' : 'none' }};">取消关注：{{ $data->click($userid) }}</a>
                        <a id="collect" style="display:{{ !$data->collect($userid) ? 'block' : 'none' }};">收藏：{{ $data->collect($userid) }}</a>
                        <a id="nocollect" style="display:{{ $data->collect($userid) ? 'block' : 'none' }};">取消收藏：{{ $data->collect($userid) }}</a>
                        <span class="right">时间：{{ $data->created_at }}&nbsp;&nbsp;发布人：{{ $data->uid }}</span>
                    </td>
                </tr>
            </table>
            @endforeach
            @endif
            @include('home.common.page')
        </div>
    </div>

    <script>
        $(document).ready(function(){
            var userid = $("input[name='userid']").val();
            var uid = $("input[name='uid']").val();
            var id = $("input[name='id']").val();
            $("#click").click(function(){
                if(userid==uid){ alert("不能关注自己的创意 !"); return; }
                window.location.href = '/idea/click/'+id+'/1';
            });
            $("#noclick").click(function(){
//                if(userid==uid){ alert("不能关注自己的创意 !"); return; }
                window.location.href = '/idea/click/'+id+'/0';
            });
            $("#collect").click(function(){
                if(userid==uid){ alert("不能收藏自己的创意 !"); return; }
                window.location.href = '/idea/collect/'+id+'/1';
            });
            $("#nocollect").click(function(){
//                if(userid==uid){ alert("不能关注自己的创意 !"); return; }
                window.location.href = '/idea/collect/'+id+'/0';
            });
        });
    </script>
@stop