<?php
namespace App\Http\Controllers\Admin;

use App\Models\UserModel;
use Illuminate\Http\Request;
use App\Models\ThemeModel;

class ThemeController extends BaseController
{
    /**
     * 网站链接管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->model = new ThemeModel();
        $this->crumb['']['name'] = '专栏列表';
        $this->crumb['category']['name'] = '专栏管理';
        $this->crumb['category']['url'] = 'theme';
    }

    public function index($uname=0)
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> $this->query($uname),
            'prefix_url'=> '/admin/theme',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
            'uname'=> $uname ? $uname :'',
        ];
        return view('admin.theme.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->crumb['create']['name'];
        $curr['url'] = $this->crumb['create']['url'];
        $result = [
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.theme.create', $result);
    }

    public function store(Request $request)
    {
        $themeModel = ThemeModel::where('name',$request->name)->first();
        if ($themeModel) { echo "<script>alert('已有同名专题，请重命名！');history.go(-1);</script>";exit; }
        $data = $this->getData($request);
        $data['created_at'] = time();
        ThemeModel::create($data);
        return redirect(DOMAIN.'admin/theme');
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $result = [
            'data'=> ThemeModel::find($id),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.theme.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = time();
        ThemeModel::where('id',$id)->update($data);
        return redirect(DOMAIN.'admin/theme');
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $result = [
            'data'=> ThemeModel::find($id),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.theme.show', $result);
    }





    public function query($uname)
    {
        if ($uname && $uname!='本站') {
            $datas = ThemeModel::where('uname','like','%'.$uname.'%')
                ->orderBy('sort','desc')
                ->orderBy('id','desc')
                ->paginate($this->limit);
        } else {
            $datas = ThemeModel::orderBy('sort','desc')
                ->orderBy('id','desc')
                ->paginate($this->limit);
        }
        $datas->limit = $this->limit;
        return $datas;
    }

    public function getData(Request $request)
    {
        if (!$request->name || !$request->intro) {
            echo "<script>alert('专题名称、内容必填！');history.go(-1);</script>";exit;
        }
        if ($request->username && strlen($request->username)<2) {
            echo "<script>alert('用户名必须大于等于2的字符！');history.go(-1);</script>";exit;
        }
        if ($uname=$request->username) {
            $userModel = UserModel::where('username',$uname)->first();
            if (!$userModel) { echo "<script>alert('没有此用户！');history.go(-1);</script>";exit; }
        }
        return array(
            'name'=> $request->name,
            'uid'=> ($request->username&&isset($userModel)&&$userModel)?$userModel->id:0,
            'uname'=> ($request->username&&isset($userModel)&&$userModel)?$userModel->username:'',
            'intro'=> $request->intro,
            'sort'=> $request->sort,
            'isshow'=> $request->isshow,
        );
    }
}