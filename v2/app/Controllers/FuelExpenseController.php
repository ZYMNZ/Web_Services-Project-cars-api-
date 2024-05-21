<?php

namespace Vanier\Api\Controllers;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Vanier\Api\Exceptions\HttpInvalidInputException;
use Vanier\Api\Helpers\FuelExpenseHelper;

class FuelExpenseController extends BaseController
{

    public function handleGetFuelExpense(Request $request, Response $response, array $uri_args)
    {
        $expense = $request->getParsedBody();
        

        $annualMilesDriven = $expense['annual_miles_driven'];
        $milesPerGallon = $expense['miles_per_gallon'];
        $pricePerGallon = $expense['price_per_gallon'];

//        $result = FuelExpenseHelper::getFuelExpense($expense,$request);
        $result = FuelExpenseHelper::getFuelExpense($request, $annualMilesDriven,$milesPerGallon,$pricePerGallon);

        $response_data = array(
            "annual_miles_driven" => $expense['annual_miles_driven'], 
            "miles_per_gallon" => $expense['miles_per_gallon'], 
            "price_per_gallon" => $expense['price_per_gallon'],
            "fuel_expense" => $result
        );
        
        return $this->makeResponse($response, $response_data,201);

    }
}
