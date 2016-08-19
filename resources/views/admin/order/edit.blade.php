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
                <form class="am-form" data-am-validator method="POST" action="{{DOMAIN}}admin/order/{{$data->id}}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="POST">
                    <fieldset>
                        <div class="am-form-group">
                            <label>订单状态 / Status：</label>
                            <select name="status">
                                @foreach($model['genreNames'] as $kgenre=>$genreName)
                                    <option value="{{ $kgenre }}" {{ $data->genre }}>{{ $genreName }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="am-form-group">
                            <label>是否删除 / Is Del：</label>
                            <label><input type="radio" name="del" value="0" {{ $data->del==0 ? 'checked' : '' }}/> 删除&nbsp;&nbsp;</label>
                            <label><input type="radio" name="del" value="1" {{ $data->del==1 ? 'checked' : '' }}/> 还原&nbsp;&nbsp;</label>
                        </div>

                        <div class="am-form-group">
                            <label>前台显示否 / Is Show：</label>
                            <label><input type="radio" name="isshow" value="0" {{ $data->isshow==0 ? 'checked' : '' }}/> 前台不显示&nbsp;&nbsp;</label>
                            <label><input type="radio" name="isshow" value="1" {{ $data->isshow==1 ? 'checked' : '' }}/> 前台显示&nbsp;&nbsp;</label>
                        </div>

                        <button type="submit" class="am-btn am-btn-primary">保存修改</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop

