<?php
namespace App\Http\Controllers\Home;

class NewUserController extends BaseController
{
    /**
     * 网站前台租赁频道
     */

    public function index()
    {
        $result = [
            'curr_menu'=> 'newuser',
        ];
        return view('home.newuser.index', $result);
    }
}