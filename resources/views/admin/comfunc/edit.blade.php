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
                <form class="am-form" data-am-validator method="POST" action="{{DOMAIN}}admin/comfunc/{{$data['id']}}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="POST">
                    <fieldset>
                        <div class="am-form-group">
                            <label>公司名称 / Company Name：</label>
                            <input type="text" placeholder="公司名称，不填则本站新增模块" minlength="2" maxlength="20" name="cname" value="{{ComNameById($data['cid'])}}">
                        </div>

                        <div class="am-form-group">
                            <label>功能名称 / Name：</label>
                            <input type="text" placeholder="至少2个字符" minlength="2" maxlength="20" required name="name" value="{{$data['name']}}"/>
                        </div>

                        <div class="am-form-group">
                            <label>所属模块 / Module：</label>
                            <select name="module_id" required>
                                @if(count($modules))
                                    @foreach($modules as $module)
                                    <option value="{{$module['id']}}"
                                            {{$data['module_id']==$module['id']?'selected':''}}>
                                        {{$module['name']}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>内容 / intro：</label> 最多输入255
                            <textarea name="intro" cols="80" rows="10" required>{{$data['intro']}}</textarea>
                        </div>

                        <div class="am-form-group">
                            <label>图片 / Picture：</label>
                            先添加，在上传图片。
                        </div>

                        <div class="am-form-group">
                            <label>小字 / Small：</label> 最多输入1000
                            {{--<input type="text" placeholder="小字/数字/合作伙伴，多组用|隔开" name="small" value="{{$data['small']}}">--}}
                            <textarea name="small" cols="80" rows="10" placeholder="小字/数字/合作伙伴/联系方式，多组用|隔开">{{$data['small']}}</textarea>
                        </div>

                        <button type="submit" class="am-btn am-btn-primary">保存修改</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop

