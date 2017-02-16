<?php
namespace App\Http\Controllers\Member;

use App\Api\ApiUser\ApiUsers;
use App\Http\Controllers\BaseController as Controller;
use Session;

class BaseController extends Controller
{
    /**
     * 会员后台基础控制器
     */

    public function __construct()
    {
        parent::__construct();
        if (!Session::has('user')) { return redirect('/login'); }
        $this->userid = Session::get('user.uid');
        $this->userType = Session::get('user.userType');
    }
}