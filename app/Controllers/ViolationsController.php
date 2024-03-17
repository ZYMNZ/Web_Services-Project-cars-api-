<?php

namespace Vanier\Api\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Vanier\Api\Models\ViolationsModel;

class ViolationsController extends BaseController
{
    private ViolationsModel $violations_model;
    private string $pattern;
    public function __construct() {
        parent::__construct();
        $this->violations_model = new ViolationsModel();
        $this->pattern = "/^V-\d{5}$/";
    }
    public function handleAllViolations(Request $request, Response $response, array $uri_args): Response {
        $filters = $request->getQueryParams();
        $this->violations_model->validatePagination($request, $filters);
        $data = $this->violations_model->getAllViolations($filters);
        return $this->makeResponse($response, $data);
    }
}