<?php
namespace App\Models\Admin;

use App\Models\BaseModel;

class MenusModel extends BaseModel
{
    protected $table = 'bs_menus';
    protected $fillable = [
        'id','name','type','intro','namespace','controller_prefix','platUrl','url','action','style_class','pid','isshow','isshow2','sort','sort2','created_at','updated_at',
    ];
    protected $types = [
        1=>'会员后台member',2=>'个人后台person',3=>'企业后台company',
    ];
    protected $isshows = [
        1=>'不显示','显示',
    ];

    public function getIsShow()
    {
        return array_key_exists($this->isshow,$this->isshows) ? $this->isshows[$this->isshow] : '';
    }

    public function parent()
    {
        return $this->belongsTo($this, 'pid');
    }

    /**
     * 获取完整url
     */
    public function getUrl()
    {
        if ($this->type==1) {
            $url = '/member/'.$this->url;
        } elseif ($this->type==2) {
            $url = '/person/'.$this->url;
        } elseif ($this->type==3) {
            $url = '/copany/'.$this->url;
        }
        return $url;
    }

    /**
     * 得到会员后台左侧菜单 type==1
     */
    public static function MemberMenus()
    {
        return MenusModel::where(['type'=>1,'isshow'=>2])->orderBy('sort','desc')->get();
    }

    /**
     * 得到个人后台左侧菜单 type==2
     */
    public static function PersonMenus()
    {
        return MenusModel::where(['type'=>2,'isshow'=>2])->orderBy('sort','desc')->get();
    }

    /**
     * 得到公司后台左侧菜单 type==3
     */
    public static function CompanyMenus()
    {
        return MenusModel::where(['type'=>3,'isshow'=>2])->orderBy('sort2','desc')->get();
    }
}