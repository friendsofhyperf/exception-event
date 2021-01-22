<?php

declare(strict_types=1);
/**
 * This file is part of frientsofhyperf/exception-event.
 *
 * @link     https://github.com/frientsofhyperf/exception-event
 * @document https://github.com/frientsofhyperf/exception-event/blob/main/README.md
 * @contact  hdj@addcn.com
 */
namespace FriendsOfHyperf\ExceptionEvent;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => [],
            'annotations' => [
                'scan' => [
                    'paths' => [
                        __DIR__,
                    ],
                ],
            ],
            'commands' => [],
            'listeners' => [],
            'publish' => [],
        ];
    }
}
