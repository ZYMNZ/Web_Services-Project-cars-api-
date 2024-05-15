<?php

namespace Vanier\Api\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Vanier\Api\Models\OwnerModel;
use Vanier\Api\Validations\OwnerValidation;
use Vanier\Api\Validations\Validation;

class OwnerController extends BaseController
{
    private OwnerModel $owner_model;
    private string $pattern;
    public function __construct()
    {
        parent::__construct();
        $this->owner_model = new OwnerModel();
        $this->pattern = "/^O-\d{5}$/";
    }

    public function handleGetAllOwners(Request $request, Response $response, array $uri_args): Response {
        $filters = $request->getQueryParams();
        $filters = array_map('trim', $filters);
        $this->owner_model->validatePagination($request, $filters);
        $data = $this->owner_model->getAllOwners($filters, $request);
        return $this->makeResponse($response, $data);
    }
    public function handleGetOwnerInfo(Request $request, Response $response, array $uri_args): Response {
        $owner_id = $uri_args['owner_id'];
        $this->assertIdFormat($request, $owner_id, $this->pattern);
        $filters = $request->getQueryParams();
        $this->owner_model->validatePagination($request, $filters);
        $data = $this->owner_model->getOwnerInfo($owner_id);
        $this->assertIdExists($request, $data);
        return $this->makeResponse($response, $data);
    }
    public function handleGetOwnerCars(Request $request, Response $response, array $uri_args): Response
    {
        $owner_id = $uri_args['owner_id'];
        $this->assertIdFormat($request, $owner_id, $this->pattern);
        $filters = $request->getQueryParams();
        $this->owner_model->validatePagination($request, $filters);
        $data = $this->owner_model->getOwnerCars($owner_id, $filters);
        $this->assertIdExists($request, $data);
        return $this->makeResponse($response, $data);
    }
    public function handleGetOwnerDeals(Request $request, Response $response, array $uri_args): Response
    {
        $owner_id = $uri_args['owner_id'];
        $this->assertIdFormat($request, $owner_id, $this->pattern);
        $filters = $request->getQueryParams();
        $this->owner_model->validatePagination($request, $filters);
        $data = $this->owner_model->getOwnerDeals($owner_id, $filters);
        $this->assertIdExists($request, $data);
        return $this->makeResponse($response, $data);
    }
    public function handleGetOwnerViolations(Request $request, Response $response, array $uri_args): Response
    {
        $owner_id = $uri_args['owner_id'];
        $this->assertIdFormat($request, $owner_id, $this->pattern);
        $filters = $request->getQueryParams();
        $this->owner_model->validatePagination($request, $filters);
        $data = $this->owner_model->getOwnerViolations($owner_id, $filters);
        $this->assertIdExists($request, $data);
        return $this->makeResponse($response, $data);
    }

    public function handleCreateOwners(Request $request, Response $response, array $uri_args): Response
    {
        $owners = $request->getParsedBody();
        foreach ($owners as $key => $value) {
            OwnerValidation::validateOwnersCreation($value, $request);
            $this->owner_model->createOwner($value);
        }
        $response_data = array(
            "code" => "success",
            "message" => "the specified owners have been created successfully!"
        );

        return $this->makeResponse($response, $response_data,201);
    }

    public function handleUpdateOwners(Request $request, Response $response, array $uri_args): Response
    {
        $owners = $request->getParsedBody();
        foreach($owners as $owner){
            OwnerValidation::validateOwnersUpdate($owner, $request);
            //! we're sending the data body without the id, we only need the id to know which car[row] to update
            $owner_id = $owner['owner_id'];
            unset($owner['owner_id']);
            $this->owner_model->updateOwners($owner, $owner_id);
        }

        $response_data = array(
            "code" => "success",
            "message" => "the specified owners have been updated successfully!"
        );

        return $this->makeResponse(
            $response,
            $response_data,
            201
        );
    }

    public function handleDeleteOwners(Request $request, Response $response, array $uri_args): Response
    {
        $owners = $request->getParsedBody();

        OwnerValidation::validateOwnersDeletion($owners, $request);
        $not_deleted_ids = [];
        foreach ($owners as $key => $owner_id) {
            $status = $this->owner_model->deleteOwner($owner_id);
            if ($status == 0) {
                $not_deleted_ids[] = $owner_id;
            }
        }
        if (count($owners) == 1 && count($not_deleted_ids) == 1) {
            $response_data = array(
                "code" => "failed",
                "message" => "the specified owner has not been deleted successfully!"
            );
        } else if (count($owners) <= 0) {
            $response_data = array(
                "code" => "failed",
                "message" => "there is/are no specified owner(s)!"
            );
        } else {
            $message = "the specified owners have been deleted successfully";
            if (count($not_deleted_ids) > 0) {
                $response_data = array(
                    "code" => "success",
                    "message" => $message . " except " . implode(', ', $not_deleted_ids) . "!"
                );
            } else {
                $response_data = array(
                    "code" => "success",
                    "message" => $message . "!"
                );
            }

        }
        return $this->makeResponse(
            $response,
            $response_data
        );
    }
}