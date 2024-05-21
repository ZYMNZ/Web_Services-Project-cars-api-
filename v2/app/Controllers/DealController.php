<?php

namespace Vanier\Api\Controllers;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Vanier\Api\Helpers\WebServiceInvoker;
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

    /**
     * @throws GuzzleException
     */
    public function handleGetAllDeals(Request $request, Response $response, array $uri_args): Response {
        $filters = $request->getQueryParams();
        $this->deal_model->validatePagination($request, $filters);
        $data = $this->deal_model->getAllDeals($filters);

        //*invoker
        $wa_invoker = new WebServiceInvoker();
        $uri = "https://freetestapi.com/api/v1/cars";
        $cars = $wa_invoker->invokeAPI2($uri);
        $data["cars_api"] = $cars;

        return $this->makeResponse($response, $data);
    }

    public function handleGetDealById(Request $request, Response $response, array $uri_args): Response {
        $deal_id = $uri_args['deal_id'];
        $this->assertIdFormat($request,$deal_id, $this->pattern);
        $data = $this->deal_model->getDealById($deal_id);
        $this->assertIdExists($request, $data);
        return $this->makeResponse($response, $data);
    }

    public function handleGetDealInsurances(Request $request, Response $response, array $uri_args): Response {
        $deal_id = $uri_args['deal_id'];
        $this->assertIdFormat($request,$deal_id, $this->pattern);
        $filters = $request->getQueryParams();
        $this->deal_model->validatePagination($request, $filters);
        $data = $this->deal_model->getDealInsurances($deal_id, $filters);
        $this->assertIdExists($request, $data);
        return $this->makeResponse($response, $data);
    }
}