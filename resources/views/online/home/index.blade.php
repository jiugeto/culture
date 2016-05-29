@extends('online.main')
@section('content')
    {{--内页的样式方便调节动画--}}
    {{--<link rel="stylesheet" href="/assets-home/css/online.css">--}}
    <style>
        @if(count($attrs))
        @foreach($attrs as $attrs0)
            /*一级属性样式：.attr*/
            {{'.'.$attrs0->style_name.' {'}}
            @if($attr=$attrs0->attrs() && $attr['switch'])
                @if($attr['ismargin']==1)@elseif($attr['ismargin']==2){{'margin:'.$attr['margin1'].' '.$attr['margin2'].';'}}@elseif($attr['ismargin']==3){{'margin:'.$attr['margin1'].' '.$attr['margin2'].'px;'}}@elseif($attr['ismargin']==4){{'margin:'.$attr['margin1'].'px '.$attr['margin2'].';'}}@elseif($attr['ismargin']==5){{'margin:'.$attr['margin3'].'px '.$attr['margin4'].'px '.$attr['margin5'].'px '.$attr['margin6'].'px;'}}@endif
                @if($attr['ispadding']==1)@elseif($attr['ispadding']==2){{'padding:'.$attr['padding1'].' '.$attr['padding2'].';'}}@elseif($attr['ispaddingpadding']==3){{'padding:'.$attr['padding1'].' '.$attr['padding2'].'px;'}}@elseif($attr['ispadding']==4){{'padding:'.$attr['padding1'].'px '.$attr['padding2'].';'}}@elseif($attr['ispadding']==5){{'padding:'.$attr['padding3'].'px '.$attr['padding4'].'px '.$attr['padding5'].'px '.$attr['padding6'].'px;'}}@endif
                @if($attr['width']){{'width:'.$attr['width'].'px;'}}@endif
                @if($attr['height']){{'height:'.$attr['height'].'px;'}}@endif
                @if($attr['position']==4){{$attr['left']?'left:'.$attr['left'].'px;':''}}{{$attr['top']?'top:'.$attr['top'].'px;':''}}@endif
            @endif
            {{'}'}}
            /*二级属性样式：.attr div.pos*/
            {{'.'.$attrs0->style_name.' {'}}
            @if($attr2=$attrs0->attrs2() && $attr2['switch2'])
            @endif
            {{'{'}}
            /*三级属性样式：.attr div.dh*/
            /*图片属性样式：.attr img*/
            /*文字属性样式：.attr text*/
        @endforeach
        @endif
        /*================================*/
        .timeline { margin-bottom:5px; width:980px; height:5px; overflow:hidden; }
        .timeline div.dh { width:980px; height:2px; background:red; }

        {{--动画样式--}}
        /*动画的代码开始：定义动画时间*/
        /*时间线进度条*/

        /*动画的代码开始*/

        /*时间线进度条*/
        @keyframes timeline
        {
            from { left:-980px; }
            to { left:0px; }
        }
    </style>

    {{--  在线创建窗口 --}}
    <div class="online_win">
        <div class="animate">
            {{--动画开始--}}
            @if(count($attrs))
                @foreach($attrs as $attr)
                <div class="{{ $attr->style_name }}">
                    {{--动画开始--}}
                    <div class="pos">
                        <div class="dh"><img src="/uploads/images/2016/ppt.png"></div>
                    </div>
                </div>
                @endforeach
            @endif
            {{--动画结束--}}
        </div>
    </div>
    <div class="switch">
        <div class="timeline"><div class="dh" id="timeline">{{--时间线进度条--}}</div></div>
        <a id="play" title="暂停后播放"><button class="onlinebtn">播放</button></a>
        <a id="stop"><button class="onlinebtn">暂停</button></a>
        <a href="/online" title="退回到原始状态"><button class="onlinebtn">重置</button></a>
        <a href="/online/restart" title="直接播放"><button class="onlinebtn">重播</button></a>
        <a id="menu"><button class="onlinebtn">菜单</button></a>
        <a href="/online/{{$data->id}}/frame" title="编辑属性和内容"><button class="onlinebtn">编辑</button></a>
    </div>
    <div class="menus"></div>

    <script>
        $(document).ready(function(){
            var dh = $(".dh");
            $("#play").click(function(){
                dh.css('animation-play-state','running');
            });
            $("#stop").click(function(){
                dh.css('animation-play-state','paused');
            });
        });
    </script>
@stop