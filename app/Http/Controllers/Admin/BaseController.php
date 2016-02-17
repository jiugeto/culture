<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActionModel;
use App\Models\LinkModel;
use App\Tools;

class BaseController extends Controller
{
    /**
     * 系统后台基础控制器
     */
    protected $limit = 10;       //每页显示记录数
    protected $model;       //数据模型
    protected $uploadSizeLimit = 1024*1024*1;       //上传文件大小限制 1M

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