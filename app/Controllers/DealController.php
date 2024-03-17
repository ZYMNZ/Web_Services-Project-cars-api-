<?php

namespace Vanier\Api\Controllers;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Vanier\Api\Models\DealModel;

class DealController extends BaseController
{
    private DealModel $deal_model;
    private string $pattern;
    public function __construct() {
        parent::__construct();
        $this->deal_model = new DealModel();
        $this->pattern = "/^D-\d{5}$/";
    }
    public function handleGetAllDeals(Request $request, Response $response, array $uri_args): Response {
        $filters = $request->getQueryParams();
        $this->deal_model->validatePagination($request, $filters);
        $data = $this->deal_model->getAllDeals($filters);
        return $this->makeResponse($response, $data);
    }
}