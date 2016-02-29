<?php
namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use App\Models\LinkModel;
use App\Tools;
//use Illuminate\Support\Facades\DB;

class FooterComposer
{
    /**
     * 绑定系统后台左侧菜单的数据
     */

    public function compose(View $view)
    {
        $view->with('footers', $this::getFooters());
    }

    public static function getFooters()
    {
        return Tools::getChild(LinkModel::footers(),$pid=0);
    }
}