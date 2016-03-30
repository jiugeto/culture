<?php
namespace App\Http\Controllers\Home;

class CreationController extends BaseController
{
    /**
     * 网站前台创作窗口
     */

    public function index()
    {
        $result = [
            'menus'=> $this->list,
            'curr'=> 'creation',
        ];
        return view('home.creation.index', $result);
    }
}