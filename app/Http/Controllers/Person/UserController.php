<?php
namespace App\Http\Controllers\Person;

use App\Models\UserModel;

class UserController extends BaseController
{
    /**
     * 个人后台 用户管理
     */

    public function index()
    {
        $result = [
            'links'=> $this->links,
            'curr'=> 'user',
        ];
        return view('person.user.index', $result);
    }

    public function getHead()
    {
        $result = [
            'data'=> UserModel::find($this->userid),
            'links'=> $this->links,
            'curr'=> 'user',
        ];
        return view('person.user.head', $result);
    }
}