<?php

namespace Vanier\Api\Exceptions;

use Slim\Exception\HttpSpecializedException;

class HttpInvalidAccountException extends HttpSpecializedException
{
    protected $code = 400; // HTTP status code for Bad Request
    protected $message = 'Invalid email address provided.';
    protected string $title = '400 Bad Request';
    protected string $description = 'The input provided is invalid or not allowed.';
}

