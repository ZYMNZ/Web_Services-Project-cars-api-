<?php

namespace Vanier\Api\Validations;

use Vanier\Api\Exceptions\HttpInvalidInputException;
use Vanier\Api\Helpers\Validator;

class Validation
{
    //* /owners rules
    private static array $NAME = ['name' => ['required', ['regex', '/^[a-zA-Z\s]+$/']]];
    private static array $EMAIL = ['email' => ['required', 'email']];
    private static array $POSTAL_CODE = ['postal_code' => ['required', 'alphaNum']]; //length ???
    private static array $COUNTRY = ['country' => ['required', 'alpha']];
    private static array $CITY = ['city' => ['required', 'alpha']];
    private static array $AGE = ['age' => ['required', 'integer', ['lengthMax', 3]]];
    private static array $GENDER = ['gender' => ['required', 'alpha', ['in', ['male', 'female']]]];

    //* /owners rules


    public static function validate($filters, $request): void
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
    }

    private static function buildRules(string $filter_name, array $rules): array
    {
        $filter_rules = [
            //* /owners rules
            'name' => self::$NAME,
            'email' => self::$EMAIL,
            'postal_code' => self::$POSTAL_CODE,
            'country' => self::$COUNTRY,
            'city' => self::$CITY,
            'age' => self::$AGE,
            'gender' => self::$GENDER,
        ];

        if (array_key_exists($filter_name, $filter_rules)) {
            $rules += $filter_rules[$filter_name];
        }
        return $rules;
    }
}