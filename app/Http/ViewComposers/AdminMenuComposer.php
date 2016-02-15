<?php
namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use App\Models\ActionModel;
use App\Tools;
//use Illuminate\Support\Facades\DB;

class AdminMenuComposer
{
    /**
     * 绑定系统后台左侧菜单的数据
     */

    public function compose(View $view)
    {
        $view->with('actions', $this::getActions());
    }

    public static function getActions()
    {
        return Tools::getChild(ActionModel::all(),$pid=0);
    }
}