<?php declare(strict_types=1);

namespace Vanier\Api\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;

class ContentNegotiationMiddleware implements MiddlewareInterface
{
    public function process(Request $request, RequestHandler $handler): ResponseInterface
    {
        $accept_header = $request->getHeaderLine('Accept');
        if (!str_contains($accept_header, "application/json")) {
            $response = new Response(406);
            $unsupported_response = [
                'code' => 406,
                'message' => 'Unsupported Resource Representation',
                'description' => 'The server does not support this resource representation. Only application/json is supported.',
            ];

            $unsupported_response = json_encode($unsupported_response);
            $response->getBody()->write($unsupported_response);
            return $response->withHeader("Content-Type", "application/json");
        }
        return $handler->handle($request);
    }
}
