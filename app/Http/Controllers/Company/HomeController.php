<?php
namespace App\Http\Controllers\Company;

use App\Models\Company\ComFuncModel;
use App\Models\Company\ComMainModel;
use App\Models\GoodsModel;
use App\Models\LinkModel;

class HomeController extends BaseController
{
    /**
     * 企业后台首页
     */

    public function __construct()
    {
        parent::__construct();
        $this->list['func']['name'] = '企业首页';
        $this->list['func']['url'] = '';
    }

    public function index($cid=0)
    {
        $company = $this->company($cid,$this->list['func']['url']);
//        dd($this->getLayoutHomeSwitchs($company['cid']));
        $result = [
            'ppts'=> $this->getPpts($company['uid'],$limit=10),
            'comMain'=> $this->getComMain($company['cid']),
            'firms'=> $this->getFirms($company['cid'],$limit=4),
            'news'=> $this->getNews($company['cid'],$limit=8),
            'infos'=> $this->getInfos($company['cid'],$limit=8),
            'works'=> $this->getWorks($company['uid'],$limit=4),
            'parterners'=> $this->getParterners($company['cid'],$limit=5),
            'topmenus'=> $this->topmenus,
            'footlinks'=> $this->footlinks($company['cid'],$limit=10),
            'layoutHomeSwitchs'=> $this->getLayoutHomeSwitchs($company['cid']),
            'layoutSkin'=> $this->getLayoutSkin($company['cid']),
            'prefix_url'=> $this->prefix_url,
        ];
//        $this->getHomeSwitch($company['cid']);  //初始化公司首页开关
        return view('company.home.index', $result);
    }

    /**
     * 合作伙伴列表
     */
    public function parterner($cid)
    {
        $limit = 20;
        $moduleid = 5;      //5代表合作伙伴
        $company = $this->company($cid,$this->list['func']['url']);
        $datas = ComFuncModel::where('cid',$company['cid'])
            ->where('module_id',$moduleid)
            ->paginate($limit);
        $datas->limit = $limit;
        $result = [
            'datas'=> $datas,
            'comMain'=> $this->getComMain($company['cid']),
            'topmenus'=> $this->topmenus,
            'prefix_url'=> $this->prefix_url,
        ];
        return view('company.home.parterner', $result);
    }

    /**
     * 合作伙伴列表
     */
    public function partShow($cid,$id)
    {
        $company = $this->company($cid,$this->list['func']['url']);
        $result = [
            'datas'=> ComFuncModel::find($id),
            'topmenus'=> $this->topmenus,
        ];
        return view('company.home.partShow', $result);
    }

    /**
     * 企业宣传PPT
     */
    public function getPpts($uid,$limit)
    {
        //adplace_id==6，前台公司首页PPT
        $ads = \App\Models\AdModel::where('uid',$uid)
            ->where('adplace_id',5)
            ->where('isuse',1)
            ->where('isshow',1)
            ->where('fromTime','<',time())
            ->where('toTime','>',time())
            ->orderBy('sort','desc')
            ->paginate($limit);
        $ads->limit = $limit;
        return $ads;
    }

    /**
     * 企业服务 genre==2，type==5
     */
    public function getFirms($cid,$limit)
    {
        $module = $this->getModuleId($cid,$genre=2);
        return $this->getFuncs($cid,$module,$limit,$type=5);
    }

    /**
     * 企业新闻 genre==1，type==3
     */
    public function getNews($cid,$limit)
    {
        $module = $this->getModuleId($cid,$genre=1);
        return $this->getFuncs($cid,$module,$limit,$type=3);
    }

    /**
     * 企业资讯 genre==1，type==4
     */
    public function getInfos($cid,$limit)
    {
        $module = $this->getModuleId($cid,$genre=1);
        return $this->getFuncs($cid,$module,$limit,$type=4);
    }

    /**
     * 企业产品 GodsModel
     */
    public function getWorks($uid,$limit)
    {
        $works = GoodsModel::where('uid',$uid)
            ->where('del',0)
            //1代表产品
            ->where('genre',1)
            //4代表企业供应
            ->where('type',4)
            ->where('isshow',1)
            ->where('isshow2',1)
            ->orderBy('sort','desc')
            ->orderBy('id','desc')
            ->paginate($limit);
        $works->limit = $limit;
      return $works;
    }

    /**
     * 企业合作伙伴 genre==5
     */
    public function getParterners($cid,$limit)
    {
        $module = $this->getModuleId($cid,$genre=5);
        return $this->getFuncs($cid,$module,$limit);
    }

    /**
     * 脚步链接
     */
    public function footlinks($cid,$limit)
    {
        $datas = LinkModel::where('cid',$cid)
            ->where('type_id',3)
            ->where('isshow',1)
            ->orderBy('sort','desc')
            ->orderBy('id','desc')
            ->paginate($limit);
        $datas->limit = $limit;
        return $datas;
    }

    /**
     * 企业功能查询
     */
    public function getFuncs($cid,$module,$limit,$type=null)
    {
        if ($type) {
            $datas = ComFuncModel::where('cid',$cid)
                ->where('module_id',$module)
                ->where('type',$type)
                ->orderBy('sort','desc')
                ->orderBy('id','desc')
                ->paginate($limit);
        } else {
            $datas = ComFuncModel::where('cid',$cid)
                ->where('module_id',$module)
                ->orderBy('sort','desc')
                ->orderBy('id','desc')
                ->paginate($limit);
        }
        $datas->limit = $limit;
        return $datas;
    }

    /**
     * 获取企业首页的功能显示列表
     */
    public function getLayoutHomeSwitchs($cid)
    {
        $comMainModel = ComMainModel::where('cid',$cid)->first();
        return unserialize($comMainModel->layoutHome);
    }

    /**
     * 获取企业页面皮肤颜色
     */
    public function getLayoutSkin($cid)
    {
        $comMainModel = ComMainModel::where('cid',$cid)->first();
        return array(
            'skin'=> $comMainModel->getSkin(),
            'name'=> $comMainModel->getSkinName(),
        );
    }

    /**
     * 首页开关初始化
     */
    public function getHomeSwitch($cid)
    {
        $comMainModel = new ComMainModel();
        foreach ($comMainModel['layoutHomes'] as $k=>$layoutHome) {
            $arr[$layoutHome]['key'] = $k;
            $arr[$layoutHome]['name'] = $comMainModel['layoutHomeNames'][$k];
            $arr[$layoutHome]['value'] = 1;
        }
        ComMainModel::where('cid',$cid)->update(['layoutHome'=> serialize($arr)]);
    }
}