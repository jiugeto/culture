<?php
/**
 * Created by PhpStorm.
 * User: liubin
 * Date: 15/4/20
 * Time: 22:46
 */

namespace App\Http\Middleware;

use Session;
use App\Models\UserModel;
use Closure;
use Hash;

class MemberAuth
{
    public function handle($request, Closure $next)
    {
//        dd(Session::get('user.username'));
        //判断系统后台有无此登录的用户
        if(!Session::has('user.username')){
//            Session::put('msg', '请先登录');
            return redirect('/login');
        }
        //验证密码
        $username = Session::get('user.username');
        $password = Session::get('user.password');
        $adminModel = UserModel::where('username',$username)->first();
//        dd($password,Hash::make($password),$adminModel);
        if(!$adminModel || !(Hash::check($password,$adminModel->password))){
            dd('密码错误');
            return redirect('/login');
        }
        return $next($request);
    }
}