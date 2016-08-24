@extends('person.main')
@section('content')
    <div class="per_body" style="border:0;height:700px;background:0;">
        @include('person.partials.top')
        <div class="per_list">
            <p class="title">皮肤设置</p>
            <div class="list">
                <b>顶部设置</b>
                <p class="user_info">顶部背景
                    <a id="change_bg">更换背景</a>
                </p>
                <div class="top_bg"><img src="{{ $data->getTopBg() }}"></div>
                <div class="pic_list">
                    @if(count($pics))
                        @foreach($pics as $pic)
                    <div class="img" onclick="getImg({{ $pic->id }})"><img src="{{ $pic->url }}"></div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        @include('person.common.head')
    </div>

    <script>
        //显示、隐藏图片列表
        $("#change_bg").click(function(){ $(".pic_list").toggle(200); });

        //切换背景图片
        function getImg(pic_id){
            window.location.href = '{{DOMAIN}}person/skin/pic/'+pic_id;
        }
    </script>
@stop