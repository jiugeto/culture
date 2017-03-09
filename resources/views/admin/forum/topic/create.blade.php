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
                <form class="am-form" data-am-validator method="POST" action="{{DOMAIN}}admin/topic" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <fieldset>
                        <div class="am-form-group">
                            <label>专题名称 / Name：</label>
                            <input type="text" placeholder="至少2个字符" minlength="2" maxlength="20" required name="name"/>
                        </div>

                        <div class="am-form-group">
                            <label>专题内容 / Introduce：</label>
                            <textarea cols="50" rows="5" placeholder="" name="intro"></textarea>
                        </div>

                        <button type="submit" class="am-btn am-btn-primary" onclick="history.go(-1)">返回</button>
                        <button type="submit" class="am-btn am-btn-primary">保存添加</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop

