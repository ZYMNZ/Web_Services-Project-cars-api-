<?php

namespace Vanier\Api\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Vanier\Api\Helpers\LoggerHelper;

class AccessLogMiddleware extends LoggerHelper
{
    public function process(Request $request, RequestHandler $handler): ResponseInterface
    {
        $access_log = LoggerHelper::accessLogger();
        $access_log->info(sprintf('%s %s',$request->getMethod(), $request->getUri()));
        $response = $handler->handle($request);
        $access_log->info(sprintf(
            '%d %s',
            $response->getStatusCode(),
            $response->getReasonPhrase(),
        ));
        return $response;
    }
}