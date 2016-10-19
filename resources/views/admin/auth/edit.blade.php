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
                <form class="am-form" data-am-validator method="POST" action="{{DOMAIN}}admin/auth" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <fieldset>
                        <div class="am-form-group" style="padding:2px 10px;border:1px dashed lightgrey;">
                            <label style="color:orangered;">{{ $model['auths'][$auth] }}</label>
                            <label>功能 / Menus：</label>
                            <br>
                            会员后台 <br>
                            @foreach($model->getMenus() as $menu)
                                @if($menu->type==1)
                                    <label><input type="checkbox" name="menu_{{$auth}}[]" value="{{ $menu->id }}" {{ $model->getAuthByTwoId($auth,$menu->id)==$menu->id ? 'checked' : '' }} onclick="change_{{$auth}}({{$menu->id}});">
                                        {{ $menu->name }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    </label>
                                @endif
                            @endforeach
                            <br>
                            {{--个人后台 <br>--}}
                            {{--@foreach($model->getMenus() as $menu)--}}
                            {{--@if($menu->type==2)--}}
                            {{--<label><input type="checkbox" name="menu[]" value="{{ $menu->id }}">--}}
                            {{--{{ $menu->name }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--}}
                            {{--</label>--}}
                            {{--@endif--}}
                            {{--@endforeach--}}
                            {{--<br>--}}
                            企业后台 <br>
                            @foreach($model->getMenus() as $menu)
                                @if($menu->type==3)
                                    <label><input type="checkbox" name="menu_{{$auth}}[]" value="{{ $menu->id }}" {{ $model->getAuthByTwoId($auth,$menu->id)==$menu->id ? 'checked' : '' }}>
                                        {{ $menu->name }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    </label>
                                @endif
                            @endforeach
                            <br>
                            <button type="button" class="am-btn am-btn-primary" onclick="getAuth({{$auth}})">确定更新</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop

