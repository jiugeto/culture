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
                <form class="am-form" data-am-validator method="POST" action="/admin/cominfo" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <fieldset>
                        <div class="am-form-group">
                            <label>信息名称 / Name：</label>
                            <input type="text" placeholder="至少2个字符" minlength="2" required name="name"/>
                        </div>

                        <div class="am-form-group">
                            <label>信息类型 / Type：</label>
                            <select name="type">
                                <option value="">选择类型</option>
                                @foreach($types as $ktype=>$type)
                                    <option value="{{ $ktype }}">{{ $type }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>图片 / Picture (最多6张)：<a href="/admin/pic">图片列表</a></label>
                            <select name="pic_id">
                                <option value="">选择图片</option>
                                @if($pics)
                                @foreach($pics as $pic)
                                    <option value="{{ $pic->name }}">{{ $pic->name }}</option>
                                @endforeach
                                @endif
                            </select>
                            <input type="hidden" name="numPic" value="1">
                            <span id="more"></span>
                            <br> <a class="am-btn am-btn-primary" id="add">更多图片</a>
                            <script>
                                $(document).ready(function(){
                                    $("#add").click(function(){
                                        var numPic = $("input[name='numPic']");
                                        var picHtml = '';
                                        numPic[0].value = numPic.val()*1+1;
                                        if(numPic.val()>6){ alert('图片限制6张！');return false; }
                                        picHtml += '<br>图片(第'+numPic.val()+'张)';
                                        picHtml += '<select name="pic_id'+numPic.val()+'">';
                                        picHtml += '<option value="">选择图片</option>';
                                        picHtml += '@if($pics)';
                                        picHtml += '@foreach($pics as $kpic=>$pic)';
                                        picHtml += '<option value="{{ $kpic }}">{{ $pic->name }}</option>';
                                        picHtml += '@endforeach';
                                        picHtml += '@endif';
                                        picHtml += '</select>';
                                        picHtml += '';
                                        $("#more").append(picHtml);
                                    });
                                });
                            </script>
                        </div>

                        <div class="am-form-group">
                            <label>内容 / intro：</label>
                            @include('UEditor::head')
                            <script id="container" name="intro" type="text/plain"></script>
                            <script type="text/javascript">
                                var ue = UE.getEditor('container',{
                                    //initialFrameWidth:500,
                                    initialFrameHeight:200,
                                    toolbars:[['redo','undo','bold','italic','underline','strikethrough','horizontal','forecolor','fontfamily','fontsize','priview','directionality','paragraph','imagefloat','insertimage','searchreplace','pasteplain','help']]
                                });
                                ue.ready(function() {
                                    //此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.
                                    ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');
                                });
                            </script>
                        </div>

                        <div class="am-form-group">
                            <label>排序 / Sort：</label>
                            <input type="text" pattern="^\d+$" required name="sort" value="10">
                        </div>

                        <div class="am-form-group">
                            <label>是否置顶 / Is Top：</label>
                            <label><input type="radio" name="istop" value="0" checked> 不置顶&nbsp;&nbsp;</label>
                            <label><input type="radio" name="istop" value="1"> 置顶&nbsp;&nbsp;</label>
                        </div>

                        <div class="am-form-group">
                            <label>前台是否显示 / Is Show：</label>
                            <label><input type="radio" name="isshow" value="0"> 不显示&nbsp;&nbsp;</label>
                            <label><input type="radio" name="isshow" value="1" checked> 显示&nbsp;&nbsp;</label>
                        </div>

                        <button type="submit" class="am-btn am-btn-primary">保存添加</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop

