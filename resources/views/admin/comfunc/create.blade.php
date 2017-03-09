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
                <form class="am-form" data-am-validator method="POST" action="{{DOMAIN}}admin/comfunc" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <fieldset>
                        <div class="am-form-group">
                            <label>公司名称 / Company Name：</label>
                            <input type="text" placeholder="公司名称，不填则本站新增模块" minlength="2" maxlength="20" name="cname">
                        </div>

                        <div class="am-form-group">
                            <label>功能名称 / Name：</label>
                            <input type="text" placeholder="至少2个字符" minlength="2" required name="name"/>
                        </div>

                        <div class="am-form-group">
                            <label>所属模块 / Module：</label>
                            <select name="module_id" required>
                                @if(count($modules))
                                    @foreach($modules as $module)
                                    <option value="{{$module['id']}}">{{$module['name']}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>内容 / intro：</label> 最多输入255
                            <textarea name="intro" cols="80" rows="10" required maxlength="50"></textarea>
                        </div>

                        <div class="am-form-group">
                            <label>图片 / Picture：</label>
                            先添加，在上传图片。
                        </div>

                        <div class="am-form-group">
                            <label>小字 / Small：</label> 最多输入1000
                            {{--<input type="text" placeholder="小字/数字/合作伙伴，多组用|隔开" name="small">--}}
                            <textarea name="small" cols="80" rows="10" placeholder="小字/数字/合作伙伴/联系方式，多组用|隔开"></textarea>
                        </div>

                        <button type="submit" class="am-btn am-btn-primary">保存添加</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>

    <script>
        function init(cname){
            $.ajaxSetup({headers : {'X-CSRF-TOKEN':$('input[name="_token"]').val()}});
            $.ajax({
                type: 'POST',
                url: '{{DOMAIN}}admin/comfunc/init',
                data: {'cname':cname},
                dataType: 'json',
                success: function(data) {
                    if (data.code!=0) { alert(data.msg);return; }
//                    alert(data.data);
                    $("select[name='module_id']").html(data.data);
                }
            });
        }
    </script>
@stop

