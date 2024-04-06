<?php

namespace Vanier\Api\Models;

use Vanier\Api\Helpers\Validator;

class Validation
{
    private static array $NAME = ['name' => ['required', 'alpha']];
    private static array $EMAIL = ['email' => ['required', 'email']];
    private static array $POSTAL_CODE = ['postal_code' => ['required', 'alphaNum']]; //length ???
    private static array $COUNTRY = ['country' => ['required', 'alpha']];
    private static array $CITY = ['city' => ['required', 'alpha']];
    private static array $AGE = ['age' => ['required', 'integer', ['lengthMax', 3]]];
    private static array $GENDER = ['gender' => ['required', 'alpha', ['in', ['male', 'female']]]];

    public static function validate($filters): void
    {
        $rules = [];
        $filterNames = array_keys($filters);
        foreach ($filterNames as $filterName) {
            $rules = self::buildRules($filterName, $rules);
        }
        $validator = new Validator($filters);
        $validator->mapFieldsRules($rules);

        if ($validator->validate()) {
//            echo "<br> Valid data!";
        } else {
            //var_dump($validator->errors());
            //print_r($validator->errors());
            echo $validator->errorsToString();
            echo $validator->errorsToJson();
        }
    }

    private static function buildRules(string $filterName, array $rules): array
    {
        switch ($filterName) {
            case 'name':
                $rules += self::$NAME;
                break;
            case 'email':
                $rules += self::$EMAIL;
                break;
            case 'postal_code':
                $rules += self::$POSTAL_CODE;
                break;
            case 'country':
                $rules += self::$COUNTRY;
                break;
            case 'city':
                $rules += self::$CITY;
                break;
            case 'age':
                $rules += self::$AGE;
                break;
            case 'gender':
                $rules += self::$GENDER;
                break;
        }
        return $rules;
    }
}