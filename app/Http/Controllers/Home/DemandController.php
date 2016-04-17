<?php
namespace App\Http\Controllers\Home;

class DemandController extends BaseController
{
    /**
     * 网站前台需求信息
     */

    public function index()
    {
        $result = [
//            'menus'=> $this->menus,
            'curr_menu'=> 'demand',
        ];
        return view('home.demand.index', $result);
    }
}