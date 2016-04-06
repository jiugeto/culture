<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * 会员注册页面
     * 支持手机、邮箱、用户名
     */

    public function index()
    {
        return view('loginOrRegist.regist');
    }

    public function store(Request $request)
    {
        dd($request->all());
        return redirect('/');
    }
}