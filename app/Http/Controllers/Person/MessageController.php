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

    public function index($m=1)
    {
        //$m：1收件箱，2发件箱，3草稿箱，4回收站
        if ($m==1) { $url0 = ''; }
        elseif ($m==2) { $url0 = '/outbox'; }
        elseif ($m==3) { $url0 = '/draft'; }
        elseif ($m==4) { $url0 = '/trash'; }
        $result = [
            'datas'=> $this->query($m),
            'prefix_url'=> DOMAIN.'person'.$url0,
            'links'=> $this->links,
            'user'=> $this->user,
            'curr'=> $this->curr,
            'm'=> $m,
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
        $data = $this->getData($request);
        $data['created_at'] = time();
        MessageModel::create($data);
        return redirect(DOMAIN.'person/message');
    }

    public function edit($id)
    {
        $result = [
            'links'=> $this->links,
            'data'=> MessageModel::find($id),
            'user'=> $this->user,
            'curr'=> $this->curr,
        ];
        return view('person.message.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = time();
        MessageModel::where('id',$id)->update($data);
        return redirect(DOMAIN.'person/message');
    }

    public function show($id)
    {
        $result = [
            'links'=> $this->links,
            'data'=> MessageModel::find($id),
            'user'=> $this->user,
            'curr'=> $this->curr,
        ];
        return view('person.message.show', $result);
    }

    public function setSend($id)
    {
        $update = [
            'status'=> 2,
            'senderTime'=> time(),
        ];
        MessageModel::where('id',$id)->update($update);
        return redirect(DOMAIN.'person/message');
    }





    public function getData(Request $request)
    {
        if (!$request->name || !$request->title || !$request->intro) {
            echo "<script>alert('消息标题、内容必填！');</script>";exit;
        }
//        $userModel = UserModel::find($this->userid);
        $userModel = UserModel::where('email',$request->name)
            ->orWhere('qq',$request->name)
            ->orWhere('username',$request->name)
            ->first();
        if (!$userModel) {
            echo "<script>alert('无此收件人！');</script>";exit;
        }
        if ($userModel->id==$this->userid) {
            echo "<script>alert('不能发送给自己！');</script>";exit;
        }
        if (strlen($request->title)<2 || strlen($request->intro)<2) {
            echo "<script>alert('消息标题、内容不少于2个字符！');</script>";exit;
        }
        return array(
            'title'=> $request->title,
            'genre'=> $this->getGenre(),
            'intro'=> $request->intro,
            'sender'=> $this->userid,
            //确定草稿还是发送
            'senderTime'=> $request->submit=='send' ? time() : 0,
            'accept'=> $userModel->id,
            'status'=> $request->submit=='send' ? 2 : 1,
        );
    }

    public function query($m=1)
    {
        //$m：1收件箱，2发件箱，3草稿箱，4回收站
//        //$t：0所有，1一天内，2一周内，3一月内，4更早
//        $day = 3600*24;
//        $week = $day * 7;
//        $month = $week * 30;    //假定一月30天
//        if ($t==1) { $time = $day; }
//        elseif ($t==2) { $time = $week; }
//        elseif ($t==3) { $time = $month; }
//        elseif ($t==4) { $time = $month; }
        if ($m==1) {
            $datas = MessageModel::where('del',0)
                ->where('sender','<>',$this->userid)
                ->where('accept',$this->userid)
                ->where('status','>',2)
                ->orderBy('id','desc')
                ->paginate($this->limit);
        } elseif ($m==2) {
            $datas = MessageModel::where('del',0)
                ->where('sender',$this->userid)
                ->where('accept','<>',$this->userid)
                ->where('status','>',1)
                ->orderBy('id','desc')
                ->paginate($this->limit);
        } elseif ($m==3) {
            $datas = MessageModel::where('del',0)
                ->where('sender',$this->userid)
                ->where('accept','<>',$this->userid)
                ->where('status',1)
                ->orderBy('id','desc')
                ->paginate($this->limit);
        } elseif ($m==4) {
            $datas = MessageModel::where('del',1)
                ->orderBy('id','desc')
                ->paginate($this->limit);
        }
        $datas->limit = $this->limit;
        return $datas;
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