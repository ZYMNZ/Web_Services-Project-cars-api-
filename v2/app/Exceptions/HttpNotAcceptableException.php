<?php

namespace Vanier\Api\Exceptions;
use Slim\Exception\HttpSpecializedException;

class HttpNotAcceptableException extends HttpSpecializedException
{
    protected $code = 406;
    protected $message = 'Unsupported resource representation.';
    protected string $title = '406 Accept Header Not Allowed';
    protected string $description = 'The server does not support this resource representation. Only application/json is supported.';
}
