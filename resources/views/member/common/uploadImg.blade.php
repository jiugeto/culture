{{--会员后台上传图片的模板--}}


<style>
    #uploadImg { padding:5px 20px; }
    #zhaotu { padding:10px;padding-bottom:30px;width:150px;line-height:20px;color:#FFFFFF;font-size:20px;background:orangered;cursor:pointer; }
    #bendi { padding:3px 10px;width:300px; }
</style>
<script src="{{PUB}}assets/js/local_pre.js"></script>
<div id="uploadImg">
    <input type="button" id="zhaotu" value="[ 找图 ]" title="点击去找图片" onclick="path.click()">
    <input type="file" id="path" style="display:none" onchange="url_file.value=this.value;loadImageFile();" name="url_ori">
    <input type="text" id="bendi" placeholder="本地图片地址" name="url_file" readonly>
    <div id="preview" style="width:450px;height:150px;border:1px dotted grey;
    filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale);"></div>
</div>