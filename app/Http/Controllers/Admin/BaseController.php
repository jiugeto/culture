<?php
namespace App\Http\Controllers\Admin;

use App\Models\Admin\AdminModel;
use App\Models\Admin\MenusModel;
//use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\ActionModel;
use App\Models\LinkModel;
use App\Tools;

class BaseController extends Controller
{
    /**
     * 系统后台基础控制器
     */

    /**
     * 面包屑
     */
    protected $crumb = [
        'main'=> [
            'name'=> '系统后台',
            'url'=> '',
        ],
        'category'=> [
            'name'=> '功能',
            'url'=> '',
        ],
        ''=> [
            'name'=> '列表',
            'url'=> '',
        ],
        'show'=> [
            'name'=> '详情',
            'url'=> 'show',
        ],
        'create'=> [
            'name'=> '添加',
            'url'=> 'create',
        ],
        'edit'=> [
            'name'=> '修改',
            'url'=> 'edit',
        ],
        'trash'=> [
            'name'=> '回收站',
            'url'=> 'trash',
        ],
        'notrash'=> [
            'action','menus','admin','role','link','commain','cominfo','comfirm','commodule','comfunc'
        ],
    ];

    public function __construct()
    {
        if (\Session::has('admin.limit')) {
            $this->limit = AdminModel::where('username',\Session::get('admin.username'))->first()->limit;
        }
    }

    /**
     * 获取权限数据列表
     */
    public function actions()
    {
        if ($actions = ActionModel::all()) {
            return Tools::getChild($actions,$pid=0);
        }
        return [];
    }

    /**
     * 获取链接数据列表
     */
    public function links()
    {
        if ($links = LinkModel::all()) {
            return Tools::getChild($links,$pid=0);
        }
        return [];
    }

    /**
     * 获取前台控制菜单列表
     */
    public function menus()
    {
        if ($menus = MenusModel::all()) {
            return Tools::getChild($menus,$pid=0);
        }
        return [];
    }
}