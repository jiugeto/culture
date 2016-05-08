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
                <form class="am-form" data-am-validator method="POST" action="/admin/productattr" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <fieldset>
                        <div class="am-form-group">
                            <label>属性名称 / Name：</label>
                            {{--<input type="text" placeholder="至少2个字符" minlength="2" required name="name"/>--}}
                            <select name="name" required>
                                @foreach($model['attrs'] as $kattr=>$attr)
                                    <option value="{{ $kattr }}">{{ $model['attrNames'][$kattr] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>属性名称 / Name：</label>
                            {{--margin,padding--}}
                            <span id="val1">
                                <input type="text" placeholder="输入数值，默认0，空着不填代表自动居中" pattern="^\d+$" name="val1-1" value="0"/><div style="height:5px;"></div>
                                <input type="text" placeholder="输入数值，默认0，空着不填代表自动居中" pattern="^\d+$" name="val1-2" value="0"/>
                            </span>
                            {{--width,height,border-radius--}}
                            <span id="val2" style="display:none;">
                                <input type="text" placeholder="输入数值" pattern="^\d+$" name="val2" value="0"/>
                            </span>
                            {{--color,background--}}
                            <span id="val3" style="display:none;">
                                点击选取颜色<input type="color" name="val3"/>
                                颜色预览：<div style="height:50px;border:2px solid grey;" class="yulan"></div>
                            </span>
                            {{--border--}}
                            <span id="val4" style="display:none;">
                                <input type="text" placeholder="输入数值" pattern="^\d+$" name="val4-1"/><div style="height:5px;"></div>
                                <select name="val4-2">
                                    @foreach($model['borderTypes'] as $kborderType=>$borderType)
                                    <option value="{{ $kborderType }}">{{ $model['borderTypeNames'][$kborderType] }}</option>
                                    @endforeach
                                </select>
                                <div style="height:5px;"></div>
                                点击选取颜色<input type="color" name="val4-3"/>颜色预览：<div style="height:50px;border:2px solid grey;" class="yulan"></div>
                            </span>
                            {{--position--}}
                            <span id="val5">
                                <select name=""></select>
                            </span>
                        </div>
                        <script>
                            $(document).ready(function(){
                                var name = $("select[name='name']");
                                var val1 = $("#val1");
                                var val2 = $("#val2");
                                var val3 = $("#val3");
                                var val4 = $("#val4");
                                name.change(function(){
                                    if($.inArray(name.val(),[1,2])){
                                        val1.show(); val2.hide(); val3.hide(); val3.hide();
                                    }
                                    if ($.inArray(name.val(),[3,4,6,7])){
                                        val1.hide(); val2.show(); val3.hide(); val3.hide();
                                    }
                                    if($.inArray(name.val(),[5,9,10])){
                                        val1.hide(); val2.hide(); val3.show(); val4.hide();
                                    }
                                });
                                $("input[name='val3']").change(function(){
//                                    alert(this.value);
                                    $(".yulan")[0].style.background = this.value;
                                });
                            });
                        </script>

                        <div class="am-form-group">
                            <label>简介 / Introduce：</label>
                            <textarea name="intro" cols="50" rows="5"></textarea>
                        </div>

                        <button type="submit" class="am-btn am-btn-primary">保存添加</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop

