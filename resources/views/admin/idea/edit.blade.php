@extends('admin.main')
@section('content')
    <div class="admin-content">
        @include('admin.common.crumb')
        <div class="am-g">
            {{--@include('admin.common.menu')--}}
        </div>
        <hr/>

        <div class="am-g">
            @include('admin.common.info')
            <div class="am-u-sm-12 am-u-md-8 am-u-md-pull-4">
                <form class="am-form" data-am-validator method="POST" action="{{DOMAIN}}admin/idea/{{$data['id']}}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="POST">
                    <fieldset>
                        <div class="am-form-group">
                            <label>创意名称 / Name：</label>
                            <input type="text" placeholder="至少2个字符" minlength="2" maxlength="20" required name="name" value="{{$data['name']}}"/>
                        </div>

                        <div class="am-form-group">
                            <label>创意供求 / Genre：</label>
                            <select name="genre" required>
                                @foreach($model['genres'] as $k=>$vgenre)
                                    <option value="{{$k}}" {{$data['genre']==$k?'selected':''}}>{{$vgenre}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>创意类型 / Category：</label>
                            <select name="cate" required>
                                @foreach($model['cates'] as $k=>$vcate)
                                    <option value="{{$k}}" {{$data['cate']==$k?'selected':''}}>{{$vcate}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>发布方 / User Name：</label>
                            <input type="text" placeholder="用户名称" minlength="2" maxlength="20" required name="uname" value="{{UserNameById($data['uid'])}}">
                        </div>

                        <div class="am-form-group">
                            <label>简介 / Introduce：</label>
                            <textarea name="intro" cols="50" rows="5" required>{{$data['intro']}}</textarea>
                        </div>

                        <div class="am-form-group">
                            <label>详情是否显示 / Is Detail：</label>
                            <select name="isdetail" required>
                                @foreach($model['isdetails'] as $k=>$visdetail)
                                    <option value="{{$k}}" {{$data['isdetail']==$k?'selected':''}}>{{$visdetail}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>详情 / Detail：</label>
                            <textarea name="detail" cols="50" rows="10" required>{{$data['detail']}}</textarea>
                        </div>

                        <div class="am-form-group">
                            <label>价格 / Price：</label>
                            <input type="text" placeholder="正整数" pattern="^\d+$" name="money" required value="{{$data['money']}}"/>
                        </div>

                        <button type="submit" class="am-btn am-btn-primary">保存修改</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop

