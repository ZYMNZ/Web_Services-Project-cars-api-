<?php

namespace Vanier\Api\Controllers;

use Vanier\Api\Models\CarModel;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Vanier\Api\Validations\Validation;

class CarController extends BaseController
{
    private CarModel $cars_model;
    private string $pattern;
    public function __construct() {
        parent::__construct();
        $this->cars_model = new CarModel();
        $this->pattern = "/^C-\d{5}$/";
    }

    public function handleGetAllCars(Request $request, Response $response, array $uri_args): Response {
        $filters = $request->getQueryParams();
        $this->cars_model->validatePagination($request, $filters);
        $data = $this->cars_model->getAllCars($filters);
        return $this->makeResponse($response, $data);
    }

    public function handleGetCarById(Request $request, Response $response, array $uri_args): Response {
        $car_id = $uri_args['car_id'];
        $this->assertIdFormat($request,$car_id, $this->pattern);
        $data = $this->cars_model->getCarById($car_id);
        $this->assertIdExists($request, $data);
        return $this->makeResponse($response, $data);
    }

    public function handleGetCarEmissions(Request $request, Response $response, array $uri_args): Response {
        $car_id = $uri_args['car_id'];
        $this->assertIdFormat($request,$car_id, $this->pattern);
        $filters = $request->getQueryParams();
        $this->cars_model->validatePagination($request, $filters);
        $data = $this->cars_model->getCarEmissions($car_id, $filters);
        $this->assertIdExists($request, $data);
        return $this->makeResponse($response, $data);
    }

    public function handleGetCarDeals(Request $request, Response $response, array $uri_args): Response {
        $car_id = $uri_args['car_id'];
        $this->assertIdFormat($request,$car_id, $this->pattern);
        $filters = $request->getQueryParams();
        $this->cars_model->validatePagination($request, $filters);
        $data = $this->cars_model->getCarDeals($car_id, $filters);
        $this->assertIdExists($request, $data);
        return $this->makeResponse($response, $data);
    }

    public function handleGetCarConsumptions(Request $request, Response $response, array $uri_args): Response {
        $car_id = $uri_args['car_id'];
        $this->assertIdFormat($request,$car_id, $this->pattern);
        $filters = $request->getQueryParams();
        $this->cars_model->validatePagination($request, $filters);
        $data = $this->cars_model->getCarConsumptions($car_id, $filters);
        $this->assertIdExists($request, $data);
        return $this->makeResponse($response, $data);
    }

    //POST cars
    public function handleCreateCars(Request $request, Response $response, array $uri_args): Response
    {
        //? Step 1) get the parsed data from the request's body
        $cars = $request->getParsedBody();
        //? Step 2) Process the collection items to be created:
        
        //TODO Validate the received values using the Valitron (or your custom validation methods)

        Validation::validateCarsCreation($cars,$request);

        foreach ($cars as $key => $value) {
            //! Insert the new car into the DB table
            $this->cars_model->createCar($value);
        } 

        //? Step3) prepare the response
        $response_data = array(
            "code" => "success", 
            "message" => "the specified cars have been created successfully!"
        );
        
        return $this->makeResponse($response, $response_data,201);
    }

    public function handleUpdateCars(Request $request, Response $response, array $uri_args): Response
    {
        $cars = $request->getParsedBody();

        foreach($cars as $car){
            $car_id = $car['car_id'];
            unset($car['car_id']);
            
            //! we're sending the data body without the id, we only need the id to know which car[row] to update
            $this->cars_model->updateCars($car,$car_id);
        }

        $response_data = array(
            "code" => "success",
            "message" => "the specified cars have been updated successfully!"
        );

        return $this->makeResponse(
            $response,
            $response_data,
            201
        );
    }

    public function handleDeleteCars(Request $request, Response $response, array $uri_args): Response
    {
        $cars = $request->getParsedBody();

        foreach ($cars as $car_id) {
            $this->cars_model->deleteCar($car_id);
        }

        $response_data = array(
            "code" => "success",
            "message" => "the specified cars have been deleted successfully!"
        );

        return $this->makeResponse($response, $response_data, 200);
    }

}