<?php

namespace Vanier\Api\Validations;

use Vanier\Api\Exceptions\HttpInvalidInputException;
use Vanier\Api\Helpers\Validator;

class Validation
{
    //* /owners rules
    private static array $OWNER_ID = ['owner_id' => ['required', ['regex', '/^O-\d{5}$/']]];
    private static array $NAME = ['name' => ['required', ['regex', '/^[a-zA-Z\s]+$/']]];
    private static array $EMAIL = ['email' => ['required', 'email']];
    private static array $POSTAL_CODE = ['postal_code' => ['required', 'alphaNum']]; //length ???
    private static array $COUNTRY = ['country' => ['required', 'alpha']];
    private static array $CITY = ['city' => ['required', 'alpha']];
    private static array $DRIVER_AGE = ['driver_age' => ['required', 'integer', ['lengthMax', 3]]];
    private static array $DRIVER_GENDER = ['driver_gender' => ['required', 'alpha', ['in', ['male', 'female']]]];
    private static array $INSURANCE_ID = ['insurance_id' => ['required', ['regex', '/^I-\d{5}$/']]];

    //* /owners rules


    /*public static function validate($filters, $request): void
    {
        $rules = [];
        $filter_names = array_keys($filters);
        foreach ($filter_names as $filter_name) {
            $rules = self::buildRules($filter_name, $rules);
        }
        $validator = new Validator($filters);
        $validator->mapFieldsRules($rules);

        if (!$validator->validate()) {
            throw new HttpInvalidInputException(
                $request,
                trim($validator->errorsToString())
            );
        }
    }*/

    public static function validateOwners($data, $request): void
    {
        $validator = new Validator($data);
        $validator->rule('required', [
            'owner_id',
            'name',
            'email',
            'postal_code',
            'country',
            'city',
            'driver_age',
            'driver_gender',
            'insurance_id'
        ])->message('{field} is required')
            ->rule('regex', 'owner_id', '/^O-\d{5}$/')->message('{field} must start with {O-} and end with 5 numeric values')
            ->rule('regex', 'owner_id', '/^O-\d{5}$/')->message('{field} must start with {O-} and end with 5 numeric values')
            ->rule('regex', ['name', 'country', 'city'], '/^[a-zA-Z\s]+$/')->message('{field} must not have special characters or numbers')
            ->rule('regex', 'driver_gender', '/^(male|female)$/i')->message('{field} cannot be anything other than male or female')
            ->rule('regex', 'insurance_id', '/^I-\d{5}$/')->message('{field} must start with {I-} and end with 5 numeric values')
            ->rule('email', 'email')->message('{field} is not a valid')
            ->rule('alphaNum', 'postal_code')->message('{field} is not a valid')
            ->rule('integer', 'driver_age')->message('{field} must be an integer')
            ->rule('min', 'driver_age', '18')->message('{field} cannot be less than 18')
            ->rule('max', 'driver_age', '100')->message('{field} cannot be greater than 100');


        $validator->labels([
            'owner_id' => 'Owner ID',
            'name' => 'Name',
            'email' => 'Email address',
            'postal_code' => 'Postal code',
            'country' => 'Country',
            'city' => 'City',
            'driver_age' => 'Driver age',
            'driver_gender' => 'Driver gender',
            'insurance_id' => 'Insurance ID'
        ]);
        self::validate($validator, $request);
    }

    public static function validate($validator, $request): void
    {
        if (!$validator->validate()) {
            $message = trim($validator->errorsToString());
            if (str_contains($message, '  ')) {
                $message = str_replace('  ', ' ', $message);
            }
            throw new HttpInvalidInputException(
                $request,
                $message
            );
        }
    }

    private static function buildRules(string $filter_name, array $rules): array
    {
        $filter_rules = [
            //* /owners rules
            'owner_id' => self::$OWNER_ID,
            'name' => self::$NAME,
            'email' => self::$EMAIL,
            'postal_code' => self::$POSTAL_CODE,
            'country' => self::$COUNTRY,
            'city' => self::$CITY,
            'driver_age' => self::$DRIVER_AGE,
            'driver_gender' => self::$DRIVER_GENDER,
            'insurance_id' => self::$INSURANCE_ID,

            //* /owners rules
        ];

        if (array_key_exists($filter_name, $filter_rules)) {
            $rules += $filter_rules[$filter_name];
        }
        return $rules;
    }
}