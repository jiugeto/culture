@include('admin.proCreation.basic.playStyle')

<div style="width:720px;height:405px;background:ghostwhite;">{{--背景--}}</div>
<div id="win_out">
    @if(count($cons))
        @foreach($cons as $con)
    <div class="attr {{$attr->style_name}}">
        <div class="pos">
            <div class="dh">
                @if($con->genre==1)
                    <img src="{{ $con->getPicUrl() }}">
                @else
                    {{ $con->name }}
                @endif
            </div>
        </div>
    </div>
        @endforeach
    @endif
</div>

<audio id="audio" {{--autoplay--}}>
    <source src="{{PUB}}uploads/audio/15211285.wav" type="audio/wav"/>
</audio>

<div class="switch">
    <a onclick=""><button class="onlinebtn play">播 放</button></a>
    <a onclick=""><button class="onlinebtn stop" style="display:none;">暂 停</button></a>
    <a href=""><button class="onlinebtn">刷 新</button></a>
    <div class="timeline"><div class="dh" id="timeline">{{--时间线进度条--}}</div></div>
</div>

<script src="{{PUB}}assets/js/jquery-1.10.2.min.js"></script>
<script>
    //播放、暂停切换
    $(document).ready(function(){
        var dh = $(".dh");
        $(".play").click(function(){
            dh.css('animation-play-state','running');
            $(this).hide(); $(".stop").show();
            document.getElementById("audio").play();
        });
        $(".stop").click(function(){
            dh.css('animation-play-state','paused');
            $(this).hide(); $(".play").show();
            document.getElementById("audio").pause();
        });
    });
</script>