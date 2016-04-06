<?php
namespace App\Http\Controllers\Home;

class AboutController extends BaseController
{
    /**
     * 网站前台租赁频道
     */

    public function index($genre=0)
    {
        $result = [
            'menus'=> $this->menus,
            'curr_menu'=> 'about',
        ];
        return view('home.about.index', $result);
    }
}