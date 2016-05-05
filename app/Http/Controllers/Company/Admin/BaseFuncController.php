<?php
namespace App\Http\Controllers\Company\Admin;

use App\Models\Company\ComFuncModel;
use App\Models\PicModel;
use Illuminate\Http\Request;

class BaseFuncController extends BaseController
{
    /**
     * 企业开展后台 基础功能控制器
     */

    protected $pics;

    public function __construct()
    {
        parent::__construct();
        $this->model = new ComFuncModel();
        $this->pics = PicModel::where('uid',$this->userid)->get();
    }

    /**
     * 增改页面时收集数据
     */
    public function getData(Request $request,$module)
    {
        if (!$request->intro) { echo "<script>alert('内容不能空！');history.go(-1);</script>";exit; }
        $data = [
            'name'=> $request->name,
            'cid'=> $this->cid,
            'module_id'=> $module,
            'genre'=> isset($request->genre)?$request->genre:1,     //1代表默认模块，2担保新加单页
            'type'=> $request->type,
            'intro'=> $request->intro,
            'sort'=> $request->sort,
            'isshow'=> $request->isshow,
        ];
        return $data;
    }

    /**
     * 查询方法
     */
    public function query($module)
    {
        $abouts = ComFuncModel::where('cid',$this->cid)->where('module_id',$module)->get();
        $abouts0 = ComFuncModel::where('cid',0)->where('module_id',$module)->get();
        //有则补充记录
        if (count($abouts) && count($abouts)<count($abouts0)) {
            foreach ($abouts0 as $key=>$about) {
                if ($abouts0[$key]->cid!=$this->cid) {
                    ComFuncModel::create($this->getFuncData($module,$about));
                }
            }
        }
        //无则生成一组记录
        if (!count($abouts)) {
            foreach ($this->getFuncs($cid=0,$module) as $about) {
                ComFuncModel::create($this->getFuncData($module,$about));
            }
        }
        return ComFuncModel::where('cid',$this->cid)
                        ->where('module_id',$module)
                        ->orderBy('sort','desc')
                        ->orderBy('id','desc')
                        ->paginate($this->limit);
    }

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