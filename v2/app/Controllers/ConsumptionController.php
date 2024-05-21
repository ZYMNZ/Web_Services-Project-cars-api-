<?php

namespace Vanier\Api\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Vanier\Api\Models\ConsumptionModel;
use Vanier\Api\Validations\Validation;

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

    public function handleCreateConsumptions(Request $request, Response $response, array $uri_args): Response
    {
        //? Step 1) get the parsed data from the request's body
        $consumptions = $request->getParsedBody();
        //? Step 2) Process the collection items to be created:

        //TODO Validate the received values using the Valitron (or your custom validation methods)

        foreach ($consumptions as $key => $value) {
            Validation::validateConsumptionCreation($value,$request);
            //! Insert the new consumption into the DB table
            $this->consumption_model->createConsumption($value);
        } 

        //? Step3) prepare the response
        $response_data = array(
            "code" => "success", 
            "message" => "the specified consumptions have been created successfully!"
        );
        
        return $this->makeResponse($response, $response_data,201);
    }

    public function handleUpdateConsumptions(Request $request, Response $response, array $uri_args): Response
    {
        $consumptions = $request->getParsedBody();

        foreach($consumptions as $consumption){
            Validation::validateConsumptionsUpdate($consumption, $request);
            $consumption_id = $consumption['consumption_id'];
            unset($consumption['consumption_id']);

            //! we're sending the data body without the id, we only need the id to know which consumption[row] to update
            $this->consumption_model->updateConsumptions($consumption,$consumption_id);
        }

        $response_data = array(
            "code" => "success",
            "message" => "the specified consumptions have been updated successfully!"
        );

        return $this->makeResponse(
            $response,
            $response_data,
            201
        );
    }

    public function handleDeleteConsumptions(Request $request, Response $response, array $uri_args): Response
    {
        $consumptions = $request->getParsedBody();

        foreach ($consumptions as $consumption_id) {
            Validation::validateConsumptionsDeletion($consumption_id, $request);
            $this->consumption_model->deleteConsumption($consumption_id);
        }

        $response_data = array(
            "code" => "success",
            "message" => "the specified consumptions have been deleted successfully!"
        );

        return $this->makeResponse(
            $response,
            $response_data
        );
    }

}