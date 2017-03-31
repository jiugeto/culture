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
    .content select,.content input { padding:0 10px;width:450px;border:1px solid lightgrey; }
    .content p { padding:0 20px; }
    .content a {
        padding:10px 20px;color:gainsboro;background:orangered;
        position:absolute;left:550px;top:0;cursor:pointer;
    }
    .content a:hover { color:white; }
    .content input[type="button"] { padding:5px;width:470px;color:#e5e5e5;background:#808080;cursor:pointer; }
    .content input[type="file"] { display:none; }
    .content #preview { margin:5px;width:300px;height:150px;border:1px dotted #5bc0de;
        filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale); }
    .content button[type='submit'] {
        margin:10px 180px;padding:5px 20px;border:0;color:white;
        font-family:'微软雅黑';font-size:20px;background:#ff4466;cursor:pointer;
    }
    .content a.close { position:absolute;left:590px; }
</style>

<div class="popup" id="thumb">
    <div class="mask"></div>
    <div class="content">
        <form id="formthumb" action="" method="POST" enctype="multipart/form-data" data-am-validator>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method" value="POST">
            <p style="text-align:center;" class="pname">产品 缩略图更新</p>
            <script src="{{PUB}}assets/js/local_pre.js"></script>
            <input type="text" placeholder="本地图片地址" readonly name="url_file">
            <input type="button" value="[找图]" onclick="path.click()" title="去选择图片">
            <input type="file" id="path" onchange="url_file.value=this.value;loadImageFile();" name="url_ori">
            <div id="preview"></div>
            <button type="submit" class="homebtn" title="点击上传">立即上传</button>
        </form>
        <a title="关闭" onclick="getClose()" class="close">X</a>
    </div>
</div>
<div class="popup" id="link">
    <div class="mask"></div>
    <div class="content">
        <form id="formlink" action="" method="POST" enctype="multipart/form-data" data-am-validator>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method" value="POST">
            <p style="text-align:center;" class="pname">产品 视频链接更新</p>
            <p>链接类型：
                <select name="linkType">
                    @foreach($model['linkTypes'] as $k=>$linkType)
                        <option value="{{$k}}">{{$linkType}}</option>
                    @endforeach
                </select>
            </p>
            <p>视频链接：
                <input type="text" placeholder="输入视频链接，可以去视频门户网复制过来" required minlength="2" name="link">
            </p>
            <button type="submit" class="homebtn" title="点击更新">立即更新</button>
        </form>
        <a title="关闭" onclick="getClose()">X</a>
    </div>
</div>