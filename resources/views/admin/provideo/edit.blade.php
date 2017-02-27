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
                <form class="am-form" data-am-validator method="POST" action="{{DOMAIN}}admin/provideo/{{$data['id']}}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="POST">
                    <fieldset>
                        <div class="am-form-group">
                            <label>需求名称 / Name：</label>
                            <input type="text" placeholder="至少2个字符" minlength="2" maxlength="20" required name="name" value="{{$data['name']}}"/>
                        </div>

                        <div class="am-form-group">
                            <label>定制方式 / Genre：</label>
                            <select name="genre" required>
                                @foreach($model['genres'] as $k=>$vgenre)
                                    <option value="{{$k}}" {{$k==$data['genre']?'selected':''}}>{{$vgenre}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>需求类型 / Category：</label>
                            <select name="cate" required>
                                @foreach($model['cates'] as $k=>$vcate)
                                    <option value="{{$k}}" {{$k==$data['cate']?'selected':''}}>{{$vcate}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>产品简介 / Introduce：</label>
                            <textarea name="intro" cols="50" rows="5">{{$data['intro']}}</textarea>
                        </div>

                        <div class="am-form-group">
                            <label>发布方 / User Name：</label>
                            <input type="text" placeholder="至少2个字符" minlength="2" maxlength="20" required name="uname" value="{{UserNameById($data['uid'])}}"/>
                        </div>

                        <button type="submit" class="am-btn am-btn-primary">保存修改</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop

