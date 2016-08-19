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
                <form class="am-form" data-am-validator method="POST" action="{{DOMAIN}}admin/goods" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <fieldset>
                        <div class="am-form-group">
                            <label>产品 / Name：</label>
                            <input type="text" placeholder="至少2个字符" minlength="2" required name="name"/>
                        </div>

                        <div class="am-form-group">
                            <label>片源类型 / Genre：</label>
                            <select name="genre">
                                @foreach($model['genres'] as $kgenre=>$genre)
                                    <option value="{{ $kgenre }}">{{ $genre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>产品主体 / Type：</label>
                            <select name="type">
                                @foreach($model['types'] as $ktype=>$type)
                                    <option value="{{ $ktype }}">{{ $type }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>分类 / Category：</label>
                            <select name="type">
                                @foreach($model['types'] as $ktype=>$type)
                                    <option value="{{ $ktype }}">{{ $type }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>说明 / Introduce：</label>
                            <textarea name="intro" cols="50" rows="5"></textarea>
                        </div>

                        <button type="submit" class="am-btn am-btn-primary">保存添加</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop

