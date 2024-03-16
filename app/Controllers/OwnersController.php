<?php

namespace Vanier\Api\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Vanier\Api\Models\OwnersModel;

class OwnersController extends BaseController
{
    private OwnersModel $owners_model;
    private string $pattern;
    public function __construct()
    {
        parent::__construct();
        $this->owners_model = new OwnersModel();
        $this->pattern = "not done";
    }

    public function handleGetAllOwners(Request $request, Response $response, array $uri_args): Response {
        $filters = $request->getQueryParams();
        $this->owners_model->validatePagination($request, $filters);
        $data = $this->owners_model->getAllOwners($filters);
        return $this->makeResponse($response, $data);
    }
    public function handleGetOwnerInfo(Request $request, Response $response, array $uri_args): Response {
        $owner_id = $uri_args['owner_id'];
        $this->assertIdFormat($request, $owner_id, $this->pattern);
        $filters = $request->getQueryParams();
        $this->owners_model->validatePagination($request, $filters);
        $data = $this->owners_model->getOwnerInfo($owner_id);
        $this->assertIdExists($request, $data);
        return $this->makeResponse($response, $data);
    }
}