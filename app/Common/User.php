<?php

/**
 * 用户函数，获取用户相关信息，前缀 User
 */

use App\Api\ApiUser\ApiUsers;


//通过uid，获取用户名称
function UserNameById($uid)
{
    $apiUser = ApiUsers::getOneUser($uid);
    return $apiUser['code']==0 ? $apiUser['data']['username'] : '';
}