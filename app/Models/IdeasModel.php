<?php
namespace App\Models;

class IdeasModel extends BaseModel
{
    /**
     * 这是用户表model
     */

    protected $table = 'bs_ideas';
    protected $fillable = [
        'id','name','cate_id','intro','content','uid','sort','isshow','del','created_at','updated_at',
    ];

    /**
     * 得到所有分类
     */
    public function categorys()
    {
        $categorys =  CategoryModel::where('del',0)->get();
//        $categorys = Tools::category($categorys);
        $categorys = \App\Tools::getChild($categorys);
        return $categorys;
    }

    public function cate()
    {
        return $this->hasOne('\App\Models\CategoryModel','id','cate_id');
    }

    public function read($uid)
    {
        $datas = IdeasReadModel::where(['ideaid'=>$this->id,'uid'=>$uid])->get();
        return count($datas) ? $datas : 0;
    }

    public function click($uid)
    {
        $datas = IdeasClickModel::where(['ideaid'=>$this->id,'uid'=>$uid])->get();
        return count($datas) ? $datas : 0;
    }

    public function collect($uid)
    {
        $datas = IdeasCollectModel::where(['ideaid'=>$this->id,'uid'=>$uid])->get();
        return count($datas) ? $datas : 0;
    }

    public function user()
    {
        $uid = $this->uid ? $this->uid : 0;
        $userModel = UserModel::find($uid);
        $userModel->company = '';
        if ($companyModel = CompanyModel::where('uid',$uid)->first()) {
            $userModel->company = $companyModel;
        }
        return $userModel ? $userModel : '';
    }

    public function getUserName()
    {
        $userModel = $this->user();
        return $userModel ? $userModel->username : '';
    }
}