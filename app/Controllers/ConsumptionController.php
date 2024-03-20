<?php

namespace Vanier\Api\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Vanier\Api\Models\ConsumptionModel;

class ConsumptionController extends BaseController
{
    private ConsumptionModel $consumption_model; 
    private string $pattern;
    public function __construct() {
        parent::__construct();
        $this->consumption_model = new 
        ConsumptionModel();
        $this->pattern = "/^FC-\d{5}$/";
    }
    public function handleAllConsumptions(Request
    $request, Response $response, array $uri_args)
    : Response {
        $filters = $request->getQueryParams();
        $this->consumption_model->validatePagination($request, $filters); 
        $data = 
        $this->consumption_model->getAllConsumptions($filters); 
        return $this->makeResponse($response, $data); 
    }

    public function handleGetConsumptionInfo(Request $request, Response $response, array $uri_args): Response {
        $consumption_id = $uri_args['consumption_id'];
        $this->assertIdFormat($request, $consumption_id, $this->pattern);
        $filters = $request->getQueryParams();
        $this->consumption_model->validatePagination($request, $filters);
        $data = $this->consumption_model->getConsumptionInfo($consumption_id);
        $this->assertIdExists($request, $data);
        return $this->makeResponse($response, $data);
    }
}