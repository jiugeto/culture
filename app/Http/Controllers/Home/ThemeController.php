<?php
namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Models\Talk\ThemeModel;

class ThemeController extends BaseController
{
    /**
     * 前台话题专栏管理
     */

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $uid = $this->userid ? $this->userid : 0;
        $result = [
            'datas'=> $this->query($uid),
            'prefix_url'=> DOMAIN.'theme',
            'curr'=> 'theme',
            'uid'=> $uid,
        ];
        return view('home.theme.index', $result);
    }

    public function create()
    {
        //未登录会员不能添加
        if (!\Session::has('user.uid')) { echo "<script>alert('用户未登录，不能添加专栏！');history.go(-1);</script>";exit; }
        //2级以下会员不能添加
//        if () {}
//        dd('添加失败！');
        return view('home.theme.create');
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $data['created_at'] = time();
        ThemeModel::create($data);
        return redirect(DOMAIN.'theme');
    }

    public function edit($id)
    {
        $result = [
            'data'=> ThemeModel::find($id),
        ];
        return view('home.theme.edit', $result);
    }





    public function query($uid)
    {
        if ($uid) {
            $datas = ThemeModel::where('uid',$uid)
                ->where('isshow',1)
                ->orderBy('sort','desc')
                ->orderBy('id','desc')
                ->paginate($this->limit * 2);
        } else {
            $datas = ThemeModel::where('isshow',1)
                ->orderBy('sort','desc')
                ->orderBy('id','desc')
                ->paginate($this->limit * 2);
        }
        $datas->limit = $this->limit;
        return $datas;
    }

    public function getData(Request $request)
    {
        if (!$request->name || !$request->intro) {
            echo "<script>alert('专栏名称、内容必填！');history.go(-1);</script>";exit;
        }
        return array(
            'name'=> $request->name,
            'intro'=> $request->intro,
            'uid'=> $this->userid,
        );
    }
}