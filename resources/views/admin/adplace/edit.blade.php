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
                <form class="am-form" data-am-validator method="POST" action="/admin/place/{{$data->id}}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="POST">
                    <fieldset>
                        <div class="am-form-group">
                            <label>广告位名称 / Ad Place：</label>
                            <input type="text" placeholder="至少2个字符" minlength="2" required name="Ad_place" value="{{ $data->ad_place }}"/>
                        </div>

                        <div class="am-form-group">
                            <label>广告位简介 / Introduce：</label>
                            <textarea name="intro" cols="50" rows="5">{{ $data->intro }}</textarea>
                        </div>

                        <div class="am-form-group">
                            <label>广告位类型 / Type：
                                <a href="/admin/type/create/{{'广告位-type_id'}}">[+添加类别]</a></label>
                            <select required name="type_id">
                                @foreach($types as $type)
                                    <option value="{{ $type->id }}"
                                            {{ $data->type_id==$type->id ? 'selected' : '' }}>
                                        {{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>用户名称 / User Name：</label>
                            <input type="text" placeholder="至少2个字符" minlength="2" required name="user_name"/>
                        </div>

                        <div class="am-form-group">
                            <label>宽度 / Width：</label>
                            <input type="text" placeholder="广告位宽度" pattern="^\d{1,4}$" required name="width"/>
                        </div>

                        <div class="am-form-group">
                            <label>高度 / Height：</label>
                            <input type="text" placeholder="广告位高度" pattern="^\d{1,4}$" required name="height"/>
                        </div>

                        <div class="am-form-group">
                            <label>价格 / Price：</label>
                            <input type="text" placeholder="广告位价格(保留2位小数)" pattern="^\d+|\d+\.\d{2}$" required name="price"/>
                        </div>

                        <button type="submit" class="am-btn am-btn-primary">保存添加</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop

