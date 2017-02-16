<?php
namespace App\Http\Controllers\Member;

use App\Api\ApiBusiness\ApiRent;
use App\Api\ApiUser\ApiUsers;
use Illuminate\Http\Request;

class RentController extends BaseController
{
    /**
     * 会员后台租赁供求管理
     * rent 器材租赁
     */

    public function __construct()
    {
        parent::__construct();
        $this->lists['func']['name'] = '租赁管理';
        $this->lists['func']['url'] = 'rent';
        $this->lists['create']['name'] = '租赁发布';
    }

    public function index($type=0)
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $pageCurr = isset($_POST['pageCurr'])?$_POST['pageCurr']:1;
        $prefix_url = DOMAIN.'member/goods';
        $datas = $this->query($pageCurr,0,$type);
        $pagelist = $this->getPageList($datas,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'pagelist' => $pagelist,
            'prefix_url' => $prefix_url,
            'model' => $this->getModel(),
            'lists' => $this->lists,
            'curr' => $curr,
            'type' => $type,
        ];
        return view('member.rent.index', $result);
    }

//    public function trash($genre=0)
//    {
//        $curr['name'] = $this->lists['trash']['name'];
//        $curr['url'] = $this->lists['trash']['url'];
//        $result = [
//            'datas'=> $this->query($del=1,$genre),
//            'genre'=> $genre,
//            'lists'=> $this->lists,
//            'curr'=> $curr,
//        ];
//        return view('member.rent.index', $result);
//    }

    public function create()
    {
        $curr['name'] = $this->lists['create']['name'];
        $curr['url'] = $this->lists['create']['url'];
        $result = [
            'model'=> $this->getModel(),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.rent.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $apiRent = ApiRent::add($data);
        if ($apiRent['code']!=0) {
            echo "<script>alert('".$apiRent['msg']."');history.go(-1);</script>";exit;
        }
//        //插入搜索表
//        $rentModel = RentModel::where($data)->first();
//        \App\Models\Home\SearchModel::change($rentModel,8,'create');
        return redirect(DOMAIN.'member/rent');
    }

    public function edit($id)
    {
        $curr['name'] = $this->lists['edit']['name'];
        $curr['url'] = $this->lists['edit']['url'];
        $apiRent = ApiRent::show($id);
        if ($apiRent['code']!=0) {
            echo "<script>alert('".$apiRent['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data'=> $apiRent['data'],
            'model'=> $this->getModel(),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.rent.edit', $result);
    }

    public function update(Request $request, $id)
    {
        $data = $this->getData($request);
        $data['id'] = $id;
        $apiRent = ApiRent::modify($data);
        if ($apiRent['code']!=0) {
            echo "<script>alert('".$apiRent['msg']."');history.go(-1);</script>";exit;
        }
//        //更新搜索表
//        $rentModel = RentModel::where('id',$id)->first();
//        \App\Models\Home\SearchModel::change($rentModel,8,'update');
        return redirect(DOMAIN.'member/rent');
    }

    public function show($id)
    {
        $curr['name'] = $this->lists['show']['name'];
        $curr['url'] = $this->lists['show']['url'];
        $apiRent = ApiRent::show($id);
        if ($apiRent['code']!=0) {
            echo "<script>alert('".$apiRent['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data'=> $apiRent['data'],
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.rent.show', $result);
    }

//    public function destroy($id)
//    {
//        RentModel::where('id',$id)->update(['del'=> 1]);
//        return redirect(DOMAIN.'member/rent');
//    }
//
//    public function restore($id)
//    {
//        RentModel::where('id',$id)->update(['del'=> 0]);
//        return redirect(DOMAIN.'member/rent/trash');
//    }
//
//    public function forceDelete($id)
//    {
//        RentModel::where('id',$id)->delete();
//        return redirect(DOMAIN.'member/rent/trash');
//    }





    /**
     * 收集数据
     */
    public function getData(Request $request)
    {
        $rent = [
            'name'=> $request->name,
            'genre'=> $this->getGenre(),
            'type'=> $request->type,
            'intro'=> $request->intro,
            'uid'=> $this->userid,
            'money'=> $request->money,
        ];
        return $rent;
    }

    /**
     * 查询方法
     */
    public function query($pageCurr,$del,$type)
    {
        $genre = in_array($this->userid,[1]) ? 0 : $this->getGenre();
        $apiRent = ApiRent::index($this->limit,$pageCurr,$this->userid,$genre,$type,2,$del);
        return $apiRent['code']==0 ? $apiRent['data'] : [];
    }

    /**
     * 获取 model
     */
    public function getModel()
    {
        $apiModel = ApiRent::getModel();
        return $apiModel['code']==0 ? $apiModel['model'] : [];
    }

    /**
     * 判断用户类型
     */
    public function getGenre()
    {
        $apiUser = ApiUsers::getOneUser($this->userid);
        if ($apiUser['code']!=0) {
            echo "<script>alert('".$apiUser['msg']."');history.go(-1);</script>";exit;
        }
        if ($apiUser['data']['isuser']==7) {
            $genre = 1;     //租赁供应
        } else {
            $genre = 2;     //租赁需求
        }
        return $genre;
    }
}