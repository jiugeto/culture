<?php

namespace App\Http\Controllers\Admin;

use App\Api\ApiBusiness\ApiMenu;
use Illuminate\Http\Request;

class MenusController extends BaseController
{
    /**
     * 权限管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->crumb['category']['name'] = '前台控制菜单';
        $this->crumb['category']['url'] = 'menus';
        $this->crumb['']['name'] = '前台菜单列表';
    }

    public function index($type=0,$isshow=0)
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $pageCurr = isset($_POST['pageCurr'])?$_POST['pageCurr']:1;
        $prefix_url = DOMAIN.'admin/menus';
        $datas = $this->query($pageCurr,$type,$isshow);
        $pagelist = $this->getPageList($datas,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'pagelist' => $pagelist,
            'prefix_url' => $prefix_url,
            'model' => $this->getmodel(),
            'crumb' => $this->crumb,
            'curr' => $curr,
            'type' => $type,
            'isshow' => $isshow,
        ];
        return view('admin.menus.index', $result);
    }

    public function create($pid=0)
    {
        $curr['name'] = $this->crumb['create']['name'];
        $curr['url'] = $this->crumb['create']['url'];
        $result = [
            'parents'=> $this->parents(),
            'model'=> $this->getModel(),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.menus.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
//        $data['created_at'] = time();
//        MenusModel::create($data);
        $apiMenu = ApiMenu::addMenu($data);
        if ($apiMenu['code']!=0) {
            echo "<script>alert('".$apiMenu['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/menus');
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $apiMenu = ApiMenu::show($id);
        if ($apiMenu['code']!=0) {
            echo "<script>alert('".$apiMenu['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data'=> $apiMenu['data'],
            'model'=> $this->getModel(),
            'crumb'=> $this->crumb,
        ];
        return view('admin.menus.show', $result);
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $apiMenu = ApiMenu::show($id);
        if ($apiMenu['code']!=0) {
            echo "<script>alert('".$apiMenu['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data'=> $apiMenu['data'],
            'pids'=> $this->parents(),
            'types'=> $this->model['types'],
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.menus.edit', $result);
    }

    public function update(Request $request, $id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = time();
        MenusModel::where('id',$id)->update($data);
        return redirect(DOMAIN.'admin/menus');
    }

    public function forceDelete($id)
    {
        MenusModel::find($id)->delete();
        return redirect(DOMAIN.'admin/menus');
    }

    /**
     * 设置是否显示
     */
    public function setIsShow($id,$isshow)
    {
        $apiMenu = ApiMenu::setShow($id,$isshow);
        if ($apiMenu['code']!=0) {
            echo "<script>alert('".$apiMenu['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/menus');
    }







    /**
     * 收集数据
     */
    public function getData(Request $request)
    {
        $data = $request->all();
        if ($data['pid1']) { $data['pid'] = $data['pid1']; }
        if ($data['pid2']) { $data['pid'] = $data['pid2']; }
        if ($data['pid3']) { $data['pid'] = $data['pid3']; }
        if (!$data['pid1'] &&!$data['pid2'] &&!$data['pid3']) { $data['pid'] = 0; }
        if (!$data['style_class']) { $data['style_class'] = ''; }
        if (!$data['intro']) { $data['intro'] = ''; }
        $data = [
            'name'=> $data['name'],
            'type'=> $data['type'],
            'intro'=> $data['intro'],
            'namespace'=> $data['namespace'],
            'controller_prefix'=> substr($data['controller_prefix'],0,-10),
            'platUrl'=> $data['platUrl'],
            'url'=> $data['url'],
            'action'=> $data['action'],
            'style_class'=> $data['style_class'],
            'pid'=> $data['pid'],
//            'isshow'=> $data['isshow'],
//            'sort'=> $data['sort'],
        ];
        return $data;
    }

    /**
     * 第一级菜单
     */
    public function parents()
    {
        $apiMenu = ApiMenu::getMenuParent();
        return $apiMenu['code']==0 ? $apiMenu['data'] : [];
    }

//    /**
//     * 得到父操作
//     */
//    public function parent($pid)
//    {
//        if ($pid) {        //获取上级操作名称
//            $pname = MenusModel::where('id',$pid)->first()->name;
//        } else {
//            $pname = '0级操作';
//        }
//        $parent['id'] = $pid;
//        $parent['name'] = $pname;
//        return $parent;
//    }

    /**
     *查询方法
     */
    public function query($pageCurr,$type,$isshow)
    {
        $apiMenu = ApiMenu::index($this->limit,$pageCurr,$type,$isshow);
        return $apiMenu['code']==0 ? $apiMenu['data'] : [];
    }

    /**
     * 获取 model
     */
    public function getModel()
    {
        $apiModel = ApiMenu::getMenuModel();
        return $apiModel['code']==0 ? $apiModel['model'] : [];
    }
}
