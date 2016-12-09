<?php
namespace App\Http\Controllers\Home;

class NewUserController extends BaseController
{
    /**
     * 网站前台
     */

    public function index()
    {
        $result = [
            'curr_menu'=> 'newuser',
        ];
        return view('home.newuser.index', $result);
    }
}