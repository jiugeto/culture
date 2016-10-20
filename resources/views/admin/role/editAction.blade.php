@extends('admin.main')
@section('content')
    <div class="admin-content">
        @include('admin.common.crumb')
        <div class="am-g">
            {{--@include('admin.common.menu')--}}
            {{--@include('admin.type.search')--}}
        </div>
        <hr/>

        <div class="am-g">
            @include('admin.common.info')
            <div class="am-u-sm-12 am-u-md-8 am-u-md-pull-4">
                <form class="am-form" data-am-validator method="POST" action="{{DOMAIN}}admin/role/action/{{ $data->id }}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="POST">
                    <fieldset>
                        <div class="am-form-group">
                            <label>{{ $data->name }} 功能：</label><br>
                            <b style="color:orangered;">一级：idXXX</b><br>
                            @foreach($actions as $action)
                                @if($action->pid==0)
                            <label><input type="checkbox" name="action[]" value="{{$action->id}}"
                                        {{ $data->getActionId($action->id)==$action->id ? 'checked' : '' }}>
                                {{$action->id.$action->name}}&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                @endif
                            @endforeach
                            <br>
                            <b style="color:orangered;">二级：XXXpid</b><br>
                            @foreach($actions as $action)
                                @if($action->pid!=0)
                            <label><input type="checkbox" name="action[]" value="{{$action->id}}"
                                        {{ $data->getActionId($action->id)==$action->id ? 'checked' : '' }}>
                                {{$action->name}}({{$action->pid}})&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                @endif
                            @endforeach
                        </div>

                        <button class="am-btn am-btn-primary" onclick="history.go(-1);">返回</button>
                        <button type="submit" class="am-btn am-btn-primary">保存修改</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop

