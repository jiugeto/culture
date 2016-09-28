{{--系统后台创作模板时间栏--}}


<div class="timetab">
    <p class="tabt">时间栏</p>
    <div class="title">
        @if(count($layers))
            @foreach($layers as $layer)
            <a href="{{DOMAIN}}admin/{{$product->id}}/creation/edit/{{$layer->id}}/{{$content->id}}/1">
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
                    <form method="POST" id="formLayer" action="{{DOMAIN}}admin/{{$product->id}}/creation/editLayer/{{$layerid}}" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="POST">
                        <input type="hidden" name="layerid" value="{{$layerid}}">
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
                        <button type="submit" class="am-btn am-btn-primary submit">保存修改</button>
                    </form>
                </div>
                <div class="layer attr">
                    {{--@if(count($layer->getLayerAttrs()))--}}
                        <input type="hidden" name="productid" value="{{$product->id}}">
                        <input type="hidden" name="layerid" value="{{$layerid}}">
                        <input type="hidden" name="con_id" value="{{$content->id}}">
                        <input type="hidden" name="attrGenre" value="{{$attr->genre}}">
                        <table>
                            <tr>
                                <td width="70">宽：</td>
                                <td>
                                    @if(count($layer->getLayerAttrs(1)) && $layerAttrs=$layer->getLayerAttrs(1))
                                        @foreach($layerAttrs as $layerAttr)
                                            <div class="keyval">
                                                <input type="text" class="left" name="per_1_{{$layerAttr->id}}" value="{{ $layerAttr->per }}"><input type="text" class="right" name="val_1_{{$layerAttr->id}}" value="{{ $layerAttr->val }}">
                                                <input type="hidden" name="layerAttrId_1" value="{{ $layerAttr->id }}">
                                                <input type="button" style="font-size:14px;" value="更新" onclick="editLayerAttr(1);">
                                            </div>
                                        @endforeach
                                    @endif
                                    <div class="keyval">
                                        <input type="text" class="left" name="per_1"><input type="text" class="right" name="val_1">
                                        <input type="button" style="font-size:14px;" value="添加" onclick="addLayerAttr(1);">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>高：</td>
                                <td>
                                    @if(count($layer->getLayerAttrs(2)) && $layerAttrs=$layer->getLayerAttrs(2))
                                        @foreach($layerAttrs as $layerAttr)
                                            <div class="keyval">
                                                <input type="text" class="left" name="per_2_{{$layerAttr->id}}" value="{{ $layerAttr->per }}"><input type="text" class="right" name="val_2_{{$layerAttr->id}}" value="{{ $layerAttr->val }}">
                                                <input type="hidden" name="layerAttrId_2" value="{{ $layerAttr->id }}">
                                                <input type="button" style="font-size:14px;" value="更新" onclick="editLayerAttr(2);">
                                            </div>
                                        @endforeach
                                    @endif
                                    <div class="keyval">
                                        <input type="text" class="left" name="per_2"><input type="text" class="right" name="val_2">
                                        <input type="button" style="font-size:14px;" value="添加" onclick="addLayerAttr(2);">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>左边距：</td>
                                <td>
                                    @if(count($layer->getLayerAttrs(3)) && $layerAttrs=$layer->getLayerAttrs(3))
                                        @foreach($layerAttrs as $layerAttr)
                                            <div class="keyval">
                                                <input type="text" class="left" name="per_3_{{$layerAttr->id}}" value="{{ $layerAttr->per }}"><input type="text" class="right" name="val_3_{{$layerAttr->id}}" value="{{ $layerAttr->val }}">
                                                <input type="hidden" name="layerAttrId_3" value="{{ $layerAttr->id }}">
                                                <input type="button" style="font-size:14px;" value="更新" onclick="editLayerAttr(3);">
                                            </div>
                                        @endforeach
                                    @endif
                                    <div class="keyval">
                                        <input type="text" class="left" name="per_3"><input type="text" class="right" name="val_3">
                                        <input type="button" style="font-size:14px;" value="添加" onclick="addLayerAttr(3);">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>顶边距：</td>
                                <td>
                                    @if(count($layer->getLayerAttrs(4)) && $layerAttrs=$layer->getLayerAttrs(4))
                                        @foreach($layerAttrs as $layerAttr)
                                            <div class="keyval">
                                                <input type="text" class="left" name="per_4_{{$layerAttr->id}}" value="{{ $layerAttr->per }}"><input type="text" class="right" name="val_4_{{$layerAttr->id}}" value="{{ $layerAttr->val }}">
                                                <input type="hidden" name="layerAttrId_4" value="{{ $layerAttr->id }}">
                                                <input type="button" style="font-size:14px;" value="更新" onclick="editLayerAttr(4);">
                                            </div>
                                        @endforeach
                                    @endif
                                    <div class="keyval">
                                        <input type="text" class="left" name="per_4"><input type="text" class="right" name="val_4">
                                        <input type="button" style="font-size:14px;" value="添加" onclick="addLayerAttr(4);">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>透明度：</td>
                                <td>
                                    @if(count($layer->getLayerAttrs(5)) && $layerAttrs=$layer->getLayerAttrs(5))
                                        @foreach($layerAttrs as $layerAttr)
                                            <div class="keyval">
                                                <input type="text" class="left" name="per_5_{{$layerAttr->id}}" value="{{ $layerAttr->per }}"><input type="text" class="right" name="val_5_{{$layerAttr->id}}" value="{{ $layerAttr->val }}">
                                                <input type="hidden" name="layerAttrId_5" value="{{ $layerAttr->id }}">
                                                <input type="button" style="font-size:14px;" value="更新" onclick="editLayerAttr(5);">
                                            </div>
                                        @endforeach
                                    @endif
                                    <div class="keyval">
                                        <input type="text" class="left" name="per_5"><input type="text" class="right" name="val_5">
                                        <input type="button" style="font-size:14px;" value="添加" onclick="addLayerAttr(5);">
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
</div>
<div class="addTimeTab" onclick="$('.addlayer').toggle(200);">+添加动画设置</div>
<div class="addlayer" style="display:none;">
    <form method="POST" id="formlayerAttr" action="{{DOMAIN}}admin/{{$product->id}}/creation/addLayer" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="POST">
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
        <br><button type="submit" class="am-btn am-btn-primary" style="margin:5px 40px;padding:2px 15px;">保存添加</button>
    </form>
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