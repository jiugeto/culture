<?php
namespace App\Http\Controllers\Home;

class HomeController extends BaseController
{
    /**
     * 网站首页
     */

    public function index()
    {
        return view('home.home.index');
    }

//    /**
//     * 获得首页数据
//     */
//    public function getData()
//    {
//        return [
//            'headers'=> $this->header(),
//            'navigates'=> $this->navigate(),
//            'footers'=> $this->footer(),
//            'menus'=> $this->menus($type=4),
//        ];
//    }
}