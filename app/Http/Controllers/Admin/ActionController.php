<?php

namespace App\Http\Controllers\Admin;

use App\Api\ApiUser\ApiAction;
use Illuminate\Http\Request;

class ActionController extends BaseController
{
    /**
     * 权限管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->crumb['']['name'] = '权限列表';
        $this->crumb['category']['name'] = '权限管理';
        $this->crumb['category']['url'] = 'action';
    }

    public function index($isshow=0,$pid=0)
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $pageCurr = isset($_POST['pageCurr'])?$_POST['pageCurr']:1;
        $prefix_url = DOMAIN.'admin/action';
        $rstPid = ApiAction::getActionsByPid(0);
        $result = [
            'datas'=> $this->query($isshow,$pid,$pageCurr,$prefix_url),
            'parents'=> $rstPid['code']==0?$rstPid['data']:[],
            'prefix_url'=> DOMAIN.'admin/action',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
            'isshow'=> $isshow,
            'pid'=> $pid,
        ];
        return view('admin.action.index', $result);
    }

    public function create($pid=0)
    {
        $curr['name'] = $this->crumb['create']['name'];
        $curr['url'] = $this->crumb['create']['url'];
        $result = [
            'parent'=> $this->parent($pid),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.action.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
//        ActionModel::create($data);
        $rst = ApiAction::add($data);
        if ($rst['code']!=0) {
            echo "<script>alert('".$rst['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/action');
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $rst = ApiAction::show($id);
        if ($rst['code']!=0) {
            echo "<script>alert('".$rst['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data'=> $rst['data'],
            'crumb'=> $this->crumb,
        ];
        return view('admin.action.show', $result);
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $rstActions = ApiAction::show($id);
        if ($rstActions['code']!=0) {
            echo "<script>alert('".$rstActions['msg']."');history.go(-1);</script>";exit;
        }
        $rstPid = ApiAction::getActionsByPid(0);
        $result = [
            'data'=> $rstActions['data'],
            'pactions'=> $rstPid['code']==0?$rstPid['data']:[],
            'parent'=> $this->parent($id),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.action.edit', $result);
    }

    public function update(Request $request, $id)
    {
        $data = $this->getData($request);
        $rst = ApiAction::update($data);
        if ($rst['code']!=0) {
            echo "<script>alert('".$rst['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/action');
    }

    public function destroy($id)
    {
//        ActionModel::where('id',$id)->update(array('del'=> 1));
        $rst = ApiAction::isdel($id,1);
        if ($rst['code']!=0) {
            echo "<script>alert('".$rst['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/action');
    }

    public function restore($id)
    {
//        ActionModel::where('id',$id)->update(array('del'=> 0));
        $rst = ApiAction::isdel($id,0);
        if ($rst['code']!=0) {
            echo "<script>alert('".$rst['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/action');
    }

    public function forceDelete($id)
    {
//        ActionModel::where('id',$id)->delete();
        $rst = ApiAction::delete($id);
        if ($rst['code']!=0) {
            echo "<script>alert('".$rst['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/action');
    }

    /**
     * 设置是否显示
     */
    public function setIsShow($id,$pid,$isshow)
    {
//        $action = ActionModel::find($id);
//        ActionModel::where('id',$id)->update(['isshow'=> $isshow]);
        $rst = ApiAction::isshow($id,$isshow);
        if ($rst['code']!=0) {
            echo "<script>alert('".$rst['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/action/s/'.$isshow.'/'.$pid);
    }





    /**
     * ==========================
     * 一下是公用方法
     * ==========================
     */

    /**
     * 收集数据
     */
    public function getData(Request $request)
    {
        $data = $request->all();
        if (!$data['style_class']) { $data['style_class'] = ''; }
        if (!$data['intro']) { $data['intro'] = ''; }
        $data = [
            'name'=> $data['name'],
            'intro'=> $data['intro'],
            'namespace'=> $data['namespace'],
            'controller_prefix'=> substr($data['controller_prefix'],0,-10),
            'url'=> $data['url'],
            'action'=> $data['action'],
            'style_class'=> $data['style_class'],
            'pid'=> $data['pid'],
            'isshow'=> $data['isshow'],
        ];
        return $data;
    }

    /**
     * 得到父操作
     */
    public function parent($pid)
    {
        if ($pid) {        //获取上级操作名称
//            $pname = ActionModel::where('id',$pid)->first()->name;
            $rstParent = ApiAction::getActionPidToId($pid);
            $pname = $rstParent['code']==0?$rstParent['data']['name']:'';
        } else {
            $pname = '0级操作';
        }
        $parent['id'] = $pid;
        $parent['name'] = $pname;
        return $parent;
    }

    /**
     *查询方法
     */
    public function query($isshow,$pid,$pageCurr,$prefix_url)
    {
//        if (!$isshow && !$pid) {
//            $datas = ActionModel::orderBy('sort','desc')
//                ->orderBy('id','desc')
//                ->paginate($this->limit);
//        } elseif ($isshow && !$pid) {
//            $datas = ActionModel::where('isshow',$isshow)
//                ->orderBy('sort','desc')
//                ->orderBy('id','desc')
//                ->paginate($this->limit);
//        } elseif (!$isshow && $pid) {
//            $datas = ActionModel::where('pid',$pid)
//                ->orderBy('sort','desc')
//                ->orderBy('id','desc')
//                ->paginate($this->limit);
//        } elseif ($isshow && $pid) {
//            $datas = ActionModel::where('isshow',$isshow)
//                ->where('pid',$pid)
//                ->orderBy('sort','desc')
//                ->orderBy('id','desc')
//                ->paginate($this->limit);
//        }
//        $datas->limit = $this->limit;
        $rstActions = ApiAction::index($this->limit,$pageCurr,$isshow,$pid);
        $datas = $rstActions['code']==0?$rstActions['data']:[];
        $datas['pagelist'] = $this->getPageList($datas,$prefix_url,$this->limit,$pageCurr);
        return $datas;
    }

    /**
     * 排序 +1 increase
     */
    public function increase($id)
    {
//        ActionModel::where('id', $id)->increment('sort', 1);
        $rst = ApiAction::sort($id,1);
        if ($rst['code']!=0) {
            echo "<script>alert('".$rst['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/action');
    }

    /**
     * 排序 +1 increase
     */
    public function reduce($id)
    {
//        $action = ActionModel::find($id);
//        if ($action->sort > 0) {
//            ActionModel::where('id', $id)->increment('sort', -1);
//        }
        $rst = ApiAction::sort($id,-1);
        if ($rst['code']!=0) {
            echo "<script>alert('".$rst['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/action');
    }
}
