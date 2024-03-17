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
}