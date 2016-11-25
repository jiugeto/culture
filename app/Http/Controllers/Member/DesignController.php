<?php
namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Models\DesignModel;

class DesignController extends BaseController
{
    /**
     * 会员后台：设计管理
     */

    protected $genre;       //1企业供应，2企业需求，3个人供应，4个人需求

    public function __construct()
    {
        parent::__construct();
        $this->lists['func']['name'] = '设计管理';
        $this->lists['func']['url'] = 'design';
        $this->lists['create']['name'] = '设计发布';
        $this->model = new DesignModel();
    }

    public function index($cate=0)
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $result = [
            'datas'=> $this->query($this->genre,$del=0,$cate),
            'model'=> $this->model,
            'prefix_url'=> DOMAIN.'member/design',
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.design.index', $result);
    }

    public function trash($cate=0)
    {
        $curr['name'] = $this->lists['trash']['name'];
        $curr['url'] = $this->lists['trash']['url'];
        $result = [
            'datas'=> $this->query($this->genre,$del=1,$cate),
            'model'=> $this->model,
            'prefix_url'=> DOMAIN.'member/design/trash',
            'lists'=> $this->lists,
            'curr'=> $curr,
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
        $data['genre'] = $this->genre;
        $data['created_at'] = time();
        DesignModel::create($data);

        //插入搜索表
        $designModel = DesignModel::where($data)->first();
        \App\Models\Home\SearchModel::change($designModel,9,'create');

        return redirect(DOMAIN.'member/design');
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

        //更新搜索表
        $designModel = DesignModel::where('id',$id)->first();
        \App\Models\Home\SearchModel::change($designModel,9,'update');

        return redirect(DOMAIN.'member/designPerD');
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
        if (!$request->name || !$request->cate) {
            echo "<script>alert('设计名称、设计类型必填！');history.go(-1);</script>";exit;
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
//            'genre'=> $request->genre,
            'cate'=> $request->cate,
            'uid'=> $this->userid ? $this->userid : 0,
            'intro'=> $request->intro,
            'detail'=> $request->detail,
            'money'=> $request->money,
        );
    }

    public function query($genre,$del,$cate)
    {
        if ($genre && $cate) {
            $datas = DesignModel::where('del',$del)
                ->where('genre',$genre)
                ->where('cate',$cate)
                ->orderBy('sort','desc')
                ->orderBy('id','desc')
                ->paginate($this->limit);
        } elseif (!$genre && $cate) {
            $datas = DesignModel::where('del',$del)
                ->where('cate',$cate)
                ->orderBy('sort','desc')
                ->orderBy('id','desc')
                ->paginate($this->limit);
        } elseif ($genre && !$cate) {
            $datas = DesignModel::where('del',$del)
                ->where('genre',$genre)
                ->orderBy('sort','desc')
                ->orderBy('id','desc')
                ->paginate($this->limit);
        } elseif (!$genre && !$cate) {
            $datas = DesignModel::where('del',$del)
                ->orderBy('sort','desc')
                ->orderBy('id','desc')
                ->paginate($this->limit);
        }
        $datas->limit = $this->limit;
        return $datas;
    }
}