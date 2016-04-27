<?php
namespace App\Http\Controllers\Company\Admin;

use App\Models\Company\ComMainModel;
use App\Models\Company\ComInfoModel;
use App\Models\Company\ComFirmModel;

class ContentController extends BaseController
{
    /**
     * 企业后台首页
     */

    public function __construct()
    {
        parent::__construct();
        $this->list['func']['name'] = '内容设置';
        $this->list['func']['url'] = 'content';
    }

    public function index()
    {
        $result = [
            'datas'=> $this->query(),
            'lists'=> $this->list,
        ];
        return view('company.admin.content.index', $result);
    }

//    /**
//     * 招聘详情
//     */
//    public function showjob()
//    {
//        $data = $this->queryMain();
//        $curr['name'] = '招聘';
//        $result = [
//            'data'=> $data,
//            'lists'=> $this->list,
//            'curr'=> $curr,
//        ];
//        return view('company.admin.content.showjob', $result);
//    }

//    /**
//     * 招聘编辑
//     */
//    public function editjob()
//    {
//        $data = $this->queryMain();
//        $result = [
//            'data'=> $data,
//            'lists'=> $this->list,
//        ];
//        return view('company.admin.content.editjob', $result);
//    }




    public function query()
    {
        $this->cid = 0;     //假如默认值
        $mian = ComMainModel::where('cid',$this->cid)->first();
        $infos = ComInfoModel::where('cid',$this->cid)->paginate($this->limit);
        $firm = ComFirmModel::where('cid',$this->cid)->first();
        if ($mian) { $mainCount = 1; }else{ $mainCount = 0; }
        if ($firm) { $firmCount = 1; }else{ $firmCount = 0; }
        $datas = new \stdClass();
        $datas->count = $mainCount+$infos->count()+$firmCount;
        $datas->total = $mainCount+$infos->total()+$firmCount;
        $datas->lastPage = $datas->count?intval(ceil($datas->total/$datas->count)):1;
        $datas->currentPage = $datas->count/$this->limit<1 ? 1 : $datas->count/$this->limit;
        $datas->nextPageUrl = $datas->currentPage +1;
        $datas->items = array();
        $datas->items[] = $mian['attributes'];
        if (count($infos)) {
            foreach ($infos as $info) {
                $datas->items[] = $info['attributes'];
            }
        }
        if ($firm) { $datas->items[] = $firm['attributes']; }
        return $datas;
    }

//    public function queryMain()
//    {
//        $this->cid = 0;     //假如默认值
//        return ComMainModel::where('cid',$this->cid)->get();
//    }
}