<?php
namespace App\Http\Controllers\Home;

use App\Api\ApiBusiness\ApiAd;
use App\Api\ApiBusiness\ApiEntertain;
use App\Api\ApiBusiness\ApiGoods;
use App\Api\ApiBusiness\ApiIdea;
use App\Api\ApiBusiness\ApiOrder;
use App\Api\ApiBusiness\ApiRent;
use App\Api\ApiOnline\ApiOrderPro;
use App\Api\ApiOnline\ApiProduct;
use App\Api\ApiUser\ApiCompany;
use App\Api\ApiUser\ApiTip;
use App\Api\ApiUser\ApiUsers;
use App\Api\ApiUser\ApiUserVoice;

class HomeController extends BaseController
{
    /**
     * 网站首页
     */

//    type字段，产品主体：1个人需求，2设计师供应，3企业需求，4企业供应

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $result = [
            'ppts'=> $this->getPpts(9),      //首页轮播大图
            'pptslimit'=> 9,                 //轮播图个数限制
            'ideas'=> $this->getIdeas(3),
//            'talks'=> $this->getTalks(3),
            'products'=> $this->getProducts(10),        //在线创作
            'goods'=> $this->getGoods(6),               //视频
            'companys'=> $this->getCompanys(6),
            'recommends'=> $this->getRecommendProducts(6),
            'demands'=> $this->getDemands(6),
            'entertains'=> $this->getEntertains(6),
            'rents'=> $this->getRents(5),
            'designs'=> $this->getDesigns(9),
            'onlineOrders'=> $this->getOnlineOrders(15),
            'mainOrders'=> $this->getMainOrders(5),
            'cooperations'=> $this->getCooperations(6),
            'uservoices'=> $this->getUserVoices(5),
            'usertip'=> $this->getTip(),
            'curr_menu'=> '',
            'number'=> $this->number,
            'floors'=> $this->floors,
        ];
        return view('home.home.index', $result);
    }

    /**
     * 前台首页轮播大图
     */
    public function getPpts($limit)
    {
        //adplace_id==1，前台首页横幅
        $apiAd = ApiAd::index($limit,1,0,1,0,0,1,2);
        return $apiAd['code']==0 ? $apiAd['data'] : [];
    }

    /**
     * 获取创意
     */
    public function getIdeas($limit)
    {
        $apiIdea = ApiIdea::index($limit,1,0,0,2,0);
        return $apiIdea['code']==0 ? $apiIdea['data'] : [];
    }

//    /**
//     * 获取话题
//     */
//    public function getTalks($limit)
//    {
//        $apiTalk = ApiTalk::index($limit,1);
//        return $apiTalk['code']==0 ? $apiTalk['data'] : [];
//    }

    /**
     * 获取在线创作
     */
    public function getProducts($limit)
    {
        $apiProduct = ApiProduct::getProductsList($limit);
        return $apiProduct['code']==0 ? $apiProduct['data'] : [];
    }

    /**
     * 获取产品样片 设计师供应type==2，制作公司供应type==4
     */
    public function getGoods($limit)
    {
        $apiGoods = ApiGoods::index($limit,1,array(2,4),0,2,0,0);
        return $apiGoods['code']==0 ? $apiGoods['data'] : [];
    }

    /**
     * 获取供应单位
     */
    public function getCompanys($limit)
    {
        $apiCompany = ApiCompany::getCompanyList($limit);
        return $apiCompany['code']==0 ? $apiCompany['data'] : [];
    }

    /**
     * 获取推荐产品 设计师供应type==2，制作公司供应type==4
     */
    public function getRecommendProducts($limit)
    {
        $apiGoods = ApiGoods::index($limit,1,array(2,4),0,2,1,0);
        return $apiGoods['code']==0 ? $apiGoods['data'] : [];
    }

    /**
     * 获取样片需求 个人需求type==1，企业需求type==3
     */
    public function getDemands($limit)
    {
        $apiGoods = ApiGoods::index($limit,1,array(1,3),0,2,0,0);
        return $apiGoods['code']==0 ? $apiGoods['data'] : [];
    }

    /**
     * 获取娱乐信息
     */
    public function getEntertains($limit)
    {
        $apiEntertain = ApiEntertain::index($limit,1,0);
        return $apiEntertain['code']==0 ? $apiEntertain['data'] : [];
    }

    /**
     * 获取租赁信息
     */
    public function getRents($limit)
    {
        $apiRent = ApiRent::index($limit,1,0);
        return $apiRent['code']==0 ? $apiRent['data'] : [];
    }

    /**
     * 获取设计信息
     */
    public function getDesigns($limit)
    {
        $apiRent = ApiRent::index($limit,1,0);
        return $apiRent['code']==0 ? $apiRent['data'] : [];
    }

    /**
     * 获取实时数据 来自主体业务
     */
    public function getMainOrders($limit)
    {
        $apiOrder = ApiOrder::index($limit,1,2);
        return $apiOrder['code']==0 ? $apiOrder['data'] : [];
    }

    /**
     * 获取实时数据 来自在线创作
     */
    public function getOnlineOrders($limit)
    {
        $apiOrder = ApiOrderPro::index($limit,1,0,0,2,0);
        return $apiOrder['code']==0 ? $apiOrder['data'] : [];
    }

    /**
     * 获取合作单位和个人设计师
     */
    public function getCooperations($limit)
    {
        $apiUser = ApiUsers::getUserList($limit);
        return $apiUser['code']==0 ? $apiUser['data'] : [];
    }

    /**
     * 获取用户心声
     */
    public function getUserVoices($limit)
    {
        $rst = ApiUserVoice::getUserVoiceList($limit,1,0,2);
        return $rst['code']==0 ? $rst['data'] : [];
    }

    /**
     * 给用户发红包
     */
    public function getTip()
    {
        //type：1新人红包
        $type = 1;
        $rst = ApiTip::getTipByUid($this->userid,$type);
        $datas = $rst['code']==0?$rst['data']:[];
        if (!$datas) {
            $tip['key'] = $type;
            $tip['name'] = '新人红包';
            $tip['val'] = 50;
        }
        return isset($tip) ? $tip : [];
    }
}