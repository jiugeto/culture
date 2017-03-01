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
                <form class="am-form" data-am-validator method="POST" action="{{DOMAIN}}admin/ad" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <fieldset>
                        <div class="am-form-group">
                            <label>广告名称 / Name：</label>
                            <input type="text" placeholder="至少2个字符" minlength="2" required name="name"/>
                        </div>

                        <div class="am-form-group">
                            <label>所属广告位 / Ad Place：</label>
                            <select name="adplace" required>
                                @if(count($adplaces))
                                @foreach($adplaces as $adplace)
                                    <option value="{{$adplace['id']}}">
                                        {{$adplace['name'].'('.$adplace['width'].'*'.$adplace['height'].')'}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>广告说明 / Introduce：</label>
                            <textarea name="intro" cols="50" rows="5"></textarea>
                        </div>

                        <div class="am-form-group">
                            <label>显示图片 / Thumb：</label>
                            先添加，在上传图片。
                        </div>

                        <div class="am-form-group">
                            <label>广告链接 / Link：</label>
                            <input type="text" placeholder="广告跳转的链接" minlength="1" required name="link"/>
                        </div>

                        <div class="am-form-group">
                            <label>有效时间开始 / Start：</label>
                            <input type="text" placeholder="点击选择日期" class="form-datetime am-form-field" data-am-datepicker="{format: 'yyyy-mm-dd'}" name="fromTime"/>
                        </div>

                        <div class="am-form-group">
                            <label>有效时间结束 / End：</label>
                            <input type="text" placeholder="点击选择日期" class="form-datetime am-form-field" data-am-datepicker="{format: 'yyyy-mm-dd'}" name="toTime"/>
                        </div>

                        <div class="am-form-group">
                            <label>发布单位 / Company Name：</label>
                            <input type="text" placeholder="广告位发布方" minlength="2" maxlength="20" required name="uname"/>
                        </div>

                        <button type="submit" class="am-btn am-btn-primary">保存添加</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>

    <script>
        function piclist(){
            $(".pic_list").toggle(200);
            $("#open").toggle(); $("#close").toggle();
        }
        function getPic(pic){
            var arr = pic.split('-');
            $("input[name='pic_id']")[0].value = arr[0];
            $("input[name='pic_name']")[0].value = arr[1]+'('+arr[2]+'*'+arr[3]+')';
            $(".pic_list").hide();
        }
    </script>
@stop

