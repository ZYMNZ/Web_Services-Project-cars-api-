<?php

namespace Vanier\Api\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Vanier\Api\Models\InsuranceModel;

class InsuranceController extends BaseController
{
    private InsuranceModel $insurance_model;
    private string $pattern;
    public function __construct() {
        parent::__construct();
        $this->insurance_model = new InsuranceModel();
        $this->pattern = "/^I-\d{5}$/";
    }
    public function handleAllInsurances(Request $request, Response $response, array $uri_args): Response {
        $filters = $request->getQueryParams();
        $this->insurance_model->validatePagination($request, $filters);
        $data = $this->insurance_model->getAllInsurances($filters);
        return $this->makeResponse($response, $data);
    }
    public function handleGetInsuranceInfo(Request $request, Response $response, array $uri_args): Response {
        $insurance_id = $uri_args['insurance_id'];
        $this->assertIdFormat($request, $insurance_id, $this->pattern);
        $filters = $request->getQueryParams();
        $this->insurance_model->validatePagination($request, $filters);
        $data = $this->insurance_model->getInsuranceInfo($insurance_id);
        $this->assertIdExists($request, $data);
        return $this->makeResponse($response, $data);
    }
    public function handleGetInsuranceOwners(Request $request, Response $response, array $uri_args): Response
    {
        $insurance_id = $uri_args['insurance_id'];
        $this->assertIdFormat($request, $insurance_id, $this->pattern);
        $filters = $request->getQueryParams();
        $this->insurance_model->validatePagination($request, $filters);
        $data = $this->insurance_model->getInsuranceOwners($insurance_id, $filters);
        $this->assertIdExists($request, $data);
        return $this->makeResponse($response, $data);
    }
}