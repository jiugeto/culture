<?php
namespace App\Http\Controllers\Company;

use App\Api\ApiBusiness\ApiComModule;
use App\Api\ApiBusiness\ApiLink;
use App\Api\ApiUser\ApiCompany;
use App\Http\Controllers\BaseController as Controller;
use Session;
use Illuminate\Support\Facades\View;

class BaseController extends Controller
{
    /**
     * 公司页面基础控制器
     */

    protected $topmenus = array();
    protected $prefix_url = '';
//    protected $visitRate = 10;       //访问日志间隔时间10s

    public function __construct()
    {
        parent::__construct();
//        View::share('topmenu',$this->getTopMenu());      //共享topmenu数据
//        View::share('footers',$this->getFooter());       //共享footer数据
    }

    public function company($cid,$url)
    {
        //判断cid
        if (!$cid && !Session::has('user.cid')) {
            echo "<script>alert('参数错误，或者没有权限！');history.go(-1);</script>";exit;
        } elseif ($cid && !Session::has('user.cid')) {
            $this->cid = $cid;
            $apiCompany = ApiCompany::show($cid);
            $this->company = $apiCompany['code']==0 ? $apiCompany['data'] : [];
            $this->userid = $this->company ? $this->company['uid'] : 0;
        } elseif (Session::has('user.cid')) {
            $this->userid = Session::get('user.uid');
            $this->cid = Session::get('user.cid');
            $this->company = Session::get('user.company');
        }
//        define('VISITRATE',$this->visitRate);
        $this->getComModules($this->cid);
        //拼接url
        if ($url) {
            $this->prefix_url = '/c/'.$this->cid.'/'.$url;
        } else {
            $this->prefix_url = '/c/'.$this->cid.$url;
        }
        return array(
            'uid'=> $this->userid,
            'cid'=> $this->cid,
            'company'=> $this->company,
        );
    }

    /**
     * 企业页面模块获取更新
     */
    public function getComModules($cid)
    {
        $apiComModule = ApiComModule::index($this->limit,1,$cid,2);
        return $apiComModule['code']==0 ? $apiComModule['data'] : [];
    }

    /**
     * 获取所属模块id
     */
    public function getModuleId($cid,$genre)
    {
        $apiComModule = ApiComModule::getModuleByGenre($cid,$genre);
        if ($apiComModule['code']!=0) {
            $apiComModule = ApiComModule::getModuleByGenre(0,$genre);
        }
        return $apiComModule['data']['id'];
    }

    /**
     * 公司页面top菜单
     */
    public function getTopMenu($cid=0)
    {
        $apiLink = ApiLink::index(8,1,$cid,2,2,'desc');
        return $apiLink['code']==0 ? $apiLink['data'] : [];
    }

    /**
     * 公司页面footer菜单
     */
    public function getFooter($cid=0)
    {
        $apiLink = ApiLink::index(8,1,$cid,3,2,'desc');
        return $apiLink['code']==0 ? $apiLink['data'] : [];
    }
}