<?php

namespace Vanier\Api\Validations;

use Vanier\Api\Exceptions\HttpInvalidInputException;
use Vanier\Api\Helpers\LoggerHelper;
use Vanier\Api\Helpers\Validator;

class OwnerValidation extends BaseValidation
{
    public static function validateOwnersCreation($data, $request): void
    {
        $validateExistence = new Validator($data);
        $validateFields = new Validator($data);

        $validateExistence->rule('required', [
            'owner_id',
            'name',
            'email',
            'postal_code',
            'country',
            'city',
            'driver_age',
            'driver_gender',
            'insurance_id'
        ])->message('{field} is required');

        $validateFields
            ->rule('regex', 'owner_id', '/^O-\d{5}$/')->message('{field} must start with {O-} and end with 5 numeric values')
            ->rule('regex', ['name', 'country', 'city'], '/^[A-Za-z]+(?:[\s\-_][A-Za-z]+)*$/')->message('{field} must not have special characters or numbers')
            ->rule('regex', 'driver_gender', '/^(male|female)$/i')->message('{field} cannot be anything other than male or female')
            ->rule('regex', 'insurance_id', '/^I-\d{5}$/')->message('{field} must start with {I-} and end with 5 numeric values')
            ->rule('email', 'email')->message('{field} is not a valid')
            ->rule('integer', 'postal_code')->message('{field} is not a valid')
            ->rule('length', 'postal_code', '5')->message('{field} must only have 5 digits')
            ->rule('integer', 'driver_age')->message('{field} must be an integer')
            ->rule('min', 'driver_age', '18')->message('{field} cannot be less than 18')
            ->rule('max', 'driver_age', '100')->message('{field} cannot be greater than 100');

        $labels = [
            'owner_id' => 'Owner ID',
            'name' => 'Name',
            'email' => 'Email address',
            'postal_code' => 'Postal code',
            'country' => 'Country',
            'city' => 'City',
            'driver_age' => 'Driver age',
            'driver_gender' => 'Driver gender',
            'insurance_id' => 'Insurance ID'
        ];

        $validateExistence->labels($labels);
        $validateFields->labels($labels);

        self::validate($validateExistence, $request);
        self::validate($validateFields, $request);
    }

    public static function validateOwnersUpdate($data, $request): void
    {
        $validateExistence = new Validator($data);
        $validateFields = new Validator($data);

        $validateExistence->rule('required', 'owner_id')
            ->message('{field} is required')
            ->rule('optional', [
                'name',
                'email',
                'postal_code',
                'country',
                'city',
                'driver_age',
                'driver_gender',
                'insurance_id'
            ]);
        $validateFields
            ->rule('regex', 'owner_id', '/^O-\d{5}$/')->message('{field} must start with {O-} and end with 5 numeric values')
            ->rule('regex', ['name', 'country', 'city'], '/^[A-Za-z]+(?:[\s\-_][A-Za-z]+)*$/')->message('{field} must not have special characters or numbers')
            ->rule('regex', 'driver_gender', '/^(male|female)$/i')->message('{field} cannot be anything other than male or female')
            ->rule('regex', 'insurance_id', '/^I-\d{5}$/')->message('{field} must start with {I-} and end with 5 numeric values')
            ->rule('email', 'email')->message('{field} is not a valid')
            ->rule('integer', 'postal_code')->message('{field} is not a valid')
            ->rule('length', 'postal_code', '5')->message('{field} must only have 5 digits')
            ->rule('integer', 'driver_age')->message('{field} must be an integer')
            ->rule('min', 'driver_age', '18')->message('{field} cannot be less than 18')
            ->rule('max', 'driver_age', '100')->message('{field} cannot be greater than 100');


        $labels = [
            'owner_id' => 'Owner ID',
            'name' => 'Name',
            'email' => 'Email address',
            'postal_code' => 'Postal code',
            'country' => 'Country',
            'city' => 'City',
            'driver_age' => 'Driver age',
            'driver_gender' => 'Driver gender',
            'insurance_id' => 'Insurance ID'
        ];

        $validateExistence->labels($labels);
        $validateFields->labels($labels);

        self::validate($validateExistence, $request);
        self::validate($validateFields, $request);
    }
    public static function validateOwnersDeletion($data, $request): void
    {
        $incorrectlyFormattedIndexes = [];
        foreach ($data as $key => $owner_id) {
            if (preg_match('/^O-\d{5}$/', $owner_id) === 0) {
                $incorrectlyFormattedIndexes[] = $key;
            }
        }
        if (count($incorrectlyFormattedIndexes) > 0) {
            throw new HttpInvalidInputException(
                $request,
                "Index(es) " . implode(', ', $incorrectlyFormattedIndexes) . " is/are incorrect format."
            );
        }
    }
}