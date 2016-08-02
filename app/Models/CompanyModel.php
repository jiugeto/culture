<?php
namespace App\Models;

class CompanyModel extends BaseModel
{
    /**
     * 这是用户表model
     */

    protected $table = 'companys';
    protected $fillable = [
        'id','name','genre','area','address','yyzzid','uid','sort','areacode','tel','qq','web','fax','zipcode','email','created_at','updated_at',
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

    public function areaName()
    {
        $areaid = $this->area ? $this->area : 0;
        $areaModel = AreaModel::find($areaid);
        $areaName = '';
        //本级
        if ($areaModel) {
            $areaName = $areaName.$areaModel->cityname;
        }
        //上一级
        if (isset($areaModel)&&$areaModel->parentid) {
            $areaModel2 = AreaModel::find($areaModel->parentid);
            $areaName = $areaModel2 ? $areaName.$areaModel2->cityname : $areaName;
        }
        //上上级
        if (isset($areaModel2)&&$areaModel2->parentid) {
            $areaModel3 = AreaModel::find($areaModel2->parentid);
            $areaName = $areaModel3 ? $areaName.$areaModel3->cityname : $areaName;
        }
        return $areaName;
    }
}