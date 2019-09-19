<?php

declare(strict_types = 1);

/**
 * Author: 狂奔的螞蟻 <www.firstphp.com>
 * Date: 2019/9/16
 * Time: 6:35 PM
 */

namespace Firstphp\Dingtalk\Facades;

use Firstphp\Dingtalk\DingtalkClient;
use Hyperf\Contract\ConfigInterface;
use Psr\Container\ContainerInterface;

class DingtalkFactory
{


    /**
     * @var ContainerInterface
     */
    protected $container;

    public function __invoke(ContainerInterface $container)
    {
        $contents = $container->get(ConfigInterface::class);
        $config = $contents->get("dingtalk");
        return $container->make(DingtalkClient::class, compact('config'));
    }

}