<?php
namespace App\Http\ViewComposers;

use App\Api\ApiBusiness\ApiMenu;
use Illuminate\Contracts\View\View;

class MemberMenuComposer
{
    /**
     * 绑定系统后台左侧菜单的数据
     */

    public function compose(View $view)
    {
        $view->with('memberMenus', $this::getMemberMenus());
    }

    public static function getMemberMenus()
    {
        //菜单类型type：1会员后台member，2个人后台person，3企业后台company
        $apiMenu = ApiMenu::getMenusByType(1);
        return $apiMenu['code']==0 ? $apiMenu['data'] : [];
    }
}