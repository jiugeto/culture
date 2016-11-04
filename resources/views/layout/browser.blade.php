{{-- 浏览器判断 --}}


<style>
    #liulanqi { width:100%;height:100%;position:fixed;top:0;left:0;z-index:1100; }
    #liulanqi #mask { width:100%;height:100%;background:black;filter:alpha(opacity=50);-moz-opacity:0.5;-khtml-opacity: 0.5;opacity: 0.5;   }
    #liulanqi #llq { padding:30px 20px;width:460px;border:2px solid black;font-size:20px;background:white;text-align:center;position:fixed;top:20%;left:30%;z-index:1100; }
    #liulanqi a { color:orangered; }
</style>
<div id="liulanqi" style="display:none;">
    <div id="mask"></div>
    <div id="llq">
        您的浏览器过旧<br>
        建议升级谷歌、火狐等浏览器，正常浏览<br>
        选择浏览器(此处或者其他官网)<br>
        点击下载后，双击安装：<br>
        <a href="https://www.baidu.com/link?url=8O4F8BEU7P9uhZNXZduwDLtdkRbof4tECbj3fGEpn_uKQVFC3h3U8vZ8TNb1lz7qYpzMbklxMkx9gPq8xytJE1ge_ZaFdca80CQia_cPir_&wd=&eqid=e3943fe00001ec450000000457a84309" target="_blank">谷歌浏览器(百度版)</a><br>
        <a href="http://www.google.cn/chrome/browser/desktop/index.html" target="_blank">谷歌浏览器(官网)</a><br>
        <a href="http://download.firefox.com.cn/releases-sha2/stub/official/zh-CN/Firefox-latest.exe" target="_blank">火狐浏览器(官网)</a>
    </div>
</div>
<script>
    (function isIE() {
        var userAgent = window.navigator.userAgent; //取得浏览器的userAgent字符串
        if (userAgent.indexOf("MSIE")/*!=-1*/>0) {
//            alert('你的IE系列浏览器过旧，建议升级为谷歌、火狐等浏览器，正常浏览！');
            $("#liulanqi").show();
        } else if (userAgent.indexOf("Firefox")>0 || userAgent.indexOf("Chrome")>0 || userAgent.indexOf("Safari")>0 || userAgent.indexOf("Opera")>0) {
            $("#liulanqi").hide();
        } else {
//            alert('你非谷歌、火狐等浏览器，建议升级为谷歌、火狐等浏览器，正常浏览！');
            $("#liulanqi").show();
        }
    })();
</script>