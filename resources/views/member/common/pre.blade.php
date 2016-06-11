{{-- 会员后台视频预览模板，外在视图要有个id=pre --}}


<div class="play" style="display:none;">
    <embed src="http://yuntv.letv.com/bcloud.swf" allowFullScreen="true" quality="high"  width="640" height="360" align="middle" allowScriptAccess="always" flashvars="uu=1ew2bpfrka&vu=9c87e2e08b&pu=5fc8cd11e6&auto_play=0&gpcflag=1{{--&width=640&height=360--}}" type="application/x-shockwave-flash"></embed>
    <a id="close">X</a>
</div>

<script>
    $(document).ready(function(){
        $("#pre").click(function(){ $(".play").show(); });
        $("#close").click(function(){
            $(".play").html('');
        });
    });
</script>