<?php

namespace Vanier\Api\Helpers;
use Vanier\Api\Exceptions\HttpInvalidInputException;
use Psr\Http\Message\ServerRequestInterface as Request;

class FuelExpenseHelper
{
    private $pattern = "/^[0-9]+\.?[0-9]+$/";

    public static function getFuelExpense(Request $request, $annualMilesDriven,$milesPerGallon,$pricePerGallon){
        //TODO validation

        if (!is_numeric($annualMilesDriven,$milesPerGallon,$pricePerGallon)) {
            throw new HttpInvalidInputException(
                $request,
                 "errorrr"
            );
        }
        $annualFuelExpense = ($annualMilesDriven / $milesPerGallon) * $pricePerGallon;

        return $annualFuelExpense;
    }

}
// preg_match($this->pattern,$annualMilesDriven) ||