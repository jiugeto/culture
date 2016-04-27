<?php
namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use App\Models\Admin\ActionModel;
use App\Models\Admin\MenusModel;
use App\Tools;
//use Illuminate\Support\Facades\DB;

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
        return Tools::getChild(MenusModel::CompanyMenus(),$pid=0);
    }
}