<?php
namespace App\Http\ViewComposers;

use App\Api\ApiBusiness\ApiLink;
use Illuminate\Contracts\View\View;

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
        $apiLink = ApiLink::header(5,0,2);
        return $apiLink['code']==0 ? $apiLink['data'] : [];
    }
}