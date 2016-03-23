<?php
namespace App\Http\Controllers\Member;

use App\Models\RentModel;
use Illuminate\Http\Request;

class RentController extends BaseController
{
    /**
     * 会员后台租赁供求管理
     * rent 器材租赁
     */

    public function __construct()
    {
        $this->list['func']['name'] = '租赁供求';
        $this->list['func']['url'] = 'rent';
        $this->list['create']['name'] = '租赁发布';
        $this->model = new RentModel();
    }

    public function index($genre=0)
    {
        $result = [
            'datas'=> $this->query($del=0,$genre),
            'genre'=> $genre,
            'menus'=> $this->list,
            'curr'=> '',
        ];
        return view('member.rent.index', $result);
    }

    public function trash($genre=0)
    {
        $result = [
            'datas'=> $this->query($del=1,$genre),
            'genre'=> $genre,
            'menus'=> $this->list,
            'curr'=> 'trash',
        ];
        return view('member.rent.index', $result);
    }

    public function create()
    {
        $result = [
            'menus'=> $this->list,
            'curr'=> 'create',
        ];
        return view('member.rent.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $data['created_at'] = date('Y-m-d', time());
        RentModel::create($data);
        return redirect('/member/rent');
    }

    public function edit($id)
    {
        $data = RentModel::find($id);
        $result = [
            'data'=> $data,
            'menus'=> $this->list,
            'curr'=> 'create',
        ];
        return view('member.rent.edit', $result);
    }

    public function update(Request $request, $id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = date('Y-m-d', time());
        RentModel::where('id',$id)->update($data);
        return redirect('/member/rent');
    }

    public function show($id)
    {
        $data = RentModel::find($id);
        $result = [
            'data'=> $data,
            'menus'=> $this->list,
            'curr'=> 'show',
        ];
        return view('member.rent.show', $result);
    }

    public function destroy($id)
    {
        RentModel::where('id',$id)->update(['del'=> 1]);
        return redirect('/member/rent');
    }

    public function restore($id)
    {
        RentModel::where('id',$id)->update(['del'=> 0]);
        return redirect('/member/rent/trash');
    }

    public function forceDelete($id)
    {
        RentModel::where('id',$id)->delete();
        return redirect('/member/rent/trash');
    }





    /**
     * 收集数据
     */
    public function getData(Request $request)
    {
        $data = $request->all();
        //uid暂时为0
        $data['uid'] = 0;
        $rent = [
            'name'=> $data['name'],
            'genre'=> $data['genre'],
            'intro'=> $data['intro'],
            'uid'=> $data['uid'],
            'price'=> $data['price'],
        ];
        return $rent;
    }

    /**
     * 查询方法
     */
    public function query($del=0,$genre=0)
    {
        if ($genre) {
            $rents = RentModel::where('del',$del)
                ->where('genre',$genre)
                ->orderBy('id','desc')
                ->paginate($this->limit);
        } else {
            $rents = RentModel::where('del',$del)
                ->orderBy('id','desc')
                ->paginate($this->limit);
        }
        return $rents;
    }
}