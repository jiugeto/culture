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

class MemberAuth
{
    public function handle($request, Closure $next)
    {
//        dd(Session::get('admin.username'));
        //判断系统后台有无此登录的用户
        if(!Session::has('user.username')){
//            Session::put('msg', '请先登录');
            return redirect('/admin/login');
        }
        //验证密码
        $username = Session::get('user.username');
        $adminModel = UserModel::where('username',$username)->first();
        if (!$adminModel) { return redirect('/admin/login'); }
        if(Session::get('user.password')!=$adminModel->password){
            return redirect('/admin/login');
        }
        return $next($request);
    }
}