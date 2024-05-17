<?php

namespace Vanier\Api\Helpers;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class LoggerHelper
{
    public function __construct()
    {

    }

    public static function accessLogger($request): Logger
    {
        $client_ip = $_SERVER["REMOTE_ADDR"];
        $method = $request->getMethod();
        $uri = $request->getUri()->getPath();
        $log_record = $client_ip. ' ' .$method. ' '. $uri;

        $access_logger = new Logger("access");

        $extras = $request->getQueryParams();
        $access_logger->info($log_record,$extras);
        $access_logger->pushHandler(new StreamHandler(APP_LOGS_DIR.APP_ACCESS_LOGS_FILE, Logger::INFO));
        return $access_logger;
    }

    public static function errorLogger($request): Logger
    {
        $client_ip = $_SERVER["REMOTE_ADDR"];
        $method = $request->getMethod();
        $uri = $request->getUri()->getPath();
        $log_record = $client_ip. ' ' .$method. ' '. $uri;

        $error_logger = new Logger('error');

        $extras = $request->getQueryParams();
        $error_logger->error($log_record,$extras);

        $error_logger->pushHandler(new StreamHandler(APP_LOGS_DIR.APP_ERROR_LOGS_FILE, Logger::ERROR));
        return $error_logger;
    }

}