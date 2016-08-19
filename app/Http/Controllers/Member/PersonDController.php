<?php
namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Models\GoodsModel;

class PersonDController extends BaseGoodsController
{
    /**
     * 个人会员需求管理
     * goods 商品、货物，代表文化类产品
     */

    //产品主体：1个人需求，2设计师供应，3企业需求，4企业供应
    protected $type = 1;

    public function __construct()
    {
        parent::__construct();
        $this->lists['func']['name'] = '个人需求';
        $this->lists['func']['url'] = 'personD';
        $this->lists['create']['name'] = '发布需求';
        $this->model = new GoodsModel();
    }

    public function index()
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $result = [
            'datas'=> $this->query($del=0,$this->type),
            'prefix_url'=> DOMAIN.'member/personD',
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.personSD.index', $result);
    }

    public function trash()
    {
        $curr['name'] = $this->lists['trash']['name'];
        $curr['url'] = $this->lists['trash']['url'];
        $result = [
            'datas'=> $this->query($del=1,$this->type),
            'prefix_url'=> DOMAIN.'member/personD/trash',
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.personSD.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->lists['create']['name'];
        $curr['url'] = $this->lists['create']['url'];
        $result = [
            'pics'=> $this->model->pics($this->userid),
            'videos'=> $this->model->videos($this->userid),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.personSD.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request,$this->type);
        $data['created_at'] = time();
        GoodsModel::create($data);
        return redirect(DOMAIN.'member/personD');
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
        return view('member.personSD.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request,$this->type);
        $data['updated_at'] = time();
        GoodsModel::where('id',$id)->update($data);
        return redirect(DOMAIN.'member/personD');
    }

    public function show($id)
    {
        $curr['name'] = $this->lists['show']['name'];
        $curr['url'] = $this->lists['show']['url'];
        $result = [
            'data'=> GoodsModel::find($id),
            'model'=> $this->model,
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.personD.show', $result);
    }

    public function destroy($id)
    {
        GoodsModel::where('id',$id)->update(['del'=> 1]);
        return redirect(DOMAIN.'member/personD');
    }

    public function restore($id)
    {
        GoodsModel::where('id',$id)->update(['del'=> 0]);
        return redirect(DOMAIN.'member/personD/trash');
    }

    public function forceDelete($id)
    {
        GoodsModel::where('id',$id)->delete();
        return redirect(DOMAIN.'member/personD/trash');
    }
}