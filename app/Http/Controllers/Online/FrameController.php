<?php
namespace App\Http\Controllers\Online;

use App\Models\Online\ProductModel;
use Illuminate\Http\Request;

class FrameController extends BaseController
{
    /**
     * 在线创作 单帧管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->model = new ProductModel();
    }

    public function index($productid,$layerid=0,$con_id=0,$genre=1)
    {
        $layer = $this->getOneLayer($productid,$layerid);
        $result = [
            'product'=> ProductModel::find($productid),
            'cons'=> $this->getCons($productid,$layer->id),
            'content'=> $this->getOneCon($productid,$layer->id,$con_id),
            'attr'=> $this->getOneAttr($productid,$layer->id,$genre),
            'attrModel'=> $this->attrModel,
            'layers'=> $this->getLayers($productid),
            'layer'=> $layer,
            'layerModel'=> $this->layerModel,
            'pics'=> $this->model->getUserPics($this->userid),
            'layerid'=> $layer->id,
            'con_id'=> $con_id,
            'genre'=> $genre,
        ];
        return view('online.frame.index', $result);
    }
}