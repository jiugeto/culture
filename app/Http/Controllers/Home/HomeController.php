<?php
namespace App\Http\Controllers\Home;

class HomeController extends BaseController
{
    /**
     * 网站首页
     */

//    type字段，产品主体：1个人需求，2设计师供应，3企业需求，4企业供应

    public function __construct()
    {
    }

    public function index()
    {
        $result = [
            'ideas'=> $this->getIdeas(),
            'talks'=> $this->getTalks(),
            'onlines'=> $this->getOnlines(),
//            'menus'=> $this->menus,
            'curr_menu'=> '/',
            'number'=> $this->number,
            'floors'=> $this->floors,
        ];
        return view('home.home.index', $result);
    }

    /**
     * 获取创意
     */
    public function getIdeas()
    {
        return \App\Models\IdeasModel::where(['del'=>0, 'isshow'=>1])
                    ->orderBy('sort','desc')
                    ->orderBy('id','desc')
                    ->get();
//                    ->paginate($this->limit);
    }

    /**
     * 获取话题
     */
    public function getTalks()
    {
        return \App\Models\TalksModel::where(['del'=>0, 'isshow'=>1])
                    ->orderBy('sort','desc')
                    ->orderBy('id','desc')
                    ->get();
    }

    /**
     * 获取在线创作
     */
    public function getProducts()
    {
        return \App\Models\ProductModel::where(['del'=>0, 'isshow'=>1])
                    ->orderBy('sort','desc')
                    ->orderBy('id','desc')
                    ->get();
    }

    /**
     * 获取产品样片 设计师供应type==2，制作公司供应type==4
     */
    public function getGoods()
    {
        return \App\Models\GoodsModel::where(['del'=>0, 'isshow'=>1])
                    ->whereIn('type',[2,4])
                    ->orderBy('sort','desc')
                    ->orderBy('id','desc')
                    ->get();
    }

    /**
     * 获取供应单位
     */
    public function getCompanys()
    {
        return \App\Models\CompanyModel::orderBy('sort','desc')
                    ->orderBy('id','desc')
                    ->get();
    }

    /**
     * 获取推荐产品 设计师供应type==2，制作公司供应type==4
     */
    public function getRecommendProducts()
    {
        return \App\Models\GoodsModel::where('recommend',1)
                    ->whereIn('type',[2,4])
                    ->orderBy('sort','desc')
                    ->orderBy('id','desc')
                    ->get();
    }

    /**
     * 获取样片需求 个人需求type==1，企业需求type==3
     */
    public function getDemands()
    {
        return \App\Models\GoodsModel::whereIn('type',[1,3])
                    ->orderBy('sort','desc')
                    ->orderBy('id','desc')
                    ->get();
    }

    /**
     * 获取娱乐信息
     */
    public function getEntertains()
    {
        return \App\Models\EntertainModel::where('del',0)
                    ->orderBy('sort','desc')
                    ->orderBy('id','desc')
                    ->get();
    }

    /**
     * 获取租赁信息
     */
    public function getRents()
    {
        return \App\Models\RentModel::where('del',0)
                    ->orderBy('sort','desc')
                    ->orderBy('id','desc')
                    ->get();
    }

    /**
     * 获取设计信息
     */
    public function getDesigns()
    {
        return \App\Models\DesignModel::where('del',0)
                    ->orderBy('sort','desc')
                    ->orderBy('id','desc')
                    ->get();
    }

    /**
     * 获取实时数据 来自订单表
     */
    public function getOrders()
    {
        return \App\Models\OrderModel::where('isshow',1)
                    ->orderBy('id','desc')
                    ->get();
    }

    /**
     * 获取合作单位和个人设计师
     */
    public function getCooperations()
    {
        $users = \App\Models\UserModel::whereIn('isuser',[3,4,5,6])->get();
    }
}