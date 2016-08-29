<?php
namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Company\ComMainModel;
use App\Models\Company\ComModuleModel;
use App\Models\CompanyModel;
use App\Models\LinkModel;

class BaseController extends Controller
{
    /**
     * 公司后台基础控制器
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
        if (!$cid && !\Session::has('user.cid')) {
            echo "<script>alert('参数错误，或者没有权限！');history.go(-1);</script>";exit;
        } elseif ($cid && !\Session::has('user.cid')) {
            $this->cid = $cid;
            $this->company = CompanyModel::find($cid);
            $this->userid = $this->company->uid;
        }elseif (!$cid && \Session::has('user.cid')) {
            $this->userid = \Session::get('user.uid');
            $this->cid = \Session::get('user.cid');
            $this->company = unserialize(\Session::get('user.company'));
        }
        define('CID',$this->cid);
        $this->getComModules($this->cid);
        $this->topmenus = LinkModel::where('cid',$this->cid)
            ->where('type_id', 2)
            ->where('isshow', 1)
            ->orderBy('sort','desc')
            ->orderBy('id','desc')
            ->paginate(8);
        //拼接url
        if ($url) {
            $this->prefix_url = DOMAIN.'c/'.$this->cid.'/'.$this->list['func']['url'];
        } else {
            $this->prefix_url = DOMAIN.'c/'.$this->cid.$this->list['func']['url'];
        }
        return array(
            'uid'=> $this->userid,
            'cid'=> $this->cid,
            'company'=> $this->company,
            'topmenus'=> $this->topmenus,
        );
    }

    /**
     * 公司基本信息
     */
    public function getComMain($cid)
    {
        return ComMainModel::where('cid',$cid)->first();
    }

    /**
     * 企业页面模块获取更新
     */
    public function getComModules($cid)
    {
        return ComModuleModel::where('cid',$cid)->get();
    }

    /**
     * 获取所属模块id
     */
    public function getModuleId($cid,$genre)
    {
        $moduleModel = ComModuleModel::where('cid',$cid)->where('genre',$genre)->first();
        if (!$moduleModel) { $moduleModel = ComModuleModel::where('cid',0)->where('genre',$genre)->first(); }
        return $moduleModel->id;
    }
}