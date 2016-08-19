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
                <form class="am-form" data-am-validator method="POST" action="{{DOMAIN}}admin/design/{{$data->id}}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="POST">
                    <fieldset>
                        <div class="am-form-group">
                            <label>设计名称 / Name：</label>
                            <input type="text" placeholder="至少2个字符" minlength="2" required name="name" value="{{ $data->name }}"/>
                        </div>

                        <div class="am-form-group">
                            <label>供求类型 / Genre：</label>
                            @foreach($model['genres'] as $kgenre=>$vgenre)
                                <label><input type="radio" name="genre" value="{{ $kgenre }}"
                                            {{ $kgenre==$data->genre ? 'checked' : '' }}/> {{ $vgenre }}&nbsp;&nbsp;</label>
                            @endforeach
                        </div>

                        <div class="am-form-group">
                            <label>设计类型 / Category：</label>
                            <select name="cate" required>
                            @foreach($model['cates'] as $kcate=>$vcate)
                                <option value="{{ $kcate }}" {{ $kcate==$data->cate ? 'selected' : '' }}>{{ $vcate }}</option>
                            @endforeach
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>用户名称 / User Name：</label>
                            <input type="text" placeholder="用户名称" minlength="2" name="uname" required value="{{ $data->uname }}">
                        </div>

                        <div class="am-form-group">
                            <label>设计说明 / Introduce：</label>
                            <textarea name="intro" cols="50" rows="5">{{ $data->intro }}</textarea>
                        </div>

                        <div class="am-form-group">
                            <label>价格 / Price：</label>
                            <input type="text" placeholder="数字" pattern="^\d+\(\d+\.\d{1,2})$" required name="price" value="{{ $data->price }}"/>
                        </div>

                        <button type="submit" class="am-btn am-btn-primary">保存修改</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop

