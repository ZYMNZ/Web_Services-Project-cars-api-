<?php

namespace Vanier\Api\Middleware;

use DomainException;
use Firebase\JWT\BeforeValidException;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\SignatureInvalidException;
use InvalidArgumentException;
use LogicException;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Http\Message\ResponseInterface;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpForbiddenException;
use Slim\Exception\HttpUnauthorizedException;
use UnexpectedValueException;
use Slim\Routing\RouteCollectorProxy;

use Vanier\Api\Helpers\JWTManager;
use Vanier\Api\Helpers\LoggerHelper;
use Vanier\Api\Models\AccessLogModel;

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
        $route = substr($uriRoute, 9);
        if ($route === "/account" || $route === "/token")
        return $handler->handle($request);


        // If not:
        //-- 2) Retrieve the token from the request Authorization's header. 
        $token = $request->getHeaderLine('Authorization');
        // 3) Parse the token: remove the "Bearer " word.
        $parsed_token = str_replace('Bearer ', '', $token);
        //-- 4) Try to decode the JWT token
        //@see https://github.com/firebase/php-jwt#exception-handling
        $decoded = "";
//        $access_logger = new Logger('access');
//        $access_logger->pushHandler(new StreamHandler(APP_LOGS_DIR.APP_ACCESS_LOGS_FILE, Logger::INFO));
        $error_log = LoggerHelper::errorLogger($request);
//        $access_log = LoggerHelper::accessLogger();
//        $error_logger = new Logger('error');
//        $error_logger->pushHandler(new StreamHandler(APP_LOGS_DIR.APP_ERROR_LOGS_FILE, Logger::ERROR));
        try {
            $decoded = JWTManager::decodeJWT($parsed_token, JWTManager::SIGNATURE_ALGO);
        } catch (LogicException $e) {
            // errors having to do with environmental setup or malformed JWT Keys

            $error_log->error('LogicException: ' . $e->getMessage());
            throw new HttpBadRequestException($request, 'Malformed Token');
//            echo "error in 1";
        } catch (UnexpectedValueException $e) {
            // provided JWT is malformed OR
            // provided JWT is missing an algorithm / using an unsupported algorithm OR
            // provided JWT algorithm does not match provided key OR
            // provided key ID in key/key-array is empty or invalid.
            // errors having to do with JWT signature and claims
            $error_log->error($e->getMessage());
            throw new HttpUnauthorizedException($request, 'Token Expired');
        }
        // --5) Access to POST, PUT and DELETE operations must be restricted:
        //     Only admin accounts can be authorized.
//        var_dump($decoded); exit;
//        var_dump($request->getMethod()); exit;
        if ($request->getMethod() !== 'GET' && $decoded['role'] != 'admin') {
            $error_log->error('Insufficient permission access');
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
//        var_dump("");
        $request = $request->withAttribute("APP_JWT_TOKEN_KEY", $parsed_token);

        $test = $request->getAttribute("APP_JWT_TOKEN_KEY");
//        var_dump($test);exit;

        //? Step1) instantiate and configure a logger.
//        var_dump(APP_LOGS_DIR.APP_ACCESS_LOGS_FILE);


        $access_log_model = new AccessLogModel();
        $access_log_model->createLogEntry($decoded, $route);


        //-- 7) At this point, the client app's request has been authorized, we pass the request to the next
        // middleware in the middleware stack. 
        return $handler->handle($request);
    }
}
