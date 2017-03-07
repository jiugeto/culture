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
                <form class="am-form" data-am-validator method="POST" action="{{DOMAIN}}admin/commain/{{$data['id']}}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="POST">
                    <fieldset>
                        <div class="am-form-group">
                            <label>公司名称 / Name：</label>
                            <input type="text" placeholder="至少2个字符" minlength="2" maxlength="20" required name="name" value="{{$data['name']}}"/>
                        </div>
                        
                        <div class="am-form-group">
                            <label>皮肤选择 / Skin：</label>
                        </div>

                        <div class="am-form-group">
                            <label>公司首页开关 / Layout：</label>
                        </div>

                        <button type="submit" class="am-btn am-btn-primary">保存修改</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop

