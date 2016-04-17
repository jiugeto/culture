<?php
namespace App\Http\Controllers\Home;

class SupplyController extends BaseController
{
    /**
     * 网站前台供应企业
     */

    public function index()
    {
        $result = [
//            'menus'=> $this->menus,
            'curr_menu'=> 'supply',
        ];
        return view('home.supply.index', $result);
    }
}