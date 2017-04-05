<?php
namespace App\Http\Controllers\Company\Admin;

use App\Api\ApiBusiness\ApiComFunc;
use App\Api\ApiBusiness\ApiComModule;
use App\Http\Controllers\BaseController as Controller;
use Session;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    /**
     * 公司后台控制中心基础控制器
     */

    /**
     * 面包屑
     */
    protected $lists = [
        'main'=> [
            'name'=> '企业后台',
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

    public function __construct()
    {
        parent::__construct();
        if (!Session::has('user.cid')) {
            echo "<script>alert('未登录或非公司身份！');history.go(-1);</script>";exit;
        }
        $this->userid = Session::get('user.uid');
        $this->cid = Session::get('user.cid');
        if (Session::has('user.company')) {
            $this->company = Session::get('user.company');
        }
        View::share('company',$this->company);                             //共享公司数据
        define("DOMAIN_C_BACK",DOMAIN."com/back/");                        //公司请求链接前缀
    }

    /**
     * 条件获取功能
     */
    public function getFuncs($cid,$genre,$limit,$pageCurr,$prefix_url)
    {
        $apiModule = ApiComModule::getModuleByGenre($cid,$genre);
        if ($apiModule['code']!=0) {
            echo "<script>alert('没有记录！');history.go(-1);</script>";exit;
        }
        $module = $apiModule['data']['id'];
        $apiFunc = ApiComFunc::index($limit,$pageCurr,$cid,$module,2);
        if ($apiFunc['code']!=0) {
            $datas = array(); $total = 0;
        } else {
            $datas = $apiFunc['data']; $total = $apiFunc['pagelist']['total'];
        }
        $pagelist = $this->getPageList($total,$prefix_url,$limit,$pageCurr);
        return array(
            'datas' =>  $datas,
            'pagelist'  =>  $pagelist,
        );
    }

    /**
     * 收集功能数据
     */
    public function getData(Request $request,$genre)
    {
        if (!$this->cid) {
            echo "<script>alert('非企业或者未登录！');history.go(-1);</script>";exit;
        }
        $apiModule = ApiComModule::getModuleByGenre($this->cid,$genre);
        if ($apiModule['code']!=0) {
            echo "<script>alert('没有记录！');history.go(-1);</script>";exit;
        }
        $module = $apiModule['data']['id'];
        if (in_array($genre,[6,9])) {
            $small = '';
        } else if ($genre==7) {
            $small = $request->small;
        } else {
            $small = '';
        }
        return array(
            'name'  =>  $request->name,
            'cid'   =>  $this->cid,
            'module_id' =>  $module,
            'intro' =>  $request->intro,
            'small' =>  $small,
        );
    }
}