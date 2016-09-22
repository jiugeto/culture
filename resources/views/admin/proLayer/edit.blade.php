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
                <form class="am-form" data-am-validator method="POST" action="{{DOMAIN}}admin/{{$attr->id}}/proLayer/{{ $data->id }}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="POST">
                    <fieldset>
                        <div class="am-form-group">
                            <label>产品名称 / Name：{{ $attr->getProductName() }}</label>
                        </div>

                        <div class="am-form-group">
                            <label>属性名称 / Name：{{ $attr->name }}</label>
                        </div>

                        <div class="am-form-group">
                            <label>名称 / Name：</label>
                            <input type="text" placeholder="至少2个字符" minlength="2" required name="name" value="{{ $data->name }}"/>
                        </div>

                        <div class="am-form-group">
                            <label>动画时长 / Duration：(单位s)</label>
                            <input type="text" placeholder="" pattern="^\d+$" required name="timelong" value="{{ $data->timelong }}"/>
                        </div>

                        <div class="am-form-group">
                            <label>速度曲线 / Function：</label>
                            <select name="func" required>
                                @foreach($model['funcNames'] as $kfunc=>$funcName)
                                    <option value="{{ $kfunc }}" {{ $data->func==$kfunc ? 'selected' : '' }}>{{ $funcName }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>延时秒数 / Delay：(单位s)</label>
                            <input type="text" placeholder="数字，不填为0" pattern="^\d+$" name="delay" value="{{ $data->delay }}"/>
                        </div>

                        <button type="submit" class="am-btn am-btn-primary">保存修改</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop

