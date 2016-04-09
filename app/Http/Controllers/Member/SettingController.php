<?php
namespace App\Http\Controllers\Member;

use App\Models\UserModel;

class SettingController extends BaseController
{
    /**
     *会员认证管理
     */

//    type：1普通用户，2普通企业，3设计师，4制作公司，5租赁公司，6娱乐公司

    public function __construct()
    {
        $this->lists['func']['name'] = '用户设置';
        $this->lists['func']['url'] = 'setting';
        $this->uid = \Session::has('user.uid');
        if ($this->uid) { return redirect('/logon'); }
    }

    public function edit()
    {
        $result = [
            'data'=> UserModel::find($this->uid),
            'lists'=> $this->lists,
            'curr_list'=> '',
            'menus'=> $this->menus,
        ];
        return view('member.setting.edit', $result);
    }
}