<?php
namespace App\Http\Controllers\Company\Admin;

use App\Models\Company\ComSingleModel;
use Illuminate\Http\Request;

class SingleController extends BaseController
{
    /**
     * 企业后台 单页管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->lists['category']['name'] = '公司信息';
        $this->lists['category']['url'] = 'coninfo';
        $this->lists['func']['name'] = '添加单页';
        $this->lists['func']['url'] = 'single';
        $this->model = new ComSingleModel();
    }

    public function index()
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $result = [
            'datas'=> $this->query($del=0),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('company.admin.single.index', $result);
    }

    /**
     * 查询方法
     */
    public function query($del=0)
    {
        $datas = ComSingleModel::where('cid',$this->cid)
            ->where('del',$del)
            ->paginate($this->limit);
        return $datas;
    }
}