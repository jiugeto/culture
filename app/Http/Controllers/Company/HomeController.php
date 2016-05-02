<?php
namespace App\Http\Controllers\Company;

use App\Models\Company\ComFirmModel;
use App\Models\Company\ComInfoModel;
use App\Models\Company\ComPptModel;
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

    public function index()
    {
        $result = [
            'ppts'=> $this->getPpts(),
            'firms'=> $this->getFirms(),
            'news'=> $this->getNews(),
            'products'=> $this->getProducts(),
            'parterners'=> $this->getParterners(),
            'topmenus'=> $this->topmenus,
            'curr'=> 'home',
        ];
        return view('company.home.index', $result);
    }

    /**
     * 企业宣传PPT
     */
    public function getPpts()
    {
        //假如没有。即可生成默认记录
        $pptModels = ComPptModel::where('cid',$this->cid)->get();
        $pptModels0 = ComPptModel::where('cid',0)->get();
        //有则补充记录
//        if (count($pptModels) && count($pptModels)<$this->comPptNum) {
        if (count($pptModels) && count($pptModels)<count($pptModels0)) {
            foreach ($pptModels0 as $key=>$pptModel) {
                if ($pptModels0[$key]->cid!=$this->cid) {
                    $data = [
                        'pic_id'=> $pptModel->pic_id,
                        'cid'=> $this->cid,
                        'title'=> $pptModel->title,
                        'url'=> $pptModel->url,
                        'created_at'=> date('Y-m-d H:i:s', time()),
                    ];
                    ComPptModel::create($data);
                }
            }
        }
        //无则生成一组记录
        if (!count($pptModels)) {
            foreach (ComPptModel::where('cid',0)->get() as $pptModel) {
                $data = [
                    'pic_id'=> $pptModel->pic_id,
                    'cid'=> $this->cid,
                    'title'=> $pptModel->title,
                    'url'=> $pptModel->url,
                    'created_at'=> date('Y-m-d H:i:s', time()),
                ];
                ComPptModel::create($data);
            }
        }
        return ComPptModel::where('cid',$this->cid)->get();
    }

    /**
     * 企业服务
     */
    public function getFirms()
    {
        //假如没有。即可生成默认记录
        $firmModels = ComFirmModel::where('cid',$this->cid)->get();
        $firmModels0 = ComFirmModel::where('cid',0)->get();
        //有则补充记录
//        if (count($firmModels) && count($firmModels)<$this->firmNum) {
        if (count($firmModels) && count($firmModels)<count($firmModels0)) {
            foreach ($firmModels0 as $key=>$firmModel) {
                if ($firmModels0[$key]->cid!=$this->cid) {
                    $data = [
                        'name'=> $firmModel->name,
                        'cid'=> $this->cid,
                        'intro'=> $firmModel->intro,
                        'title'=> $firmModel->title,
                        'pic_id'=> $firmModel->pic_id,
                        'detail'=> $firmModel->detail,
                        'small'=> $firmModel->small,
                        'created_at'=> date('Y-m-d H:i:s', time()),
                    ];
                    ComFirmModel::create($data);
                }
            }
        }
        //无则生成一组记录
        if (!count($firmModels)) {
            foreach (ComFirmModel::where('cid',0)->get() as $firmModel) {
                $data = [
                    'name'=> $firmModel->name,
                    'cid'=> $this->cid,
                    'intro'=> $firmModel->intro,
                    'title'=> $firmModel->title,
                    'pic_id'=> $firmModel->pic_id,
                    'detail'=> $firmModel->detail,
                    'small'=> $firmModel->small,
                    'created_at'=> date('Y-m-d H:i:s', time()),
                ];
                ComFirmModel::create($data);
            }
        }
        return ComFirmModel::where('cid',$this->cid)->get();
    }

    /**
     * 企业新闻咨询 type 4,5
     */
    public function getNews()
    {
        //假如没有。即可生成默认记录
        $newModels = ComInfoModel::where('cid',$this->cid)->whereIn('type',[4,5])->get();
        $newModels0 = ComInfoModel::where('cid',0)->whereIn('type',[4,5])->get();
        if (!count($newModels)) {
            foreach ($newModels0 as $newModel) {
                $data = [
                    'name'=> $newModel->name,
                    'cid'=> $this->cid,
                    'type'=> $newModel->type,
                    'intro'=> $newModel->intro,
                    'pic'=> $newModel->pic,
                    'created_at'=> date('Y-m-d H:i:s', time()),
                ];
                ComInfoModel::create($data);
            }
        }
        return count($newModels)?$newModels:ComFirmModel::where('cid',$this->cid)->whereIn('type',[4,5])->get();
    }

    /**
     * 企业产品
     */
    public function getProducts()
    {
        //假如没有。即可生成默认记录
        $productModels = ProductModel::where('uid',$this->userid)->get();
        //有则补充记录
        //无则生成一组记录
    }

    /**
     * 企业合作伙伴
     */
    public function getParterners(){}
}