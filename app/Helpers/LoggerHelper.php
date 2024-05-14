<?php

namespace Vanier\Api\Helpers;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class LoggerHelper
{
    public function __construct()
    {

    }

    public static function accessLogger(): Logger
    {
        $access_logger = new Logger("access");
        $access_logger->pushHandler(new StreamHandler(APP_LOGS_DIR.APP_ACCESS_LOGS_FILE, Logger::INFO));
        return $access_logger;
    }

    public static function errorLogger(): Logger
    {
        $error_logger = new Logger('error');
        $error_logger->pushHandler(new StreamHandler(APP_LOGS_DIR.APP_ERROR_LOGS_FILE, Logger::ERROR));
        return $error_logger;
    }

}