<?php
namespace App\Http\Controllers\Home;

class DemandController extends BaseController
{
    /**
     * 网站前台创作窗口
     */

    public function index()
    {
        $result = [
            'menus'=> $this->list,
            'curr'=> 'demand',
        ];
        return view('home.demand.index', $result);
    }
}