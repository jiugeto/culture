<?php
namespace App\Http\Controllers\Home;

use App\Models\Base\AdModel;
use App\Models\Base\OrderModel;
use App\Models\Base\UserTipModel;
use App\Models\CompanyModel;
use App\Models\DesignModel;
use App\Models\EntertainModel;
use App\Models\GoodsModel;
use App\Models\IdeasModel;
use App\Models\Online\ProductModel;
use App\Models\RentModel;
use App\Models\TalksModel;
use App\Models\UserModel;
use App\Models\UserVoiceModel;

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
            'ideas'=> $this->getIdeas(3),
            'talks'=> $this->getTalks(3),
            'products'=> $this->getProducts(10),        //在线创作
            'goods'=> $this->getGoods(6),               //视频
            'companys'=> $this->getCompanys(6),
            'recommends'=> $this->getRecommendProducts(6),
            'demands'=> $this->getDemands(6),
            'entertains'=> $this->getEntertains(6),
            'rents'=> $this->getRents(5),
            'designs'=> $this->getDesigns(9),
            'orders'=> $this->getOrders(10),
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
        $datas = AdModel::where('uid',0)
            ->where('adplace_id',1)
            ->where('isuse',1)
            ->where('isshow',1)
//            ->where('fromTime','<',time())
//            ->where('toTime','>',time())
            ->orderBy('sort','desc')
            ->paginate($limit);
        $datas->limit = $limit;
        return $datas;
    }

    /**
     * 获取创意
     */
    public function getIdeas($limit)
    {
        $datas = IdeasModel::where(['del'=>0, 'isshow'=>1])
                    ->orderBy('sort','desc')
                    ->orderBy('id','desc')
                    ->paginate($limit);
        static $number = 1;
        if (count($datas)) {
            foreach ($datas as $data) { $data->number = $number ++; }
        }
        return $datas;
    }

    /**
     * 获取话题
     */
    public function getTalks($limit)
    {
        $datas =  TalksModel::where(['del'=>0, 'isshow'=>1])
                    ->orderBy('sort','desc')
                    ->orderBy('id','desc')
                    ->paginate($limit);
        static $number = 1;
        if (count($datas)) {
            foreach ($datas as $data) { $data->number = $number ++; }
        }
        return $datas;
    }

    /**
     * 获取在线创作
     */
    public function getProducts($limit)
    {
        return ProductModel::where('isshow',1)
                    ->orderBy('sort','desc')
                    ->orderBy('id','desc')
                    ->paginate($limit);
    }

    /**
     * 获取产品样片 设计师供应type==2，制作公司供应type==4
     */
    public function getGoods($limit)
    {
        return GoodsModel::where(['del'=>0, 'isshow'=>1])
                    ->whereIn('type',[2,4])
                    ->orderBy('sort','desc')
                    ->orderBy('id','desc')
                    ->paginate($limit);
    }

    /**
     * 获取供应单位
     */
    public function getCompanys($limit)
    {
        return CompanyModel::orderBy('sort','desc')
                    ->orderBy('id','desc')
                    ->paginate($limit);
    }

    /**
     * 获取推荐产品 设计师供应type==2，制作公司供应type==4
     */
    public function getRecommendProducts($limit)
    {
        return GoodsModel::where('recommend',1)
                    ->whereIn('type',[2,4])
                    ->orderBy('sort','desc')
                    ->orderBy('id','desc')
                    ->paginate($limit);
    }

    /**
     * 获取样片需求 个人需求type==1，企业需求type==3
     */
    public function getDemands($limit)
    {
        return GoodsModel::whereIn('type',[1,3])
                    ->orderBy('sort','desc')
                    ->orderBy('id','desc')
                    ->paginate($limit);
    }

    /**
     * 获取娱乐信息
     */
    public function getEntertains($limit)
    {
        return EntertainModel::where('del',0)
                    ->orderBy('sort','desc')
                    ->orderBy('id','desc')
                    ->paginate($limit);
    }

    /**
     * 获取租赁信息
     */
    public function getRents($limit)
    {
        return RentModel::where('del',0)
                    ->orderBy('sort','desc')
                    ->orderBy('id','desc')
                    ->paginate($limit);
    }

    /**
     * 获取设计信息
     */
    public function getDesigns($limit)
    {
        return DesignModel::where('del',0)
                    ->orderBy('sort','desc')
                    ->orderBy('id','desc')
                    ->paginate($limit);
    }

    /**
     * 获取实时数据 来自订单表
     */
    public function getOrders($limit)
    {
        return OrderModel::where('isshow',1)
                    ->orderBy('id','desc')
                    ->paginate($limit);
    }

    /**
     * 获取合作单位和个人设计师
     */
    public function getCooperations($limit)
    {
        return UserModel::whereIn('isuser',[3,4,5,6])
                    ->paginate($limit);
    }

    /**
     * 获取用户心声
     */
    public function getUserVoices($limit)
    {
        return UserVoiceModel::where('isshow',2)
                    ->orderBy('sort','desc')
                    ->paginate($limit);
    }

    /**
     * 给用户发红包
     */
    public function getTip()
    {
        //新人红包
        $newModel = new UserTipModel();
        $new = UserTipModel::where('uid',$this->userid)
            ->where('type',1)
            ->first();
        if (!$new) {
            $tip['key'] = 1;
            $tip['name'] = $newModel['types'][1];
            $tip['val'] = 200;
        }
        return isset($tip) ? $tip : [];
    }
}