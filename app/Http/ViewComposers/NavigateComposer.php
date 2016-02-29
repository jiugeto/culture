<?php
namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use App\Models\LinkModel;
use App\Tools;
//use Illuminate\Support\Facades\DB;

class NavigateComposer
{
    /**
     * 绑定系统后台左侧菜单的数据
     */

    public function compose(View $view)
    {
        $view->with('navigates', $this::getNavigates());
    }

    public static function getNavigates()
    {
        return Tools::getChild(LinkModel::navigates(),$pid=0);
    }
}