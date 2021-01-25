<?php

declare(strict_types=1);
/**
 * This file is part of friendsofhyperf/exception-event.
 *
 * @link     https://github.com/friendsofhyperf/exception-event
 * @document https://github.com/friendsofhyperf/exception-event/blob/main/README.md
 * @contact  huangdijia@gmail.com
 */
use Hyperf\Utils\ApplicationContext;
use Hyperf\Utils\Context;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

if (! function_exists('report')) {
    /**
     * @param string|Throwable $exception
     * @param array ...$arguments
     */
    function report($exception = 'RuntimeException', ...$parameters)
    {
        if (is_string($exception)) {
            $exception = class_exists($exception) ? new $exception(...$parameters) : new RuntimeException($exception);
        }

        if (ApplicationContext::hasContainer()) {
            $request = Context::get(ServerRequestInterface::class);
            $response = Context::get(ResponseInterface::class);

            ApplicationContext::getContainer()->get(EventDispatcherInterface::class)->dispatch($exception, $request, $response);
        }
    }
}

if (! function_exists('report_if')) {
    /**
     * @param mixed $condition
     * @param string|Throwable $exception
     * @param array ...$parameters
     * @throws TypeError
     * @return mixed
     */
    function report_if($condition, $exception = 'RuntimeException', ...$parameters)
    {
        if ($condition) {
            report($exception, ...$parameters);
        }

        return $condition;
    }
}

if (! function_exists('report_unless')) {
    /**
     * @param mixed $condition
     * @param string|Throwable $exception
     * @param array ...$parameters
     * @throws TypeError
     * @return mixed
     */
    function report_unless($condition, $exception = 'RuntimeException', ...$parameters)
    {
        if (! $condition) {
            report($exception, ...$parameters);
        }

        return $condition;
    }
}
