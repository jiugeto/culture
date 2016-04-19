<?php
namespace App\Http\Controllers\Person;

class SettingController extends BaseController
{
    /**
     * 个人后台首页
     */

    public function __construct()
    {
        $this->list['func']['name'] = '资料设置';
        $this->list['func']['url'] = '';
    }

    public function index()
    {
        $result = [
            'menus'=> $this->list,
        ];
        return view('person.setting.index', $result);
    }
}