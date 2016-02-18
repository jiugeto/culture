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
                <form class="am-form" data-am-validator method="POST" action="/admin/type" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <fieldset>
                        <div class="am-form-group">
                            <label>类型名称 / Name：</label>
                            <input type="text" placeholder="至少2个字符" minlength="2" required name="name"/>
                        </div>

                        <div class="am-form-group">
                            <label>类型介绍 / Introduce：</label>
                            <textarea name="intro" cols="50" rows="5"></textarea>
                        </div>

                        <div class="am-form-group">
                            <label>所在数据表名称 / Table：</label>
                            @if($table_name)
                                <input type="text" minlength="2" placeholder="至少2个字符" required name="table_name" value="{{ $table_name }}" readonly>
                            @else
                                <input type="text" minlength="2" placeholder="至少2个字符" required name="table_name">
                            @endif
                            <label>字段名称 / Field：</label>
                            @if($field)
                                <input type="text" placeholder="至少2个字母字符" pattern="^[a-z_]{2,}$" required name="field" value="{{ $field }}" readonly>
                            @else
                                <input type="text" placeholder="至少2个字母字符" pattern="^[a-z_]{2,}$" required name="field">
                            @endif
                        </div>

                        <button type="submit" class="am-btn am-btn-primary">保存添加</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop

