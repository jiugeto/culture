<?php
namespace App\Http\Controllers\Admin;

use App\Models\Admin\MenusModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LinkModel;
use App\Tools;
use Session;
use Redis;

class BaseController extends Controller
{
    /**
     * 系统后台基础控制器
     */

    protected $limit = 20;       //每页显示记录数

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
            'action','menus','admin','role','link','commain','cominfo','comfirm','commodule','comfunc',
            'staff','works','place','ad','product','proAttr','proLayer','proCon','opinions',
        ],
    ];

    public function __construct()
    {
        parent::__construct();
        $this->setSessionInRedis($this->redisTime);     //同步缓存中session
        if (!Session::has('admin')) { return redirect('/admin/login'); }
        $this->adminid = Session::get('admin.adminid');
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

    /**
     * 判断缓存中的session
     */
    public function setSessionInRedis($redisTime)
    {
        //假如session中有，缓存中没有，则同步为有
        if (Session::get('admin') && !Redis::get('cul_admin_session')) {
            $adminInfo = Session::get('admin');
            $adminInfo['cookie'] = $_COOKIE;
            Redis::setex('cul_admin_session',$redisTime,serialize($adminInfo));
        }
        //假如session中没有，缓存中有，则同步为有
        if (!Session::get('admin') && Redis::get('cul_admin_session')) {
            $cul_admin_session = unserialize(Redis::get('cul_admin_session'));
            $cul_admin_session['cookie'] = $_COOKIE;
            if ($cul_admin_session['cookie']!=$_COOKIE) { echo 'no';exit; }
            Session::put('admin',$cul_admin_session);
        }
        //更新session中的cookie值
        if (Session::get('admin')) {
            $adminInfo = Session::get('admin');
            $adminInfo['cookie'] = $_COOKIE;
            Redis::setex('cul_admin_session',$redisTime,serialize($adminInfo));
            Session::put('admin',$adminInfo);
        }
    }
}