@extends('admin.main')
@section('content')
    <div class="admin-content">
        @include('admin.common.crumb')
        <div class="am-g">
            {{--@include('admin.common.menu')--}}
            <div class="am-u-sm-12 am-u-md-6">
                <div class="am-btn-toolbar">
                    <div class="am-btn-group am-btn-group-xs">
                        <a href="{{DOMAIN}}admin/{{$productid}}/proLayer">
                            <button type="button" class="am-btn am-btn-default">
                                <img src="{{PUB}}assets/images/redo.png" class="icon"> 返回动画设置
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <hr/>

        <div class="am-g">
            @include('admin.common.info')
            <div class="am-u-sm-12 am-u-md-8 am-u-md-pull-4">
                <form class="am-form" data-am-validator method="POST" action="{{DOMAIN}}admin/{{$productid}}/proLayer" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <fieldset>
                        <div class="am-form-group">
                            <label>产品名称 / Name：{{ $model->getProductName() }}</label>
                        </div>

                        <div class="am-form-group">
                            <label>名称 / Name：</label>
                            <input type="text" placeholder="至少2个字符" minlength="2" required name="name"/>
                        </div>

                        <div class="am-form-group">
                            <label>动画时长 / Duration：(单位s)</label>
                            <input type="text" placeholder="动画持续时间" pattern="^\d+$" required name="timelong"/>
                        </div>

                        <div class="am-form-group">
                            <label>速度曲线 / Function：</label>
                            <select name="func" required>
                                @foreach($model['funcNames'] as $kfunc=>$funcName)
                                    <option value="{{ $kfunc }}">{{ $funcName }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>延时秒数 / Delay：(单位s)</label>
                            <input type="text" placeholder="运动之前的等待时间" pattern="^\d+$" name="delay"/>
                        </div>

                        <button type="submit" class="am-btn am-btn-primary">保存添加</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop

