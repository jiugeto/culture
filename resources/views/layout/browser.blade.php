{{-- 浏览器判断 --}}


<style>
    #liulanq { padding:5px 20px;font-size:20px;background:white;position:fixed;z-index:1000;display:none; }
</style>
<script>
    (function isIE() {
        var userAgent = window.navigator.userAgent; //取得浏览器的userAgent字符串
        if (userAgent.indexOf("MSIE")/*!=-1*/>0) {
            alert('你的IE系列浏览器过旧，建议升级为谷歌、火狐等浏览器，正常浏览！');
            $("#liulanq").show();
        } else if (userAgent.indexOf("Firefox")>0 || userAgent.indexOf("Chrome")>0 || userAgent.indexOf("Safari")>0 || userAgent.indexOf("Opera")>0) {
            $("#liulanq").hide();
        } else {
            alert('你非谷歌、火狐等浏览器，建议升级为谷歌、火狐等浏览器，正常浏览！');
            $("#liulanq").show();
        }
    })();
</script>
<div id="liulanq">
    选择浏览器(此处或者其他)，点击下载后，双击安装：
    <a href="https://www.baidu.com/link?url=8O4F8BEU7P9uhZNXZduwDLtdkRbof4tECbj3fGEpn_uKQVFC3h3U8vZ8TNb1lz7qYpzMbklxMkx9gPq8xytJE1ge_ZaFdca80CQia_cPir_&wd=&eqid=e3943fe00001ec450000000457a84309" target="_blank">谷歌浏览器</a>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <a href="http://download.firefox.com.cn/releases-sha2/stub/official/zh-CN/Firefox-latest.exe" target="_blank">火狐浏览器</a>
</div>