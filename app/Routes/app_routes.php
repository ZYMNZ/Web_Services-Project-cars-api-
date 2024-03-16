<?php

declare(strict_types=1);

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Vanier\Api\Controllers\AboutController;
use Vanier\Api\Controllers\InsurancesController;
use Vanier\Api\Controllers\OwnersController;
use Vanier\Api\Controllers\ViolationsController;
use Vanier\Api\Helpers\DateTimeHelper;

// Import the app instance into this file's scope.
global $app;

// TODO: Add your app's routes here.
//! The callbacks must be implemented in a controller class.
//! The Vanier\Api must be used as namespace prefix. 

//* ROUTE: GET /
$app->get('/', [AboutController::class, 'handleAboutWebService']);

//* ROUTE: GET /owners
$app->get('/owners', [OwnersController::class, 'handleGetAllOwners']);
$app->get('/owners/{owner_id}', [OwnersController::class, 'handleGetOwnerInfo']);

//* ROUTE: GET /violations
$app->get('/violations', [ViolationsController::class, 'handleAllViolations']);

//* ROUTE: GET /insurances
$app->get('/insurances', [InsurancesController::class, 'handleAllInsurances']);

//* ROUTE: GET /hello
$app->get('/hello', function (Request $request, Response $response, $args) {

    $now = DateTimeHelper::getDateAndTime(DateTimeHelper::D_M_Y);
    $response->getBody()->write("Reporting! Hello there! The current time is: " . $now);
    return $response;
});
