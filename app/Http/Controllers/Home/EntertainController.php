<?php
namespace App\Http\Controllers\Home;

class EntertainController extends BaseController
{
    /**
     * 网站前台娱乐频道
     */

    public function index()
    {
        $result = [
            'menus'=> $this->menus,
            'curr_menu'=> 'entertain',
        ];
        return view('home.entertain.index', $result);
    }
}