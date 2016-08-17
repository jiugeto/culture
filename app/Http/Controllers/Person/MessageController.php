<?php
namespace App\Http\Controllers\Person;

use App\Models\MessageModel;
use App\Models\UserModel;
use Illuminate\Http\Request;

class MessageController extends BaseController
{
    /**
     * 个人后台 消息管理
     */

    protected $curr = 'message';

    public function __construct()
    {
        parent::__construct();
        $this->model = new MessageModel();
    }

    public function index()
    {
        $result = [
            'datas'=> $this->query(),
            'links'=> $this->links,
            'user'=> $this->user,
            'curr'=> $this->curr,
        ];
        return view('person.message.index', $result);
    }

    public function create()
    {
        $result = [
            'links'=> $this->links,
            'user'=> $this->user,
            'curr'=> $this->curr,
        ];
        return view('person.message.create', $result);
    }

    public function store(Request $request)
    {
    }




    public function getData(Request $request)
    {
        if (!$request->name || !$request->title || !$request->intro) {
            echo "<script>alert('消息标题、内容必填！');</script>";exit;
        }
        $userModel = UserModel::find($this->userid);
        if (in_array($request->name,[$userModel->email,$request->qq,$request->username])) {}
        if (strlen($request->title)<2 || strlen($request->intro)<2) {
            echo "<script>alert('消息标题、内容不少于2个字符！');</script>";exit;
        }
        return array(
            'title'=> $request->title,
            'genre'=> $request->genre,
            'intro'=> $request->intro,
            'sender'=> $this->userid,
        );
    }

    public function query()
    {
        return MessageModel::where('del',0)
            ->paginate($this->limit);
    }

    public function getGenre()
    {
        $isuser = $this->model->getUser($this->userid)->isuser;
        if (in_array($isuser,[1,3])) {
            $genre = 1;
        } elseif (in_array($isuser,[2,4,5,6])) {
            $genre = 2;
        }
        return isset($genre) ? $genre : 0;
    }
}