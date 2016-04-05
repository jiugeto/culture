<?php
/**
 * Created by PhpStorm.
 * User: liubin
 * Date: 15/4/20
 * Time: 22:46
 */

namespace App\Http\Middleware;


use Closure;
//use App\Models\Admin\ActionModel;
//use Illuminate\Support\Facades\Route;
//use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminAuth
{
    public function handle($request, Closure $next)
    {
        //判断系统后台有无此登录的用户
        if(!Session::has('admin.username')){
            return redirect('/admin/login');
        }
        //验证
        if(Session::get('admin.password')!=$request->password){
            Session::put('admin.username', $request->username);
            Session::put('admin.password', $request->password);
        }
        return $next($request);
    }
}