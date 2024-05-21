<?php

namespace Vanier\Api\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Vanier\Api\Models\ViolationModel;

class ViolationController extends BaseController
{
    private ViolationModel $violation_model;
    private string $pattern;
    public function __construct() {
        parent::__construct();
        $this->violation_model = new ViolationModel();
        $this->pattern = "/^V-\d{5}$/";
    }
    public function handleAllViolations(Request $request, Response $response, array $uri_args): Response {
        $filters = $request->getQueryParams();
        $this->violation_model->validatePagination($request, $filters);
        $data = $this->violation_model->getAllViolations($filters);
        return $this->makeResponse($response, $data);
    }
    public function handleGetViolationInfo(Request $request, Response $response, array $uri_args): Response {
        $violation_id = $uri_args['violation_id'];
        $this->assertIdFormat($request, $violation_id, $this->pattern);
        $filters = $request->getQueryParams();
        $this->violation_model->validatePagination($request, $filters);
        $data = $this->violation_model->getViolationInfo($violation_id);
        $this->assertIdExists($request, $data);
        return $this->makeResponse($response, $data);
    }
    public function handleGetViolationCars(Request $request, Response $response, array $uri_args): Response
    {
        $violation_id = $uri_args['violation_id'];
        $this->assertIdFormat($request, $violation_id, $this->pattern);
        $filters = $request->getQueryParams();
        $this->violation_model->validatePagination($request, $filters);
        $data = $this->violation_model->getViolationCars($violation_id, $filters);
        $this->assertIdExists($request, $data);
        return $this->makeResponse($response, $data);
    }
}