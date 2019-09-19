<?php

declare(strict_types = 1);

/**
 * Author: 狂奔的螞蟻 <www.firstphp.com>
 * Date: 2019/9/16
 * Time: 6:29 PM
 */

namespace Firstphp\Dingtalk;

use Firstphp\Dingtalk\Bridge\Http;
use Psr\Container\ContainerInterface;

class DingtalkClient implements DingtalkInterface
{

    /**
     * @var array
     */
    protected $config;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var string
     */
    protected $appid;

    /**
     * @var string
     */
    protected $appsecret;

    /**
     * @var object
     */
    protected $http;


    /**
     * @var ContainerInterface
     */
    protected $container;


    public function __construct(array $config = [], ContainerInterface $container)
    {
        $config = $config ? $config : config('dingtalk');

        if ($config) {
            $this->url = $config['url'];
            $this->appid = $config['appid'];
            $this->appsecret = $config['appsecret'];
        }

        $this->http = $container->make(Http::class, compact('config'));

    }


    /**
     * @param string $appid
     * @param string $appsecret
     */
    public function gettoken()
    {
        return $this->http->get('sns/gettoken', [
            'query' => [
                'appid' => $this->appid,
                'appsecret' => $this->appsecret,
            ]
        ]);
    }


    /**
     * @param string $access_token
     * @param string $tmp_auth_code
     * @return mixed
     */
    public function getPersistentCode(string $access_token = '', string $tmp_auth_code = '')
    {
        return $this->http->post('sns/get_persistent_code?access_token=' . $access_token, [
            'json' => [
                'tmp_auth_code' => $tmp_auth_code
            ]
        ]);
    }


    /**
     * @param string $access_token
     * @param string $openid
     * @param string $persistentCode
     */
    public function getSnsToken(string $access_token = '', string $openid = '', string $persistentCode = '')
    {
        return $this->http->post('sns/get_sns_token?access_token=' . $access_token, [
            'json' => [
                'openid' => $openid,
                'persistent_code' => $persistentCode
            ]
        ]);
    }


    /**
     * @param string $sns_token
     */
    public function getuserinfo(string $sns_token = '')
    {
        return $this->http->get('sns/getuserinfo', [
            'query' => [
                'sns_token' => $sns_token
            ]
        ]);
    }
}