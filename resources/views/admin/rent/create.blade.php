@extends('admin.main')
@section('content')
    <div class="admin-content">
        @include('admin.common.crumb')
        <div class="am-g">
            {{--@include('admin.common.menu')--}}
        </div>
        <hr/>

        <div class="am-g">
            @include('admin.common.info')
            <div class="am-u-sm-12 am-u-md-8 am-u-md-pull-4">
                <form class="am-form" data-am-validator method="POST" action="{{DOMAIN}}admin/rent" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <fieldset>
                        <div class="am-form-group">
                            <label>设备名称 / Name：</label>
                            <input type="text" placeholder="至少2个字符" minlength="2" maxlength="20" required name="name"/>
                        </div>

                        <div class="am-form-group">
                            <label>供求类型 / Genre：</label>
                            <input type="radio" name="genre" value="1" checked/> 供应商&nbsp;&nbsp;
                            <input type="radio" name="genre" value="2"/> 需求方&nbsp;&nbsp;
                        </div>

                        <div class="am-form-group">
                            <label>设备类型 / Type：</label>
                            <select name="type" required>
                                @foreach($model['types'] as $k=>$vtype)
                                    <option value="{{ $k }}">{{ $vtype }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>租赁商 / User Name：</label>
                            <input type="text" placeholder="用户名称" minlength="2" maxlength="20" name="uname">
                        </div>

                        <div class="am-form-group">
                            <label>说明 / Introduce：</label>
                            <textarea name="intro" cols="50" rows="5"></textarea>
                        </div>

                        <div class="am-form-group">
                            <label>租金 / Money：</label>
                            <input type="text" placeholder="数字" pattern="^\d+$" required name="money"/>
                        </div>

                        <div class="am-form-group am-datepicker-date">
                            <label>租赁起始时间 / Start Time：</label>
                            <input type="text" placeholder="如：2016-01-01 01:01" pattern="^\d{4}-\d{2}-\d{2}\s\d{2}:\d{2}$" data-am-datepicker="{theme: 'success'}" name="fromtime"/>
                            <label>租赁结束时间 / End Time：</label>
                            <input type="text" placeholder="如：2016-02-02 02:02" pattern="^\d{4}-\d{2}-\d{2}\s\d{2}:\d{2}$" data-am-datepicker="{theme: 'success'}" name="totime"/>
                        </div>

                        <button type="button" class="am-btn am-btn-primary" onclick="history.go(-1)">返回</button>
                        <button type="submit" class="am-btn am-btn-primary">保存添加</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop

