@include('admin.proCreation.basic.playStyle')

<div style="width:720px;height:405px;background:ghostwhite;">{{--背景--}}</div>
<div id="win_out">
    <div class="img img1">
        <div class="pos">
            <div class="dh"><img src="/uploads/images/2016/ppt.png"></div>
        </div>
    </div>

    <div class="img img2">
        <div class="pos">
            <div class="dh"><img src="/uploads/images/2016/online1.png"></div>
        </div>
        <div class="pos">
            <div class="dh"><img src="/uploads/images/2016/online1.png"></div>
        </div>
        <div class="pos">
            <div class="dh"><img src="/uploads/images/2016/online1.png"></div>
        </div>
    </div>

    <div class="img img3">
        <div class="pos">
            <div class="dh"><img src="/uploads/images/2016/online1.png"></div>
        </div>
        <div class="pos">
            <div class="dh"><img src="/uploads/images/2016/online1.png"></div>
        </div>
    </div>

    <div class="img img4">
        <div class="pos">
            <div class="dh"><img src="/uploads/images/2016/ppt.png"></div>
        </div>
    </div>

    <div class="img img4">
        <div class="pos">
            <div class="dh"><img src="/uploads/images/2016/ppt.png"></div>
        </div>
    </div>

    <div class="img img5">
        <div class="pos">
            <div class="dh"><img src="/uploads/images/2016/ppt.png"></div>
        </div>
    </div>

    <div class="img end">
        <div class="dh">END</div>
    </div>
</div>

<audio id="audio" autoplay>
    <source src="{{PUB}}uploads/audio/15211285.wav" type="audio/wav"/>
</audio>

<div class="switch">
    <a onclick=""><button class="onlinebtn play" style="display:none;">播 放</button></a>
    <a onclick=""><button class="onlinebtn stop">暂 停</button></a>
    <a href=""><button class="onlinebtn">重 置</button></a>
    <div class="timeline"><div class="dh" id="timeline">{{--时间线进度条--}}</div></div>
</div>

<script src="{{PUB}}assets/js/jquery-1.10.2.min.js"></script>
<script>
    //函数自调用，来暂停播放
//    (function(){
//        $(".dh").css('animation-play-state','paused');
//        $(".stop").hide(); $(".play").show();
//    })();
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