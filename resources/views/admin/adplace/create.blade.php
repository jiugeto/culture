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
                <form class="am-form" data-am-validator method="POST" action="{{DOMAIN}}admin/place" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <fieldset>
                        <div class="am-form-group">
                            <label>广告位名称 / Ad Place：</label>
                            <input type="text" placeholder="至少2个字符" minlength="2" required name="name"/>
                        </div>

                        <div class="am-form-group">
                            <label>广告位平台 / Plat：</label>
                            <select name="plat">
                                @if(count($model['plats']))
                                    @foreach($model['plats'] as $kplat=>$plat)
                                        <option value="{{ $kplat }}">{{ $plat }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>广告位简介 / Introduce：</label>
                            <textarea name="intro" cols="50" rows="5"></textarea>
                        </div>

                        <div class="am-form-group">
                            <label>宽度 / Width：</label>
                            <input type="text" placeholder="输入1-4位数字" pattern="^\d{1,4}$" required name="width"/>
                        </div>

                        <div class="am-form-group">
                            <label>高度 / Height：</label>
                            <input type="text" placeholder="输入1-3位数字" pattern="^\d{1,3}$" required name="height"/>
                        </div>

                        <div class="am-form-group">
                            <label>价格 / Price：</label>
                            <input type="text" placeholder="输入数字" pattern="^(\d+)|(\d+\.\d{1,2})$" required name="price"/>
                        </div>

                        <div class="am-form-group">
                            <label>广告数量 / Number：</label>
                            <input type="text" placeholder="输入数字" pattern="^\d+$" required name="number"/>
                        </div>

                        <button type="submit" class="am-btn am-btn-primary">保存添加</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop

