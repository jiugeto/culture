{{--图片上传模板--}}


<script src="{{PUB}}assets/js/local_pre.js"></script>
<input type="text" placeholder="本地图片地址" readonly name="url_file">
<input type="button" value="[找图]" onclick="path.click()" class="am-btn am-btn-primary">
<input type="file" id="path" style="display:none" onchange="url_file.value=this.value;loadImageFile();" name="url_ori">
<div id="preview" style="margin:5px;width:300px;height:150px;border:1px dotted #5bc0de;filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale);"></div>