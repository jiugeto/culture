<?php
namespace App\Http\Controllers\Company;

use App\Models\Company\ComFuncModel;
use App\Models\Company\ComMainModel;
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
            'comMain'=> $this->getComMain(),
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
     * 企业服务 genre==2
     */
    public function getFirms()
    {
        //假如没有。即可生成默认记录
        $module = $this->getModuleId($genre=2);
        $firmModels = $this->getFuncs($cid=$this->cid,$module);
        $firmModels0 = $this->getFuncs($cid=0,$module);
        //有则补充记录
        if (count($firmModels) && count($firmModels)<count($firmModels0)) {
            foreach ($firmModels0 as $key=>$firmModel) {
                if ($firmModels0[$key]->cid!=$this->cid) {
                    ComFuncModel::create($this->getFuncData($module,$firmModel));
                }
            }
        }
        //无则生成一组记录
        if (!count($firmModels)) {
            foreach ($this->getFuncs($cid=0,$module) as $firmModel) {
                ComFuncModel::create($this->getFuncData($module,$firmModel));
            }
        }
        return $this->getFuncs($cid=$this->cid,$module);
    }

    /**
     * 企业新闻资讯 genre==6
     */
    public function getNews()
    {
        //假如没有。即可生成默认记录
        $module = $this->getModuleId($genre=6);
        $newModels = $this->getFuncs($cid=$this->cid,$module);
        $newModels0 = $this->getFuncs($cid=0,$module);
        if (!count($newModels)) {
            foreach ($newModels0 as $newModel) {
                ComFuncModel::create($this->getFuncData($module,$newModel));
            }
        }
        return $this->getFuncs($cid=$this->cid,$module);
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

    /**
     * 企业功能查询 未分页
     */
    public function getFuncs($cid,$module)
    {
        return ComFuncModel::where('cid',$cid)->where('module_id',$module)->get();
    }

    /**
     * 收集功能数据
     */
    public function getFuncData($module_id,$model)
    {
        return array(
            'name'=> $model->name,
            'cid'=> $this->cid,
            'module_id'=> $module_id,
            'type'=> $model->type,
            'genre'=> $model->genre,
            'pic_id'=> $model->pic_id,
            'intro'=> $model->intro,
            'small'=> $model->small,
            'sort'=> $model->sort,
            'isshow'=> $model->isshow,
            'created_at'=> date('Y-m-d H:i:s', time()),
        );
    }
}