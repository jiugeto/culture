<?php

/**
 * 用户函数，获取用户相关信息，函数名：User + 结果 + By + 添加
 */

use App\Api\ApiUser\ApiUsers;


//通过uid，获取用户名称
function UserNameById($uid)
{
    $apiUser = ApiUsers::getOneUser($uid);
    return $apiUser['code']==0 ? $apiUser['data']['username'] : '';
}

//通过uid，判断用户类型
function UserTypeById($uid)
{
    $apiUser = ApiUsers::getOneUser($uid);
    return $apiUser['code']==0 ? $apiUser['data']['isuser'] : '';
}

//通过uname，获取记录
function UserIdByUname($uname)
{
    $apiUser = ApiUsers::getOneUserByUname($uname);
    return $apiUser['code']==0 ? $apiUser['data']['id'] : '';
}