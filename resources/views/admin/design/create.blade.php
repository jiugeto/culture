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
                <form class="am-form" data-am-validator method="POST" action="{{DOMAIN}}admin/design" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <fieldset>
                        <div class="am-form-group">
                            <label>设计名称 / Name：</label>
                            <input type="text" placeholder="至少2个字符" minlength="2" maxlength="20" required name="name"/>
                        </div>

                        <div class="am-form-group">
                            <label>设计类型 / Category：</label>
                            <select name="cate" required>
                            @foreach($model['cates'] as $k=>$vcate)
                                <option value="{{$k}}">{{$vcate}}</option>
                            @endforeach
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>发布方 / User Name：</label>
                            <input type="text" placeholder="用户名称" minlength="2" maxlength="20" name="uname">
                        </div>

                        <div class="am-form-group">
                            <label>设计说明 / Introduce：</label>
                            <textarea name="intro" cols="50" rows="5" required></textarea>
                        </div>

                        <div class="am-form-group">
                            <label>设计详情 / Detail：</label>
                            <textarea name="detail" cols="50" rows="10" required></textarea>
                        </div>

                        <div class="am-form-group">
                            <label>价格 / Price：</label>
                            <input type="text" placeholder="正整数" pattern="^\d+$" name="money" required/>
                        </div>

                        <button type="submit" class="am-btn am-btn-primary">保存添加</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop

