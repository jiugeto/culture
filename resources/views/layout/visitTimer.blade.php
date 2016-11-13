{{--做一个访问的定时器--}}


<input type="hidden" name="_token" value="{{csrf_token()}}">
<input type="hidden" name="cid" value="{{ CID }}">
<input type="hidden" name="uid" value="{{ Session::has('user') ? Session::get('user.uid') : 0 }}">
<input type="hidden" name="visit_url" value="{{ $_SERVER['REQUEST_URI'] }}">
<input type="hidden" name="visitRate" value="{{ VISITRATE }}">
<script>
    $.ajaxSetup({headers : {'X-CSRF-TOKEN':$('input[name="_token"]').val()}});
    //定时器 异步运行
    function count(){
        console.log('hello');
        var uid = $("input[name='uid']").val();
        var cid = $("input[name='cid']").val();
        var visit_url = $("input[name='visit_url']").val();
        //ajax局部刷新
        $.ajax({
            type: 'POST',
            url: '{{DOMAIN}}c/{{CID}}/visitlog/set',
            data: {'uid':uid,'cid':cid,'visit_url':visit_url},
            dataType: 'json',
            success: function(data) {
//                $(".laymsg").hide(); $(".layback").show(); $("#backcon").html(data.message);
            }
        });
    }

    //使用方法名字定时执行方法
    var visitRate = $("input[name='visitRate']");
//    var t2 = window.setInterval("count()",1000 * 2);
    window.setInterval("count()",1000 * visitRate.val());
//    window.clearTimeout(t1);//去掉定时器
</script>