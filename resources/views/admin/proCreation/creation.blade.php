{{--创作的编辑模板--}}


<div class="admin_menu">
    <div class="content">
        <div class="title">内容栏</div>
        <div class="con">
            @if(count($cons))
                @foreach($cons as $con)
                    <div class="edit_con">
                        @if($con->id<$content->id)
                            <a href="{{DOMAIN}}admin/{{$product->id}}/creation/edit/{{$con->id}}">
                                <b>{{ $con->getName() }}</b>
                            </a>
                        @endif
                        @if($con->id==$content->id)
                            <b>{{ $con->getName() }}</b>
                            <form method="POST" id="form1" action="{{DOMAIN}}admin/{{$product->id}}/creation/editCon/{{$con->id}}" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="_method" value="POST">
                                <div class="con_one">类型：
                                    <label><input type="radio" name="genre_{{$con->id}}" value="1" {{$con->genre==1?'checked':''}} onclick="getGenre1({{$con->id}})"> 图片&nbsp;</label>
                                    <label><input type="radio" name="genre_{{$con->id}}" value="2" {{$con->genre==2?'checked':''}} onclick="getGenre2({{$con->id}})"> 文字</label>
                                </div>
                                <div class="con_one pic_{{$con->id}}" style="display:{{$con->genre==1?'block':'none'}};">图片：
                                    <select name="pic_{{$con->id}}">
                                        @if(count($pics))
                                            @foreach($pics as $pic)
                                                <option value="{{ $pic->id }}" {{ $con->pic_id==$pic->id?'selected':'' }}>{{ $pic->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="con_one text_{{$con->id}}" style="display:{{$con->genre==2?'block':'none'}};">
                                    文字：<input type="text" class="t" name="text_{{$con->id}}" value="{{ $con->name }}">
                                </div>
                                <button type="submit" class="am-btn am-btn-primary submit">保存修改</button>
                            </form>
                        @endif
                        @if($con->id>$content->id)
                            <a href="{{DOMAIN}}admin/{{$product->id}}/creation/edit/{{$con->id}}"><b>{{ $con->getName() }} 修改</b></a>
                        @endif
                    </div>
                @endforeach
            @endif

            <div class="new_con">
                <b>添 加</b>
                <form method="POST" id="form2" action="{{DOMAIN}}admin/{{$product->id}}/creation/addCon" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="con_one">类型：
                        <label><input type="radio" name="genre" value="1" checked onclick="$('.pic').show();$('.text').hide();"> 图片&nbsp;</label>
                        <label><input type="radio" name="genre" value="2" onclick="$('.text').show();$('.pic').hide();"> 文字</label>
                    </div>
                    <div class="con_one pic">图片：
                        <select name="pic">
                            @if(count($pics))
                                @foreach($pics as $pic)
                                    <option value="{{ $pic->id }}">{{ $pic->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="con_one text" style="display:none;">
                        文字：<input type="text" class="t" name="text">
                    </div>
                    <button type="submit" class="am-btn am-btn-primary submit">保存添加</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="admin_menu">
    <div class="content">
        <div class="title">属性栏</div>
        @if($attr)
            <div class="con">
                <div class="edit_con">
                    @if($attr->genre!=1)<a href="{{DOMAIN}}admin/{{$product->id}}/creation/edit/{{$con->id}}/1">@endif
                        <b>一 层</b>
                    @if($attr->genre!=1)</a>@endif
                    @if($attr->genre!=2)<a href="{{DOMAIN}}admin/{{$product->id}}/creation/edit/{{$con->id}}/2">@endif
                        <b>二 层</b>
                    @if($attr->genre!=2)</a>@endif
                    @if($attr->genre!=3)<a href="{{DOMAIN}}admin/{{$product->id}}/creation/edit/{{$con->id}}/3">@endif
                        <b>三 层</b>
                    @if($attr->genre!=3)</a>@endif
                    <br>
                    <form method="POST" id="form3" action="{{DOMAIN}}admin/{{$product->id}}/creation/editAttr/{{$attr->id}}" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="POST">
                        <div class="con_one">
                            属性名称：<input type="text" class="t" name="name" value="{{ $attr->name }}">
                        </div>
                        <div class="con_one">
                            宽：<input type="text" class="t" style="width:30px" name="width" value="{{ $attr->getWidth() }}">px，
                            高：<input type="text" class="t" style="width:30px" name="height" value="{{ $attr->getHeight() }}">px
                        </div>
                        <div class="con_one">
                            边框：
                            <select name="padType" onchange="getPadType()">
                                @foreach($attrModel['padTypes'] as $kpad=>$padType)
                                    <option value="{{ $kpad }}" {{ $attr->getPadType()==$kpad ? 'selected' : '' }}>{{ $padType }}</option>
                                @endforeach
                            </select>
                                <span class="pad pad1" style="display:{{$attr->getPadType()==1?'block':'none'}};">
                                    <br>&nbsp;&nbsp;
                                    四边：<input type="text" class="t" style="width:30px" placeholder="上" name="pad1" value="{{$attr->getPadType()==1?$attr->getPadVal2(0):''}}">px
                                </span>
                                <span class="pad pad2" style="display:{{$attr->getPadType()==2?'block':'none'}};">
                                    <br>&nbsp;&nbsp;
                                    上下：<input type="text" class="t" style="width:30px" placeholder="上" name="pad1" value="{{$attr->getPadType()==1?$attr->getPadVal2(0):''}}">，
                                    左右：<input type="text" class="t" style="width:30px" placeholder="上" name="pad1" value="{{$attr->getPadType()==1?$attr->getPadVal2(1):''}}">px
                                </span>
                                <span class="pad pad3" style="display:{{$attr->getPadType()==3?'block':'none'}};">
                                    <br>&nbsp;&nbsp;
                                    各边：
                                    <input type="text" class="t" style="width:30px" placeholder="上" name="pad1" value="{{$attr->getPadType()==1?$attr->getPadVal2(0):''}}">
                                    <input type="text" class="t" style="width:30px" placeholder="下" name="pad1" value="{{$attr->getPadType()==1?$attr->getPadVal2(1):''}}">
                                    <input type="text" class="t" style="width:30px" placeholder="左" name="pad1" value="{{$attr->getPadType()==1?$attr->getPadVal2(2):''}}">
                                    <input type="text" class="t" style="width:30px" placeholder="右" name="pad1" value="{{$attr->getPadType()==1?$attr->getPadVal2(3):''}}">px
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
                                    <input type="text" class="t" style="width:30px" name="left" value="{{ $attr->getPosLeft() }}">px
                                    <br>&nbsp;&nbsp;顶边距：
                                    <input type="text" class="t" style="width:30px" name="top" value="{{ $attr->getPosTop() }}">px
                                </span>
                        </div>
                        <div class="con_one">
                            浮动方式：
                            <select name="float">
                                @foreach($attrModel['floats'] as $kfloat=>$float)
                                    <option value="{{ $kfloat }}">{{ $float }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="con_one">
                            透明度：
                            <label><input type="radio" name="isopacity" value="0" {{ explode(',',$attr->opacity)[0]==0?'checked':'' }} onclick="$('.opacity').hide();"> 不启用&nbsp;</label>
                            <label><input type="radio" name="isopacity" value="1" {{ explode(',',$attr->opacity)[0]==1?'checked':'' }} onclick="$('.opacity').show();"> 启用&nbsp;</label>
                            <span class="opacity" style="display:{{explode(',',$attr->opacity)[0]==1?'block':'none'}};">
                                &nbsp;&nbsp;透明度：
                                <input type="text" style="width:50px;" name="opacity" value="{{ $attr->getOpacity() }}">%
                            </span>
                        </div>
                        <button type="submit" class="am-btn am-btn-primary submit">保存修改</button>
                    </form>
                </div>
            </div>
        @endif
    </div>
</div>

<script>
    function getGenre1(id){ $(".pic_"+id).show(); $(".text_"+id).hide(); }
    function getGenre2(id){ $(".text_"+id).show(); $(".pic_"+id).hide(); }
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