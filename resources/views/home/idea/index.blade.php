@extends('home.main')
@section('content')
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
                        {{--<span class="right">浏览量</span>--}}
                        <span class="right">{{ count($data->read()) }}</span>
                        <span class="right"><a href="/idea/{{$data->id}}">查看</a></span>
                    </td>
                </tr>
                <tr><td class="con">{!! $data->content !!}</td></tr>
                <tr>
                    <td class="small">
                        <a href="/idea/click/{{$data->id}}">关注</a>：{{ count($data->click()) }}
                        <a href="/idea/collect/{{$data->id}}">收藏</a>：{{ count($data->collect()) }}
                        <span class="right">时间：{{ $data->created_at }}&nbsp;&nbsp;发布人：{{ $data->uid }}</span>
                    </td>
                </tr>
            </table>
            @endforeach
            @endif
        </div>
    </div>
@stop