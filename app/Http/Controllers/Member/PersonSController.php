<?php
namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Models\GoodsModel;
use App\Models\CategoryModel;

class PersonSController extends BaseGoodsController
{
    /**
     * 个人作品供应管理
     * goods 商品、货物，代表文化类产品
     */

    public function __construct()
    {
        parent::__construct();
        $this->lists['func']['name'] = '个人作品';
        $this->lists['func']['url'] = 'personS';
        $this->lists['create']['name'] = '发布作品';
        $this->model = new GoodsModel();
    }

    public function index($type=0,$cate_id=0)
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $result = [
            'datas'=> $this->query($del=0,$type,$cate_id),
            'prefix_url'=> '/member/personS',
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.personSD.index', $result);
    }

    public function trash($type=0,$cate_id=0)
    {
        $curr['name'] = $this->lists['trash']['name'];
        $curr['url'] = $this->lists['trash']['url'];
        $result = [
            'datas'=> $this->query($del=1,$type,$cate_id),
            'prefix_url'=> '/member/personS/trash',
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
            'categorys'=> $this->model->categorys(),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.personSD.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request,$this->model['types'][1]);
        $data['created_at'] = date('Y-m-d', time());
        GoodsModel::create($data);
        return redirect('/member/personS');
    }

    public function edit($id)
    {
        $curr['name'] = $this->lists['edit']['name'];
        $curr['url'] = $this->lists['edit']['url'];
        $result = [
            'data'=> GoodsModel::find($id),
            'categorys'=> CategoryModel::all(),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.personSD.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request,$id);
        $data['updated_at'] = date('Y-m-d H:i:s', time());
        GoodsModel::where('id',$id)->update($data);
        return redirect('/member/personS');
    }

    public function show($id)
    {
        $curr['name'] = $this->lists['show']['name'];
        $curr['url'] = $this->lists['show']['url'];
        $result = [
            'data'=> GoodsModel::find($id),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.personSD.show', $result);
    }

    public function destroy($id)
    {
        GoodsModel::where('id',$id)->update(['del'=> 1]);
        return redirect('/member/personS');
    }

    public function restore($id)
    {
        GoodsModel::where('id',$id)->update(['del'=> 0]);
        return redirect('/member/personS/trash');
    }

    public function forceDelete($id)
    {
        GoodsModel::where('id',$id)->delete();
        return redirect('/member/personS/trash');
    }
}