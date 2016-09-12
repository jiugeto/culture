{{--加载编辑器的模板--}}


@include('UEditor::head')
<script id="container" name="intro" type="text/plain">
    @if(isset($data->intro)){!! $data->intro !!}@endif
</script>
<script type="text/javascript">
    var ue = UE.getEditor('container',{
        initialFrameWidth:400,
        initialFrameHeight:100,
        toolbars:[['redo','undo','bold','italic','underline','strikethrough','horizontal','forecolor','fontfamily','fontsize','priview','directionality','paragraph','imagefloat','insertimage','searchreplace','pasteplain','help','fullscreen']]
    });
    ue.ready(function() {
        //此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.
        ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');
    });
</script>