<?php
namespace App\Http\Controllers\Home;

use App\Api\ApiUser\ApiUserVoice;
use App\Models\Base\UserGoldModel;
use App\Models\Base\WalletModel;
use App\Models\Home\UserVoiceModel;
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
        $pageCurr = isset($_POST['pageCurr'])?$_POST['pageCurr']:1;
        $prefix_url = DOMAIN.'uservoice';
        $result = [
            'datas'=> $this->query($pageCurr,$prefix_url),
            'model'=> $this->model,
            'prefix_url'=> $prefix_url,
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
//        $data['created_at'] = time();
//        UserVoiceModel::create($data);
        ApiUserVoice::add($data);

        //成功发布后给用户随机奖励金币1-5个
        $gold = rand(1,5);
        UserGoldModel::setGold($this->userid,3,$gold);
        //计算金币总数
        if ($gold) { WalletModel::setGold($this->userid,$gold); }

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

    public function query($pageCurr,$prefix_url)
    {
//        $datas = UserVoiceModel::where('isshow',2)
//            ->orderBy('sort','desc')
//            ->paginate($this->limit);
//        $datas->limit = $this->limit;
        $rst = ApiUserVoice::getUserVoiceList($this->limit,$pageCurr);
        $datas = $rst['code']==0?$rst['data']:[];
        $datas['pagelist'] = $this->getPageList($datas,$prefix_url,$this->limit,$pageCurr);
        return $datas;
    }
}