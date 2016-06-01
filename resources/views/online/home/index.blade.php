@extends('online.main')
@section('content')
    {{--内页的样式方便调节动画--}}
    {{--<link rel="stylesheet" href="/assets-home/css/online.css">--}}
    <style>
        .animate { font-family:"微软雅黑"; }
        @if(count($attrs))
        @foreach($attrs as $attrs0)
        /*一级属性样式：.attr*/
            {{'.'.$attrs0->style_name.' {'}}
            @if($attr=$attrs0->attrs())
            @if($attr['switch'])
                @if($attr['ismargin']==1)@elseif($attr['ismargin']==2){{'margin:'.$attr['margin1'].' '.$attr['margin2'].';'}}@elseif($attr['ismargin']==3){{'margin:'.$attr['margin1'].' '.$attr['margin2'].'px;'}}@elseif($attr['ismargin']==4){{'margin:'.$attr['margin1'].'px '.$attr['margin2'].';'}}@elseif($attr['ismargin']==5){{'margin:'.$attr['margin3'].'px '.$attr['margin4'].'px '.$attr['margin5'].'px '.$attr['margin6'].'px;'}}@endif
                @if($attr['ispadding']==1)@elseif($attr['ispadding']==2){{'padding:'.$attr['padding1'].' '.$attr['padding2'].';'}}@elseif($attr['ispadding']==3){{'padding:'.$attr['padding1'].' '.$attr['padding2'].'px;'}}@elseif($attr['ispadding']==4){{'padding:'.$attr['padding1'].'px '.$attr['padding2'].';'}}@elseif($attr['ispadding']==5){{'padding:'.$attr['padding3'].'px '.$attr['padding4'].'px '.$attr['padding5'].'px '.$attr['padding6'].'px;'}}@endif
                @if($attr['width']!=''){{'width:'.$attr['width'].'px;'}}@endif
                @if($attr['height']!=''){{'height:'.$attr['height'].'px;'}}@endif
                @if($attr['position']==4){{'position:'.$attrModel->positionType($attr['position']).';'}}{{$attr['left']?'left:'.$attr['left'].'px;':''}}{{$attr['top']?'top:'.$attr['top'].'px;':''}}@endif
                @if($attr['border1']){{'border'}}{{in_array($attr['border1'],[1,2,3,4])?'-'.$attrModel->borderDirection($attr['border1']):''}}{{':'.$attr['border2'].'px '.$attrModel->borderType($attr['border3']).' '.$attr['border4'].';'}}@endif
                @if($attr['iscolor']){{'color:'.$attr['color'].';'}}@endif
                @if($attr['isbackground']){{'background:'.$attr['background'].';'}}@endif
                @if(isset($attr['float'])&&$attr['float']){{'float:'.$attrModel->floatType($attr['float']).';'}}@endif
                @if($attr['font_size']!=''){{'font-size:'.$attr['font_size'].'px;'}}@endif
                @if($attr['text_align']){{'text-align:'.$attrModel->textAlign($attr['text_align']).';'}}@endif
                @if($attr['overflow']){{'overflow:'.$attrModel->overflow($attr['overflow']).';'}}@endif
                @if($attr['opacity']!=''){{'opacity:'.$attr['opacity']/100 . '%;'}}@endif
            @endif
            @endif
            {{'}'}}
        /*================================*/

        /*二级属性样式：.attr div.pos*/
            {{'.'.$attrs0->style_name.' div.pos {'}}
            @if($attr2=$attrs0->attrs2())
            @if($attr2['switch2'])
                @if($attr2['ismargin']==1)@elseif($attr2['ismargin']==2){{'margin:'.$attr2['margin1'].' '.$attr2['margin2'].';'}}@elseif($attr2['ismargin']==3){{'margin:'.$attr2['margin1'].' '.$attr2['margin2'].'px;'}}@elseif($attr2['ismargin']==4){{'margin:'.$attr2['margin1'].'px '.$attr2['margin2'].';'}}@elseif($attr2['ismargin']==5){{'margin:'.$attr2['margin3'].'px '.$attr2['margin4'].'px '.$attr2['margin5'].'px '.$attr2['margin6'].'px;'}}@endif
                @if($attr2['ispadding']==1)@elseif($attr2['ispadding']==2){{'padding:'.$attr2['padding1'].' '.$attr2['padding2'].';'}}@elseif($attr2['ispadding']==3){{'padding:'.$attr2['padding1'].' '.$attr2['padding2'].'px;'}}@elseif($attr2['ispadding']==4){{'padding:'.$attr2['padding1'].'px '.$attr2['padding2'].';'}}@elseif($attr2['ispadding']==5){{'padding:'.$attr2['padding3'].'px '.$attr2['padding4'].'px '.$attr2['padding5'].'px '.$attr2['padding6'].'px;'}}@endif
                @if($attr2['width']!=''){{'width:'.$attr2['width'].'px;'}}@endif
                @if($attr2['height']!=''){{'height:'.$attr2['height'].'px;'}}@endif
                @if($attr2['position']==4){{'position:'.$attrModel->positionType($attr2['position']).';'}}{{$attr2['left']?'left:'.$attr2['left'].'px;':''}}{{$attr2['top']?'top:'.$attr2['top'].'px;':''}}@endif
                @if($attr2['border1']){{'border'}}{{in_array($attr2['border1'],[1,2,3,4])?'-'.$attrModel->borderDirection($attr2['border1']):''}}{{':'.$attr2['border2'].'px '.$attrModel->borderType($attr2['border3']).' '.$attr2['border4'].';'}}@endif
                @if($attr2['iscolor']){{'color:'.$attr2['color'].';'}}@endif
                @if($attr2['isbackground']){{'background:'.$attr2['background'].';'}}@endif
                @if(isset($attr2['float'])&&$attr2['float']){{'float:'.$attrModel->floatType($attr2['float']).';'}}@endif
                @if($attr2['font_size']!=''){{'font-size:'.$attr2['font_size'].'px;'}}@endif
                @if($attr2['text_align']){{'text-align:'.$attrModel->textAlign($attr2['text_align']).';'}}@endif
                @if($attr2['overflow']){{'overflow:'.$attrModel->overflow($attr2['overflow']).';'}}@endif
                @if($attr2['opacity']!=''){{'opacity:'.$attr2['opacity']/100 . '%;'}}@endif
            @endif
            @endif
            {{'}'}}
        /*================================*/

        /*三级属性样式：.attr div.dh*/
            {{'.'.$attrs0->style_name.' div.dh {'}}
            @if($attr3=$attrs0->attrs3())
            @if($attr3['switch3'])
                @if($attr3['ismargin']==1)@elseif($attr3['ismargin']==2){{'margin:'.$attr3['margin1'].' '.$attr3['margin2'].';'}}@elseif($attr3['ismargin']==3){{'margin:'.$attr3['margin1'].' '.$attr3['margin2'].'px;'}}@elseif($attr3['ismargin']==4){{'margin:'.$attr3['margin1'].'px '.$attr3['margin2'].';'}}@elseif($attr3['ismargin']==5){{'margin:'.$attr3['margin3'].'px '.$attr3['margin4'].'px '.$attr3['margin5'].'px '.$attr3['margin6'].'px;'}}@endif
                @if($attr3['ispadding']==1)@elseif($attr3['ispadding']==2){{'padding:'.$attr3['padding1'].' '.$attr3['padding2'].';'}}@elseif($attr3['ispadding']==3){{'padding:'.$attr3['padding1'].' '.$attr3['padding2'].'px;'}}@elseif($attr3['ispadding']==4){{'padding:'.$attr3['padding1'].'px '.$attr3['padding2'].';'}}@elseif($attr3['ispadding']==5){{'padding:'.$attr3['padding3'].'px '.$attr3['padding4'].'px '.$attr3['padding5'].'px '.$attr3['padding6'].'px;'}}@endif
                @if($attr3['width']!=''){{'width:'.$attr3['width'].'px;'}}@endif
                @if($attr3['height']!=''){{'height:'.$attr3['height'].'px;'}}@endif
                @if($attr3['position']==4){{'position:'.$attrModel->positionType($attr3['position']).';'}}{{$attr3['left']?'left:'.$attr3['left'].'px;':''}}{{$attr3['top']?'top:'.$attr3['top'].'px;':''}}@endif
                @if($attr3['border1']){{'border'}}{{in_array($attr3['border1'],[1,2,3,4])?'-'.$attrModel->borderDirection($attr3['border1']):''}}{{':'.$attr3['border2'].'px '.$attrModel->borderType($attr3['border3']).' '.$attr3['border4'].';'}}@endif
                @if($attr3['iscolor']){{'color:'.$attr3['color'].';'}}@endif
                @if($attr3['isbackground']){{'background:'.$attr3['background'].';'}}@endif
                @if(isset($attr3['float'])&&$attr3['float']){{'float:'.$attrModel->floatType($attr3['float']).';'}}@endif
                @if($attr3['font_size']!=''){{'font-size:'.$attr3['font_size'].'px;'}}@endif
                @if($attr3['text_align']){{'text-align:'.$attrModel->textAlign($attr3['text_align']).';'}}@endif
                @if($attr3['overflow']){{'overflow:'.$attrModel->overflow($attr3['overflow']).';'}}@endif
                @if($attr3['opacity']!=''){{'opacity:'.$attr3['opacity']/100 . '%;'}}@endif
            @endif
            @endif
            {{'}'}}
        /*================================*/

        /*图片属性样式：.attr img*/
            {{'.'.$attrs0->style_name.' div.pos img {'}}
            @if($pics=$attrs0->picAttr())
            @if($pics['switch4'])
                @if($pics['ismargin']==1)@elseif($pics['ismargin']==2){{'margin:'.$pics['margin1'].' '.$pics['margin2'].';'}}@elseif($pics['ismargin']==3){{'margin:'.$pics['margin1'].' '.$pics['margin2'].'px;'}}@elseif($pics['ismargin']==4){{'margin:'.$pics['margin1'].'px '.$pics['margin2'].';'}}@elseif($pics['ismargin']==5){{'margin:'.$pics['margin3'].'px '.$pics['margin4'].'px '.$pics['margin5'].'px '.$pics['margin6'].'px;'}}@endif
                @if($pics['ispadding']==1)@elseif($pics['ispadding']==2){{'padding:'.$pics['padding1'].' '.$pics['padding2'].';'}}@elseif($pics['ispadding']==3){{'padding:'.$pics['padding1'].' '.$pics['padding2'].'px;'}}@elseif($pics['ispadding']==4){{'padding:'.$pics['padding1'].'px '.$pics['padding2'].';'}}@elseif($pics['ispadding']==5){{'padding:'.$pics['padding3'].'px '.$pics['padding4'].'px '.$pics['padding5'].'px '.$pics['padding6'].'px;'}}@endif
                @if($pics['width']!=''){{'width:'.$pics['width'].'px;'}}@endif
                @if($pics['height']!=''){{'height:'.$pics['height'].'px;'}}@endif
                @if($pics['position']==4){{'position:'.$attrModel->positionType($pics['position']).';'}}{{$pics['left']?'left:'.$pics['left'].'px;':''}}{{$pics['top']?'top:'.$pics['top'].'px;':''}}@endif
                @if($pics['border1']){{'border'}}{{in_array($pics['border1'],[1,2,3,4])?'-'.$attrModel->borderDirection($pics['border1']):''}}{{':'.$pics['border2'].'px '.$attrModel->borderType($pics['border3']).' '.$pics['border4'].';'}}@endif
                @if(isset($pics['float'])&&$pics['float']){{'float:'.$attrModel->floatType($pics['float']).';'}}@endif
                @if($pics['overflow']){{'overflow:'.$attrModel->overflow($pics['overflow']).';'}}@endif
                @if($pics['opacity']!=''){{'opacity:'.$pics['opacity']/100 . '%;'}}@endif
            @endif
            @endif
            {{'}'}}
        /*================================*/

        /*文字属性样式：.attr text*/
            {{'.'.$attrs0->style_name.' div.pos .text {'}}
            @if($texts=$attrs0->textAttr())
            @if($texts['switch5'])
                @if($texts['ismargin']==1)@elseif($texts['ismargin']==2){{'margin:'.$texts['margin1'].' '.$texts['margin2'].';'}}@elseif($texts['ismargin']==3){{'margin:'.$texts['margin1'].' '.$texts['margin2'].'px;'}}@elseif($texts['ismargin']==4){{'margin:'.$texts['margin1'].'px '.$texts['margin2'].';'}}@elseif($texts['ismargin']==5){{'margin:'.$texts['margin3'].'px '.$texts['margin4'].'px '.$texts['margin5'].'px '.$texts['margin6'].'px;'}}@endif
                @if($texts['ispadding']==1)@elseif($texts['ispadding']==2){{'padding:'.$texts['padding1'].' '.$texts['padding2'].';'}}@elseif($attr2['ispadding']==3){{'padding:'.$texts['padding1'].' '.$texts['padding2'].'px;'}}@elseif($texts['ispadding']==4){{'padding:'.$texts['padding1'].'px '.$texts['padding2'].';'}}@elseif($texts['ispadding']==5){{'padding:'.$texts['padding3'].'px '.$texts['padding4'].'px '.$texts['padding5'].'px '.$texts['padding6'].'px;'}}@endif
                @if($texts['width']!=''){{'width:'.$texts['width'].'px;'}}@endif
                @if($texts['height']!=''){{'height:'.$texts['height'].'px;'}}@endif
                @if($texts['position']==4){{'position:'.$attrModel->positionType($text['position']).';'}}{{$texts['left']?'left:'.$texts['left'].'px;':''}}{{$texts['top']?'top:'.$texts['top'].'px;':''}}@endif
                @if($texts['border1']){{'border'}}{{in_array($texts['border1'],[1,2,3,4])?'-'.$attrModel->borderDirection($texts['border1']):''}}{{':'.$texts['border2'].'px '.$attrModel->borderType($texts['border3']).' '.$texts['border4'].';'}}@endif
                @if($texts['iscolor']){{'color:'.$texts['color'].';'}}@endif
                @if($texts['isbackground']){{'background:'.$texts['background'].';'}}@endif
                @if(isset($texts['float'])&&$texts['float']){{'float:'.$attrModel->floatType($texts['float']).';'}}@endif
                @if($texts['font_size']!=''){{'font-size:'.$texts['font_size'].'px;'}}@endif
                @if($texts['text_align']){{'text-align:'.$attrModel->textAlign($texts['text_align']).';'}}@endif
                @if($texts['overflow']){{'overflow:'.$attrModel->overflow($texts['overflow']).';'}}@endif
                @if($texts['opacity']!=''){{'opacity:'.$texts['opacity']/100 . '%;'}}@endif
            @endif
            @endif
            {{'}'}}
        @endforeach
    @endif
        /*================================*/
        .timeline { margin-bottom:5px; width:980px; height:5px; overflow:hidden; }
        .timeline div.dh { width:980px; height:2px; background:red; }

        {{--动画样式--}}
        /*动画的代码开始：定义动画时间*/
        @if(count($attrs))
        @foreach($attrs as $attrs0)
            @if($attrs0->layers())
            @foreach($attrs0->layers() as $layer)
        {{'.'.$attrs0->style_name}} div.dh {
            animation-name:{{ $layer->animation_name }};
            {{--animation-play-state:{{ $layerModel->getState($layer->state) }};--}}
            animation-play-state:paused;
            animation-duration:{{ $layer->duration }}s;
            animation-timing-function:{{ $layerModel->getFunc($layer->function) }};
            animation-delay:{{ $layer->delay }}s;
            animation-iteration-count:{{ $layer->count }};
            animation-fill-mode:{{ $layerModel->getMode($layer->mode) }};
        }
            @endforeach
            @endif
        @endforeach
        @endif
        /*时间线进度条*/
        .timeline div.dh {
            animation-name:timeline;
            animation-play-state:paused;
            {{--animation-duration:{{ $attrs[count($attrs)-1]->delay+$attrs[count($attrs)-1]->duration }}s;--}}
            animation-duration:2s;
            animation-timing-function:linear;
            animation-delay:0s;
            animation-fill-mode:forwards;
        }

        /*动画的代码开始*/
        @if(count($attrs))
        @foreach($attrs as $attrs0)
            @if($attrs0->layers())
            @foreach($attrs0->layers() as $layer)
            {{ '@keyframes '.$layer->animation_name }}
            {{ '{' }}
                @if($layerAttrs=$layerModel->getLayerAttrs($layer->productid,$layer->attrid,$layer->id))
                @foreach($layerAttrs as $layerAttr)
                {{ $layerAttr->per.'% { '.$layerAttrModel->getLayerAttr($layerAttr->attrSel).':'}}@if($layerAttr->attrSel==10){{$layerAttr->val/100}}@else{{$layerAttr->val}}@endif{{ '; }' }}
                @endforeach
                @endif
            {{ '}' }}
            @endforeach
            @endif
        @endforeach
        @endif
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
                @if($attr->cons())
                @foreach($attr->cons() as $con)
                <div class="pos">
                    <div class="dh">
                        @if($con->genre==1)
                            <img src="{{ $conModel->getPicUrl($con->pic_id) }}">
                        @elseif($con->genre==2)
                            <div class="text">{{ $con->name }}</div>
                        @endif
                    </div>
                </div>
                @endforeach
                @endif
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