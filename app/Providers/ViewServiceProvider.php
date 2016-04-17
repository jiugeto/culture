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
        View::composer(
            'admin.partials.menu', 'App\Http\ViewComposers\AdminMenuComposer'
        );
        //会员后台左侧菜单数据
        View::composer(
            'member.partials.menu', 'App\Http\ViewComposers\MemberMenuComposer'
        );
        //前台顶部header链接
        View::composer(
            'layout.header', 'App\Http\ViewComposers\HeaderComposer'
        );
        //前台navigate链接
        View::composer(
            ['layout.navigate','home.common.crumb'], 'App\Http\ViewComposers\NavigateComposer'
        );
        //前台底部footer链接
        View::composer(
            'layout.footer', 'App\Http\ViewComposers\FooterComposer'
        );
    }

    public function register()
    {
        //
    }
}