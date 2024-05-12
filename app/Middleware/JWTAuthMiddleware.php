<?php

namespace Vanier\Api\Middleware;

use LogicException;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Http\Message\ResponseInterface;
use Slim\Exception\HttpForbiddenException;
use UnexpectedValueException;

use Vanier\Api\Helpers\JWTManager;

class JWTAuthMiddleware implements MiddlewareInterface
{

    public function __construct(array $options = [])
    {
    }
    public function process(Request $request, RequestHandler $handler): ResponseInterface
    {
        /*-- 1) Routes to ignore (public routes):
              We need to ignore the routes that enables client applications
              to create account and request a JWT token.
        */        
        // 1.a) If the request's uri contains /account or /token, handle the request:
        $uriRoute = $request->getUri()->getPath();
        if (str_contains($uriRoute,  '/account') ||
            str_contains($uriRoute,  '/token'))
        return $handler->handle($request);

        // If not:
        //-- 2) Retrieve the token from the request Authorization's header. 
        $token = $request->getHeaderLine('Authorization');
        // 3) Parse the token: remove the "Bearer " word.
        $parsed_token = str_replace('Bearer ', '', $token);
        //-- 4) Try to decode the JWT token
        //@see https://github.com/firebase/php-jwt#exception-handling
        $decoded = "";
        try {
            $decoded = JWTManager::decodeJWT($parsed_token, JWTManager::SIGNATURE_ALGO);
        } catch (LogicException $e) {
            // errors having to do with environmental setup or malformed JWT Keys
            echo 'LogicException: ' . $e->getMessage();
        } catch (UnexpectedValueException $e) {
            // errors having to do with JWT signature and claims
            echo 'UnexpectedValueException: ' . $e->getMessage();
        }
        // --5) Access to POST, PUT and DELETE operations must be restricted:
        //     Only admin accounts can be authorized.
        if (!str_contains($request->getMethod(), 'GET') && $decoded['role'] != 'admin') {
            throw new HttpForbiddenException($request, 'Insufficient permission!');
        }
//        $decoded['role'];
        // If the request's method is: POST, PUT, or DELETE., only admins are allowed.
        // throw new HttpForbiddenException($request, 'Insufficient permission!');

        //-- 6) The client application has been authorized:
        /* 6.a) Now we need to store the token payload in the request object. The payload is needed for logging purposes and 
           needs to be passed as an attribute to the request's handling callbacks.  
           This will allow the target resource's callback to access the token payload for various purposes 
           (such as logging, etc.). Use the APP_JWT_TOKEN_KEY as attribute name. 
           @see: Slim's documentation for more details about storing attributes in the request object. 
         */
        
        //-- 7) At this point, the client app's request has been authorized, we pass the request to the next
        // middleware in the middleware stack. 
        return $handler->handle($request);
    }
}
