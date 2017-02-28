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
                <form class="am-form" data-am-validator method="POST" action="{{DOMAIN}}admin/link/{{$data['id']}}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="POST">
                    <fieldset>
                        <div class="am-form-group">
                            <label>链接名称 / Name：</label>
                            <input type="text" placeholder="至少2个字符" minlength="2" maxlength="20" required name="name" value="{{$data['name']}}"/>
                        </div>

                        <div class="am-form-group">
                            <label>显示方式 / Way：</label>
                            <label><input type="radio" name="display_way" value="1" {{$data['display_way']==1?'checked':''}}>文字方式显示&nbsp;&nbsp;</label>
                            <label><input type="radio" name="display_way" value="2" {{$data['display_way']==2?'checked':''}}>图片方式显示&nbsp;&nbsp;</label>
                        </div>

                        <div class="am-form-group">
                            <label>图片id / Picture：</label>
                        </div>

                        <div class="am-form-group">
                            <label>鼠标移动显示 / Title：</label>
                            <input type="text" name="title" value="{{$data['title']}}"/>
                        </div>

                        <div class="am-form-group">
                            <label>链接类型 / Type：</label>
                            <select name="type" onchange="getType(this.value)">
                                @foreach($model['types'] as $k=>$vtype)
                                    <option value="{{$k}}" {{$data['type']==$k?'selected':''}}>{{$vtype}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>父链接 / Parent：</label>
                            <select name="pid" required>
                                <option value="0" {{$data['pid']==0?'selected':''}}>0级链接</option>
                                @foreach($plinks as $plink)
                                    @if($plink['type']==$data['type'])
                                        <option value="{{$plink['id']}}" {{$data['pid']==$plink['id']?'selected':''}}>
                                            {{$plink['name']}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>链接介绍 / Introduce：</label>
                            <textarea name="intro" cols="50" rows="5">{{$data['intro']}}</textarea>
                        </div>

                        <div class="am-form-group">
                            <label>访问链接地址 / Link：</label>
                            <input type="text" placeholder="至少2个字符('/'代表首页)" required name="link" value="{{$data['link']}}"/>
                        </div>

                        <div class="am-form-group">
                            <label>发布单位 / Company Name：</label>
                            <input type="text" placeholder="公司名称，不填代表本站" name="cname" value="{{ComNameById($data['cid'])}}"/>
                        </div>

                        <button type="submit" class="am-btn am-btn-primary">保存修改</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>

    <script>
        function getType(type){
            var html = '';
            html += '<option value="0">0级链接</option>';
            html += '@foreach($plinks as $plink)';
            if (type==1) {
                html += '@if($plink['type']==1)';
                html += '<option value="{{$plink['id']}}">{{$plink['name']}}</option>';
                html += '@endif';
            } else if (type==2) {
                html += '@if($plink['type']==2)';
                html += '<option value="{{$plink['id']}}">{{$plink['name']}}</option>';
                html += '@endif';
            } else if (type==3) {
                html += '@if($plink['type']==3)';
                html += '<option value="{{$plink['id']}}">{{$plink['name']}}</option>';
                html += '@endif';
            }
            html += '@endforeach';
            html += '';
            $("select[name='pid']").html(html);
        }
    </script>
@stop

