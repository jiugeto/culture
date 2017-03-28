<?php
namespace App\Http\Controllers\Company;

use App\Api\ApiBusiness\ApiGoods;

class ProductController extends BaseController
{
    /**
     * 企业后台产品
     */

    public function __construct()
    {
        parent::__construct();
    }

    public function index($cid,$cate=0)
    {
        $list['func']['name'] = '产品';
        $list['func']['url'] = 'product';
        $company = $this->company($cid,$list['func']['url']);
        $cid = $company['company']['id'];
        $pageCurr = isset($_GET['page']) ? $_GET['page'] : 1;
        $apiGoods = ApiGoods::index($this->limit,$pageCurr,$company['company']['uid'],0,$cid,0,2);
        if ($apiGoods['code']!=0) {
            $datas = array(); $total = 0;
        } else {
            $datas = $apiGoods['data']; $total = $apiGoods['pagelist']['total'];
        }
        $pagelist = $this->getPageList($total,$this->prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'pagelist' => $pagelist,
            'prefix_url' => $this->prefix_url,
            'model' => $this->getModel(),
            'curr' => $list['func']['url'],
            'cate' => $cate,
        ];
        return view('company.product.index', $result);
    }

    /**
     * 花絮
     */
    public function part($cid,$cate=0)
    {
        dd('未处理');
        $list['func']['name'] = '花絮';
        $list['func']['url'] = 'part';
        $company = $this->company($cid,$list['func']['url']);
        $result = [
            'datas'=> $this->query($company['uid'],$genre=2,$cate),
            'model'=> $this->model,
            'comMain'=> $this->getComMain($company['cid']),
            'topmenus'=> $this->topmenus,
            'prefix_url'=> $this->prefix_url,
            'curr'=> $list['func']['url'],
            'cate'=> $cate,
        ];
        return view('company.product.index', $result);
    }

//    /**
//     * 视频预览
//     */
//    public function video($cid,$id,$videoid)
//    {
//        $company = \App\Models\CompanyModel::find($cid);
//        $data = GoodsModel::find($id);
//        $result = [
//            'data'=> $data,
//            'video'=> \App\Models\Base\VideoModel::find($videoid),
//            'uid'=> $company->uid,
//            'videoName'=> $data->name,
//        ];
//        return view('layout.videoPre', $result);
//    }

    /**
     * 获取 model
     */
    public function getModel()
    {
        $apiModel = ApiGoods::getModel();
        return $apiModel['code']==0 ? $apiModel['model'] : [];
    }
}