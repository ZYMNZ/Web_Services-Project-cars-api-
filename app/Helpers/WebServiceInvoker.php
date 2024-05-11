<?php
namespace Vanier\Api\Helpers;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class WebServiceInvoker
{
    private array $client_options = [];

    public function __construct($options = []){
        $this->client_options = $options;

    }

    /**
     * @throws GuzzleException
     */
    public function invokeURI(string $resource_uri) : mixed{
        $client = new Client($this->client_options);
        $response = $client->get($resource_uri);

        if($response->getStatusCode() !== 200){
            return $this->returnError(
                $response->getStatusCode(),
                $response->getReasonPhrase(),
            );
        }
        $resource_data = $response->getBody()->getContents();
        if(empty($resource_data)){
            return $this->returnError(
                'Error',
                'Empty response received!',
            );
        }
        $cars = json_decode($resource_data);
        $parsed_cars = array();
        //THIS IS JUST A DEFAULT STRUCTURE (MIGHT BE CHANGED ACCORDING TO THE *API*)
        foreach($cars as $key => $cars){
            //WE NEED TO DECIDE WHICH PROPERTIES TO DISPLAY!

        }
        return $parsed_cars;
    }
    private function  returnError($code, $message):array{
        return array(
            "code"=> $code,
            "message"=> $message,
        );
    }
}