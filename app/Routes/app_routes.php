<?php

declare(strict_types=1);

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Vanier\Api\Controllers\AboutController;
use Vanier\Api\Controllers\CarController;
use Vanier\Api\Controllers\DealController;
use Vanier\Api\Controllers\InsuranceController;
use Vanier\Api\Controllers\OwnerController;
use Vanier\Api\Controllers\ViolationController;
use Vanier\Api\Helpers\DateTimeHelper;

// Import the app instance into this file's scope.
global $app;

// TODO: Add your app's routes here.
//! The callbacks must be implemented in a controller class.
//! The Vanier\Api must be used as namespace prefix. 

//* ROUTE: GET /
$app->get('/', [AboutController::class, 'handleAboutWebService']);

//* ROUTE: GET /cars
$app->get('/cars', [CarController::class, 'handleGetAllCars']);
//* ROUTE: GET /cars/{car_id}
$app->get('/cars/{car_id}', [CarController::class, 'handleGetCarById']);
//* ROUTE: GET /cars/{car_id}/emissions
$app->get('/cars/{car_id}/emissions', [CarController::class, 'handleGetCarEmissions']);
//* ROUTE: GET /cars/{car_id}/deals
$app->get('/cars/{car_id}/deals', [CarController::class, 'handleGetCarDeals']);
//* ROUTE: GET /cars/{car_id}/consumptions
$app->get('/cars/{car_id}/consumptions', [CarController::class, 'handleGetCarConsumptions']);

//* ROUTE: GET /deals
$app->get('/deals', [DealController::class, 'handleGetAllDeals']);
//* ROUTE: GET /deals/{deal_id}
$app->get('/deals/{deal_id}', [DealController::class, 'handleGetDealById']);
//* ROUTE: GET /deals/{deal_id}/insurances
$app->get('/deals/{deal_id}/insurances', [DealController::class, 'handleGetDealInsurances']);

//* ROUTE: GET /owners
$app->get('/owners', [OwnerController::class, 'handleGetAllOwners']);
$app->get('/owners/{owner_id}', [OwnerController::class, 'handleGetOwnerInfo']);
$app->get('/owners/{owner_id}/cars', [OwnerController::class, 'handleGetOwnerCars']);
$app->get('/owners/{owner_id}/deals', [OwnerController::class, 'handleGetOwnerDeals']);
$app->get('/owners/{owner_id}/violations', [OwnerController::class, 'handleGetOwnerViolations']);

//* ROUTE: GET /violations
$app->get('/violations', [ViolationController::class, 'handleAllViolations']);
$app->get('/violations/{violation_id}', [ViolationController::class, 'handleGetViolationInfo']);
$app->get('/violations/{violation_id}/cars', [ViolationController::class, 'handleGetViolationCars']);

//* ROUTE: GET /insurances
$app->get('/insurances', [InsuranceController::class, 'handleAllInsurances']);
$app->get('/insurances/{insurance_id}', [InsuranceController::class, 'handleGetInsuranceInfo']);
$app->get('/insurances/{insurance_id}/owners', [InsuranceController::class, 'handleGetInsuranceOwners']);

//* ROUTE: GET /emissions


//* ROUTE: GET /consumption

//* ROUTE: GET /hello
$app->get('/hello', function (Request $request, Response $response, $args) {

    $now = DateTimeHelper::getDateAndTime(DateTimeHelper::D_M_Y);
    $response->getBody()->write("Reporting! Hello there! The current time is: " . $now);
    return $response;
});
