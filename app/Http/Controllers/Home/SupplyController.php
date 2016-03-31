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
            'menus'=> $this->list,
            'curr'=> 'supply',
        ];
        return view('home.supply.index', $result);
    }
}