<?php

declare(strict_types=1);
/**
 * This file is part of friendsofhyperf/exception-event.
 *
 * @link     https://github.com/friendsofhyperf/exception-event
 * @document https://github.com/friendsofhyperf/exception-event/blob/main/README.md
 * @contact  huangdijia@gmail.com
 */
namespace FriendsOfHyperf\ExceptionEvent\Listener;

use FriendsOfHyperf\ExceptionEvent\Event\ExceptionDispatched;
use Hyperf\Event\Contract\ListenerInterface;
use Hyperf\Framework\Event\BootApplication;
use Hyperf\Utils\ApplicationContext;
use Hyperf\Utils\Context;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class BootApplicationListener implements ListenerInterface
{
    public function listen(): array
    {
        return [
            BootApplication::class,
        ];
    }

    /**
     * @param BootApplication $event
     */
    public function process(object $event)
    {
        set_exception_handler(function ($exception) {
            /** @var \Psr\Container\ContainerInterface $container */
            $container = ApplicationContext::getContainer();
            /** @var EventDispatcherInterface $eventDispatcher */
            $eventDispatcher = $container->get(EventDispatcherInterface::class);
            /** @var null|ServerRequestInterface $request */
            $request = Context::get(ServerRequestInterface::class);
            /** @var null|ResponseInterface $response */
            $response = Context::get(ResponseInterface::class);

            $eventDispatcher->dispatch(new ExceptionDispatched($exception, $request, $response));
        });
    }
}
