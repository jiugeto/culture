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
                <form class="am-form" data-am-validator method="POST" action="{{ url('/admin/menus') }}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <fieldset>
                        <div class="am-form-group">
                            <label>菜单名称 / Name：</label>
                            <input type="text" placeholder="至少2个字符" minlength="2" required name="name"/>
                        </div>

                        <div class="am-form-group">
                            <label>菜单类型 / Type：</label>
                            <select name="type" required>
                                @foreach($types as $kt=>$type)
                                    <option value="{{ $kt }}">{{ $type }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>父级菜单 / Pid：</label>
                            <select name="pid">
                                <option value="0">-0级菜单-</option>
                                @foreach($pids as $pid)
                                    <option value="{{ $pid->id }}">{{ $pid->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>命名空间 / Namespace：</label>
                            <input type="text" placeholder="例：App\Http\Controllers\Admin" pattern="^[A-Z][a-zA-Z_\\]+$" required name="namespace"/>
                        </div>

                        <div class="am-form-group">
                            <label>控制器名称 / Controller Name：</label>
                            <input type="text" placeholder="例：TestController" pattern="^[A-Z][a-zA-Z_]+$" required name="controller_prefix"/>
                        </div>

                        <div class="am-form-group">
                            <label>访问路径部分url / Url：</label>
                            <input type="text" placeholder="例：action" pattern="^[a-zA-Z_]+$" required name="url"/>
                        </div>

                        <div class="am-form-group">
                            <label>方法名 / Function Name：</label>
                            <input type="text" placeholder="例：index" pattern="^[a-zA-Z_]+$" required name="action"/>
                        </div>

                        <div class="am-form-group">
                            <label>Class样式 / Style Name：</label>
                            <input type="text" pattern="^[a-zA-Z_-]+$" name="style_class"/>
                        </div>

                        <div class="am-form-group">
                            <label>描述 / Introduce：</label>
                            <textarea name="intro" cols="50" rows="5"></textarea>
                        </div>

                        <div class="am-form-group">
                            <label>前台是否显示 / Is Show：</label>
                            <label><input type="radio" name="isshow" value="0"/> 不显示&nbsp;&nbsp;</label>
                            <label><input type="radio" name="isshow" value="1" checked/> 显示&nbsp;&nbsp;</label>
                        </div>

                        <button type="submit" class="am-btn am-btn-primary">保存添加</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop

