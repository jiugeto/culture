<?php
namespace App\Http\Controllers\Person;

class HomeController extends BaseController
{
    /**
     * 个人后台首页
     */

//    public function __construct()
//    {
//        $this->list['func']['name'] = '个人首页';
//        $this->list['func']['url'] = '';
//    }

    public function index()
    {
        return view('person.home.index');
    }
}