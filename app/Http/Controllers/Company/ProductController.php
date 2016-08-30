<?php
namespace App\Http\Controllers\Company;

use App\Models\GoodsModel;

class ProductController extends BaseController
{
    /**
     * 企业后台产品
     */

    public function __construct()
    {
        parent::__construct();
        $this->model = new GoodsModel();
//        $this->list['func']['name'] = '产品';
//        $this->list['func']['url'] = 'product';
    }

    public function index($cid)
    {
        $list['func']['name'] = '产品';
        $list['func']['url'] = 'product';
        $company = $this->company($cid,$list['func']['url']);
        $result = [
            'datas'=> $this->query($company['uid'],$genre=1),
            'model'=> $this->model,
            'comMain'=> $this->getComMain($company['cid']),
            'topmenus'=> $this->topmenus,
            'prefix_url'=> $this->prefix_url,
            'curr'=> $list['func']['url'],
        ];
        return view('company.product.index', $result);
    }

    /**
     * 花絮
     */
    public function part($cid)
    {
        $list['func']['name'] = '花絮';
        $list['func']['url'] = 'part';
        $company = $this->company($cid,$list['func']['url']);
        $result = [
            'datas'=> $this->query($company['uid'],$genre=2),
            'model'=> $this->model,
            'comMain'=> $this->getComMain($company['cid']),
            'topmenus'=> $this->topmenus,
            'prefix_url'=> $this->prefix_url,
            'curr'=> $list['func']['url'],
        ];
        return view('company.product.index', $result);
    }





    public function query($uid,$genre)
    {
        $limit = 20;
        $datas = GoodsModel::where('uid',$uid)
            ->where('del',0)
            //genre==1代表产品
            ->where('genre',$genre)
            //type==4代表企业供应
            ->where('type',4)
            ->where('isshow',1)
            ->where('isshow2',1)
            ->orderBy('sort','desc')
            ->orderBy('id','desc')
            ->paginate($limit);
        $datas->limit = $limit;
        return $datas;
    }
}