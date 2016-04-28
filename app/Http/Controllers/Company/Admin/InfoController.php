<?php
namespace App\Http\Controllers\Company\Admin;

use App\Models\Company\ComInfoModel;
use App\Models\GoodsModel;
use Illuminate\Http\Request;

class InfoController extends BaseController
{
    /**
     * 企业后台首页
     */

    //信息类型：1公司介绍，2资质荣誉，3历程，4公司新闻，5行业咨询，6团队
    protected $types;

    public function __construct()
    {
        parent::__construct();
        $this->lists['category']['name'] = '内容设置';
        $this->lists['category']['url'] = 'content';
        $this->model = new GoodsModel();
        $this->types = $this->model['types'];
    }

    public function query($type)
    {
//        $this->cid = 0;     //假如默认0
//        return GoodsModel::where('cid',$this->cid)->where('type',$type)->paginate($this->limit);
        return ComInfoModel::where('cid',$this->cid)->where('type',$type)->first();
    }
}