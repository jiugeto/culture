<?php
/**
 * Created by PhpStorm.
 * User: liubin
 * Date: 15/4/20
 * Time: 22:46
 */

namespace App\Http\Middleware;

use Session;
use Closure;

class AdminAuth
{
    public function handle($request, Closure $next)
    {
        //判断系统后台有无此登录的用户
        if(!Session::has('admin')){
            return redirect('/admin/login');
        }
        return $next($request);
    }
}