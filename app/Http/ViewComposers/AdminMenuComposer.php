<?php
namespace App\Http\ViewComposers;

use App\Api\ApiUser\ApiAction;
use Illuminate\Contracts\View\View;
use App\Tools;

class AdminMenuComposer
{
    /**
     * 绑定系统后台左侧菜单的数据
     */

    public function compose(View $view)
    {
        $view->with('actions', $this::getActions());
    }

    public static function getActions()
    {
//        return Tools::getChild(ActionModel::getAdminMenus(),$pid=0);
        $rstAction = ApiAction::adminMenuList(\Session::get('admin.role_id'));
        return AdminMenuComposer::getChild($rstAction['data'],$pid=0);
    }

    /**
     * 数组子id重组
     */
    public static function getChild($arrs,$pid=0){
        $list = array();
        foreach ($arrs as $v){
            if ($v['pid'] == $pid) {
                //找到子节点,继续找该子节点的后代节点
                $v['child'] = AdminMenuComposer::getChild($arrs,$v['id']);
                $list[] = $v;
            }
        }
        return $list;
    }
}