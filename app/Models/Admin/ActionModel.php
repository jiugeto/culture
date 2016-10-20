<?php
namespace App\Models\Admin;

use App\Models\BaseModel;

class ActionModel extends BaseModel
{
    protected $table = 'ba_action';
    protected $fillable = [
        'id','name','intro','namespace','controller_prefix','url','action','style_class','pid','sort','isshow','created_at','updated_at',
    ];
    protected $isshows = [
        '','不显示','显示',
    ];

    public function getIsShow()
    {
        return array_key_exists($this->isshow,$this->isshows) ? $this->isshows[$this->isshow] : '';
    }

    /**
     * 获取上级名称
     */
    public function getParentName()
    {
        if ($this->pid) {
            $action = ActionModel::find($this->pid);
            $actionName = $action ? $action->name : '';
        } else {
            $actionName = '顶级操作';
        }
        return isset($actionName) ? $actionName : '';
    }

    /**
     * 获得所有父级
     */
    public function getParents()
    {
        $parents = ActionModel::where('pid',0)->get();
        $parentArr = array(0=>'所有');
        if (count($parents)) {
            foreach ($parents as $parent) {
                $parentArr[$parent->id] = $parent->name;
            }
        }
        return $parentArr;
    }

    /**
     * 系统后台左侧菜单栏用
     */
    public static function getAdminMenus()
    {
        $actionArr = array();
        $roleActions = RoleActionModel::where('role_id',\Session::get('admin.role_id'))->get();
        foreach ($roleActions as $roleAction) {
            $actionArr[] = $roleAction->action_id;
        }
        return ActionModel::whereIn('id',$actionArr)
            ->where('isshow',2)
            ->orderBy('sort','desc')
            ->get();
    }
}