{{-- 这里是在线创作的静帧展示模板 --}}


{{--  在线创建窗口 --}}
<div class="online_win">
    <div class="animate">
        {{--动画开始--}}
        @if(count($attrs))
        @foreach($attrs as $attr)
        <div class="{{ $attr->style_name }}">
            @if($attr->cons())
            @foreach($attr->cons() as $con)
                <div class="pos">
                    <div class="dh">
                    @if($con->genre==1)
                        <img src="{{ $conModel->getPicUrl($con->pic_id) }}">
                    @elseif($con->genre==2)
                        <div class="text">{{ $con->name }}</div>
                    @endif
                    </div>
                </div>
            @endforeach
            @endif
        </div>
        @endforeach
        @endif
        {{--动画结束--}}
    </div>
</div>
<div style="height:230px;">{{--空白--}}</div>
{{--  在线创建窗口 --}}