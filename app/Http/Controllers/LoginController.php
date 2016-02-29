<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * 会员注册页面
     * 支持手机、邮箱、用户名
     */

    public function index()
    {
        return view('loginOrRegist.login.index');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        dd($data);
        return redirect('/');
    }
}