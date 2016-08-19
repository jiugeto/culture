@extends('admin.main')
@section('content')
    <div class="admin-content">
        @include('admin.common.crumb')
        <div class="am-g">
            {{--@include('admin.common.menu')--}}
            {{--@include('admin.type.search')--}}
        </div>
        <hr/>

        <div class="am-g">
            @include('admin.common.info')
            <div class="am-u-sm-12 am-u-md-8 am-u-md-pull-4">
                <form class="am-form" data-am-validator method="POST" action="{{DOMAIN}}admin/area/{{ $data->id }}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="POST">
                    <fieldset>
                        <div class="am-form-group">
                            <label>城市名称 / City Name：</label>
                            <input type="text" placeholder="城市名称" minlength="2" required name="cityname" value="{{ $data->cityname }}"/>
                        </div>

                        <div class="am-form-group">
                            <label>父id / Pid：</label>
                            <select name="parentid">
                                @foreach($parents as $parent)
                                    @if($parent->id!=$data->id)
                                    <option value="{{ $parent->id }}" {{ $data->parentid==$parent->id ? 'selected' : '' }}>{{ $parent->cityname }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="am-btn am-btn-primary">保存修改</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@stop

