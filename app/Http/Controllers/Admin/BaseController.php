<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
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
    ];

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
}