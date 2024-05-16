<?php

namespace Vanier\Api\Validations;

use Vanier\Api\Exceptions\HttpInvalidInputException;
use Vanier\Api\Helpers\Validator;

class Validation
{
    public static function validateOwnersCreation($data, $request): void
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
            ->rule('regex', ['name', 'country', 'city'], '/^[A-Za-z]+(?:[\s\-_][A-Za-z]+)*$/')->message('{field} must not have special characters or numbers')
            ->rule('regex', 'driver_gender', '/^(male|female)$/i')->message('{field} cannot be anything other than male or female')
            ->rule('regex', 'insurance_id', '/^I-\d{5}$/')->message('{field} must start with {I-} and end with 5 numeric values')
            ->rule('email', 'email')->message('{field} is not a valid')
            ->rule('integer', 'postal_code')->message('{field} is not a valid')
            ->rule('length', 'postal_code', '5')->message('{field} must only have 5 digits')
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

    public static function validateOwnersUpdate($data, $request): void
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
            ->rule('regex', ['name', 'country', 'city'], '/^[A-Za-z]+(?:[\s\-_][A-Za-z]+)*$/')->message('{field} must not have special characters or numbers')
            ->rule('regex', 'driver_gender', '/^(male|female)$/i')->message('{field} cannot be anything other than male or female')
            ->rule('regex', 'insurance_id', '/^I-\d{5}$/')->message('{field} must start with {I-} and end with 5 numeric values')
            ->rule('email', 'email')->message('{field} is not a valid')
            ->rule('integer', 'postal_code')->message('{field} is not a valid')
            ->rule('length', 'postal_code', '5')->message('{field} must only have 5 digits')
            ->rule('integer', 'driver_age')->message('{field} must be an integer')
            ->rule('min', 'driver_age', '18')->message('{field} cannot be less than 18')
            ->rule('max', 'driver_age', '100')->message('{field} cannot be greater than 100');


        $validator->labels([
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

    public static function validateOwnersDeletion($data, $request): void
    {

        $validator = new Validator($data);
        $validator->rule('required', 'owner_id')->message('{field} is required')
            ->rule('regex', 'owner_id', '/^O-\d{5}$/')->message('{field} must start with {O-} and end with 5 numeric values');

        $validator->labels([
            'owner_id' => 'Owner ID'
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

/**
 * Validates the data for car creation.
 *
 * This method validates the data provided for creating a car. It checks for required fields,
 * validates the data types of the fields, and applies specific rules such as minimum values
 * and regex patterns to the fields. If the validation fails, it throws an exception.
 *
 * @param array $data The data to be validated.
 * @param mixed $request For the exception.
 * @throws HttpInvalidInputException If the validation fails.
 *
 * @return void
 */
public static function validateCarsCreation(array $data, $request): void
{
    $validator = new Validator($data);
    $validator->rule('required', [
        'car_id',
        'car_name',
        'cylinders',
        'horsepower',
        'year',
        'engine_type',
        'car_make',
        'car_model',
        'is_fuel_economic',
        'owner_id',
        'deal_id',
    ])->message('{field} is required')
        ->rule('integer', ['cylinders', 'horsepower', 'year'])->message('{field} must be an integer')
        ->rule('boolean', 'is_fuel_economic')->message('{field} must be a boolean')
        ->rule('regex', 'car_id', '/^C-\d{5}$/')->message('{field} must be in the format C-XXXXX example:"C-12345"')
        ->rule('regex', ['car_name','engine_type', 'car_make', 'car_model'], '/^[A-Za-z0-9]+(?:[\s\-_][A-Za-z0-9]+)*$/')->message("{field} accepts only alphanumeric characters, spaces, hyphens, and underscores, can't end with them")
       ->rule('min', ['cylinders','horsepower'], '0')->message('{field} cannot be less than 0')
        ->rule('min', 'year', '1950')->message('{field} cannot be less than 1950')
        ->rule('regex', 'deal_id', '/^D-\d{5}$/')->message('{field} must be in the format D-XXXXX example:"D-12345"')
        ->rule('regex', 'owner_id', '/^O-\d{5}$/')->message('{field} must be in the format O-XXXXX example:"O-12345"')
        ->rule('optional',['emission_id','consumption_id'])
        ->rule('regex', 'emission_id', '/^E-\d{5}$/')->message('{field} must be in the format E-XXXXX example:"E-12345"')
        ->rule('regex', 'consumption_id', '/^FC-\d{5}$/')->message('{field} must be in the format FC-XXXXX example:"FC-12345"');

    $validator->labels([
        'car_id' => 'Car ID',
        'car_name' => 'Car Name',
        'cylinders' => 'Cylinders',
        'horsepower' => 'Horsepower',
        'year' => 'Year',
        'engine_type' => 'Engine Type',
        'car_make' => 'Car Make',
        'car_model' => 'Car Model',
        'is_fuel_economic' => 'Is Fuel Economic',
        'owner_id' => 'Owner ID',
        'emission_id' => 'Emission ID',
        'consumption_id' => 'Consumption ID',
        'deal_id' => 'Deal ID'
    ]);

    self::validate($validator, $request);
}

/**
 * Validates the data for car update.
 *
 * This method validates the data provided for updating a car.
 * It checks for required fields, validates the data types of the fields, and applies specific rules.
 * If the validation fails, it throws an exception.
 *
 * @param array $data The data to be validated.
 * @param mixed $request For the exception.
 * @throws HttpInvalidInputException If the validation fails.
 *
 * @return void
 */
public static function validateCarsUpdate(array $data, $request): void
{
    $validator = new Validator($data);
    $validator->rule('required', [

    ])->message('{field} is required')
        ->rule('integer', ['cylinders', 'horsepower', 'year'])->message('{field} must be an integer')
        ->rule('boolean', 'is_fuel_economic')->message('{field} must be a boolean')
        ->rule('regex', ['car_name','engine_type', 'car_make', 'car_model'], '/^[A-Za-z0-9]+(?:[\s\-_][A-Za-z0-9]+)*$/')->message('{field} accepts only alphanumeric characters, spaces, hyphens, and underscores')
       ->rule('min', ['cylinders','horsepower'], '0')->message('{field} cannot be less than 0')
        ->rule('min', 'year', '1950')->message('{field} cannot be less than 1950')
        ->rule('regex', 'deal_id', '/^D-\d{5}$/')->message('{field} must be in the format D-XXXXX example:"D-12345"')
        ->rule('regex', 'owner_id', '/^O-\d{5}$/')->message('{field} must be in the format O-XXXXX example:"O-12345"')
        ->rule('optional',['emission_id','consumption_id'])
        ->rule('regex', 'emission_id', '/^E-\d{5}$/')->message('{field} must be in the format E-XXXXX example:"E-12345"')
        ->rule('regex', 'consumption_id', '/^FC-\d{5}$/')->message('{field} must be in the format FC-XXXXX example:"FC-12345"');

    $validator->labels([
        'car_name' => 'Car Name',
        'cylinders' => 'Cylinders',
        'horsepower' => 'Horsepower',
        'year' => 'Year',
        'engine_type' => 'Engine Type',
        'car_make' => 'Car Make',
        'car_model' => 'Car Model',
        'is_fuel_economic' => 'Is Fuel Economic',
        'owner_id' => 'Owner ID',
        'emission_id' => 'Emission ID',
        'consumption_id' => 'Consumption ID',
        'deal_id' => 'Deal ID'
    ]);


}

/**
 * Validates the data for car deletion.
 *
 * This method validates the data provided for deleting a car.
 * It checks if the id is valid.
 * If the validation fails, it throws an exception.
 *
 * @param array $data The data to be validated.
 * @param mixed $request For the exception.
 * @throws HttpInvalidInputException If the validation fails.
 *
 * @return void
 */
public static function validateCarsDeletion(array $data, $request): void
{
    $validator = new Validator($data);
    $validator->rule('required', 'car_id')->message('{field} is required')
        ->rule('regex', 'car_id', '/^C-\d{5}$/')->message('{field} must be in the format C-XXXXX example:"C-12345"');

    $validator->labels([
        'car_id' => 'Car ID'
    ]);
    
    self::validate($validator, $request);
}

public static function validateConsumptionCreation(array $data, $request): void
{
    $validator = new Validator($data);
    $validator->rule('required', [
        'consumption_id',
        'engine_size',
        'fuel_consumption_city',
        'fuel_consumption_hwy',
        'fuel_consumption_combined',
    ])->message('{field} is required')
      ->rule('regex', 'consumption_id', '/^FC-\d{5}$/')->message('{field} must be in the format FC-XXXXX example:"FC-12345"')
      ->rule('integer', ['engine_size', 'fuel_consumption_city', 'fuel_consumption_hwy', 'fuel_consumption_combined'])->message('{field} must be an integer')
      ->rule('min', ['engine_size', 'fuel_consumption_city', 'fuel_consumption_hwy', 'fuel_consumption_combined'], '0')->message('{field} cannot be less than 0');

    $validator->labels([
        'consumption_id' => 'Consumption ID',
        'engine_size' => 'Engine Size',
        'fuel_consumption_city' => 'Fuel Consumption City',
        'fuel_consumption_hwy' => 'Fuel Consumption Highway',
        'fuel_consumption_combined' => 'Fuel Consumption Combined'
    ]);

    self::validate($validator, $request);
}

public static function validateConsumptionsUpdate(array $data, $request): void
{
    $validator = new Validator($data);
    $validator->rule('required', [
        'consumption_id',
        'engine_size',
        'fuel_consumption_city',
        'fuel_consumption_hwy',
        'fuel_consumption_combined',
    ])->message('{field} is required')
      ->rule('integer', ['engine_size', 'fuel_consumption_city', 'fuel_consumption_hwy', 'fuel_consumption_combined'])->message('{field} must be an integer')
      ->rule('regex', 'consumption_id', '/^FC-\d{5}$/')->message('{field} must be in the format FC-XXXXX example:"FC-12345"')
      ->rule('min', ['engine_size', 'fuel_consumption_city', 'fuel_consumption_hwy', 'fuel_consumption_combined'], '0')->message('{field} cannot be less than 0');

    $validator->labels([
        'consumption_id' => 'Consumption ID',
        'engine_size' => 'Engine Size',
        'fuel_consumption_city' => 'Fuel Consumption City',
        'fuel_consumption_hwy' => 'Fuel Consumption Highway',
        'fuel_consumption_combined' => 'Fuel Consumption Combined'
    ]);

    self::validate($validator, $request);
}

public static function validateConsumptionsDeletion(array $data, $request): void
{
    $validator = new Validator($data);
    $validator->rule('required', 'consumption_id')->message('{field} is required')
              ->rule('regex', 'consumption_id', '/^FC-\d{5}$/')->message('{field} must be in the format FC-XXXXX example:"FC-12345"');

    $validator->labels([
        'consumption_id' => 'Consumption ID'
    ]);

    self::validate($validator, $request);
}

    public static function validateFuelExpense(array $data, $request): void
    {
        $validateExistence = new Validator($data);
        $validateFields = new Validator($data);

        $validateExistence->rule('required', [
            'annual_miles_driven',
            'miles_per_gallon',
            'price_per_gallon',
        ])->message('{field} is required');

            $validateFields->rule('regex', 'annual_miles_driven', "/^[0-9]+\.?[0-9]+$/")->message('{field} must be an number')
            ->rule('regex', 'miles_per_gallon', "/^[0-9]+\.?[0-9]+$/")->message('{field} must be an number')
            ->rule('regex', 'price_per_gallon', "/^[0-9]+\.?[0-9]+$/")->message('{field} must be an number');

        $labels = [
            'annual_miles_driven' => 'Annual Miles Driven',
            'miles_per_gallon' => 'Miles Per Gallon',
            'price_per_gallon' => 'Price Per Gallon'
        ];

        $validateExistence->labels($labels);
        $validateFields->labels($labels);

        self::validate($validateExistence, $request);
        self::validate($validateFields, $request);;
    }

}
