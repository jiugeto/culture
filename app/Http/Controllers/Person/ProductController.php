<?php
namespace App\Http\Controllers\Person;

use App\Models\ProductModel;
use App\Models\Base\VideoModel;

class ProductController extends BaseController
{
    /**
     * 个人后台 视频列表，在线创作的
     */

    protected $curr = 'product';

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $result = [
            'datas'=> $this->query(),
            'prefix_url'=> DOMAIN.'person/product',
            'user'=> $this->user,
            'links'=> $this->links,
            'curr'=> $this->curr,
        ];
        return view('person.product.index', $result);
    }





    public function query()
    {
        $uid = $this->userid ? $this->userid : 0;
        $datas = ProductModel::where('del',0)
            ->where('uid',$uid)
            ->orderBy('sort','desc')
            ->orderBy('id','desc')
            ->paginate($this->limit);
        $datas->limit = $this->limit;
        return $datas;
    }
}