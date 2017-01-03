<?php
namespace App\Models\Base;

use App\Models\BaseModel;

class AreaModel extends BaseModel
{
    protected $table = 'bs_citys';
    protected $fillable = [
        'id','parentid','cityname','nocode','zipcode','weathercode','created_at','updated_at',
    ];

    /**
     * 上级地区的名称
     */
    public function parent()
    {
        return $this->parentid ? AreaModel::find($this->parentid)->cityname : '0级';
    }

    /**
     * 通过 id 获取城市父子字符串，子id->父id往上找
     */
    public static function getAreaStr($area_id)
    {
        $areaModel = AreaModel::find($area_id);
        $areaSrt = $areaModel?$areaModel->cityname:'';
        if ($areaModel && $areaModel->parentid!=0) {
            $areaModel2 = AreaModel::find($areaModel->parentid);
            if ($areaModel2) {
                $areaSrt = $areaModel2->cityname.','.$areaSrt;
            }
        }
        if ($areaModel && isset($areaModel2) && $areaModel2->parentid!=0) {
            $areaModel3 = AreaModel::find($areaModel2->parentid);
            if ($areaModel3) {
                $areaSrt = $areaModel3->cityname.','.$areaSrt;
            }
        }
        return $areaSrt;
    }

    /**
     * 发布方名称：bs_order，bs_order_pro，bs_order_firm
     */
    public function getSellName()
    {
        $userModel = $this->getUser($this->seller);
        return $userModel ? $userModel['username'] : '';
    }

    /**
     * 申请方名称：bs_order，bs_order_pro，bs_order_firm
     */
    public function getBuyName()
    {
        $userModel = $this->getUser($this->buyer);
        return $userModel ? $userModel['username'] : '';
    }
}