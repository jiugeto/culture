<?php
namespace App\Http\Controllers\Home;

class DesignController extends BaseController
{
    /**
     * 网站前台租赁频道
     */

    public function index($genre=0)
    {
        $result = [
            'menus'=> $this->list,
            'curr'=> 'design',
            'genre'=> $genre,
        ];
        return view('home.design.index', $result);
    }
}