{{----}}


<div class="frame_con">
    <div class="title">2 内容栏</div>

    @if(count($cons))
        @foreach($cons as $con)
        <div class="edit_con">
            @if($con->id<$content->id)
                <a href="{{DOMAIN}}online/u/{{$product->id}}/frame/{{$layerid}}/{{$con->id}}/1">
                    <b>{{ $con->getName() }}</b>
                </a>
            @endif
            @if($con->id==$content->id)
                <b>内容2</b>
                <form method="POST" action="{{DOMAIN}}online/u/{{$product->id}}/frame/editCon/{{$con->id}}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="POST">
                    <input type="hidden" name="layerid" value="{{$layerid}}">
                    <input type="hidden" name="con_id" value="{{$con->id}}">
                    <input type="hidden" name="attrGenre" value="{{$attr->genre}}">
                    <div class="con_one">类型：
                        <label><input type="radio" class="radio" name="conGenre" value="1" {{$con->genre==1?'checked':''}} onclick="$('.conPic').show();$('.conText').hide();"> 图片&nbsp;</label>
                        <label><input type="radio" class="radio" name="conGenre" value="2" {{$con->genre==2?'checked':''}} onclick="$('.conPic').hide();$('.conText').show();"> 文字</label>
                    </div>
                    <div class="con_one conPic" style="display:{{$con->genre==1?'block':'none'}};">图片：
                        <select name="conPic">
                            @if(count($pics))
                                @foreach($pics as $pic)
                                    <option value="{{ $pic->id }}" {{ $con->pic_id==$pic->id?'selected':'' }}>
                                        {{ $pic->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="con_one conText" style="display:{{$con->genre==2?'block':'none'}};">
                        文字：<input type="text" name="conText" value="{{ $con->name }}">
                    </div>
                    <button type="submit" class="submit">保存修改</button>
                </form>
            @endif
        </div>
        @endforeach
    @endif

    <div class="edit_con">
        <b>添 加</b>
        <form method="POST" action="{{DOMAIN}}online/u/{{$product->id}}/frame/addCon" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method" value="POST">
            <input type="hidden" name="layerid" value="{{$layerid}}">
            <input type="hidden" name="con_id" value="{{$con->id}}">
            <input type="hidden" name="attrGenre" value="{{$attr->genre}}">
            <div class="con_one">类型：
                <label><input type="radio" class="radio" name="conGenre" value="1" checked onclick="$('.newPic').show();$('.newText').hide();"> 图片&nbsp;</label>
                <label><input type="radio" class="radio" name="conGenre" value="2" onclick="$('.newText').show();$('.newPic').hide();"> 文字</label>
            </div>
            <div class="con_one newPic">图片：
                <select name="conPic">
                    @if(count($pics))
                        @foreach($pics as $pic)
                            <option value="{{ $pic->id }}">{{ $pic->name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="con_one newText" style="display:none;">
                文字：<input type="text" name="conText">
            </div>
            <button type="submit" class="submit">保存添加</button>
        </form>
    </div>
</div>

<div class="frame_con">
    <div class="title">3 属性栏</div>
    <div class="edit_con">
        @if($attr->genre!=1)<a href="{{DOMAIN}}online/u/{{$product->id}}/frame/{{$layerid}}/{{$content->id}}/1">@endif
            <b>图 层</b>
            @if($attr->genre!=1)</a>@endif
        @if($attr->genre!=2)<a href="{{DOMAIN}}online/u/{{$product->id}}/frame/{{$layerid}}/{{$content->id}}/2">@endif
            <b>定 位</b>
            @if($attr->genre!=2)</a>@endif
        @if($attr->genre!=3)<a href="{{DOMAIN}}online/u/{{$product->id}}/frame/{{$layerid}}/{{$content->id}}/3">@endif
            <b>动 画</b>
            @if($attr->genre!=3)</a>@endif
        <br>
        <form method="POST" action="{{DOMAIN}}online/u/{{$product->id}}/frame/editAttr/{{$attr->id}}" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method" value="POST">
            <input type="hidden" name="layerid" value="{{$layerid}}">
            <input type="hidden" name="con_id" value="{{$con->id}}">
            <input type="hidden" name="genre" value="{{$attr->genre}}">
            @if($attr->genre==1)
                <div class="con_one">
                    属性名称：<input type="text" name="name" value="{{ $attr->name }}">
                </div>
            @endif
            <div class="con_one">
                宽：<input type="text" style="width:40px" name="width" value="{{ $attr->getWidth() }}">px，
                高：<input type="text" style="width:40px" name="height" value="{{ $attr->getHeight() }}">px
            </div>
            <div class="con_one">
                内边距：
                <select name="padType" onchange="getPadType()">
                    @foreach($attrModel['padTypes'] as $kpad=>$padType)
                        <option value="{{ $kpad }}" {{ $attr->getPadType()==$kpad ? 'selected' : '' }}>{{ $padType }}</option>
                    @endforeach
                </select>
                <span class="pad pad1" style="display:{{$attr->getPadType()==1?'block':'none'}};">
                    &nbsp;&nbsp;
                    四边：<input type="text" style="width:30px" placeholder="上" name="pad1" value="{{$attr->getPadType()==1?$attr->getPadVal2()[0]:''}}">px
                </span>
                <span class="pad pad2" style="display:{{$attr->getPadType()==2?'block':'none'}};">
                    <br>&nbsp;&nbsp;
                    上下：<input type="text" style="width:30px" placeholder="上" name="pad2" value="{{$attr->getPadType()==2?$attr->getPadVal2()[0]:''}}">，
                    左右：<input type="text" style="width:30px" placeholder="上" name="pad3" value="{{$attr->getPadType()==2?$attr->getPadVal2()[1]:''}}">px
                </span>
                <span class="pad pad3" style="display:{{$attr->getPadType()==3?'block':'none'}};">
                    <br>&nbsp;&nbsp;
                    各边：
                    <input type="text" style="width:27px" placeholder="上" name="pad4" value="{{$attr->getPadType()==3?$attr->getPadVal2()[0]:''}}"><input type="text" style="width:27px" placeholder="下" name="pad5" value="{{$attr->getPadType()==3?$attr->getPadVal2()[1]:''}}"><input type="text" style="width:27px" placeholder="左" name="pad6" value="{{$attr->getPadType()==3?$attr->getPadVal2()[2]:''}}"><input type="text" style="width:27px" placeholder="右" name="pad7" value="{{$attr->getPadType()==3?$attr->getPadVal2()[3]:''}}">px
                </span>
            </div>
            <div class="con_one">
                边框：
                <label><input type="radio" class="radio" name="isborder" value="0" {{$attr->getIsBorder()==0?'checked':''}} onclick="$('#border').hide();"> 无&nbsp;</label>
                <label><input type="radio" class="radio" name="isborder" value="1" {{$attr->getIsBorder()==1?'checked':''}} onclick="$('#border').show();"> 有&nbsp;</label>
                <span id="border" style="display:{{$attr->getIsBorder()==1?'block':'none'}};">
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size:14px;">(宽度，类型，颜色)</span>
                    <br>&nbsp;&nbsp;
                    <input type="text" style="width:30px;" placeholder="宽" name="borderText" value="{{ explode(',',$attr->border)[1] }}">
                    <select name="borderType" style="width:70px;">
                        @if(count($attrModel['borderTypeNames']))
                            @foreach($attrModel['borderTypeNames'] as $kborderType=>$vborderTypeName)
                                <option value="{{ $kborderType }}" {{ explode(',',$attr->border)[2]==$kborderType ? 'selected' : '' }}>{{ $vborderTypeName }}</option>
                            @endforeach
                        @endif
                    </select>
                    <select name="borderColor" style="width:80px;">
                        @if(count($attrModel['borderColorNames']))
                            @foreach($attrModel['borderColorNames'] as $kborderColor=>$vborderColorName)
                                <option value="{{ $kborderColor }}" {{ explode(',',$attr->border)[3]==$kborderColor ? 'selected' : '' }}>{{ $vborderColorName }}</option>
                            @endforeach
                        @endif
                    </select>
                </span>
            </div>
            <div class="con_one">
                定位：
                <select name="posType" onchange="getPosType()">
                    @foreach($attrModel['posTypes'] as $kposType=>$posType)
                        <option value="{{ $kposType }}" {{ $attr->getPosType()==$kposType?'selected':'' }}>{{ $posType }}</option>
                    @endforeach
                </select>
                <span class="pos" style="display:{{$attr->getPosType()?'block':'none'}};">
                    <br>&nbsp;&nbsp;左边距：
                    <input type="text" style="width:40px" name="left" value="{{ $attr->getPosLeft() }}">px
                    <br>&nbsp;&nbsp;顶边距：
                    <input type="text" style="width:40px" name="top" value="{{ $attr->getPosTop() }}">px
                </span>
            </div>
            <div class="con_one">
                浮动方式：
                <select name="float">
                    @foreach($attrModel['floats'] as $kfloat=>$vfloat)
                        <option value="{{ $kfloat }}" {{ $attr->float==$kfloat ? 'selected' : '' }}>{{ $vfloat }}</option>
                    @endforeach
                </select>
            </div>
            <div class="con_one">
                透明度：
                <label><input type="radio" class="radio" name="isopacity" value="0" {{ explode(',',$attr->opacity)[0]==0?'checked':'' }} onclick="$('.opacity').hide();"> 不启用&nbsp;</label>
                <label><input type="radio" class="radio" name="isopacity" value="1" {{ explode(',',$attr->opacity)[0]==1?'checked':'' }} onclick="$('.opacity').show();"> 启用&nbsp;</label>
                <span class="opacity" style="display:{{explode(',',$attr->opacity)[0]==1?'block':'none'}};">
                    &nbsp;&nbsp;透明度：
                    <input type="text" style="width:50px;" name="opacity" value="{{ $attr->getOpacity() }}">%
                </span>
            </div>
            <button type="submit" class="submit">保存修改</button>
        </form>
    </div>
</div>

<script>
    function getPadType(){
        var padType = $("select[name='padType']").val();
        if (padType!=0) {
            $(".pad").hide(); $(".pad"+padType).show();
        } else {
            $(".pad").hide();
        }
    }
    function getPosType(){
        var posType = $("select[name='posType']").val();
        if (posType==1) { $(".pos").show(); } else { $(".pos").hide(); }
    }
</script>