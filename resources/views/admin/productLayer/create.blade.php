@extends('admin.main')
@section('content')
    <div class="admin-content">
        @include('admin.common.crumb')
        <div class="am-g">
            @include('admin.common.menu')
            {{--@include('admin.type.search')--}}
        </div>
        <hr/>

        <div class="am-g">
            @include('admin.common.info')
            <div class="am-u-sm-12 am-u-md-8 am-u-md-pull-4">
                <form class="am-form" data-am-validator method="POST" action="/admin/productlayer" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <fieldset>
                        <div class="am-form-group">
                            <label>名称 / Name：</label>
                            <input type="text" placeholder="至少2个字符" minlength="2" required name="name"/>
                        </div>

                        <div class="am-form-group">
                            <label>产品名称 / Product：
                                <a href="/admin/product">产品列表</a></label>
                            <select name="productid">
                                @if($model->productAll())
                                    @foreach($model->productAll() as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>属性名称 / Attr：
                                <a href="/admin/productattr">属性列表</a></label>
                            <select name="attrid">
                                @if($model->attrAll())
                                    @foreach($model->attrAll() as $attr)
                                        <option value="{{ $attr->id }}">{{ $attr->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>动画名称 / Animation Name：</label>
                            <input type="text" placeholder="至少2个字符，英文、拼音或字母组合" pattern="^[a-zA-Z0-9-_]+$" required name="animation_name"/>
                        </div>

                        <div class="am-form-group">
                            <label>动画时长 / Duration：(单位s)</label>
                            <input type="text" placeholder="" pattern="^\d+$" required name="duration"/>
                        </div>

                        <div class="am-form-group">
                            <label>速度曲线 / Function：</label>
                            <select name="function" required>
                                @foreach($model['functionNames'] as $kfunction=>$functionName)
                                    <option value="{{ $kfunction }}">{{ $functionName }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>延时秒数 / Delay：(单位s)</label>
                            <input type="text" placeholder="至少2个字符" pattern="^\d+$" required name="delay" value="0"/>
                        </div>

                        <div class="am-form-group">
                            <label>播放次数 / Count：</label>
                            <input type="text" placeholder="默认1" pattern="^([1-9])|([1-9]\d+)$" required name="count" value="1"/>
                        </div>

                        <div class="am-form-group">
                            <label>播放方向 / Direction：</label>
                            <label><input type="radio" name="direction" value="1" checked> 正常&nbsp;&nbsp;</label>
                            <label><input type="radio" name="direction" value="2"> 轮流反向&nbsp;&nbsp;</label>
                        </div>

                        <div class="am-form-group">
                            <label>播放状态 / State：</label>
                            <label><input type="radio" name="state" value="0" checked> 暂停&nbsp;&nbsp;</label>
                            <label><input type="radio" name="state" value="1"> 播放&nbsp;&nbsp;</label>
                        </div>


                        <div class="am-form-group">
                            <label>播放模式 / Mode：</label>
                            <select name="mode" required>
                                @foreach($model['modeNames'] as $kmode=>$modeName)
                                    <option value="{{ $kmode }}">{{ $modeName }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>字段名称 / Field：(横向，多组用|隔开)</label>
                            <input type="text" placeholder="字母、英文或拼音，多个用|隔开" pattern="^[a-zA-Z0-9-_|]+$" required name="field"/>
                        </div>

                        <div class="am-form-group">
                            <label>动画百分比 / Per：(单位%，纵向，多组用|隔开)</label>
                            <input type="text" placeholder="数字百分比，多组用|隔开" pattern="^[0-9|]+$" required name="per"/>
                        </div>

                        <div class="am-form-group">
                            <label>动画值 / Value：(用|隔开)</label>
                            {{--<a style="cursor:pointer;" id="add">增加</a>--}}
                            <input type="hidden" name="per_index" value="2">
                            <br>动画关键帧1：
                            <input type="text" placeholder="多个属性值用|隔开" pattern="^[a-zA-Z0-9-_|]+$" required name="val1"/>
                            <span id="val"></span>
                        </div>
                        <script>
                            $(document).ready(function(){
                                var per = $("input[name='per']");
                                var per_index = $("input[name='per_index']");
//                                $("#add").click(function(){
//                                    var html = '<div style="height:5px;"></div><span >动画关键帧'+val_index.val()+'：<input type="text" placeholder="多个用|隔开" minlength="2" required name="val'+val_index.val()+'"/></span>';
//                                    var html = '<div style="height:20px;"></div>动画属性名称：<input type="text" placeholder="动画属性名称" minlength="2" required name="key'+val_index.val()+'"/>动画属性名称：<input type="text" placeholder="动画属性值" minlength="2" required name="val'+val_index.val()+'"/>';
//                                    $("#val").append(html);
//                                    val_index[0].value = val_index.val() * 1 +1;
//                                });
                                per.change(function(){
                                    var pers = per.val().split('|');
                                    $("#val")[0].innerHTML = '';
                                    for(var i=per_index.val();i<pers.length+1;i++){
                                        $("#val").append('<div style="height:5px;"></div><span >动画关键帧'+i+'：<input type="text" placeholder="多个属性值用|隔开" pattern="^[a-zA-Z0-9-_|]+$" required name="val'+i+'"/></span>');
                                    }
                                });
                            });
                        </script>

                        <div class="am-form-group">
                            <label>动画简介 / Introduce：</label>
                            <textarea name="intro" cols="50" rows="5"></textarea>
                        </div>

                        <button type="submit" class="am-btn am-btn-primary">保存添加</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop

