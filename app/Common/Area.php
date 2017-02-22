<?php

/**
 * 地区函数，获取地区相关信息，函数名：Area + 结果 + By +条件
 */

use App\Api\ApiBusiness\ApiArea;


//通过地区id，获取地区名称
function AreaNameByid($area_id,$type=2)
{
    //type：1地区名，2地区拼接字符串
    $apiArea = ApiArea::getNameById($area_id,$type);
    return $apiArea['code']==0 ? $apiArea['data']['areaName'] : '';
}

//通过地区名称，获取当前id
function AreaIdByName($areaName)
{
    if (!$areaName) { return 0; }
    $apiArea = ApiArea::getAreaByName($areaName);
    return $apiArea['code']==0 ? $apiArea['data']['id'] : 0;
}