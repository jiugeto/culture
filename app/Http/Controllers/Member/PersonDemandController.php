<?php
namespace App\Http\Controllers\Member;

use App\Models\CategoryModel;
use Illuminate\Http\Request;
use App\Models\GoodsModel;

class PersonDemandController extends BaseGoodsController
{
    /**
     * 个人会员需求管理
     * goods 商品、货物，代表文化类产品
     */

    //产品主体：1个人需求，2设计师供应，3企业需求，4企业供应
    protected $type = 1;

    public function __construct()
    {
        $this->list['func']['name'] = '个人需求';
        $this->list['func']['url'] = 'persondemand';
        $this->model = new GoodsModel();
    }

    public function index($cate_id=0)
    {
        $result = [
            'datas'=> $this->query($del=0,$this->type,$cate_id),
            'prefix_url'=> '/member/persondemand',
            'menus'=> $this->list,
            'curr'=> '',
        ];
        return view('member.persondemand.index', $result);
    }

    public function trash($cate_id=0)
    {
        $result = [
            'datas'=> $this->query($del=1,$this->type,$cate_id),
            'prefix_url'=> '/member/persondemand/trash',
            'menus'=> $this->list,
            'curr'=> 'trash',
        ];
        return view('member.persondemand.index', $result);
    }

    public function create()
    {
        $result = [
//            'cates'=> $this->model->cates(),
            'categorys'=> $this->model->categorys(),
            'menus'=> $this->list,
            'curr'=> 'create',
        ];
//        dd($this->model->categorys());
        return view('member.persondemand.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request,$this->type);
        $data['created_at'] = date('Y-m-d', time());
        GoodsModel::create($data);
        return redirect('/member/persondemand');
    }

    public function edit($id)
    {
        $data = GoodsModel::find($id);
        $result = [
            'data'=> $data,
//            'cates'=> $this->model->cates(),
            'categorys'=> CategoryModel::all(),
            'menus'=> $this->list,
            'curr'=> 'edit',
        ];
        return view('member.persondemand.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request,$this->type,$id);
        $data['updated_at'] = date('Y-m-d H:i:s', time());
        GoodsModel::where('id',$id)->update($data);
        return redirect('/member/persondemand');
    }

    public function show($id)
    {
        $data = GoodsModel::find($id);
        $result = [
            'data'=> $data,
            'menus'=> $this->list,
            'curr'=> 'show',
        ];
        return view('member.persondemand.show', $result);
    }

    public function destroy($id)
    {
        GoodsModel::where('id',$id)->update(['del'=> 1]);
        return redirect('/member/persondemand');
    }

    public function restore($id)
    {
        GoodsModel::where('id',$id)->update(['del'=> 0]);
        return redirect('/member/persondemand/trash');
    }

    public function forceDelete($id)
    {
        GoodsModel::where('id',$id)->delete();
        return redirect('/member/persondemand/trash');
    }
}