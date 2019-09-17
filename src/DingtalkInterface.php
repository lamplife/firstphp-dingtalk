<?php

declare(strict_types = 1);

/**
 * Author: 狂奔的螞蟻 <www.firstphp.com>
 * Date: 2019/9/16
 * Time: 6:26 PM
 */

namespace Firstphp\Dingtalk;


interface DingtalkInterface
{


    /**
     * 获取token
     *
     * @return mixed
     */
    public function gettoken();


    /**
     * 获取永久授权码
     *
     * @param string $access_token
     * @param string $tmp_auth_code
     * @return mixed
     */
    public function getPersistentCode(string $access_token = '', string $tmp_auth_code = '');


    /**
     * 获取用户授权的SNS_TOKEN
     *
     * @param string $access_token
     * @param string $openid
     * @param string $persistentCode
     * @return mixed
     */
    public function getSnsToken(string $access_token = '', string $openid = '', string $persistentCode = '');


    /**
     * 获取用户信息
     *
     * @param string $sns_token
     * @return mixed
     */
    public function getuserinfo(string $sns_token = '');

}