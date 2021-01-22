<?php

declare(strict_types=1);
/**
 * This file is part of frientsofhyperf/exception-event.
 *
 * @link     https://github.com/frientsofhyperf/exception-event
 * @document https://github.com/frientsofhyperf/exception-event/blob/main/README.md
 * @contact  hdj@addcn.com
 */
namespace FriendsOfHyperf\ExceptionEvent\Event;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Throwable;

class ExceptionDispatched
{
    /**
     * @var Throwable
     */
    public $exception;

    /**
     * @var null|ServerRequestInterface
     */
    public $request;

    /**
     * @var null|ResponseInterface
     */
    public $response;

    public function __construct(Throwable $exception, ?ServerRequestInterface $request = null, ?ResponseInterface $response = null)
    {
        $this->exception = $exception;
        $this->request = $request;
        $this->response = $response;
    }
}
