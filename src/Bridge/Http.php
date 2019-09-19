<?php

declare(strict_types = 1);

/**
 * Created by PhpStorm.
 * User: 狂奔的螞蟻 <www.firstphp.com>
 * Date: 2019/9/17
 * Time: 下午16:28
 */

namespace Firstphp\Dingtalk\Bridge;

use Hyperf\Guzzle\ClientFactory;


class Http
{

    const BASE_URI = 'https://oapi.dingtalk.com/';

    protected $componentToken;
    protected $componentAppid;
    protected $authorizerToken;
    protected $uploadType;
    protected $client;


    public function __construct(array $config = [], ClientFactory $clientFactory)
    {
        $baseUri = isset($config['url']) && $config['url'] ? $config['url'] : static::BASE_URI;
        $options = [
            'base_uri' => $baseUri,
            'timeout' => 200,
            'verify' => false,
        ];
        $this->client = $clientFactory->create($options);
    }


    public function setComponentToken($componentToken)
    {
        $this->componentToken = $componentToken;
    }


    public function setAuthorizerToken($authorizerToken)
    {
        $this->authorizerToken = $authorizerToken;
    }


    public function setUploadType($type)
    {
        $this->uploadType = $type;
    }


    public function setComponentId()
    {
        $this->componentAppid = config('wxapp.component_id');
    }


    public function __call($name, $arguments)
    {
        if ($this->componentToken) {
            $arguments[0] .= (stripos($arguments[0], '?') ? '&' : '?') . 'component_access_token=' . $this->componentToken;
        }
        if ($this->componentAppid) {
            $arguments[0] .= (stripos($arguments[0], '?') ? '&' : '?') . 'component_appid=' . $this->componentAppid;
        }
        if ($this->authorizerToken) {
            $arguments[0] .= (stripos($arguments[0], '?') ? '&' : '?') . 'access_token=' . $this->authorizerToken;
        }
        if ($this->uploadType) {
            $arguments[0] .= (stripos($arguments[0], '?') ? '&' : '?') . 'type=' . $this->uploadType;
        }

        $response = json_decode($this->client->$name($arguments[0], $arguments[1])->getBody()->getContents(), true);
        if (isset($response['errcode']) && $response['errcode'] != 0) {
            return $response;
        }
        return $response;
    }


}