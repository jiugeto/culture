<?php
namespace App\Http\Controllers\Company\Admin;

use App\Models\Company\ComMainModel;
use App\Models\Company\ComModuleModel;
use App\Models\Company\ComFuncModel;
use App\Models\CompanyModel;
use App\Models\GoodsModel;
use App\Tools;

class ContentController extends BaseController
{
    /**
     * 企业后台首页
     */

    public function __construct()
    {
        parent::__construct();
        $this->lists['func']['name'] = '内容设置';
        $this->lists['func']['url'] = 'content';
    }

    public function index()
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $result = [
            'data'=> $this->query(),
            'lists'=> $this->lists,
//            'prefix_url'=> DOMAIN.'company/admin/content',
            'curr'=> $curr,
            'curr_func'=> $this->lists['func']['url'],
        ];
        return view('company.admin.content.index', $result);
    }




    public function query()
    {
        $data = new \stdClass();
        //type==1公司简介，2历程，3新闻，4资讯，5服务，6团队，7招聘，21单页
        $data->abouts = ComFuncModel::where('type','<',5)->where('cid',$this->cid)->get();
        $data->products = GoodsModel::where('genre',1)->where('type',4)->get();
        $data->teams = ComFuncModel::where('type',6)->where('cid',$this->cid)->get();
        $data->jobs = ComFuncModel::where('type',7)->where('cid',$this->cid)->get();

        //公司联系方式
        $data->contactFields = ['area','point','address','tel','qq','web','fax','email',];
        $data->contactFieldNames = ['地区','坐标','地址','电话','qq','网址','传真','邮箱',];
        $data->contact = 0;
        $comMainModel = CompanyModel::find($this->cid);
        $comMainModel = Tools::objectToArray($comMainModel);
        foreach ($data->contactFields as $contactField) {
            if ($comMainModel[$contactField]) { $data->contact ++; }
        }

        $data->parts = GoodsModel::where('genre',2)->where('type',4)->get();
        $data->firms = ComFuncModel::where('type',5)->where('cid',$this->cid)->get();
        return $data;
    }

//    public function query()
//    {
//        $this->cid = 0;     //假如默认值
//        $mian = ComMainModel::where('cid',$this->cid)->first();
//        $infos = ComModuleModel::where('cid',$this->cid)->paginate($this->limit);
//        $firm = ComFuncModel::where('cid',$this->cid)->first();
//        if ($mian) { $mainCount = 1; }else{ $mainCount = 0; }
//        if ($firm) { $firmCount = 1; }else{ $firmCount = 0; }
//        $datas = new \stdClass();
//        $datas->count = $mainCount+$infos->count()+$firmCount;
//        $datas->total = $mainCount+$infos->total()+$firmCount;
//        $datas->lastPage = $datas->count?intval(ceil($datas->total/$datas->count)):1;
//        $datas->currentPage = $datas->count/$this->limit<1 ? 1 : $datas->count/$this->limit;
//        $datas->nextPageUrl = $datas->currentPage +1;
//        $datas->items = array();
//        $datas->items[] = $mian['attributes'];
//        if (count($infos)) {
//            foreach ($infos as $info) {
//                $datas->items[] = $info['attributes'];
//            }
//        }
//        if ($firm) { $datas->items[] = $firm['attributes']; }
//        return $datas;
//    }
}