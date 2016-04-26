<?php
namespace App\Models\Company;

use App\Models\Admin\MenusModel;
use App\Models\BaseModel;

class ComFuncModel extends BaseModel
{
    /**
     * 公司后台控制中心：企业主表 model
     */

    protected $table = 'bs_com_func';
    protected $fillable = [
        'id','name','cid','menuid','intro','sort','istop','isshow','isshow2','created_at','updated_at',
    ];

    //功能模块菜单id(menuid)：20首页参数，21后台权限，22公司信息，23内容设置，24页面布局，25基本设置，26添加单页，27首页编辑，28产品编辑，29新闻编辑，30招聘编辑，31联系编辑

    /**
     *  首页参数 20
     */
    public function getHomes()
    {
        return MenusModel::find(20);
    }

    /**
     *  后台权限 21
     */
    public function getAuths()
    {
        return MenusModel::find(21);
    }

    /**
     *  公司信息 22
     */
    public function getInfos()
    {
        return MenusModel::find(22);
    }

    /**
     *  内容设置 23
     */
    public function getCons()
    {
        return MenusModel::find(23);
    }

    /**
     *  页面布局 24
     */
    public function getLayouts(){}

    /**
     *  基本设置 25
     */
    public function getBasics(){}

    /**
     *  添加单页 26
     */
    public function getSingles(){}

    /**
     *  首页编辑 27
     */
    public function getMains(){}

    /**
     *  产品编辑 28
     */
    public function getProducts(){}

    /**
     *  新闻编辑 29
     */
    public function getNews(){}

    /**
     *  招聘编辑 30
     */
    public function getRecruits(){}

    /**
     *  联系编辑 31
     */
    public function getContacts(){}
}