<?php

namespace Vanier\Api\Validations;

use Vanier\Api\Helpers\Validator;

class TokenValidation extends BaseValidation
{
    public static function validateTokenCreation($data, $request): void
    {
        $validateExistence = new Validator($data);
        $validateFields = new Validator($data);
        
        $validateExistence->rule('required', [
            'email',
            'password',
        ])->message('{field} is required');

        $validateFields
            ->rule('email', 'email')->message('{field} is not a valid');

        $labels = [
            'email' => 'Email address',
            'password' => 'Password',
        ];

        $validateExistence->labels($labels);
        $validateFields->labels($labels);

        self::validate($validateExistence, $request);
        self::validate($validateFields, $request);
    }
}
