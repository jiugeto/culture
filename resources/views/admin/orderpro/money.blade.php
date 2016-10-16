{{--创作定价模板--}}


<style>
    .sureMoney { width:100%;height:100%;clear:both;position:fixed;top:0;left:0;display:none; }
    .sureMoney .popup_bg { width:100%;height:100%;background:rgba(0,0,0,0.5); }
    .sureMoney .popup_money { width:500px;height:200px;border:1px solid black;background:white;position:fixed;left:35%;top:35%; }
    .sureMoney p { padding:5px;text-align:center; }
    .sureMoney input { padding:5px 10px;width:250px;border:1px solid lightgrey; }
</style>

<div class="sureMoney">
    <div class="popup_bg">&nbsp;</div>
    <div class="popup_money">
        <p><b>创作价格制定</b></p>
        <p>制作修改价格：<input type="text" placeholder="输入该动画价格" name="money"></p>
        <p><button type="submit" class="am-btn am-btn-primary" onclick="getSureMoney()">保存价格</button></p>
    </div>
</div>

<script>
    function getSureMoney(){
        var money = $("input[name='money']").val();
        var id = $("input[name='id']").val();
        alert(id);return;
        if (money=='' || money==0) {
            alert('价格必填！');return;
        } else if (isNaN(money)) {
            alert('价格必须是数字！');return;
        }
        window.location.href = '{{DOMAIN}}admin/orderpro/money/'+id+'/'+money;
    }
</script>