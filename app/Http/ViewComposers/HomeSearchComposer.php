<?php
namespace App\Http\ViewComposers;

use App\Models\Home\SearchModel;
use Illuminate\Contracts\View\View;
//use Illuminate\Support\Facades\DB;

class HomeSearchComposer
{
    /**
     * 绑定系统后台左侧菜单的数据
     */

    public function compose(View $view)
    {
        $view->with('searchs', array(
//            'genres'    =>  $this::getSearchGenres(),
//            'hotwords'  =>  $this->getSearchKeyWords()
        ));
    }

    public function getSearchGenres()
    {
        $searchModel = new SearchModel();
        return $searchModel['genres'];
    }

    public static function getSearchKeyWords()
    {
        return SearchModel::getHotWords();
    }
}