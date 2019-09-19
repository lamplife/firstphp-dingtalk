<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf-cloud/hyperf/blob/master/LICENSE
 */

namespace Firstphp\Dingtalk;
use Firstphp\Dingtalk\DingtalkInterface;
use Firstphp\Dingtalk\Facades\DingtalkFactory;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => [
                DingtalkInterface::class => DingtalkFactory::class
            ],
            'commands' => [
            ],
            'scan' => [
                'paths' => [
                    __DIR__,
                ],
            ],
            'publish' => [
                [
                    'id' => 'config',
                    'description' => 'The config for firstphp-dingtalk.',
                    'source' => __DIR__ . '/../publish/dingtalk.php',
                    'destination' => BASE_PATH . '/config/autoload/dingtalk.php',
                ],
            ],
        ];
    }
}
