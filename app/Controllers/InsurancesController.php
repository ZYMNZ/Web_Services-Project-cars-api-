<?php

namespace Vanier\Api\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Vanier\Api\Models\InsurancesModel;

class InsurancesController extends BaseController
{
    private InsurancesModel $insurancesModel;
    private string $pattern;
    public function __construct() {
        parent::__construct();
        $this->insurancesModel = new InsurancesModel();
        $this->pattern = "Not done";
    }
    public function handleAllInsurances(Request $request, Response $response, array $uri_args): Response {
        $filters = $request->getQueryParams();
        $this->insurancesModel->validatePagination($request, $filters);
        $data = $this->insurancesModel->getAllInsurances($filters);
        return $this->makeResponse($response, $data);
    }
}