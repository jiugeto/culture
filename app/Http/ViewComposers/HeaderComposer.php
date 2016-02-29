<?php
namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use App\Models\LinkModel;
use App\Tools;
//use Illuminate\Support\Facades\DB;

class HeaderComposer
{
    /**
     * 绑定系统后台左侧菜单的数据
     */

    public function compose(View $view)
    {
        $view->with('headers', $this::getHeaders());
    }

    public static function getHeaders()
    {
        return Tools::getChild(LinkModel::headers(),$pid=0);
    }
}