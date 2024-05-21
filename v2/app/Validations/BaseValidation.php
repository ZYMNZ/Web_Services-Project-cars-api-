<?php

namespace Vanier\Api\Validations;

use Vanier\Api\Exceptions\HttpInvalidInputException;
use Vanier\Api\Helpers\LoggerHelper;

class BaseValidation
{
    protected static function validate($validator, $request): void
    {
        if (!$validator->validate()) {
            $message = trim($validator->errorsToString());
            if (str_contains($message, '  ')) {
                $message = str_replace('  ', ' ', $message);
            }
            $error_log = LoggerHelper::errorLogger();
            $error_log->error($message);
            throw new HttpInvalidInputException(
                $request,
                $message
            );
        }
    }
}