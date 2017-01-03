{{--前台视频预览模板--}}


<style>
    #preview { display:none; }
    #preview #mask { width:100%;height:100%;background:black;position:fixed;top:0;left:0;z-index:10;
        filter:alpha(opacity:50);opacity:0.5;-moz-opacity:0.5;-khtml-opacity:0.5; }
    #err { width:500px;height:100px;text-align:center;line-height:100px;background:white;position:fixed;top:300px;left:30%;z-index:10; }
    #err a { color:grey;position:relative;top:-119px;left:280px; }
    #video_pre { width:1000px;height:540px;position:fixed;top:200px;z-index:10; }
    #video_pre a { padding:20px 12px;text-decoration:none;color:white;background:red;z-index:10; }
    #video_pre a:hover { color:orangered;background:black; }
</style>

<div id="preview">
    <div id="mask"></div>
    <div id="video_pre"></div>
</div>

<script>
    function getPreview(id){
        var linkType = $("input[name='linkType"+id+"']").val();
        var link = $("input[name='link"+id+"']").val();
        var preview = '';
        if (link=='') {
//            alert('未上传效果，请耐心等待...');return;
            preview = "<div id='err'>未上传效果，请耐心等待...<br><a href='javascript:void(0);' onclick='closePreview()'>关闭</a></div>";
            $("#video_pre").html(preview);
        } else if (linkType==1) {
            preview = '<embed src="'+link+'" allowFullScreen="true" quality="high" width="960" height="540" align="middle" allowScriptAccess="always" type="application/x-shockwave-flash"></embed>';
            preview += ' <a href="javascript:;" onclick="closePreview()">X</a>';
            $("#video_pre").html(preview).css('top','180px').css('margin-left','30px');
            $("#video_pre embed").css('position','').css('left','');
            $("#video_pre iframe").css('position','').css('left','');
            $("#video_pre a").css('position','relative').css('top','-232px').css('left','0px');
        } else if (linkType==2 || linkType==3) {
            preview = link;
            $("#video_pre").html(preview).css('top','200px').css('margin','auto');
            $("#video_pre embed").css('position','relative').css('left','180px');
            $("#video_pre iframe").css('position','relative').css('left','180px');
            $("#video_pre").append(' <a href="javascript:;" class="close" onclick="closePreview()">X</a>');
            $("#video_pre a").css('position','relative').css('top','-162px').css('left','180px');
        }
        $("#preview").show(200);
    }
    function closePreview(){
        window.location.href = '';
    }
</script>