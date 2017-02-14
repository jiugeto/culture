<?php
namespace App\Http\ViewComposers;

use App\Api\ApiBusiness\ApiLink;
use Illuminate\Contracts\View\View;

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
        $apiLink = ApiLink::footer(5,0,2);
        return $apiLink['code']==0 ? $apiLink['data'] : [];
    }
}