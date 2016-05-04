<?php
namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use App\Models\Admin\ActionModel;
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
        return Tools::getChild(ActionModel::where('isshow',1)->orderBy('sort','desc')->get(),$pid=0);
    }
}