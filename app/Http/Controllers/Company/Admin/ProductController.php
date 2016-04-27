<?php
namespace App\Http\Controllers\Company\Admin;

use App\Models\GoodsModel;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
    /**
     * 企业开展后台，产品管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->lists['category']['name'] = '内容设置';
        $this->lists['category']['url'] = 'content';
        $this->lists['func']['name'] = '产品编辑';
        $this->lists['func']['url'] = 'product';
    }

    public function index()
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $result = [
            'datas'=> $this->query(),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('company.admin.product.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->lists['create']['name'];
        $curr['url'] = $this->lists['create']['url'];
        $result = [
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('company.admin.product.create', $result);
    }

   public function store(Request $request)
   {
       $data = $this->getData($request);
       $data['created_at'] = date('Y-m-d H:i:s', time());
       GoodsModel::create($data);
       return redirect('/company/admin/product');
   }





    /**
     * 收集数据
     */
    public function getData(Request $request)
    {
        $data = [
            'name'=> $request->name,
            'genre'=> 1,     //1代表产品，2代表花絮
            'type'=> 4,     //1个人需求，2个人供应，3企业需求，4企业供应
            'cate_id'=> $request->cate_id,
            'intro'=> $request->intro,
            'title'=> $request->title,
            'pic_id'=> $request->pic_id,
            'video_id'=> $request->video_id,
            'uid'=> $this->userid,
            'uname'=> \Session::get('user.username'),
            'isshow2'=> $request->isshow2,
        ];
        return $data;
    }

    /**
     * 查询方法
     */
    public function query()
    {
        $this->userid = 0;     //假如默认值
        //说明：genre==1产品，2花絮；type==1个人需求，2个人供应，3企业需求，4企业供应
        $datas = GoodsModel::where('uid',$this->userid)
            ->where(array('genre'=>1, 'type'=>4))
            ->paginate($this->limit);
        return $datas;
    }
}