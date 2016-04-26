<?php
namespace App\Http\Controllers\Company\Admin;

class AuthController extends BaseController
{
    /**
     * 企业后台权限
     */

    public function __construct()
    {
        $this->list['func']['name'] = '权限设置';
        $this->list['func']['url'] = 'auth';
    }

    public function index()
    {
        $result = [
            'lists'=> $this->list,
        ];
        return view('company.admin.auth.index', $result);
    }
}