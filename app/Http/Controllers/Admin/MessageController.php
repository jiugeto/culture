<?php
namespace App\Http\Controllers\Admin;

use App\Models\MessageModel;

class MessageController extends BaseController
{
    /**
     * 系统后台消息管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->crumb['']['name'] = '消息列表';
        $this->crumb['category']['name'] = '消息管理';
        $this->crumb['category']['url'] = 'message';
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> $this->query(0),
            'prefix_url'=> DOMAIN.'admin/message',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.message.index', $result);
    }

    public function trash()
    {
        $curr['name'] = $this->crumb['trash']['name'];
        $curr['url'] = $this->crumb['trash']['url'];
        $result = [
            'datas'=> $this->query(0),
            'prefix_url'=> DOMAIN.'admin/message/trash',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.message.index', $result);
    }





    /**
     * 查询方法
     */
    public function query($del=0)
    {
        $datas = MessageModel::where('del',$del)->paginate($this->limit);
        $datas->limit = $this->limit;
       return $datas;
    }
}