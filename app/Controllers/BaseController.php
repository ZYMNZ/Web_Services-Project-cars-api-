<?php

declare(strict_types=1);

namespace Vanier\Api\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Vanier\Api\Exceptions\HttpInvalidInputException;
use Vanier\Api\Helpers\LoggerHelper;

abstract class BaseController
{
    public string $resource_name;
    public function __construct()
    {
        $class_name = basename(get_class($this)); #basename: without the file path
        $this->resource_name = strtolower((str_replace('Controller', '', $class_name))); #formats resource name
        $this->correctResourceName(); # corrects it if necessary
    }

    protected function makeResponse(Response $response, array $data, int $status_code = 200): Response
    {
        // var_dump($data);
        $json_data = json_encode($data);
        //-- Write JSON data into the response's body.        
        $response->getBody()->write($json_data);
        return $response->withStatus($status_code)->withAddedHeader(HEADERS_CONTENT_TYPE, APP_MEDIA_TYPE_JSON);
    }
    protected function assertIdFormat($request, $id, $pattern): void
    {
        if (preg_match($pattern, $id) === 0) {
//            $error_log = LoggerHelper::errorLogger();
//            $error_log->error("Unable to process the request: invalid $this->resource_name id format");
            throw new HttpInvalidInputException(
                $request,
                "Unable to process the request: invalid $this->resource_name id format"
            );
        }
    }
    protected function assertIdExists($request, $data): void
    {
        if (!$data[$this->resource_name]) {
//            $error_log = LoggerHelper::errorLogger();
//            $error_log->error("The supplied $this->resource_name id is not valid!");
            throw new HttpInvalidInputException(
                $request,
                "The supplied $this->resource_name id is not valid!"
            );
        }
    }
    private function correctResourceName(): void
    {
        $this->resource_name = $this->resource_name === 'matche' ? 'match' : $this->resource_name;
    }
}
