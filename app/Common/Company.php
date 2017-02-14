<?php

/**
 * 公司函数，获取公司相关信息，前缀 Com
 */

use App\Api\ApiUser\ApiCompany;


//通过cid，获取公司名称
function ComNameById($cid)
{
    $apiCompany = ApiCompany::show($cid);
    return $apiCompany['code']==0 ? $apiCompany['data']['name'] : '';
}

//通过uid，获取公司名称
function ComNameByUid($uid)
{
    $apiCompany = ApiCompany::getOneCompany($uid);
    return $apiCompany['code']==0 ? $apiCompany['data']['name'] : '';
}