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
                <form class="am-form" data-am-validator method="POST" action="{{PUB}}admin/staff/{{$data['id']}}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="POST">
                    <fieldset>
                        <div class="am-form-group">
                            <label>人员艺名 / Name：</label>
                            <input type="text" placeholder="至少2个字符" minlength="2" required name="name" value="{{$data['name']}}"/>
                        </div>

                        <div class="am-form-group">
                            <label>职员类型 / Type：</label>
                            <select name="type" required>
                                @foreach($model['types'] as $k=>$vtype)
                                    <option value="{{$k}}" {{$data['type']==$k?'selected':''}}>{{$vtype}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>发布方 / User Name：</label>
                            <input type="text" placeholder="至少2个字符" minlength="2" required name="uname" value="{{UserNameById($data['uid'])}}"/>
                        </div>

                        <div class="am-form-group">
                            <label>性别 / Sex：</label>
                            <label><input type="radio" class="radio" name="sex" value="1" {{$data['sex']==1?'checked':''}}/> 男&nbsp;&nbsp;</label>
                            <label><input type="radio" class="radio" name="sex" value="2" {{$data['sex']==2?'checked':''}}/> 女&nbsp;&nbsp;</label>
                        </div>

                        <div class="am-form-group">
                            <label>真实名字 / Real Name：</label>
                            <input type="text" placeholder="至少2个字符" minlength="2" required name="realname" value="{{$data['realname']}}"/>
                        </div>

                        <div class="am-form-group">
                            <label>所在地 / Origin：</label>
                            <input type="text" placeholder="至少2个字符" minlength="2" required name="origin" value="{{$data['origin']}}"/>
                        </div>

                        <div class="am-form-group">
                            <label>学历 / Education：</label>
                            <select name="education" required>
                            @foreach($model['edus'] as $k=>$vedu)
                                <option value="{{$k}}" {{$data['education']==$k?'selected':''}}>{{$vedu}}</option>
                            @endforeach
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>毕业学校 / School：</label>
                            <input type="text" placeholder="至少2个字符" minlength="2" required name="school" value="{{$data['school']}}"/>
                        </div>

                        <div class="am-form-group">
                            <label>兴趣爱好 / Hobby：</label><br>
                            @foreach($model['hobbys'] as $k=>$vhobby)
                                <label><input type="checkbox" name="hobby[]" value="{{$k}}" @if($data['hobby']&&in_array($k,$data['hobbys'])){{'checked'}}@endif/> {{$vhobby}}&nbsp;&nbsp;</label>
                            @endforeach
                        </div>

                        <div class="am-form-group">
                            <label>身高 / Height：(单位cm)</label>
                            <input type="text" placeholder="数字，单位cm" pattern="^([1-9]\d)|([1-9]\d{2})$" required name="height" value="{{$data['height']}}"/>
                        </div>

                        {{--<div class="am-form-group">--}}
                            {{--<label for="content">动态内容 / Activity Content：</label>--}}
                            {{--@include('UEditor::head')--}}
                            {{--<script id="container" name="content" type="text/plain"></script>--}}
                            {{--<!-- 实例化编辑器 -->--}}
                            {{--<script type="text/javascript">--}}
                                {{--var ue = UE.getEditor('container',{--}}
                                    {{--//initialFrameWidth:500,--}}
                                    {{--//initialFrameHeight:200,--}}
{{--//                                    toolbars:[['redo','undo','bold','italic','underline','strikethrough','horizontal','forecolor','fontfamily','fontsize','priview','directionality','paragraph','searchreplace','pasteplain','help']]--}}
                                {{--});--}}
                                {{--ue.ready(function() {--}}
                                    {{--//此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.--}}
                                    {{--ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');--}}
                                {{--});--}}
                            {{--</script>--}}
                        {{--</div>--}}

                        <button type="submit" class="am-btn am-btn-primary">保存修改</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop

