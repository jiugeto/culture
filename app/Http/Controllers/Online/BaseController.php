<?php
namespace App\Http\Controllers\Online;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    /**
     * 在线创作窗口基础控制器
     */

    public function __construct()
    {
        parent::__construct();
        $this->userid = \Session::has('user.uid') ? \Session::get('user.uid') : redirect('/login');
    }
}