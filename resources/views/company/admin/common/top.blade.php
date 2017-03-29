{{-- 企业后台控制管理中心顶部 --}}


<div class="com_admin_top">
    <table>
        <tr><td></td><td></td></tr>
        <tr>
            <td class="left">
                {{Session::has('user.company')?Session::get('user.company')['name']:'未知公司'}}后台管理中心
            </td>
            <td class="right">
                <a href="{{DOMAIN}}c/{{Session::get('user.cid')}}"
                    title="返回到{{Session::get('user.company')['name']}}企业首页">
                    返回公司首页</a>
                &nbsp;&nbsp;登陆者：{{Session::get('user.username')}} &nbsp;&nbsp;
                时间：{{Session::get('user.loginTime')}}
            </td>
        </tr>
    </table>
</div>