{{-- 企业后台控制管理中心顶部 --}}


<div class="com_admin_top" style="background:{{$company['skin']?$company['skin']:'#323232'}}">
    <table>
        <tr><td></td><td></td></tr>
        <tr>
            <td class="left">
                {{Session::get('user.company')['name']}}
                <span style="font-size:14px;">后台管理中心</span>
            </td>
            <td class="right">
                <a href="{{DOMAIN}}c/{{Session::get('user.cid')}}"
                    title="返回到{{Session::get('user.company')['name']}}企业首页">
                    返回公司首页</a>
                &nbsp;&nbsp;登陆者：{{Session::get('user.username')}} &nbsp;&nbsp;
                时间：{{date('Y年m月d日',Session::get('user.loginTime'))}}
            </td>
        </tr>
    </table>
</div>