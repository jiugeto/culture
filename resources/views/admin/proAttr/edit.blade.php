@extends('admin.main')
@section('content')
    <div class="admin-content">
        @include('admin.common.crumb')
        <div class="am-g">
            @include('admin.common.menu')
        </div>
        <hr/>

        <div class="am-g">
            @include('admin.common.info')
            <div class="am-u-sm-12 am-u-md-8 am-u-md-pull-4">
                <form class="am-form" data-am-validator method="POST" action="{{DOMAIN}}admin/{{$productid}}/{{$layerid}}/proAttr/{{ $data->id }}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="POST">
                    <fieldset>
                        <div class="am-form-group">
                            <label>动画设置名称 / Name：{{ $data->getLayerName() }}</label>

                        </div>

                        <div class="am-form-group">
                            <label>样式名称 / Name：</label>
                            <input type="text" placeholder="至少2个字符" minlength="2" required name="name" value="{{ $data->name }}" {{ $data->genre!=1 ? 'disabled' : '' }}/>
                        </div>

                        <div class="am-form-group">
                            <label>内边距 / Padding：</label>
                            <select name="padType">
                                @if(count($model['padTypes']))
                                    @foreach($model['padTypes'] as $kpadType=>$vpadType)
                                        <option value="{{ $kpadType }}" {{ $data->getPadType()==$kpadType ? 'selected' : '' }}>
                                            {{ $vpadType }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <script>
                            $("select[name='padType']").change(function(){
                                var padType = $(this).val();
                                if (padType) { $(".pad").hide(); $(".pad"+padType).show(); }
                            });
                        </script>

                        <div class="am-form-group pad pad1" style="display:{{$data->getPadType()==1?'block':'none'}};">
                            <label>内边距宽度 / Padding：(单位px)</label>
                            <input type="text" placeholder="上下左右" pattern="^\d+$" name="pad1" value="{{ $data->getPadType()==1?$data->getPadVal():'' }}"/>
                        </div>

                        <div class="am-form-group pad pad2" style="display:{{$data->getPadType()==2?'block':'none'}};">
                            <label>内边距宽度 / Padding：(单位px)</label>
                            <input type="text" placeholder="上下" pattern="^\d+$" name="pad2" value="{{ $data->getPadType()==1?$data->getPadVal2(2)[0]:'' }}"/>
                            <div style="height:2px;"></div>
                            <input type="text" placeholder="左右" pattern="^\d+$" name="pad3" value="{{ $data->getPadType()==1?$data->getPadVal2(2)[1]:'' }}"/>
                        </div>

                        <div class="am-form-group pad pad3" style="display:{{$data->getPadType()==3?'block':'none'}};">
                            <label>内边距宽度 / Padding：(单位px)</label>
                            <input type="text" placeholder="上" pattern="^\d+$" name="pad4" value="{{ $data->getPadType()==1?$data->getPadVal2(3)[0]:'' }}"/>
                            <div style="height:2px;"></div>
                            <input type="text" placeholder="下" pattern="^\d+$" name="pad5" value="{{ $data->getPadType()==1?$data->getPadVal2(3)[1]:'' }}"/>
                            <div style="height:2px;"></div>
                            <input type="text" placeholder="左" pattern="^\d+$" name="pad6" value="{{ $data->getPadType()==1?$data->getPadVal2(3)[2]:'' }}"/>
                            <div style="height:2px;"></div>
                            <input type="text" placeholder="右" pattern="^\d+$" name="pad7" value="{{ $data->getPadType()==1?$data->getPadVal2(3)[3]:'' }}"/>
                        </div>

                        <div class="am-form-group">
                            <label>宽度 / Width：(单位px)</label>
                            <input type="text" placeholder="不填代表没有" pattern="^\d+$" name="width" value="{{ $data->getWidth() }}"/>
                        </div>

                        <div class="am-form-group">
                            <label>高度 / Height：(单位px)</label>
                            <input type="text" placeholder="不填代表没有" pattern="^\d+$" name="height" value="{{ $data->getHeight() }}"/>
                        </div>

                        <div class="am-form-group">
                            <label>定位方式 / Position：</label>
                            <select name="posType">
                                @if(count($model['posTypes']))
                                    @foreach($model['posTypes'] as $kposType=>$vposType)
                                        <option value="{{ $kposType }}">{{ $vposType }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <script>
                            $("select[name='posType']").change(function(){
                                if ($(this).val()!=0) { $(".pos").show(); } else { $(".pos").hide(); }
                            });
                        </script>

                        <div class="am-form-group pos" style="display:{{$data->getPosType()?'block':'none'}};">
                            <label>左边距离 / Left：(单位px)</label>
                            <input type="text" placeholder="不填代表没有" pattern="^\d+$" name="left" value="{{ $data->getPos()['left'] }}"/>
                        </div>

                        <div class="am-form-group pos" style="display:{{$data->getPosType()?'block':'none'}};">
                            <label>顶部距离 / Top：(单位px)</label>
                            <input type="text" placeholder="不填代表没有" pattern="^\d+$" name="top" value="{{ $data->getPos()['top'] }}"/>
                        </div>

                        <div class="am-form-group">
                            <label>浮动方式 / Float：</label>
                            <select name="float">
                                @if(count($model['floats']))
                                    @foreach($model['floats'] as $kfloat=>$vfloat)
                                        <option value="{{ $kfloat }}" {{ $data->float==$kfloat ? 'selected' : '' }}>{{ $vfloat }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>透明度 / Opacity：</label>
                            <label><input type="radio" name="isopacity" value="0" {{ explode(',',$data->opacity)[0]==0 ? 'checked' : '' }} onclick="$('#opacity').hide()"/> 不启用&nbsp;</label>
                            <label><input type="radio" name="isopacity" value="1" {{ explode(',',$data->opacity)[0]==1 ? 'checked' : '' }} onclick="$('#opacity').show()"/> 启用&nbsp;</label>
                            <input type="text" placeholder="透明度，0透明-100不透明" id="opacity" style="display:{{explode(',',$data->opacity)[0]?'block':'none'}};" pattern="^\d+$" name="opacity" value="{{ $data->getOpacity() }}">
                        </div>

                        <button type="submit" class="am-btn am-btn-primary">保存修改</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop