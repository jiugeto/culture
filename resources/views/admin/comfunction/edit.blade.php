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
                <form class="am-form" data-am-validator method="POST" action="/admin/comfunction/{{$data->id}}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_emthod" value="POST">
                    <fieldset>
                        <div class="am-form-group">
                            <label>功能名称 / Name：</label>
                            <input type="text" placeholder="至少2个字符" minlength="2" required name="name" value="{{ $data->name }}"/>
                        </div>

                        <div class="am-form-group">
                            <label>细节描述 / Detail：</label>
                            <textarea name="detail" cols="50" rows="5">{{ $data->detail }}</textarea>
                        </div>

                        <div class="am-form-group">
                            <label>小标题 / Title：</label>
                            <input type="text" placeholder="至少2个字符，多组标题用|隔开" minlength="2" required name="title" value="{{ $data->title }}"/>
                        </div>

                        <div class="am-form-group">
                            <label>功能内容 / Introduce：</label>
                            <textarea cols="50" rows="5" placeholder="多组标题用|隔开" name="intro">{{ $data->intro }}</textarea>
                        </div>

                        <div class="am-form-group">
                            <label>小字 / Small：</label>
                            <input type="text" placeholder="至少2个字符，多组标题用|隔开" minlength="2" required name="small" value="{{ $data->small }}"/>
                        </div>

                        <div class="am-form-group">
                            <label>是否为初始化功能 / Is Default：</label>
                            <label><input type="radio" name="isdefault" value="1" {{ $data->isdefault==1 ? 'checked' : '' }}> 是&nbsp;&nbsp;</label>
                            <label><input type="radio" name="isdefault" value="2" {{ $data->isdefault==2 ? 'checked' : '' }}> 否&nbsp;&nbsp;</label>
                        </div>

                        <div class="am-form-group">
                            <label>图片 / Picture：</label>
                            <select name="pic_id">
                                <option value="">选择图片</option>
                            @if($pics)
                                @foreach($pics as $pic)
                                        <option value="{{ $pic->id }}" {{ $data->pic_id==$pic->id ? 'selected' : '' }}>
                                            <img src="{{ $pic->url }}" style="width:50px;">
                                            {{ $pic->name }}</option>
                                @endforeach
                            @endif
                            </select>
                        </div>

                        <button type="submit" class="am-btn am-btn-primary">保存修改</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop

