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
    protected $genre = 1;       //1代表默认模块
    protected $module;

    public function __construct()
    {
        parent::__construct();
        $this->model = new ComFuncModel();
        $this->pics = PicModel::where('uid',$this->userid)->where('del',0)->get();
    }

    /**
     * 增改页面时收集数据
     */
    public function getData(Request $request,$module)
    {
        if (!$request->intro) { echo "<script>alert('内容不能空！');history.go(-1);</script>";exit; }
        return array(
            'name'=> $request->name,
            'cid'=> $this->cid,
            'module_id'=> $module,
            'type'=> $request->type,
            'intro'=> $request->intro,
            'sort'=> $request->sort,
            'isshow'=> $request->isshow,
        );
    }

    /**
     * 查询方法
     */
    public function query($module,$type)
    {
        //type==0，代表[1,2,3,4]
        if ($type) {
            $datas = ComFuncModel::where('cid',$this->cid)
                ->where('module_id',$module)
                ->where('type',$type)
                ->orderBy('sort','desc')
                ->orderBy('id','desc')
                ->paginate($this->limit);
        } else {
            $datas = ComFuncModel::where('cid',$this->cid)
                ->where('module_id',$module)
                ->whereIn('type',[1,2,3,4])
                ->orderBy('sort','desc')
                ->orderBy('id','desc')
                ->paginate($this->limit);
        }
        $datas->limit = $this->limit;
       return $datas;
    }
}