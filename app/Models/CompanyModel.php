<?php
namespace App\Models;

class CompanyModel extends BaseModel
{
    /**
     * 这是用户表model
     */

    protected $table = 'companys';
    protected $fillable = [
        'id','name','genre','area','point','address','yyzzid','uid','sort','areacode','tel','qq','web','fax','zipcode','email','created_at','updated_at',
    ];

    /**
     *  2普通企业，4广告公司，5影视公司，6租赁公司
     */
    protected $genres = [
        2=>'普通企业','广告公司','影视公司','租赁公司',
    ];

    public function genreName()
    {
        return array_key_exists($this->genre,$this->genres) ? $this->genres[$this->genre] : '';
    }

    /**
     * 获取地图定位坐标
     */
    public function getPoint()
    {
        return $this->point ? explode(',',$this->point) : [];

    }

    /**
     * 获取地图定位坐标 X
     */
    public function getPointX()
    {
        return $this->getPoint() ? $this->getPoint()[0] : '120';

    }

    /**
     * 获取地图定位坐标 Y
     */
    public function getPointY()
    {
        return $this->getPoint() ? $this->getPoint()[1] : '30';

    }
}