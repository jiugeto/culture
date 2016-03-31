<?php
namespace App\Http\Controllers\Home;

class EntertainController extends BaseController
{
    /**
     * 网站前台租赁频道
     */

    public function index()
    {
        $result = [
            'menus'=> $this->list,
            'curr'=> 'rent',
        ];
        return view('home.rent.index', $result);
    }
}