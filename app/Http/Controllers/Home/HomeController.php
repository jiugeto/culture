<?php
namespace App\Http\Controllers\Home;

class HomeController extends BaseController
{
    /**
     * 网站首页
     */

    public function index()
    {
        $result = [
            'curr'=> 'home',
        ];
        return view('home.home.index', $result);
    }
}