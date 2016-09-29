{{--前台创作模板时间栏--}}

<div class="timetab">
    <div class="tabt">1 时间栏</div>
    <div class="title" style="height:{{ceil(count($layers)/5)*30}}px;">
    @if(count($layers))
        @foreach($layers as $layer)
            <a href="{{DOMAIN}}online/u/{{$product->id}}/frame/edit/{{$layer->id}}/{{$content->id}}/1">
                <div class="tab" @if($layer->id==$layerid)style="color:orangered;"@endif>
                    {{str_limit($layer->name,6)}}({{$layer->delay}}-{{$layer->delay+$layer->timelong}}s)
                </div>
            </a>
        @endforeach
    @endif
    </div>
    <div class="layerlist">
    @if(count($layers))
        @foreach($layers as $layer)
            @if($layer->id==$layerid)
            <div class="layer set">
                <form method="POST" id="formLayer" action="{{DOMAIN}}online/u/{{$product->id}}/frame/editLayer/{{$layer->id}}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="POST">
                    {{--<input type="hidden" name="layerid" value="{{$layerid}}">--}}
                    <input type="hidden" name="con_id" value="{{$content->id}}">
                    <input type="hidden" name="attrGenre" value="{{$attr->genre}}">
                    <p>设置名称：{{ str_limit($layer->name,10) }}</p>
                    <p>延迟：<input type="text" name="delay" value="{{ $layer->delay }}"> s</p>
                    <p>时长：<input type="text" name="timelong" value="{{ $layer->timelong }}"> s</p>
                    <p>
                        曲线：<select name="func">
                            @foreach($layerModel['funcNames'] as $kfunc=>$funcName)
                                <option value="{{ $kfunc }}" {{ $layer->func==$kfunc?'selected':'' }}>{{ $funcName }}</option>
                            @endforeach
                        </select>
                    </p>
                    <button type="submit" class="submit">保存修改</button>
                </form>
            </div>
            <div class="layer attr">
                {{--@if(count($layer->getLayerAttrs()))--}}
                <input type="hidden" name="productid" value="{{$product->id}}">
                <input type="hidden" name="layerid" value="{{$layerid}}">
                <input type="hidden" name="con_id" value="{{$content->id}}">
                <input type="hidden" name="attrGenre" value="{{$attr->genre}}">
                <table>
                    <tr><td colspan="2" style="font-size:12px;">下面填写说明：左边粉红是时长百分比，右边白色是值</td></tr>
                    <tr>
                        <td width="70">宽：</td>
                        <td>
                            @if(count($layer->getLayerAttrs(1)) && $layerAttrs=$layer->getLayerAttrs(1))
                                @foreach($layerAttrs as $layerAttr)
                                    <div class="keyval">
                                        <input type="text" class="left" placeholder="%" name="per_1_{{$layerAttr->id}}" value="{{ $layerAttr->per }}"><input type="text" class="right" placeholder="值" name="val_1_{{$layerAttr->id}}" value="{{ $layerAttr->val }}"><a onclick="editLayerAttr(1);">更新</a>
                                        <input type="hidden" name="layerAttrId_1" value="{{ $layerAttr->id }}">
                                    </div>
                                @endforeach
                            @endif
                            <div class="keyval">
                                <input type="text" class="left" placeholder="%" name="per_1"><input type="text" class="right" placeholder="值" name="val_1"><a onclick="addLayerAttr(1);">添加</a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>高：</td>
                        <td>
                            @if(count($layer->getLayerAttrs(2)) && $layerAttrs=$layer->getLayerAttrs(2))
                                @foreach($layerAttrs as $layerAttr)
                                    <div class="keyval">
                                        <input type="text" class="left" placeholder="%" name="per_2_{{$layerAttr->id}}" value="{{ $layerAttr->per }}"><input type="text" class="right" placeholder="值" name="val_2_{{$layerAttr->id}}" value="{{ $layerAttr->val }}"><a onclick="editLayerAttr(2);">更新</a>
                                        <input type="hidden" name="layerAttrId_2" value="{{ $layerAttr->id }}">
                                    </div>
                                @endforeach
                            @endif
                            <div class="keyval">
                                <input type="text" class="left" placeholder="%" name="per_2"><input type="text" class="right" placeholder="值" name="val_2"><a onclick="addLayerAttr(2);">添加</a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>左边距：</td>
                        <td>
                            @if(count($layer->getLayerAttrs(3)) && $layerAttrs=$layer->getLayerAttrs(3))
                                @foreach($layerAttrs as $layerAttr)
                                    <div class="keyval">
                                        <input type="text" class="left" placeholder="%" name="per_3_{{$layerAttr->id}}" value="{{ $layerAttr->per }}"><input type="text" class="right" placeholder="值" name="val_3_{{$layerAttr->id}}" value="{{ $layerAttr->val }}"><a onclick="editLayerAttr(3);">更新</a>
                                        <input type="hidden" name="layerAttrId_3" value="{{ $layerAttr->id }}">
                                    </div>
                                @endforeach
                            @endif
                            <div class="keyval">
                                <input type="text" class="left" placeholder="%" name="per_3"><input type="text" class="right" placeholder="值" name="val_3"><a onclick="addLayerAttr(3);">添加</a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>顶边距：</td>
                        <td>
                            @if(count($layer->getLayerAttrs(4)) && $layerAttrs=$layer->getLayerAttrs(4))
                                @foreach($layerAttrs as $layerAttr)
                                    <div class="keyval">
                                        <input type="text" class="left" placeholder="%" name="per_4_{{$layerAttr->id}}" value="{{ $layerAttr->per }}"><input type="text" class="right" placeholder="值" name="val_4_{{$layerAttr->id}}" value="{{ $layerAttr->val }}"><a onclick="editLayerAttr(4);">更新</a>
                                        <input type="hidden" name="layerAttrId_4" value="{{ $layerAttr->id }}">
                                    </div>
                                @endforeach
                            @endif
                            <div class="keyval">
                                <input type="text" class="left" placeholder="%" name="per_4"><input type="text" class="right" placeholder="值" name="val_4"><a onclick="addLayerAttr(4);">添加</a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>透明度：</td>
                        <td>
                            @if(count($layer->getLayerAttrs(5)) && $layerAttrs=$layer->getLayerAttrs(5))
                                @foreach($layerAttrs as $layerAttr)
                                    <div class="keyval">
                                        <input type="text" class="left" placeholder="%" name="per_5_{{$layerAttr->id}}" value="{{ $layerAttr->per }}"><input type="text" class="right" placeholder="值" name="val_5_{{$layerAttr->id}}" value="{{ $layerAttr->val }}"><a onclick="addLayerAttr(5);">更新</a>
                                        <input type="hidden" name="layerAttrId_5" value="{{ $layerAttr->id }}">
                                    </div>
                                @endforeach
                            @endif
                            <div class="keyval">
                                <input type="text" class="left" placeholder="%" name="per_5"><input type="text" class="right" placeholder="值" name="val_5"><a onclick="addLayerAttr(5);">添加</a>
                            </div>
                        </td>
                    </tr>
                </table>
                {{--@endif--}}
                <div style="height:10px"></div>
            </div>
            @endif
        @endforeach
    @endif
    </div>
    <div class="addTimeTab" title="点击隐藏或显示添加的动画选项" onclick="$('.addlayer').toggle(200);">+添加动画设置</div>
    <div class="addlayer" style="display:none;">
        <form method="POST" id="formlayerAttr" action="{{DOMAIN}}online/u/{{$product->id}}/frame/addLayer" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method" value="POST">
            {{--<input type="hidden" name="productid" value="{{$product->id}}">--}}
            动画设置：<input type="text" placeholder="动画设置名称" name="layerName">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            延 &nbsp;&nbsp;&nbsp;时 &nbsp;&nbsp;：<input type="text" placeholder="动画等待时间" name="delay" value="0">s
            <br>时 &nbsp;&nbsp;&nbsp;长 &nbsp;&nbsp;：<input type="text" placeholder="动画持续时间" name="timelong">s
            &nbsp;&nbsp;&nbsp;&nbsp;
            动画曲线：
            <select name="func">
                @foreach($layerModel['funcNames'] as $kfunc=>$funcName)
                    <option value="{{ $kfunc }}">{{ $funcName }}</option>
                @endforeach
            </select>
            <button type="submit" class="submit">保存添加</button>
        </form>
    </div>
</div>

<script>
    function addLayerAttr(layerAttr){
        var productid = $("input[name='productid']").val();
        var layerid = $("input[name='layerid']").val();
        var con_id = $("input[name='con_id']").val();
        var attrGenre = $("input[name='attrGenre']").val();
        var per = $("input[name='per_"+layerAttr+"']").val();
        var val = $("input[name='val_"+layerAttr+"']").val();
        if (per=='' || val=='') {
            alert('百分比或者值未填！');return;
        } else {
            window.location.href = '{{DOMAIN}}admin/'+productid+'/creation/addLayerAttr/'+layerid+'/'+con_id+'/'+attrGenre+'/'+layerAttr+'/'+per+'/'+val;
        }
    }
    function editLayerAttr(layerAttr){
        var productid = $("input[name='productid']").val();
        var layerid = $("input[name='layerid']").val();
        var con_id = $("input[name='con_id']").val();
        var attrGenre = $("input[name='attrGenre']").val();
        var layerAttrId = $("input[name='layerAttrId_"+layerAttr+"']").val();
        var per = $("input[name='per_"+layerAttr+"_"+layerAttrId+"']").val();
        var val = $("input[name='val_"+layerAttr+"_"+layerAttrId+"']").val();
        if (per=='' || val=='') {
            alert('百分比或者值未填！');return;
        } else {
            window.location.href = '{{DOMAIN}}admin/'+productid+'/creation/editLayerAttr/'+layerid+'/'+con_id+'/'+attrGenre+'/'+layerAttrId+'/'+layerAttr+'/'+per+'/'+val;
        }
    }
</script>