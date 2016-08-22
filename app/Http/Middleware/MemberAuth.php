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
        //判断会员后台有无此登录的用户
        if(!Session::has('user.username')){
            return redirect('/login');
        }
//        //验证密码
//        $username = Session::get('user.username');
//        $userModel = UserModel::where('username',$username)->first();
//        if(!$userModel || !(Hash::check($request->password,$userModel->password))){
//            return redirect('/login');
//        }
        return $next($request);
    }
}