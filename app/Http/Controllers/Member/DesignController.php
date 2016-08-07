<?php
namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Models\DesignModel;

class DesignController extends BaseController
{
    /**
     * 会员后台：设计管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->lists['func']['name'] = '设计供求';
        $this->lists['func']['url'] = 'design';
        $this->lists['create']['name'] = '设计发布';
        $this->model = new DesignModel();
    }

    public function index($genre=0)
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $result = [
            'datas'=> $this->query($genre,$del=0),
            'model'=> $this->model,
            'prefix_url'=> DOMAIN.'member/design',
            'lists'=> $this->lists,
            'curr'=> $curr,
            'genre'=> $genre,
        ];
        return view('member.design.index', $result);
    }

    public function trash($genre=0)
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $result = [
            'datas'=> $this->query($genre,$del=1),
            'model'=> $this->model,
            'prefix_url'=> DOMAIN.'member/design/trash',
            'lists'=> $this->lists,
            'curr'=> $curr,
            'genre'=> $genre,
        ];
        return view('member.design.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->lists['create']['name'];
        $curr['url'] = $this->lists['create']['url'];
        $result = [
            'lists'=> $this->lists,
            'model'=> $this->model,
            'curr'=> $curr,
        ];
        return view('member.design.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $data['created_at'] = time();
        DesignModel::create($data);
        return redirect('/member/design');
    }

    public function edit($id)
    {
        $curr['name'] = $this->lists['edit']['name'];
        $curr['url'] = $this->lists['edit']['url'];
        $result = [
            'lists'=> $this->lists,
            'data'=> DesignModel::find($id),
            'model'=> $this->model,
            'curr'=> $curr,
        ];
        return view('member.design.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = time();
        DesignModel::where('id',$id)->update($data);
        return redirect(DOMAIN.'member/design');
    }

    public function show($id)
    {
        $curr['name'] = $this->lists['show']['name'];
        $curr['url'] = $this->lists['show']['url'];
        $result = [
            'lists'=> $this->lists,
            'data'=> DesignModel::find($id),
            'model'=> $this->model,
            'curr'=> $curr,
        ];
        return view('member.design.show', $result);
    }

    public function destroy($id)
    {
        DesignModel::where('id',$id)->update(array('del'=> 1));
        return redirect(DOMAIN.'member/design');
    }





    public function getData(Request $request)
    {
        if (!$request->name || !$request->genre || !$request->cate) {
            echo "<script>alert('设计名称、供求类型、设计类型必填！');history.go(-1);</script>";exit;
        }
        if (!$request->intro || !$request->detail) {
            echo "<script>alert('设计简介、详情内容必填！');history.go(-1);</script>";exit;
        }
        if (!$request->money) {
            echo "<script>alert('设计价格必填！');history.go(-1);</script>";exit;
        }
        if (preg_match('/^[0-9]+(.[0-9]{1,2})$/',$request->money)) {
            echo "<script>alert('设计价格格式有误！');history.go(-1);</script>";exit;
        }

        return array(
            'name'=> $request->name,
            'genre'=> $request->genre,
            'cate'=> $request->cate,
            'uid'=> $request->uid ? $request->uid : 0,
            'intro'=> $request->intro,
            'detail'=> $request->detail,
            'price'=> $request->money,
        );
    }

    public function query($genre,$del)
    {
        if ($genre) {
            $datas = DesignModel::where('del',$del)
                ->where('genre',$genre)
                ->orderBy('sort','desc')
                ->orderBy('id','desc')
                ->paginate($this->limit);
        } else {
            $datas = DesignModel::where('del',$del)
                ->orderBy('sort','desc')
                ->orderBy('id','desc')
                ->paginate($this->limit);
        }
        $datas->limit = $this->limit;
        return $datas;
    }
}