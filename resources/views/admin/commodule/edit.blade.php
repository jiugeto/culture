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
                <form class="am-form" data-am-validator method="POST" action="{{DOMAIN}}admin/commodule/{{$data['id']}}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="POST">
                    <fieldset>
                        <div class="am-form-group">
                            <label>公司名称 / Name：</label>
                            <input type="text" placeholder="公司名称" name="cname" value="{{ComNameById($data['cid'])}}" onchange="init(this.value)"/>
                        </div>

                        <div class="am-form-group">
                            <label>模块名称 / Name：</label>
                            <input type="text" placeholder="至少2个字符" minlength="2" maxlength="20" required name="name" value="{{$data['name']}}"/>
                        </div>

                        <div class="am-form-group">
                            <label>类型 / genre：</label>
                            <select name="genre" required>
                                @foreach($model['genres'] as $k=>$vgenre)
                                    <option value="{{$k}}" {{$data['genre']==$k?'selected':''}}>{{$vgenre}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>内容 / intro：</label>
                            <textarea placeholder="模块内容" minlength="2" maxlength="255" required name="intro" cols="50" rows="5">{{$data['intro']}}</textarea>
                            {{--@include('UEditor::head')--}}
                            {{--<script id="container" name="intro" type="text/plain">--}}
                                {{--{!! $data->intro !!}--}}
                            {{--</script>--}}
                            {{--<script type="text/javascript">--}}
                                {{--var ue = UE.getEditor('container',{--}}
                                    {{--//initialFrameWidth:500,--}}
                                    {{--initialFrameHeight:200,--}}
                                    {{--toolbars:[['redo','undo','bold','italic','underline','strikethrough','horizontal','forecolor','fontfamily','fontsize','priview','directionality','paragraph','imagefloat','insertimage','searchreplace','pasteplain','help']]--}}
                                {{--});--}}
                                {{--ue.ready(function() {--}}
                                    {{--//此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.--}}
                                    {{--ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');--}}
                                {{--});--}}
                            {{--</script>--}}
                        </div>

                        <button type="submit" class="am-btn am-btn-primary">保存添加</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>

    <script>
        function init(cname){
            $.ajaxSetup({headers : {'X-CSRF-TOKEN':$('input[name="_token"]').val()}});
            $.ajax({
                type: 'POST',
                url: '{{DOMAIN}}admin/commodule/init',
                data: {'cname':cname},
                dataType: 'json',
                success: function(data) {
                    if (data.code!=0) { alert(data.msg);return; }
//                    alert(data.data);
                }
            });
        }
    </script>
@stop

