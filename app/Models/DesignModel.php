<?php
namespace App\Models;

class DesignModel extends BaseModel
{
    protected $table = 'bs_designs';
    protected $fillable = [
        'id','name','genre','cate','uid','intro','detail','price','sort','del','created_at','updated_at',
    ];
    //类型：房产，效果图，平面，漫游
    protected $cates = [
        1=>'房产漫游','效果图','平面设计',
    ];

    /**
     * 关联设计类型 bs_types
     */
//    public function types()
//    {
//        return $this->belongsToMany('App\Models\TypeModel');
//    }

    /**
     * 由 type_id 得到 type_name
     */
//    public function getOneType($type_id)
//    {
//        $type_name = '';
//        $types =  $this->types();
//        if ($types) {
//            foreach ($types as $type) {
//                if ($type_id==$type->id) {
//                    $type_name = $type->name;
//                }
//            }
//        }
//        return $type_name;
//    }

    public function genreName()
    {
        return $this->genre==1 ? '设计供应' : '设计需求';
    }

    public function getCate()
    {
        return array_key_exists($this->cate,$this->cates) ? $this->cates[$this->cate] : '';
    }

    /**
     * 发布人信息
     */
    public function user()
    {
        $uid = $this->uid ? $this->uid : 0;
        $userModel = UserModel::find($uid);
        return $userModel ? $userModel : '';
    }

    public function getUserName()
    {
        return $this->user() ? $this->user()->username : '';
    }

    public function money()
    {
        return $this->price ? $this->price.'元' : '';
    }
}