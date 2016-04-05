<?php
/**
 * Created by PhpStorm.
 * User: liubin
 * Date: 15/4/20
 * Time: 22:46
 */

namespace App\Http\Middleware;

//use App\Models\Admin\ActionModel;
//use Illuminate\Support\Facades\Route;
//use Illuminate\Support\Facades\View;
//use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Session;
//use Illuminate\Http\Request;
use Session;
use App\Models\Admin\AdminModel;
use Closure;

class AdminAuth
{
    public function handle($request, Closure $next)
    {
//        dd(Session::get('admin.username'));
        //判断系统后台有无此登录的用户
        if(!Session::has('admin.username')){
            Session::flash('msg', '请先登录');
            return redirect('/admin/login');
        }
        //验证密码
        $username = Session::get('admin.username');
        $adminModel = AdminModel::where('username',$username)->first();
        if (!$adminModel) { return redirect('/admin/login'); }
        if(Session::get('admin.password')!=$adminModel->password){
            return redirect('/admin/login');
        }
        return $next($request);
    }
}