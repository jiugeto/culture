<?php

/**
 * 地区函数，获取地区相关信息，前缀 Area
 */

use App\Api\ApiBusiness\ApiArea;


//通过地区id，获取地区名称
function AreaNameByid($area_id,$type=2)
{
    //type：1地区名，2地区拼接字符串
    $apiArea = ApiArea::getNameById($area_id,$type);
    return $apiArea['code']==0 ? $apiArea['data']['areaName'] : '未知';
}
