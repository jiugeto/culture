<?php
namespace App\Http\Controllers\Home;

use App\Models\UserVoiceModel;
use Illuminate\Http\Request;

class UserVoiceController extends BaseController
{
    /**
     * 前台用户心声管理
     */

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $result = [
            'datas'=> $this->query(),
            'model'=> $this->model,
            'prefix_url'=> DOMAIN.'usevoice',
        ];
        return view('home.uservoice.index', $result);
    }

    public function create()
    {
        if (!$this->userid) {
            echo "<script>alert('请先登录！');history.go(-1);</script>";exit;
        }
        return view('home.uservoice.create');
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $data['created_at'] = time();
        UserVoiceModel::create($data);
        return redirect(DOMAIN.'uservoice');
    }

    public function show($id)
    {
        $result = [
            'data'=> UserVoiceModel::find($id),
        ];
        return view('home.uservoice.show', $result);
    }






    public function getData(Request $request)
    {
        return array(
            'uid'=> $this->userid,
            'name'=> $request->name,
            'work'=> $request->work,
            'intro'=> $request->intro,
        );
    }

    public function query()
    {
        $datas = UserVoiceModel::where('isshow',2)
            ->orderBy('sort','desc')
            ->paginate($this->limit);
        $datas->limit = $this->limit;
        return $datas;
    }
}