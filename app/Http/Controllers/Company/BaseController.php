<?php
namespace App\Http\Controllers\Company;

use App\Api\ApiBusiness\ApiComFunc;
use App\Api\ApiBusiness\ApiComModule;
use App\Api\ApiBusiness\ApiLink;
use App\Api\ApiUser\ApiCompany;
use App\Http\Controllers\BaseController as Controller;
use Illuminate\Support\Facades\View;

class BaseController extends Controller
{
    /**
     * 公司页面基础控制器
     */

    protected $topmenus = array();
    protected $prefix_url = '';

    public function __construct()
    {
        parent::__construct();
    }

    public function company($cid,$url)
    {
        //判断cid
        if (!$cid) {
            echo "<script>alert('参数错误，或者没有权限！');history.go(-1);</script>";exit;
        } else {
            $this->cid = $cid;
            $apiCompany = ApiCompany::show($cid);
            $this->company = $apiCompany['code']==0 ? $apiCompany['data'] : [];
            $this->userid = $this->company ? $this->company['uid'] : 0;
        }
        $this->getComModules($this->cid);
        //拼接url
        if ($url) {
            $this->prefix_url = '/c/'.$this->cid.'/'.$url;
        } else {
            $this->prefix_url = '/c/'.$this->cid.$url;
        }
        View::share('company',$this->company);                //共享company数据
        View::share('topmenus',$this->getTopMenu($cid));      //共享topmenu数据
        View::share('footLinks',$this->getFooter($cid));      //共享footer数据
        return array(
            'uid'=> $this->userid,
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
     * 企业功能
     */
    public function getFuncs($cid,$limit,$genre,$pageCurr=1)
    {
        $apiComModule = ApiComModule::getModuleByGenre($cid,$genre);
        if ($apiComModule['code']!=0) {
            $apiComModule = ApiComModule::getModuleByGenre(0,$genre);
        }
        $module = $apiComModule['data']['id'];
        $apiComFunc = ApiComFunc::index($limit,1,$cid,$module,2);
        if ($apiComFunc['code']!=0) {
            $datas = array(); $total = 0;
        } else {
            $datas = $apiComFunc['data']; $total = $apiComFunc['pagelist']['total'];
        }
        $pagelist = $this->getPageList($total,$this->prefix_url,$limit,$pageCurr);
        return array(
            'datas' =>  $datas,
            'pagelist'  =>  $pagelist,
        );
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