<?php
namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Models\GoodsModel;

class CompanyDController extends BaseGoodsController
{
    /**
     * 企业需求
     * goods 商品、货物，代表文化类产品
     */

    //产品主体：1个人需求，2设计师供应，3企业需求，4企业供应
    protected $type = 3;

    public function __construct()
    {
        parent::__construct();
        $this->lists['func']['name'] = '企业需求';
        $this->lists['func']['url'] = 'companyD';
        $this->lists['create']['name'] = '发布需求';
        $this->model = new GoodsModel();
    }

    public function index()
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $result = [
            'datas'=> $this->query($del=0,$this->type),
            'prefix_url'=> DOMAIN.'member/companyD',
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.companySD.index', $result);
    }

    public function trash()
    {
        $curr['name'] = $this->lists['trash']['name'];
        $curr['url'] = $this->lists['trash']['url'];
        $result = [
            'datas'=> $this->query($del=0,$this->type),
            'prefix_url'=> DOMAIN.'member/companyD/trash',
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
            'model'=> $this->model,
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

        //插入搜索表
        $goodsModel = GoodsModel::where($data)->first();
        \App\Models\Home\SearchModel::change($goodsModel,2,'create');

        return redirect(DOMAIN.'member/companyD');
    }

    public function edit($id)
    {
        $curr['name'] = $this->lists['edit']['name'];
        $curr['url'] = $this->lists['edit']['url'];
        $result = [
            'data'=> GoodsModel::find($id),
            'model'=> $this->model,
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

        //更新搜索表
        $goodsModel = GoodsModel::where('id',$id)->first();
        \App\Models\Home\SearchModel::change($goodsModel,2,'update');

        return redirect(DOMAIN.'member/companyD');
    }

    public function show($id)
    {
        $curr['name'] = $this->lists['show']['name'];
        $curr['url'] = $this->lists['show']['url'];
        $data = GoodsModel::find($id);
        $result = [
            'data'=> $data,
            'model'=> $this->model,
            'types'=> $this->model['types'],
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.companySD.show', $result);
    }

    public function destroy($id)
    {
        GoodsModel::where('id',$id)->update(['del'=> 1]);
        return redirect(DOMAIN.'member/companyD');
    }

    public function restore($id)
    {
        GoodsModel::where('id',$id)->update(['del'=> 0]);
        return redirect(DOMAIN.'member/companyD/trash');
    }

    public function forceDelete($id)
    {
        GoodsModel::where('id',$id)->delete();
        return redirect(DOMAIN.'member/companyD/trash');
    }
}