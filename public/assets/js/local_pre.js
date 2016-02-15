/**
 * 这是js预览本地图片的js文件
 * 案例：
 *      <input type="button" value="[浏览]" onclick="path.click()" class="am-btn am-btn-primary">
 *      <input type="file" id="path" style="display:none" onchange="url_ori.value=this.value;loadImageFile();">
 *      <div id="preview" style="width: 160px; height: 120px; filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale);"></div>
 * */

var loadImageFile = (function () {
    if (window.FileReader) {
        var oPreviewImg = null, oFReader = new window.FileReader(),
            rFilter = /^(?:image\/bmp|image\/cis\-cod|image\/gif|image\/ief|image\/jpeg|image\/jpeg|image\/jpeg|image\/pipeg|image\/png|image\/svg\+xml|image\/tiff|image\/x\-cmu\-raster|image\/x\-cmx|image\/x\-icon|image\/x\-portable\-anymap|image\/x\-portable\-bitmap|image\/x\-portable\-graymap|image\/x\-portable\-pixmap|image\/x\-rgb|image\/x\-xbitmap|image\/x\-xpixmap|image\/x\-xwindowdump)$/i;
        oFReader.onload = function (oFREvent) {
            if (!oPreviewImg) {
                var newPreview = document.getElementById("preview");
                oPreviewImg = new Image();
                oPreviewImg.style.width = (newPreview.offsetWidth).toString() + "px";
                oPreviewImg.style.height = (newPreview.offsetHeight).toString() + "px";
                newPreview.appendChild(oPreviewImg);
            }
            oPreviewImg.src = oFREvent.target.result;
        };
        return function () {
            var aFiles = document.getElementById("path").files;
            if (aFiles.length === 0) { return; }
            if (!rFilter.test(aFiles[0].type)) {
                alert("You must select a valid image file!");
                return;
            }
            oFReader.readAsDataURL(aFiles[0]);
        }
    }
    if (navigator.appName === "Microsoft Internet Explorer") {
        return function () {
            alert(document.getElementById("path").value);
            document.getElementById("preview").filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = document.getElementById("path").value;
        }
    }
})();