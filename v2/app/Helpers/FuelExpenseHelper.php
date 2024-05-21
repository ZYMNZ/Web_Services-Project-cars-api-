<?php

namespace Vanier\Api\Helpers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpBadRequestException;
use Vanier\Api\Validations\Validation;

class FuelExpenseHelper
{
//    public static function getFuelExpense($expenseObject, Request $request){
    public static function getFuelExpense(Request $request, $annualMilesDriven,$milesPerGallon,$pricePerGallon){
        //TODO validation

//        foreach ($expenseObject as $key => $value) {
//            Validation::validateFuelExpense(
//                [$expenseObject['annual_miles_driven'],$expenseObject['miles_per_gallon'],$expenseObject['price_per_gallon']]
//                ,$request
//            );
//        }
        if (!is_numeric($annualMilesDriven) || !is_numeric($milesPerGallon) || !is_numeric($pricePerGallon)) {
            throw new HttpBadRequestException(
                $request,
                "Invalid input! Enter numbers only please!"
            );
        }
//        $annualFuelCost = ($expenseObject['annual_miles_driven'] / $expenseObject['miles_per_gallon']) * $expenseObject['price_per_gallon'];
        $annualFuelCost = ($annualMilesDriven / $milesPerGallon) * $pricePerGallon;
        $formattedFuelCost = number_format($annualFuelCost, 2);
        return "Annual Fuel Cost: $" . $formattedFuelCost;
    }

}
// preg_match($this->pattern,$annualMilesDriven) ||