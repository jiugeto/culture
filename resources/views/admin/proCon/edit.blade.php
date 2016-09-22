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
                <form class="am-form" data-am-validator method="POST" action="{{DOMAIN}}admin/{{$attrModel->id}}/proCon/{{ $data->id }}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="POST">
                    <fieldset>
                        <div class="am-form-group">
                            <label>类型 / Genre：</label>
                            <select name="genre" required>
                                @if($model['genres'])
                                    @foreach($model['genres'] as $kgenre=>$vgenre)
                                        <option value="{{ $kgenre }}" {{ $data->genre==$kgenre ? 'selected' : '' }}>{{ $vgenre }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="am-form-group" style="display:{{$data->genre==1?'selected':'none'}};" id="pic">
                            <label>图片 / Picture：</label>
                            @include('admin.proCon.piclist')
                        </div>

                        <div class="am-form-group" style="display:{{$data->genre==2?'block':'none'}};" id="text">
                            <label>文字内容 / Content：</label>
                            <input type="text" placeholder="至少2个字符" minlength="2" name="name"/>
                        </div>

                        <button type="submit" class="am-btn am-btn-primary">保存修改</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>

    <script>
        $("select[name='genre']").change(function(){
            var genre = $(this).val();
            if (genre==1) {
                $("#pic").show(); $("#text").hide();
            } else if (genre==2) {
                $("#pic").hide(); $("#text").show();
            }
        });
    </script>
@stop