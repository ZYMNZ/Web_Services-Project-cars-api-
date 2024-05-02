<?php

declare(strict_types=1);

use Slim\Factory\AppFactory;
use Vanier\Api\Middleware\ContentNegotiationMiddleware;
use Vanier\Api\Middleware\JWTAuthMiddleware;


define('APP_BASE_DIR',  __DIR__);

//*App's logs 
define('APP_LOGS_DIR',  'logs/');
define('APP_ACCESS_LOGS_FILE',  'access.log');
define('APP_ERROR_LOGS_FILE',  'error.log');


//! This file must be excluded in your .gitignore file. 
define('APP_ENV_FILE', 'config.env');
define('APP_JWT_TOKEN_KEY', 'APP_JWT_TOKEN');

require APP_BASE_DIR . '/vendor/autoload.php';
// require __DIR__ . '/vendor/autoload.php';


// Include the file that contains the application's global configuration settings,
// database credentials, etc.
require_once APP_BASE_DIR . '/app/Config/app_config.php';

//--Step 1) Instantiate a Slim app.
$app = AppFactory::create();

//TODO: Add the middleware here.
$app->addBodyParsingMiddleware();
$app->addRoutingMiddleware();
//$app->add(new ContentNegotiationMiddleware());

//!NOTE: the error handling middleware MUST be added last.
$errorMiddleware = $app->addErrorMiddleware(true, true, true);
$errorMiddleware->getDefaultErrorHandler()->forceContentType(APP_MEDIA_TYPE_JSON);

//TODO: change the name of the subdirectory here.
// You also need to change it in .htaccess
$app->setBasePath("/cars-api");

// Include the file that contains the application routes. 
//* NOTE: your routes must be managed in the api_routes.php file.
require_once APP_BASE_DIR . '/app/Routes/app_routes.php';

// Run the app.
$app->run();
