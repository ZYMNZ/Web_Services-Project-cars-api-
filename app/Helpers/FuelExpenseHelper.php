<?php

namespace Vanier\Api\Helpers;
use Vanier\Api\Exceptions\HttpInvalidInputException;
use Psr\Http\Message\ServerRequestInterface as Request;

class FuelExpenseHelper
{
    private $pattern = "/^[0-9]+\.?[0-9]+$/";

    public static function getFuelExpense(Request $request, $annualMilesDriven,$milesPerGallon,$pricePerGallon){
        //TODO validation

        if (!is_numeric($annualMilesDriven) || !is_numeric($milesPerGallon) || !is_numeric($pricePerGallon)) {
            throw new HttpInvalidInputException(
                $request,
                "Invalid input! Enter numbers only please!"
            );
        }
        $annualFuelCost = ($annualMilesDriven / $milesPerGallon) * $pricePerGallon;
        $formattedFuelCost = number_format($annualFuelCost, 2);
        return "Annual Fuel Cost: $" . $formattedFuelCost;
    }

}
// preg_match($this->pattern,$annualMilesDriven) ||