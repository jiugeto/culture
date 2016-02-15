<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * 数据在系统后台页面共享
     */

    public function boot()
    {
        //系统后台左侧菜单数据
//        view()->composer(
//            'admin.partials.menu', 'App\Http\ViewComposers\AdminMenuComposer'
//        );
        View::composer(
            'admin.partials.menu', 'App\Http\ViewComposers\AdminMenuComposer'
        );
    }

    public function register()
    {
        //
    }
}