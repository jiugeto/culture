@extends('person.main')
@section('content')
    <div class="per_body" style="border:0;height:700px;background:0;">
        @include('person.common.top')
        <div class="per_list">
            <p class="title">皮肤设置</p>
            <div class="list" style="width:748px;height:500px">
                <div style="text-align:center;font-size:16px;"><b>顶部设置</b></div>
                <p class="user_info">顶部背景
                    {{--<a id="change_bg">更换背景</a>--}}
                </p>
                <div class="top_bg">
                    <img src="{{ $model->getUrlByPicid($data['per_top_bg_img']) }}" style="
                        @if($size=$model->getImgSize($data['per_top_bg_img'],$w=150,$h=280))
                            width:{{$size['w']}}px;height:{{$size['h']}}px;
                        @endif
                    ">
                </div>
                <div style="margin:5px 0;border-bottom:1px dashed ghostwhite;"></div>
                <p class="user_info">
                    <a id="change_bg">点击更换背景</a>
                </p>
                <div class="pic_list">
                    @if(count($pics))
                        @foreach($pics as $pic)
                    <div class="img" onclick="getImg({{ $pic->id }})"><img src="{{ $pic->url }}"></div>
                        @endforeach
                    @endif
                    <button type="button" class="companybtn" style="
                        border:0;color:orangered;background:0;position:absolute;left:590px;outline:none;
                        " onclick="$('.pic_list').hide(200)">关闭</button>
                </div>
                <div style="margin:20px auto;text-align:center;">
                    <button type="button" class="companybtn" onclick="history.go(-1);">返回上一页</button>
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