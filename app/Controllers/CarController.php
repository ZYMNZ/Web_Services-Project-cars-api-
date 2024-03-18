<?php

namespace Vanier\Api\Controllers;

use Vanier\Api\Models\CarModel;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

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
}