<?php
namespace App\Http\Controllers\Admin;

use App\Api\ApiBusiness\ApiMessage;

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
        $pageCurr = isset($_GET['pageCurr'])?$_GET['pageCurr']:1;
        $prefix_url = DOMAIN.'admin/message';
        $apiMsg = ApiMessage::index($this->limit,$pageCurr,0,0,0,0);
        if ($apiMsg['code']!=0) {
            $datas = array(); $total = 0;
        } else {
            $datas = $apiMsg['data']; $total = $apiMsg['pagelist']['total'];
        }
        $pagelist = $this->getPageList($total,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'pagelist' => $pagelist,
            'prefix_url' => $prefix_url,
            'crumb' => $this->crumb,
            'curr' => $curr,
        ];
        return view('admin.message.index', $result);
    }

//    public function trash()
//    {
//        $curr['name'] = $this->crumb['trash']['name'];
//        $curr['url'] = $this->crumb['trash']['url'];
//        $result = [
//            'datas'=> $this->query(0),
//            'prefix_url'=> DOMAIN.'admin/message/trash',
//            'crumb'=> $this->crumb,
//            'curr'=> $curr,
//        ];
//        return view('admin.message.index', $result);
//    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $apiMsg = ApiMessage::show($id);
        if ($apiMsg['code']!=0) {
            echo "<script>alert('".$apiMsg['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data'=> $apiMsg['data'],
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.message.show', $result);
    }

    /**
     * 设置是否显示
     */
    public function setShow($id,$isshow)
    {
        $apiMsg = ApiMessage::setShow($id,$isshow);
        if ($apiMsg['code']!=0) {
            echo "<script>alert('".$apiMsg['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/message');
    }
}