<?php
namespace App\Http\ViewComposers;

use App\Api\ApiBusiness\ApiMenu;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class CompanyAdminMenuComposer
{
    /**
     * 绑定系统后台左侧菜单的数据
     */

    public function compose(View $view)
    {
        $view->with('companyMenus', $this::getCompanyMenus());
    }

    public static function getCompanyMenus()
    {
        //菜单类型type：1会员后台member，2个人后台person，3企业后台company
        $apiMenu = ApiMenu::getMenusByType(3);
        return $apiMenu['code']==0 ? $apiMenu['data'] : [];
    }
}