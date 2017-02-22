{{--后台弹窗模板：上传缩略图--}}


<style>
    #popup { padding:10px;display:none; }
    #mask {
        width:100%;height:100%;background:black;
        filter:alpha(opacity:30); opacity:0.3;  -moz-opacity:0.3; -khtml-opacity:0.3;
        position:fixed; left:0; top:0; z-index:100;
    }
    #content {
        padding:20px 0;width:600px;color:grey;background:white;
        position:fixed; left:28%; top:200px; z-index:100;
    }
    #content input,#content textarea { padding:5px;width:500px;border:1px solid lightgrey; }
    #content p { padding:0 40px; }
    /*.tankuang .con p.tk_intro {*/
        /*padding:5px 10px;*/
        /*text-align:center;*/
    /*}*/
    #content a {
        padding:10px 20px;color:red;background:grey;cursor:pointer;
        position:absolute;left:600px;top:0; }
    #content a:hover { color:white; }
    #content button[type='submit'] {
        margin:10px 220px;padding:5px 20px;
        border:1px solid orangered;border-radius:3px;color:white;
        font-family:'微软雅黑';font-size:20px;background:orangered;cursor:pointer;
    }
</style>

<div id="popup">
    <div id="mask"></div>
    <div id="content">
        <form id="formthumb" action="" method="POST" enctype="multipart/form-data" data-am-validator>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method" value="POST">
            <p style="text-align:center;" class="pname">产品 缩略图更新</p>
            @include('admin.common.uploadImg')
            <button type="submit" class="homebtn">立即申请</button>
        </form>
        <a title="关闭" onclick="getClose()">X</a>
    </div>
</div>

<script>
    function getThumb(id){
        var name = $("input[name='name_"+id+"']").val();
        $(".pname").html(name+' 缩略图更新');
        $("#formthumb").attr('action','{{DOMAIN}}admin/goods/thumb/'+id);
        $("#thumb").show(200);
    }
    function getLink(id){
        var name = $("input[name='name_"+id+"']").val();
        $(".pname").html(name+' 视频链接更新');
        $("#formlink").attr('action','{{DOMAIN}}admin/goods/link/'+id);
        $("#link").show(200);
    }
    function getClose(){ $('.tankuang').hide(200); }
</script>