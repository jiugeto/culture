<?php
namespace App\Models\Admin;

use App\Models\BaseModel;

class MenusModel extends BaseModel
{
    protected $table = 'bs_menus';
    protected $fillable = [
        'id','name','type','intro','namespace','controller_prefix','platUrl','url','action','style_class','pid','isshow','sort','created_at','updated_at',
    ];
    protected $types = [
        1=>'会员后台member',2=>'个人后台person',3=>'企业后台company',
    ];

    public function parent()
    {
        return $this->belongsTo($this, 'pid');
    }

    /**
     * 得到会员后台左侧菜单 type==1
     */
    public static function MemberMenus()
    {
        return MenusModel::where(['type'=>1,'isshow'=>1])->orderBy('sort','desc')->get();
    }

    /**
     * 得到个人后台左侧菜单 type==2
     */
    public static function PersonMenus()
    {
        return MenusModel::where(['type'=>2,'isshow'=>1])->orderBy('sort','desc')->get();
    }

    /**
     * 得到公司后台左侧菜单 type==3
     */
    public static function CompanyMenus()
    {
        return MenusModel::where(['type'=>3,'isshow'=>1])->orderBy('sort2','desc')->get();
    }
}