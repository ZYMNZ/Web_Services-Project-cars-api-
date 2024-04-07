<?php

namespace Vanier\Api\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Vanier\Api\Models\OwnerModel;
use Vanier\Api\Validations\Validation;

class OwnerController extends BaseController
{
    private OwnerModel $owner_model;
    private string $pattern;
    public function __construct()
    {
        parent::__construct();
        $this->owner_model = new OwnerModel();
        $this->pattern = "/^O-\d{5}$/";
    }

    public function handleGetAllOwners(Request $request, Response $response, array $uri_args): Response {
        $filters = $request->getQueryParams();
        $filters = array_map('trim', $filters);
        $this->owner_model->validatePagination($request, $filters);
        $data = $this->owner_model->getAllOwners($filters, $request);
        return $this->makeResponse($response, $data);
    }
    public function handleGetOwnerInfo(Request $request, Response $response, array $uri_args): Response {
        $owner_id = $uri_args['owner_id'];
        $this->assertIdFormat($request, $owner_id, $this->pattern);
        $filters = $request->getQueryParams();
        $this->owner_model->validatePagination($request, $filters);
        $data = $this->owner_model->getOwnerInfo($owner_id);
        $this->assertIdExists($request, $data);
        return $this->makeResponse($response, $data);
    }
    public function handleGetOwnerCars(Request $request, Response $response, array $uri_args): Response
    {
        $owner_id = $uri_args['owner_id'];
        $this->assertIdFormat($request, $owner_id, $this->pattern);
        $filters = $request->getQueryParams();
        $this->owner_model->validatePagination($request, $filters);
        $data = $this->owner_model->getOwnerCars($owner_id, $filters);
        $this->assertIdExists($request, $data);
        return $this->makeResponse($response, $data);
    }
    public function handleGetOwnerDeals(Request $request, Response $response, array $uri_args): Response
    {
        $owner_id = $uri_args['owner_id'];
        $this->assertIdFormat($request, $owner_id, $this->pattern);
        $filters = $request->getQueryParams();
        $this->owner_model->validatePagination($request, $filters);
        $data = $this->owner_model->getOwnerDeals($owner_id, $filters);
        $this->assertIdExists($request, $data);
        return $this->makeResponse($response, $data);
    }
    public function handleGetOwnerViolations(Request $request, Response $response, array $uri_args): Response
    {
        $owner_id = $uri_args['owner_id'];
        $this->assertIdFormat($request, $owner_id, $this->pattern);
        $filters = $request->getQueryParams();
        $this->owner_model->validatePagination($request, $filters);
        $data = $this->owner_model->getOwnerViolations($owner_id, $filters);
        $this->assertIdExists($request, $data);
        return $this->makeResponse($response, $data);
    }

    public function handleCreateOwners(Request $request, Response $response, array $uri_args): Response
    {
        $cars = $request->getParsedBody();
        //TODO Validate the received values using the Valitron (or your custom validation methods)


        foreach ($cars as $key => $value) {
            Validation::validateOwners($value, $request);
            $this->owner_model->createOwner($value);
        }
        $response_data = array(
            "code" => "success",
            "message" => "the specified owners have been created successfully!"
        );

        return $this->makeResponse($response, $response_data,201);
    }
}