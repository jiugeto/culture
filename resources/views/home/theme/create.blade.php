@extends('home.main')
@section('content')
    <div class="talk_con">
        <form class="form" data-am-validator method="POST" action="{{DOMAIN}}theme" enctype="multipart/form-data">
            <div class="head">添加专栏</div>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <input type="text" class="talk_input" placeholder="标题，至少2个字符" minlength="2" required name="name"/>
            <div style="height:10px;"></div>

            @include('UEditor::head')
            {{--这里可以排版文字，插入或粘贴图片--}}
            <script type="text/plain" id="container" name="intro"></script>
            <script type="text/javascript">
                var ue = UE.getEditor('container',{
                    initialFrameWidth:800,
                    initialFrameHeight:400,
                    toolbars:[['redo','undo','bold','italic','underline','strikethrough','horizontal','forecolor','fontfamily','fontsize','indent','priview','directionality','paragraph','searchreplace','insertimage','imagefloat','pasteplain','help','fullscreen']]
                });
                ue.ready(function() {
                    //此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.
                    ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');
                });
            </script>

            <div style="height:40px;"></div>
            <button type="submit" class="homebtn" style="margin-left:350px;">保存添加</button>
            <div style="height:50px;"></div>
        </form>
    </div>
@stop