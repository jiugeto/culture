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
                <form class="am-form" data-am-validator method="POST" action="{{DOMAIN}}admin/comfunc/{{ $data->id }}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="POST">
                    <fieldset>
                        <div class="am-form-group">
                            <label>功能名称 / Name：</label>
                            <input type="text" placeholder="至少2个字符" minlength="2" required name="name" value="{{ $data->name }}"/>
                        </div>

                        <div class="am-form-group">
                            <label>所属模块 / Module：</label>
                            <select name="module_id" required>
                                <option value="0" {{ $data->module_id==0 ? 'selected' : '' }}>选择模块</option>
                                @if(count($modules))
                                    @foreach($modules as $module)
                                    <option value="{{ $module->id }}" {{ $data->module_id==$module->id ? 'selected' : '' }}>{{ $module->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>类型 / Type：</label>
                            <select name="type" required>
                                @if(count($model['types']))
                                    @foreach($model['types'] as $ktype=>$type)
                                        <option value="{{ $ktype }}" {{ $data->type==$ktype ? 'selected' : '' }}>{{ $type }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>内容 / intro：</label>
                            @include('admin.common.editor')
                        </div>

                        <div class="am-form-group">
                            <label>图片 / Picture：</label><br>
                            @if($data->img)
                                <img src="{{ $data->img }}" width="300">
                                <div style="margin:5px 0;border-bottom:1px dashed lightgrey;"></div>
                            @endif
                            <label>重新上传：</label><br>
                            @include('admin.common.uploadimg')
                        </div>

                        <div class="am-form-group">
                            <label>小字 / Small：</label>
                            <input type="text" placeholder="小字/数字/合作伙伴，多组用|隔开" name="small" value="{{ $data->small }}">
                        </div>

                        <div class="am-form-group">
                            <label>企业控制排序 / Sort：</label>
                            <input type="text" pattern="^\d+$" required name="sort" value="{{ $data->sort }}">
                        </div>

                        <div class="am-form-group">
                            <label>企业控制前台是否显示 / Is Show：</label>
                            <label><input type="radio" name="isshow" value="0" {{ $data->isshow==0 ? 'checked' : '' }}> 不显示&nbsp;&nbsp;</label>
                            <label><input type="radio" name="isshow" value="1" {{ $data->isshow==1 ? 'checked' : '' }}> 显示&nbsp;&nbsp;</label>
                        </div>

                        <button type="submit" class="am-btn am-btn-primary">保存添加</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop

