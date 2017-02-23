{{--后台弹窗模板：上传缩略图--}}


<style>
    .popup { padding:10px;display:none; }
    .mask {
        width:100%;height:100%;background:black;
        filter:alpha(opacity:30); opacity:0.3;  -moz-opacity:0.3; -khtml-opacity:0.3;
        position:fixed; left:0; top:0; z-index:100;
    }
    .content {
        padding:20px;width:550px;color:grey;background:white;
        position:fixed;left:35%;top:200px;z-index:100;
    }
    .content select,.content input { padding:10px;width:450px;border:1px solid lightgrey; }
    .content p { padding:0 20px; }
    .content a {
        padding:10px 20px;color:gainsboro;background:orangered;
        position:absolute;left:550px;top:0;cursor:pointer;
    }
    .content a:hover { color:white; }
    .content button[type='submit'] {
        margin:10px 180px;padding:5px 20px;border:0;color:white;
        font-family:'微软雅黑';font-size:20px;background:#0e90d2;cursor:pointer;
    }
</style>

<div class="popup" id="thumb">
    <div class="mask"></div>
    <div class="content">
        <form id="formthumb" action="" method="POST" enctype="multipart/form-data" data-am-validator>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method" value="POST">
            <p style="text-align:center;" class="pname">产品 缩略图更新</p>
            @include('admin.common.uploadimg')
            <button type="submit" class="homebtn">立即上传</button>
        </form>
        <a title="关闭" onclick="getClose()">X</a>
    </div>
</div>