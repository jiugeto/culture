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
                <form class="am-form" data-am-validator method="POST" action="{{DOMAIN}}admin/auth/getAuth/{{$auth}}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="POST">
                    <input type="hidden" name="auth" value="{{$auth}}">
                    <fieldset>
                        <div class="am-form-group" style="padding:2px 10px;border:1px dashed lightgrey;">
                            {{--<label style="color:orangered;">{{ $model['auths'][$auth] }}</label>--}}

                            <label>功能 / Menus：</label> <br>
                           <b>1> 会员后台：</b><br>
                            @foreach($menusM as $menu)
                                <label><input type="checkbox" name="menu[]" value="{{ $menu['id'] }}"
                                        {{ in_array($menu['id'],$menuIds) ? 'checked' : '' }}>
                                    {{ $menu['name'] }}
                                    </label><br>
                                @if($menu['child'])
                                    <div style="margin-left:30px;">
                                        @foreach($menu['child'] as $submenu)
                                            <label><input type="checkbox" name="menu[]" value="{{ $submenu['id'] }}"
                                                        {{ in_array($submenu['id'],$menuIds) ? 'checked' : '' }}>
                                                {{ $submenu['name'] }}&nbsp;&nbsp;&nbsp;&nbsp;
                                            </label>
                                        @endforeach
                                    </div>
                                @endif
                            @endforeach
                            <br><hr>

                            <b>2> 个人后台：</b><br>
                            @foreach($menusP as $menu)
                                <label><input type="checkbox" name="menu[]" value="{{ $menu['id'] }}"
                                            {{ in_array($menu['id'],$menuIds) ? 'checked' : '' }}>
                                        {{ $menu['name'] }}
                                    </label><br>
                                @if($menu['child'])
                                    <div style="margin-left:30px;">
                                        @foreach($menu['child'] as $submenu)
                                            <label><input type="checkbox" name="menu[]" value="{{ $submenu['id'] }}"
                                                        {{ in_array($submenu['id'],$menuIds) ? 'checked' : '' }}>
                                                {{ $submenu['name'] }}&nbsp;&nbsp;&nbsp;&nbsp;
                                            </label>
                                        @endforeach
                                    </div>
                                @endif
                            @endforeach
                            <br><hr>

                            <b>3> 企业后台：</b><br>
                            @foreach($menusC as $menu)
                                <label><input type="checkbox" name="menu[]" value="{{ $menu['id'] }}"
                                            {{ in_array($menu['id'],$menuIds) ? 'checked' : '' }}>
                                    {{ $menu['name'] }}
                                </label><br>
                                @if($menu['child'])
                                    <div style="margin-left:30px;">
                                        @foreach($menu['child'] as $submenu)
                                            <label><input type="checkbox" name="menu[]" value="{{ $submenu['id'] }}"
                                                        {{ in_array($submenu['id'],$menuIds) ? 'checked' : '' }}>
                                                {{ $submenu['name'] }}&nbsp;&nbsp;&nbsp;&nbsp;
                                            </label>
                                        @endforeach
                                    </div>
                                @endif
                            @endforeach
                            <br><hr>

                            <button type="submit" class="am-btn am-btn-primary">确定更新</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop

