<?php

namespace Vanier\Api\Validations;

use Vanier\Api\Helpers\Validator;

class AccountValidation extends BaseValidation
{
    public static function validateAccountCreation($data, $request): void
    {
        $validateExistence = new Validator($data);
        $validateFields = new Validator($data);
        
        $validateExistence->rule('required', [
            'first_name',
            'last_name',
            'email',
            'password',
            'role',
        ])->message('{field} is required');

        $validateFields
            ->rule('regex', ['first_name', 'last_name'], '/^[A-Za-z]+(?:[\s\-_][A-Za-z]+)*$/')->message('{field} must not have special characters or numbers')
            ->rule('email', 'email')->message('{field} is not a valid')
            ->rule('regex', 'role', '/^(admin|user)$/i')->message('{field} cannot be anything other than admin or user');

        $labels = [
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email address',
            'password' => 'Password',
            'role' => 'Role',
        ];

        $validateExistence->labels($labels);
        $validateFields->labels($labels);

        self::validate($validateExistence, $request);
        self::validate($validateFields, $request);
    }
}
