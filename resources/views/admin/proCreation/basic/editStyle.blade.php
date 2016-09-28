<style>
    body,div { margin:0; padding:0; }
    div#win_out { width:720px; height:405px; overflow:hidden; }
    .attr { width:720px; height:405px; position:absolute; top:0; }

    /*================================*/
    @if(count($attrs))
    @foreach($attrs as $kattr=>$vattr)
        @if($vattr->genre==1)
    {{'.'.$vattr->style_name}} div.pos {
            @if($vattr->getWidth()) width:{{$vattr->getWidth()}}px; @endif
            @if($vattr->getHeight()) height:{{$vattr->getHeight()}}px; @endif
            @if($vattr->getFloatType()) float:{{$vattr->getFloatType()}}; @endif
            @if($vattr->getIsBorder()) border:{{$vattr->getBorder()}}; @endif
            overflow:hidden;
        }
        @elseif($vattr->genre==2)
    {{'.'.$vattr->style_name}} div.dh {
            @if($vattr->getWidth()) width:{{$vattr->getWidth()}}px; @endif
            @if($vattr->getHeight()) height:{{$vattr->getHeight()}}px; @endif
            @if($vattr->getPosType()) position:relative; @endif
            @if($vattr->getPosLeft()) top:{{$vattr->getPosLeft()}}px; @endif
            @if($vattr->getPosTop()) top:{{$vattr->getPosTop()}}px; @endif
            @if($vattr->getIsBorder()) border:{{$vattr->getBorder()}}; @endif
            overflow:hidden;
        }
        @elseif($vattr->genre==3)
    {{'.'.$vattr->style_name}} img {
            @if($vattr->getHeight()) height:{{$vattr->getHeight()}}px; @endif
            @if($vattr->getIsBorder()) border:{{$vattr->getBorder()}}; @endif
        }
        @endif
    @endforeach
    @endif

    /*================================*/
    .timeline { width:720px; background:#660033; position:absolute; top:30px; }
    .timeline div.dh { width:720px; height:3px; background:red; position:relative; left:-750px; }

    {{--动画样式--}}
    /*动画的代码开始：定义动画时间*/
    @if(count($attrs))
    @foreach($attrs as $kattr=>$vattr)
        @if($vattr->genre==1)
    {{'.'.$vattr->style_name}} div.dh {
        animation-name:{{$layer->a_name}};
        animation-play-state:running;
        animation-duration:{{$layer->timelong-$layer->delay}}s;
        animation-timing-function:ease;
        animation-delay:0s;
        /*animation-iteration-count:infinite;*/
        animation-fill-mode:forwards;
    }
        @endif
    @endforeach
    @endif
    /*时间线进度条*/
    .timeline div.dh {
    animation-name:timeline;
    animation-play-state:paused;
    animation-duration:{{$layer->timelong}}s;
    animation-timing-function:linear;
    animation-delay:0s;
    animation-fill-mode:forwards;
    }

    /*动画的代码开始*/
    {{'@keyframes '.$layer->a_name}}
    {{'{'}}
        @if(count($layerAttrs))
            @foreach($layerAttrs as $layerAttr)
         {{$layerAttr->per.'% { '.$layerAttrModel['attrSels'][$layerAttr->attrSel].':'}}{{$layerAttr->attrSel==5?$layerAttr->val/100:$layerAttr->val}}@if(in_array($layerAttr->attrSel,[1,2,3,4])){{'px;'}}@elseif($layerAttr->attrSel==5){{';'}}@endif{{'}'}}
            @endforeach
        @endif
    {{'}'}}
    /*时间线进度条*/
    @keyframes timeline
    {
    from { left:-720px; }
    to { left:0px; }
    }


    /*========== 动画开关 ==========*/
    .switch { width:720px; height:35px; position:absolute; top:405px; }
    a .onlinebtn { padding:3px 0; width:50%; color:grey; border:0; font-family:'微软雅黑'; font-size:18px; background:rgb(50,10,10); cursor:pointer; float:left; }
    a:hover .onlinebtn { color:white; background:darkred; }
</style>