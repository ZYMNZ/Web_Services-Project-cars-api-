<?php

namespace Vanier\Api\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Vanier\Api\Models\EmissionModel;

class EmissionController extends BaseController
{
    private EmissionModel $emission_model; 
    private string $pattern;
    public function __construct() {
        parent::__construct();
        $this->emission_model = new 
        EmissionModel();
        $this->pattern = "/^E-\d{5}$/";
    }
    public function handleAllEmission(Request
    $request, Response $response, array $uri_args)
    : Response {
        $filters = $request->getQueryParams();
        $this->emission_model->validatePagination($request, $filters); 
        $data = 
        $this->emission_model->getAllEmissions($filters); 
        return $this->makeResponse($response, $data); 
    }
}