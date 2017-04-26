<?php
namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use App\Api\ApiBusiness\ApiSearch;

class SearchComposer
{
    /**
     * 绑定系统后台左侧菜单的数据
     */

    public function compose(View $view)
    {
        $view->with('searchModel', $this::getSearchModel());
    }

    public static function getSearchModel()
    {
        $apiSearch = ApiSearch::getModel();
        return $apiSearch['code']==0 ? $apiSearch['model'] : [];
    }
}