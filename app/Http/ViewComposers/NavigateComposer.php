<?php
namespace App\Http\ViewComposers;

use App\Api\ApiBusiness\ApiLink;
use Illuminate\Contracts\View\View;

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
        $apiLink = ApiLink::navigate(12,0,2);
        return $apiLink['code']==0 ? $apiLink['data'] : [];
    }
}