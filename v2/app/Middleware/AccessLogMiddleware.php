<?php

namespace Vanier\Api\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Vanier\Api\Helpers\LoggerHelper;

class AccessLogMiddleware extends LoggerHelper implements MiddlewareInterface
{
    public function process(Request $request, RequestHandler $handler): ResponseInterface
    {
        if (!str_contains($request->getUri(), "account") && !str_contains($request->getUri(), "token")) {
            LoggerHelper::accessLogger($request);
        }
        return $handler->handle($request);
    }
}