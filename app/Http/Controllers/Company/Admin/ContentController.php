<?php
namespace App\Http\Controllers\Company\Admin;

use App\Models\Company\ComMainModel;
use App\Models\Company\ComModuleModel;
use App\Models\Company\ComFuncModel;

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
            'datas'=> $this->query(),
            'lists'=> $this->lists,
            'prefix_url'=> DOMAIN.'company/admin/content',
            'curr'=> $curr,
            'curr_func'=> $this->lists['func']['url'],
        ];
        return view('company.admin.content.index', $result);
    }




    public function query()
    {
        $this->cid = 0;     //假如默认值
        $mian = ComMainModel::where('cid',$this->cid)->first();
        $infos = ComModuleModel::where('cid',$this->cid)->paginate($this->limit);
        $firm = ComFuncModel::where('cid',$this->cid)->first();
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
}