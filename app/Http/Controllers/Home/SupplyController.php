<?php
namespace App\Http\Controllers\Home;

class SupplyController extends BaseController
{
    /**
     * 网站前台创作窗口
     */

    public function index()
    {
        $result = [
            'menus'=> $this->list,
            'curr'=> 'supply',
        ];
        return view('home.supply.index', $result);
    }
}