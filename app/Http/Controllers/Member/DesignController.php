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
        $this->model = new DesignModel();
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
        return redirect(DOMAIN.'member/designPerS');
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
            'genre'=> $request->genre,
            'cate'=> $request->cate,
            'uid'=> $this->userid ? $this->userid : 0,
            'intro'=> $request->intro,
            'detail'=> $request->detail,
            'price'=> $request->money,
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