<?php
namespace App\Http\Controllers\Company;

use App\Models\Company\ComFuncModel;
use App\Models\ProductModel;

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
        $company = $this->company($cid);
        $result = [
            'ppts'=> $this->getPpts($company['uid']),
            'comMain'=> $this->getComMain($company['cid']),
            'firms'=> $this->getFirms($company['cid']),
            'news'=> $this->getNews($company['cid']),
            'products'=> $this->getProducts($company['uid']),
            'parterners'=> $this->getParterners(),
            'topmenus'=> $this->topmenus,
            'curr'=> 'home',
        ];
        return view('company.home.index', $result);
    }

    /**
     * 企业宣传PPT
     */
    public function getPpts($uid)
    {
        //adplace_id==6，前台公司首页PPT
        $limit = 10;
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
     * 企业服务 genre==2
     */
    public function getFirms($cid)
    {
        //假如没有。即可生成默认记录
        $module = $this->getModuleId($genre=2);
        return $this->getFuncs($cid,$module);
    }

    /**
     * 企业新闻资讯 genre==6
     */
    public function getNews($cid)
    {
        //假如没有。即可生成默认记录
        $module = $this->getModuleId($genre=6);
        return $this->getFuncs($cid,$module);
    }

    /**
     * 企业产品
     */
    public function getProducts($uid)
    {
        $limit = 4;
        $products = ProductModel::where('uid',$uid)
            ->orderBy('id','desc')
            ->paginate($limit);
        $products->limit = $limit;
      return $products;
    }

    /**
     * 企业合作伙伴
     */
    public function getParterners(){}

    /**
     * 企业功能查询 未分页
     */
    public function getFuncs($cid,$module)
    {
        return ComFuncModel::where('cid',$cid)->where('module_id',$module)->get();
    }
}