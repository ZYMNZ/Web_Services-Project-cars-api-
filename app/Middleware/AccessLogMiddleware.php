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
        //?2) we can now log some access info:
        $client_ip = $_SERVER["REMOTE_ADDR"];
        $method = $request->getMethod();
        $uri = $request->getUri()->getPath();
        $log_record = $client_ip. ' ' .$method. ' '. $uri;
        //3) prepare extra info
        $access_log = LoggerHelper::accessLogger();

        $extras = $request->getQueryParams();
        $access_log->info($log_record,$extras);
        return $handler->handle($request);
    }
}