<?php
namespace App\Http\Controllers\Member;

//use App\Http\Requests\Request;
use Illuminate\Http\Request;
use App\Models\GoodsModel;

class CompanySController extends BaseGoodsController
{
    /**
     * 企业供应管理
     * goods 商品、货物，代表文化类产品
     */

    //产品主体：1个人需求，2设计师供应，3企业需求，4企业供应
    protected $type = 4;

    public function __construct()
    {
        parent::__construct();
        $this->lists['func']['name'] = '企业作品';
        $this->lists['func']['url'] = 'companyS';
        $this->lists['create']['name'] = '发布作品';
        $this->model = new GoodsModel();
    }

    public function index($cate_id=0)
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $result = [
            'datas'=> $this->query($del=0,$this->type),
            'prefix_url'=> DOMAIN.'member/companyS',
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.companySD.index', $result);
    }

    public function trash($cate_id=0)
    {
        $curr['name'] = $this->lists['trash']['name'];
        $curr['url'] = $this->lists['trash']['url'];
        $result = [
            'datas'=> $this->query($del=1,$this->type),
            'prefix_url'=> DOMAIN.'member/companyS/trash',
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.companySD.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->lists['create']['name'];
        $curr['url'] = $this->lists['create']['url'];
        $result = [
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.companySD.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request,$this->type);
        $data['created_at'] = time();
        GoodsModel::create($data);
        return redirect(DOMAIN.'member/companyS');
    }

    public function edit($id)
    {
        $curr['name'] = $this->lists['edit']['name'];
        $curr['url'] = $this->lists['edit']['url'];
        $result = [
            'data'=> GoodsModel::find($id),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.companySD.edit', $result);
    }

    public function update(Request $request, $id)
    {
        $data = $this->getData($request,$this->type);
        $data['updated_at'] = time();
        GoodsModel::where('id',$id)->update($data);
        return redirect(DOMAIN.'member/companyS');
    }

    public function show($id)
    {
        $curr['name'] = $this->lists['show']['name'];
        $curr['url'] = $this->lists['show']['url'];
        $data = GoodsModel::find($id);
        $result = [
            'data'=> $data,
            'types'=> $this->model['types'],
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.companySD.show', $result);
    }

    public function destroy($id)
    {
        GoodsModel::where('id',$id)->update(['del'=> 1]);
        return redirect(DOMAIN.'member/companyS');
    }

    public function restore($id)
    {
        GoodsModel::where('id',$id)->update(['del'=> 0]);
        return redirect(DOMAIN.'member/companyS/trash');
    }

    public function forceDelete($id)
    {
        GoodsModel::where('id',$id)->delete();
        return redirect(DOMAIN.'member/companyS/trash');
    }
}