<?php

namespace Vanier\Api\Exceptions;

use Slim\Exception\HttpSpecializedException;

class HttpInvalidInputException extends HttpSpecializedException
{
    protected $code = 404;
    protected $message = 'Not found.';

    protected string $title = '404 Not Found';
    protected string $description = 'No matching resource found!';
}