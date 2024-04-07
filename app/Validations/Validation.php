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
            ->rule('integer', 'postal_code')->message('{field} must be an integer');
        $validator->labels([
            'owner_id' => 'Owner ID',
            'name' => 'Name',
            'email' => 'Email',
            'postal_code' => 'Postal code',
            'country' => 'Country',
            'city' => 'City',
            'driver_age' => 'Driver Age',
            'driver_gender' => 'Driver Gender',
            'insurance_id' => 'Insurance ID'
        ]);

        if (!$validator->validate()) {
            throw new HttpInvalidInputException(
                $request,
                $validator->errorsToString()
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