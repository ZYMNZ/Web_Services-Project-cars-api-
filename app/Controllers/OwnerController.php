<?php

namespace Vanier\Api\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Vanier\Api\Models\OwnerModel;

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
        $this->owner_model->validatePagination($request, $filters);
        $data = $this->owner_model->getAllOwners($filters);
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
}