,,@extends('admin.main')
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
                <form class="am-form" data-am-validator method="POST" action="{{DOMAIN}}admin/menus/{{ $data['id'] }}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="POST">
                    <fieldset>
                        <div class="am-form-group">
                            <label>菜单名称 / Name：</label>
                            <input type="text" placeholder="至少2个字符" minlength="2" required name="name" value="{{ $data['name'] }}"/>
                        </div>

                        <div class="am-form-group">
                            <label>菜单类型 / Type：</label>
                            <select name="type" required>
                                @foreach($model['types'] as $k=>$type)
                                    <option value="{{ $k }}"
                                            {{ $data['type']==$k ? 'selected' : '' }}>
                                        {{ $type }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>父级菜单 / Pid：</label>
                            <select name="pid1" id="pid1" style="display:{{$data['type']==1?'block':'none'}};">
                                <option value="0" {{ $data['pid']==0 ? 'selected' : '' }}>-0级菜单-</option>
                                @foreach($parents as $parent)
                                    @if($parent['type']==1)
                                        <option value="{{ $parent['id'] }}"
                                                {{ $data['pid']==$parent['id'] ? 'selected' : '' }}>
                                            {{ $parent['name'] }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <select name="pid2" id="pid2" style="display:{{$data['type']==2?'block':'none'}};">
                                <option value="0">-0级菜单-</option>
                                @foreach($parents as $parent)
                                    @if($parent['type']==2)
                                        <option value="{{ $parent['id'] }}"
                                                {{ $data['pid']==$parent['id'] ? 'selected' : '' }}>
                                            {{ $parent['name'] }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <select name="pid3" id="pid3" style="display:{{$data['type']==3?'block':'none'}};">
                                <option value="0">-0级菜单-</option>
                                @foreach($parents as $parent)
                                    @if($parent['type']==3)
                                        <option value="{{ $parent['id'] }}"
                                                {{ $data['pid']==$parent['id'] ? 'selected' : '' }}>
                                            {{ $parent['name'] }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <script>
                            $(document).ready(function(){
                                var type = $("select[name='type']");
                                var pid1 = $("#pid1");
                                var pid2 = $("#pid2");
                                var pid3 = $("#pid3");
                                type.change(function(){
                                    if(type.val()==1){ pid1.show(); pid2.hide(); pid3.hide(); }
                                    if(type.val()==2){ pid1.hide(); pid2.show(); pid3.hide(); }
                                    if(type.val()==3){ pid1.hide(); pid2.hide(); pid3.show(); }
                                });
                            });
                        </script>

                        <div class="am-form-group">
                            <label>命名空间 / Namespace：</label>
                            <input type="text" placeholder="例：App\Http\Controllers\Admin" pattern="^[A-Z][a-zA-Z_\\]+$" required name="namespace" value="{{ $data['namespace'] }}"/>
                        </div>

                        <div class="am-form-group">
                            <label>控制器名称 / Controller Name：</label>
                            <input type="text" placeholder="例：TestController" pattern="^[A-Z][a-zA-Z_]+$" required name="controller_prefix" value="{{ $data['controller_prefix'] }}Controller"/>
                        </div>

                        <div class="am-form-group">
                            <label>平台路由 / Plat Url：</label>
                            <input type="text" placeholder="例：member" pattern="^[a-zA-Z_/]+$" required name="platUrl" value="{{ $data['platUrl'] }}"/>
                        </div>

                        <div class="am-form-group">
                            <label>访问路径部分url / Url：</label>
                            <input type="text" placeholder="例：action" {{--pattern="^[a-zA-Z_]+$"--}} required name="url" value="{{ $data['url'] }}"/>
                        </div>

                        <div class="am-form-group">
                            <label>方法名 / Function Name：</label>
                            <input type="text" placeholder="例：index" pattern="^[a-zA-Z_]+$" required name="action" value="{{ $data['action'] }}"/>
                        </div>

                        <div class="am-form-group">
                            <label>Class样式 / Style Name：</label>
                            <input type="text" pattern="^[a-zA-Z_-]+$" name="style_class" value="{{ $data['style_class'] }}"/>
                        </div>

                        <div class="am-form-group">
                            <label>描述 / Introduce：</label>
                            <textarea name="intro" cols="50" rows="5">{{ $data['intro'] }}</textarea>
                        </div>

                        {{--<div class="am-form-group">--}}
                            {{--<label>会员后台是否显示 / Is Show：</label>--}}
                            {{--<label><input type="radio" name="isshow" value="1" {{ $data['isshow']==1 ? 'checked' : '' }}/> 不显示&nbsp;&nbsp;</label>--}}
                            {{--<label><input type="radio" name="isshow" value="2" {{ $data['isshow']==2 ? 'checked' : '' }}/> 显示&nbsp;&nbsp;</label>--}}
                        {{--</div>--}}

                        <div class="am-form-group">
                            <label>排序 / Sort：</label>
                            <input type="text" pattern="^\d+$" name="sort" required value="{{ $data['sort'] }}"/>
                        </div>

                        <button type="submit" class="am-btn am-btn-primary">保存修改</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop

